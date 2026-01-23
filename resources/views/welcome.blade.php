<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Medica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Paleta de colores MÉDICA (Verde Esmeralda) */
            --primary-green: #0f766e;      /* Verde esmeralda principal */
            --primary-light: #14b8a6;      /* Verde claro para gradiente */
            --blob-accent: #2dd4bf;        /* Verde suave para blobs */

            --white: #ffffff;
            --bg: #f8fdfc;                 /* Fondo blanco verdoso */
            --text-dark: #1f2933;
            --muted-dark: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            height: 100vh;
            overflow: hidden;
        }

        /* ====== BLOBS ====== */
        @keyframes blob {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }

        .blob-minimal {
            position: fixed;
            z-index: 0;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(150px);
            opacity: 0.30;
            mix-blend-mode: multiply;
            animation: blob 7s infinite ease-in-out;
        }

        .blob-minimal.primary {
            background: var(--primary-green);
            top: 15%;
            left: 5%;
        }

        .blob-minimal.accent {
            background: var(--blob-accent);
            bottom: 10%;
            right: 10%;
            animation-delay: 2s;
        }

        /* ====== CONTENIDO ====== */
        .container {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 3.5rem 3rem;
            max-width: 520px;
            width: 100%;
            border: 1px solid rgba(15, 118, 110, 0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            font-size: 2.4rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 0.5rem;
            color: var(--primary-green);
        }

        .subtitle {
            color: var(--muted-dark);
            margin-bottom: 2.5rem;
            font-size: 1.05rem;
        }

        .enter-btn {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-light));
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 600;
            padding: 1.1rem 3rem;
            border-radius: 999px;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 10px 30px rgba(15, 118, 110, 0.4);
        }

        .enter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(15, 118, 110, 0.6);
        }

        .footer {
            margin-top: 2.5rem;
            font-size: 0.85rem;
            color: var(--muted-dark);
        }

        @media (max-width: 640px) {
            .card {
                padding: 2.5rem 2rem;
            }

            .logo {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="blob-minimal primary"></div>
    <div class="blob-minimal accent"></div>

    <div class="container">
        <div class="card">
            <div class="logo">Medica</div>
            <div class="subtitle">
                Servicio médico integral y gestión clínica
            </div>

            <a href="/admin" class="enter-btn">
                Acceder
            </a>

            <div class="footer">
                © <?= date('Y') ?> Medica
            </div>
        </div>
    </div>

</body>
</html>
