<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Notifications\WelcomeNewTenantNotification;

class LegacySyncController extends Controller
{
    // 1. CREAR TENANT + USUARIO + EMAIL
    public function createTenant(Request $request)
    {
        $request->validate([
            'name'         => 'required|string',
            'email'        => 'required|email',
            'legacy_id'    => 'required', // ID de Supabase
            'medical_type' => 'nullable|string',
        ]);

        try {
            // DB::transaction asegura que se crea TODO o NADA. 
            // Si falla el envío del correo o el usuario, no se crea el tenant huérfano.
            $result = DB::transaction(function () use ($request) {
                
                // A. Crear la Clínica (Tenant)
                $tenant = Tenant::firstOrCreate(
                    ['legacy_user_id' => $request->legacy_id],
                    [
                        'id'           => (string) Str::uuid(),
                        'name'         => $request->name,
                        'status'       => 'active'
                    ]
                );

                // B. Crear el Usuario Admin
                // Le asignamos una contraseña aleatoria temporal (nadie la sabrá, no importa)
                $user = User::firstOrCreate(
                    ['email' => $request->email],
                    [
                        'name'      => $request->name,
                        'password'  => Hash::make(Str::random(32)), 
                        'tenant_id' => $tenant->id,
                        'legacy_id' => $request->legacy_id,
                    ]
                );

                // C. Enviar Notificación (Solo si es nuevo)
                if ($user->wasRecentlyCreated) {
                    $user->notify(new WelcomeNewTenantNotification());
                }

                return [
                    'tenant_id' => $tenant->id,
                    'user_id'   => $user->id
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 2. VINCULAR CANAL (WhatsApp/IG)
    public function syncChannel(Request $request)
    {
        $request->validate([
            'laravel_tenant_id' => 'required|exists:tenants,id',
            'channel_type'      => 'required|in:whatsapp,instagram,facebook',
            'external_id'       => 'required',
            'display_name'      => 'required',
            'tokens'            => 'required|array',
        ]);

        $channel = Channel::updateOrCreate(
            ['external_id' => $request->external_id, 'channel' => $request->channel_type],
            [
                'tenant_id'    => $request->laravel_tenant_id,
                'display_name' => $request->display_name,
                'meta'         => $request->tokens,
                'is_active'    => true
            ]
        );

        return response()->json(['success' => true, 'id' => $channel->id]);
    }

    // 3. DESVINCULAR CANAL
    public function removeChannel(Request $request)
    {
        $request->validate(['external_id' => 'required']);
        
        Channel::where('external_id', $request->external_id)
               ->update(['is_active' => false]);

        return response()->json(['success' => true]);
    }
}