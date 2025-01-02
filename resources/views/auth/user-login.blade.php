<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyJo - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/journeyjo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');

        :root {
            --primary-color: #C77943;
            --primary-light: rgba(199, 121, 67, 0.1);
            --primary-dark: #9f5f2a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }

        body {
            min-height: 100vh;
            background: url('/api/placeholder/1920/1080') center/cover fixed;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
                    rgba(199, 121, 67, 0.8),
                    rgba(150, 75, 0, 0.9),
                    rgba(255, 255, 255, 1));
            animation: gradientShift 15s ease infinite;
            z-index: 0;
        }


        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .form {
            width: 100%;
            max-width: 1200px;
            min-height: 600px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .formBx,
        .imgBx {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .formBx {
            background: url('/api/placeholder/400/600') right/cover;
            position: relative;
        }

        .formBx::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .form-content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
            text-align: left;
        }

        .input-group label {
            display: block;
            color: #555;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #eee;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s ease;
            text-align: left;
        }

        .input-group input:focus {
            border-color: var(--primary-color);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 45px;
            color: var(--primary-color);
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            background: var(--primary-color);
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
        }

        .social-login {
            margin-top: 30px;
            text-align: center;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary-color);
            font-size: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            background: var(--primary-color);
            color: white;
        }

        .imgBx {
            background: var(--primary-color);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .welcome-text {
            position: relative;
            z-index: 1;
        }

        .welcome-text h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-icon {
            position: absolute;
            animation: float 20s linear infinite;
            color: rgba(255, 255, 255, 0.3);
            font-size: 24px;
        }

        @keyframes float {
            0% {
                transform: translate(0, 100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translate(0, -100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 1024px) {
            .form {
                max-width: 900px;
            }
        }

        @media (max-width: 768px) {
            .form {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .imgBx {
                display: none;
            }

            .formBx {
                padding: 30px;
            }

            .logo {
                font-size: 20px;
            }

            .welcome-text h2 {
                font-size: 2em;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .form {
                border-radius: 20px;
            }

            .formBx {
                padding: 20px;
            }

            .input-group input {
                padding: 12px 12px 12px 40px;
            }

            .social-icons {
                gap: 10px;
            }

            .social-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form">
            <div class="formBx">
                <div class="form-content">
                    <div class="logo">
                        <i class="fas fa-compass"></i>
                        JourneyJo
                    </div>
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                            <i class="fas fa-lock"></i>
                        </div>
                        <button type="submit" class="submit-btn">
                            Login
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                        <div class="social-login">
                            <div style="margin-top: 20px">
                                <p>Don't have an account? <a href="{{ route('user.register') }}"
                                        style="color: var(--primary-color); font-weight: bold;">Sign up now</a></p>
                            </div>
                        </div>
                        <div class="social-login">
                            <div>
                                <p>Go to <a href="{{ route('public.index') }}"
                                        style="color: var(--primary-color); font-weight: bold;">Home</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="imgBx">
                <div class="welcome-text">
                    <h2>Welcome to JourneyJo</h2>
                    <p>Explore the beautiful tourist destinations in Jordan</p>
                </div>
                <div class="floating-elements"></div>
            </div>
        </div>
    </div>

    <script>
        function createFloatingElements() {
            const icons = [
                'fas fa-plane',
                'fas fa-mountain',
                'fas fa-map-marked-alt',
                'fas fa-compass',
                'fas fa-camera',
                'fas fa-umbrella-beach',
                'fas fa-hiking',
                'fas fa-campground'
            ];

            const container = document.querySelector('.floating-elements');

            setInterval(() => {
                const icon = document.createElement('i');
                const randomIcon = icons[Math.floor(Math.random() * icons.length)];
                icon.className = `floating-icon ${randomIcon}`;
                icon.style.left = `${Math.random() * 100}%`;
                icon.style.animationDuration = `${15 + Math.random() * 10}s`;
                container.appendChild(icon);

                setTimeout(() => {
                    icon.remove();
                }, 20000);
            }, 1000);
        }

        createFloatingElements();
    </script>
</body>

</html>
