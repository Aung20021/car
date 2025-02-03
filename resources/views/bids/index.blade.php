<x-app-layout>


    <style>
        /* Style for nav links */
   .nav-link {
       text-decoration: none; /* Remove underline */
       color: black;          /* Set text color to black */
   }

   /* Optional: Change color on hover for better UX */
   .nav-link:hover {
       color: rgb(59, 52, 52);
       text-decoration: underline wavy;
       cursor: pointer; /* Optional hover effect */
   }

   /* Optional: Set active link color */
   .nav-link.active {
       color: black; /* Ensure active link remains black */
       font-weight: bold; /* Make active link bold */
   }
       .form-control{
           width: 100%;
           max-width: 140px;
       }
       .photo-container {
           width: 100%;
           max-width: 150px; /* Adjust width for large screens */
           aspect-ratio: 16 / 9; /* Ensures 16:9 ratio */
           overflow: hidden;
           position: relative;
           border-radius: 8px; /* Rounded corners */
           box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
           background: #f8f9fa; /* Light background for missing images */
       }

       .photo-container img {
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           object-fit: cover; /* Maintain aspect ratio */
       }

       /* Make the table responsive */
       .table-responsive {
           margin-bottom: 30px;
       }
       .table-responsive tbody tr {
       margin-bottom: 10px; /* Add space between rows */
       background-color: #f8f9fa; /* Optional: Add a background color to the row */
       border-radius: 5px; /* Optional: Round the corners */
       box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional: Add a subtle shadow */
   }
       /* Responsive adjustments for small screens */
       @media (max-width: 768px) {

           .table-responsive tbody td[data-label="Actions"] {
       margin-bottom: 40px; /* Add space at the bottom of the Actions column */
       border-bottom: 1px solid black;
   }
           .table-responsive thead {
       display: none; /* Hide the table header on small screens */
   }

   /* Style for table rows */
   .table-responsive tbody td {
       display: flex;
       flex-direction: row; /* Arrange the content in a row */
       align-items: center; /* Align items in the center vertically */
       padding: 5px 10px; /* Adjust padding to reduce space */
       border-top: 1px solid #ddd;
   }

   /* Add labels before the table data for mobile */
   .table-responsive tbody td::before {
       content: attr(data-label);
       font-weight: bold;
       margin-right: 10px; /* Add some space between label and data */
       text-align: left; /* Ensure label is aligned to the left */
       display: inline-block; /* Keep the label inline */
       width: 40%; /* Limit label width to avoid excess space */
   }

   /* Style the td elements */
   .table-responsive td {
       padding: 5px 10px; /* Reduce padding */
       flex: 1; /* Ensure data takes up the available space */
       border-bottom: 1px solid black;
   }

   /* Ensure the photo container is well-sized and centered */
   .photo-container {
       display: flex; /* Enable flexbox */
       justify-content: center; /* Center the image horizontally */
       align-items: center; /* Center the image vertically */
       max-width: 100px; /* Limit image width */
       margin-right: 10px; /* Space between the photo and data */
   }


   /* Hide the "Photo" column header and data label */
   .table-responsive tbody td[data-label="Photo"]::before {
       display: none; /* Hide the label for 'Photo' */
   }
/* Style for table cells containing photos */
.table-responsive tbody td[data-label="Photo"] {
   display: flex; /* Enable flexbox to align content */
   justify-content: center; /* Center the content horizontally */
   align-items: center; /* Center the content vertically */
   padding: 10px; /* Optional: Adjust padding as needed */
   border-top: 1px solid black;
}
.photo-container {
           width: 100%;
           max-width: 200px; /* Adjust width for large screens */
           aspect-ratio: 16 / 9; /* Ensures 16:9 ratio */
           overflow: hidden;
           position: relative;
           border-radius: 8px; /* Rounded corners */
           box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
           background: #f8f9fa; /* Light background for missing images */
       }

}

   </style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons (Optional for icons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Flash message for success -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
    <!-- Navigation Tabs -->
    <ul class="nav justify-content-center" id="myTabs" role="tablist">
        <!-- First Tab: Appointments for Your Cars -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active"
               id="home-tab"
               data-bs-toggle="tab"
               href="#home"
               role="tab"
               aria-controls="home"
               aria-selected="true">
               Bids on Your Cars
            </a>
        </li>

        <!-- Second Tab: Your Appointments -->
        <li class="nav-item" role="presentation">
            <a class="nav-link "
               id="profile-tab"
               data-bs-toggle="tab"
               href="#profile"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                Your Bids
            </a>
        </li>
    </ul>
            </div>
        </div>
      </div>
    </div>
  <!-- Tab Content -->
  <div class="tab-content" id="myTabContent">
    <!-- Home Tab Content -->
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="container">
            <h2 class="text-center mb-4">Bids on Your Cars</h2>
            @if ($ownedCarBids->isEmpty())
                <p>No bids on your cars yet.</p>
            @else
                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Photo</th>
                                <th>Car</th>
                                <th>Bidder</th>
                                <th>Bid Amount</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ownedCarBids as $bid)
                                <tr class="text-center">
                                    <td data-label="Photo" class="text-center">
                                        @php
                                            $photos = $bid->car->photos ?? [];
                                        @endphp
                                        <div class="photo-container">
                                            <img
                                                src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : asset('default_front.png') }}"
                                                alt="Car Photo"
                                                class="img-fluid"
                                            />
                                        </div>
                                    </td>

                                    <td data-label="Car">{{ $bid->car->make }} {{ $bid->car->model }} ({{ $bid->car->year }})</td>
                                    <td data-label="Bidder">{{ $bid->user->name }}</td>
                                    <td data-label="Bid Amount">${{ number_format($bid->highest_bid, 2) }}</td>
                                    <td data-label="Action">
                                        @if (!$bid->car->is_sold)
                                            <!-- Form to Sell the Car -->
                                            <form action="{{ route('cars.sell', $bid->car->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="buyer_id" value="{{ $bid->user->id }}">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Sell to {{ $bid->user->name }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-secondary">Sold</span>
                                        @endif
                                    </td>
                                    <td data-label="Status">
                                        @if ($bid->car->is_sold)
                                            @php
                                                // Fetch the latest transaction that matches the current car_id and buyer_id for this bid
                                                $transaction = \App\Models\Transaction::where('car_id', $bid->car->id)
                                                 ->where('buyer_id', $bid->user->id) // Match with current bid's buyer_id
                                                 ->latest('created_at') // Order by created_at to get the latest transaction
                                                 ->first();
                                            @endphp

                                            @if ($transaction)


                                                @switch($transaction->status)
                                                    @case('in_process')
                                                        <span class="badge bg-warning text-dark">Transaction in process</span>
                                                        @break
                                                    @case('succeeded')
                                                        <span class="badge bg-success">Transaction successful</span>
                                                        @break
                                                    @case('failed')
                                                        <span class="badge bg-danger">Transaction failed</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">Unknown status</span>
                                                @endswitch
                                            @else
                                                <p>No transaction found for this car.</p>
                                            @endif
                                        @else
                                            <span class="badge bg-primary">Active</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endif
        </div>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container">
            <h2 class="text-center">Your Placed Bids</h2>
            @if ($userBids->isEmpty())
                <p>You have not placed any bids yet.</p>
            @else
            <div class="table-responsive mt-4">
            <table class="table table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Photo</th>
                        <th>Car</th>
                        <th>Owner</th>
                        <th>Highest Bid</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userBids as $bid)
                        <tr class="text-center">
                            <td data-label="Photo" class="text-center">
                                @php
                                    $photos = $bid->car->photos ?? [];
                                @endphp
                                <div class="photo-container">
                                    <img
                                        src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : asset('default_front.png') }}"
                                        alt="Car Photo"
                                        class="img-fluid"
                                    />
                                </div>
                            </td>
                            <td data-label="Car">{{ $bid->car->make }} {{ $bid->car->model }} ({{ $bid->car->year }})</td>
                            <td data-label="Owner">{{ $bid->car->user->name }}</td>
                            <td data-label="Highest Bid">${{ number_format($bid->highest_bid, 2) }}</td>
                            <td data-label="Status">
                                @if ($bid->car->is_sold && $bid->car->buyer_id == $user->id)
                                    <span class="badge bg-success">You won the bid!</span>
                                @elseif ($bid->car->is_sold)
                                    <span class="badge bg-danger">Sold to another user</span>
                                @else
                                    <span class="badge bg-primary">Active</span>
                                @endif
                            </td>
                            <td data-label="Payment">
                                @if ($bid->car->is_sold && $bid->car->buyer_id == $user->id)
                                    @php
                                        $transaction = \App\Models\Transaction::where('car_id', $bid->car->id)
                                        ->where('buyer_id', $bid->car->buyer_id)
                                         ->latest('created_at')
                                                ->first();
                                    @endphp

                                    @if ($transaction && $transaction->status === 'in_process')
                                    <form action="{{ route('transactions.pay', $transaction->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Pay Now</button>
                                    </form>

                                    @elseif ($transaction && $transaction->status === 'succeeded')
                                        <span class="badge bg-success">Payment Successful</span>
                                    @elseif ($transaction && $transaction->status === 'failed')
                                        <span class="badge bg-danger">Payment Failed</span>
                                    @else
                                        <span class="badge bg-secondary">No Payment Required</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Not Applicable</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>




            @endif
        </div>
        </div>
    </div>
  </div>



        <!-- Section: Cars You Own and Bids on Them -->


        <!-- Section: Your Placed Bids -->

</x-app-layout>
