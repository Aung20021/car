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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
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
            Appointments for Your Cars
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
            Your Appointments
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
        <div class="container"> <h2 class="text-center mb-4">Appointments for Your Cars</h2>
            @if($ownedCarAppointments->isEmpty())
                <p class="text-muted text-center">No appointments for your cars.</p>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Photo</th>
                            <th>Car</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ownedCarAppointments as $appointment)
                            <tr>
                                <td data-label="Photo" class="text-center ">
                                    @php
                                        $photos = $appointment->car->photos ?? [];
                                    @endphp
                                    <div class="photo-container ">
                                        <img
                                            src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}"
                                            alt="Front Photo"
                                            class="img-fluid"
                                        />
                                    </div>
                                </td>
                                <td data-label="Car" class="fw-bold text-center">{{ $appointment->car->make }} {{ $appointment->car->model }}</td>
                                <td data-label="User" class="text-center">{{ $appointment->user->name }}</td>
                                <td data-label="Date" class="text-center">{{ $appointment->appointment_date }}</td>
                                <td data-label="Time" class="text-center">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                <td data-label="Status" class="text-center">
                                    @if($appointment->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($appointment->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($appointment->status === 'declined')
                                        <span class="badge bg-danger">Declined</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($appointment->status) }}</span>
                                    @endif
                                </td>
                                <td data-label="Actions" class="text-center">
                                    @if($appointment->status === 'pending')
                                        <form action="{{ route('test-drives.update-status', $appointment->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-outline-success me-3">Approve</button>
                                        </form>
                                        <form action="{{ route('test-drives.update-status', $appointment->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="declined">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">No Action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif</div>
    </div>

    <!-- Profile Tab Content -->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <div class="container">
        <h2 class="text-center mb-4">Your Appointments</h2>
        @if($userAppointments->isEmpty())
        <div class="text-center mt-4">
            <p class="text-muted fs-5">You have no appointments booked.</p>
        </div>
    @else
    <div class="table-responsive mt-4">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Photo</th> <!-- New Photo column -->
                    <th>Car</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userAppointments as $appointment)
                    <tr>
                        <td data-label="Photo" class="text-center ">
                            @php
                                $photos = $appointment->car->photos ?? [];
                            @endphp
                            <div class="photo-container ">
                                <img
                                    src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}"
                                    alt="Front Photo"
                                    class="img-fluid"
                                />
                            </div>
                        </td>
                        <td data-label="Car">
                            {{ $appointment->car->make }} {{ $appointment->car->model }}
                        </td>
                        <td data-label="Date">
                            <form action="{{ route('test-drives.update', $appointment->id) }}" method="POST" id="editForm-{{ $appointment->id }}">
                                @csrf
                                @method('PUT')
                                <input type="date" name="appointment_date" value="{{ $appointment->appointment_date }}" class="form-control" required>
                        </td>
                        <td data-label="Time">
                            <input type="time" name="appointment_time"
                                value="{{ \Carbon\Carbon::createFromFormat('H:i:s', $appointment->appointment_time)->format('H:i') }}"
                                class="form-control" required>
                        </td>
                        <td data-label="Status">
                            <span class="badge {{ $appointment->status === 'approved' ? 'bg-success' : ($appointment->status === 'declined' ? 'bg-danger' : 'bg-secondary') }}">
                                {{ ucfirst($appointment->status) ?? 'Pending' }}
                            </span>
                        </td>
                        <td data-label="Actions">
                            <!-- Disable the update button if status is approved -->
                            <button type="submit" class="btn btn-sm btn-primary me-4" @if($appointment->status === 'approved') disabled @endif>Update</button>
                            </form>

                            <form action="{{ route('test-drives.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <!-- Disable the cancel button if status is approved -->
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                        @if($appointment->status === 'approved') disabled @endif>
                                    Cancel
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @endif
       </div>
    </div>
  </div>










</x-app-layout>
