<x-app-layout>
      <!-- Bootstrap 5 CDN -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Optional Bootstrap Icons (if needed) -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  </body>
    <style>
        /* Add to public/css/style.css */
h1 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
}

h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #007bff;
}

h3 {
    font-size: 1.75rem;
    color: #28a745;
}

ul li {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.btn-primary {
    font-size: 1.25rem;
    padding: 12px 24px;
    text-transform: uppercase;
}

    </style>
    <div class="container mt-5">
        <!-- Page Title -->
        <h1 class="text-center mb-4">About Us</h1>

        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/car1.png') }}" alt="Used Cars Sales Portal" class="img-fluid rounded shadow-lg">
            </div>

            <!-- Content Section -->
            <div class="col-md-6">
                <h2 class="text-primary">Welcome to Used Cars Sales Portal</h2>
                <p class="lead">We are a trusted marketplace that connects buyers and sellers of pre-owned vehicles. Our platform provides a seamless experience to find, compare, and purchase cars with ease.</p>

                <h3 class="text-success">Why Choose Us?</h3>
                <ul class="list-unstyled">
                    <li>✔️ Verified Sellers & Listings</li>
                    <li>✔️ Wide Selection of Used Cars</li>
                    <li>✔️ Competitive Pricing</li>
                    <li>✔️ Secure Transactions</li>
                    <li>✔️ Fast & Reliable Customer Support</li>
                </ul>

                <p>Our mission is to make car buying and selling simple, secure, and hassle-free. Join thousands of satisfied users today!</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-lg btn-primary shadow-lg">Contact Us</a>
        </div>
    </div>
</x-app-layout>
