<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Car Portal') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }

            .content {
                min-height: calc(100vh - 60px);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                text-align: center;
                padding: 20px;
            }

            .image-section img {
                width: 100%;
                height: auto;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            }

            .image-section img:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .car-card {
                text-align: center;
                transition: transform 0.3s ease-in-out;
            }

            .car-card:hover {
                transform: translateY(-5px);
            }

            footer {
                background-color: #333;
                color: white;
                text-align: center;
                padding: 10px 0;
                position: relative;
                width: 100%;
            }
        </style>
    </head>
    <body>
        @include('layouts.navigation')

        <div class="content">
            <div class="container">
                <h1 class="mb-4">Welcome to the Car Portal</h1>
                <p>Explore various car listings and find the perfect vehicle for you!</p>

                <!-- Image Section -->
                <div class="image-section">
                    <h2 class="mb-4">Featured Cars</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('cars.index') }}" class="text-decoration-none">
                                <div class="car-card">
                                    <img src="{{ asset('images/car1.png') }}" alt="Car 1">
                                    <p class="mt-2 fw-bold">Car 1 - Amazing performance.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cars.index') }}" class="text-decoration-none">
                                <div class="car-card">
                                    <img src="{{ asset('images/car2.png') }}" alt="Car 2">
                                    <p class="mt-2 fw-bold">Car 2 - Sleek and efficient.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cars.index') }}" class="text-decoration-none">
                                <div class="car-card">
                                    <img src="{{ asset('images/car3.png') }}" alt="Car 3">
                                    <p class="mt-2 fw-bold">Car 3 - Reliable and affordable.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Additional Content -->
                <div class="mt-5">
                    <h2>Why Choose Our Car Portal?</h2>
                    <p>Find the best deals on trusted and verified car listings.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Car Portal. All rights reserved.</p>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
