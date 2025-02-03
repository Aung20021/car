<x-app-layout>
    <style>
        /* Custom Shadow Effect for Form */
.card {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Button Hover Effect */
.btn-primary:hover {
    background-color: #0069d9;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

    </style>
    <div class="container mt-5">
        <!-- Page Title -->
        <h1 class="text-center mb-4 text-primary">Contact Us</h1>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Contact Form -->
        <div class="card shadow-lg p-4 rounded-lg">
            <form action="{{ route('contact') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="form-label text-secondary">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control shadow-sm" required>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label text-secondary">Your Email</label>
                    <input type="email" name="email" id="email" class="form-control shadow-sm" required>
                </div>

                <!-- Message Field -->
                <div class="mb-4">
                    <label for="message" class="form-label text-secondary">Your Message</label>
                    <textarea name="message" id="message" rows="4" class="form-control shadow-sm" required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg shadow-md px-5">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
