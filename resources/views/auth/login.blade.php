<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyJo - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/journeyjo.png') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(45deg, #C77943, #E5B695);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #E5B695;
            border-radius: 0.5rem;
            outline: none;
            transition: all 0.3s;
            background-color: white;
        }

        .input-group label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;
            padding: 0 0.5rem;
            color: #8B4513;
            transition: all 0.3s;
        }

        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label {
            top: 0;
            font-size: 0.875rem;
            color: #C77943;
        }

        .input-group input:focus {
            border-color: #C77943;
        }

        .login-btn {
            background: linear-gradient(45deg, #C77943, #E5B695);
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(199, 121, 67, 0.4);
        }
    </style>
</head>

<body class="h-screen">
    <div class="flex h-full">
        <!-- Left Side - Illustration -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg items-center justify-center p-12 relative overflow-hidden">
            <div class="text-white z-10 text-center">
                <br><br>
                <h1 class="text-4xl font-bold mb-6 animate-float">Welcome to JourneyJo</h1>
                <p class="text-xl mb-8">Start your journey with us</p>
                <br><br>
                <div class="w-96 h-96 animate-float">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100"
                        style="background-color: #F5D6BE; border-radius:50px;">
                        <!-- Main text -->
                        <text x="70" y="65" font-family="Arial" font-size="45" font-weight="bold"
                            fill="#8B4513">Journey</text>

                        <!-- Animated "Jo" -->
                        <text x="70" y="65" font-family="Arial" font-size="45" font-weight="bold">
                            <tspan id="jo" fill="#8B4513">Jo</tspan>
                            <animate xlink:href="#jo" attributeName="x" from="70" to="242" dur="1s"
                                fill="freeze" />
                            <animate xlink:href="#jo" attributeName="fill" values="#8B4513;#C77943" dur="1s"
                                fill="freeze" />
                        </text>

                        <!-- Journey-themed icon: Compass -->
                        <g transform="translate(20, 20)">
                            <!-- Compass outer circle -->
                            <circle cx="20" cy="40" r="25" fill="none" stroke="#C77943"
                                stroke-width="2" />
                            <!-- Compass inner circle -->
                            <circle cx="20" cy="40" r="3" fill="#8B4513" />
                            <!-- Compass points -->
                            <path d="M20 15 L25 32 L20 38 L15 32 Z" fill="#8B4513" /> <!-- North -->
                            <path d="M20 65 L25 48 L20 42 L15 48 Z" fill="#C77943" /> <!-- South -->
                            <path d="M45 40 L28 45 L22 40 L28 35 Z" fill="#8B4513" /> <!-- East -->
                            <path d="M-5 40 L12 45 L18 40 L12 35 Z" fill="#C77943" /> <!-- West -->
                        </g>
                    </svg>
                </div>
            </div>
            <!-- Decorative circles -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute w-40 h-40 bg-white opacity-10 rounded-full -top-10 -left-10"></div>
                <div class="absolute w-32 h-32 bg-white opacity-10 rounded-full top-1/2 right-10"></div>
                <div class="absolute w-24 h-24 bg-white opacity-10 rounded-full bottom-10 left-1/2"></div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#FDF8F5]">
            <div class="max-w-md w-full space-y-8">
                <div class="text-center">
                    <h2 class="mt-6 text-3xl font-bold text-[#8B4513]">Welcome Back!</h2>
                    <p class="mt-2 text-sm text-[#C77943]">Please sign in to your account</p>
                </div>

                <form class="mt-8 space-y-6" action="{{ route('adminlogin') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <div class="input-group">
                            <input id="email" name="email" type="email" placeholder=" " required>
                            <label for="email">Email address</label>
                        </div>

                        <div class="input-group">
                            <input id="password" name="password" type="password" placeholder=" " required>
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <button type="submit"
                        class="login-btn w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C77943]">
                        Sign in
                    </button>

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[#E5B695]"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-[#FDF8F5] text-[#C77943]">JourneyJo</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fade in animation on load
        document.addEventListener('DOMContentLoaded', () => {
            gsap.from('.max-w-md', {
                duration: 1,
                x: 30,
                opacity: 0,
                ease: 'power3.out'
            });
        });
    </script>
</body>

</html>