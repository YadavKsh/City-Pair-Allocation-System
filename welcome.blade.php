<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>City Pair Slot Allocation System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 50%, #3b82f6 100%);
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.4;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .hero-title {
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.1;
        }
        .section-title {
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .feature-title {
            font-weight: 600;
            letter-spacing: -0.01em;
        }
        .feature-text {
            font-weight: 400;
            letter-spacing: 0.01em;
            line-height: 1.6;
        }
        .nav-text {
            font-weight: 700;
            letter-spacing: 0.01em;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative isolate gradient-bg">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <h1 class="hero-title text-4xl sm:text-6xl mb-8 text-white drop-shadow-lg">
                        City Pair Slot Allocation System
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-100 drop-shadow-md font-light">
                        Optimizing airline schedules with rationalized block times between cities.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="/slots" class="rounded-lg bg-white px-6 py-3 text-lg font-semibold text-indigo-600 shadow-lg hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-all duration-200">
                            View Available Slots
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="bg-gradient-to-b from-gray-50 to-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600 tracking-wider uppercase">About the System</h2>
                    <p class="section-title mt-2 text-3xl sm:text-4xl text-gray-900">
                        Intelligent Flight Slot Management
                    </p>
                    <p class="mt-6 text-lg leading-8 text-gray-600 font-light">
                        This system facilitates intelligent allocation of flight slots between predefined city pairs. It ensures efficient slot usage and reduced congestion using standard block times.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gradient-to-b from-white to-gray-50 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600 tracking-wider uppercase">Key Features</h2>
                    <p class="section-title mt-2 text-3xl sm:text-4xl text-gray-900">
                        Everything you need to manage slots
                    </p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                        <div class="feature-card rounded-xl p-8 transition-all duration-200">
                            <dt class="feature-title flex items-center gap-x-3 text-base leading-7 text-gray-900">
                                <svg class="h-6 w-6 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />
                                </svg>
                                Slot Allocation Between City Pairs
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                <p class="feature-text flex-auto">Efficiently manage and allocate flight slots between different city pairs with our intelligent system.</p>
                            </dd>
                        </div>
                        <div class="feature-card rounded-xl p-8 transition-all duration-200">
                            <dt class="feature-title flex items-center gap-x-3 text-base leading-7 text-gray-900">
                                <svg class="h-6 w-6 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                </svg>
                                Rationalized Block Time Management
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                <p class="feature-text flex-auto">Optimize flight schedules with standardized block times for better resource utilization.</p>
                            </dd>
                        </div>
                        <div class="feature-card rounded-xl p-8 transition-all duration-200">
                            <dt class="feature-title flex items-center gap-x-3 text-base leading-7 text-gray-900">
                                <svg class="h-6 w-6 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                    <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                Airline & Slot Monitoring Dashboard
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                <p class="feature-text flex-auto">Real-time monitoring and management of airline slots through an intuitive dashboard interface.</p>
                            </dd>
                        </div>
                        <div class="feature-card rounded-xl p-8 transition-all duration-200">
                            <dt class="feature-title flex items-center gap-x-3 text-base leading-7 text-gray-900">
                                <svg class="h-6 w-6 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z" clip-rule="evenodd" />
                                </svg>
                                Minimal Manual Intervention
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                <p class="feature-text flex-auto">Automated slot allocation system that reduces the need for manual intervention and human error.</p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gradient-to-b from-gray-900 to-gray-950">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-xs leading-5 text-gray-400 font-light">
                        &copy; 2024 City Pair Slot Allocation System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
