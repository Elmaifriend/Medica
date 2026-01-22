<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


// Ruta firmada: Solo válida si no ha expirado y la firma es correcta
Route::get('/setup-password/{user}', function (Request $request, $user) {
    if (! $request->hasValidSignature()) {
        abort(403, 'Este enlace ya caducó.');
    }

    // AQUI RETORNAS TU VISTA (Blade o React)
    // return view('auth.set-password', ['userId' => $user]);
    
    return "Hola! Aquí iría el formulario para que el usuario ID: $user establezca su nueva contraseña.";

})->name('setup.password');