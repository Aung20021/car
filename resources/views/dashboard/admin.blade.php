<x-app-layout>

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
  rel="stylesheet"
/>

  <style>

/* Style for the modal image to make it larger */
.modal-body {
          text-align: center;
          max-width: 100%;
          max-height: 85vh; /* Increase max height */
          overflow: auto;
        }

        #fullImage {
          width: 100%; /* Make the image take full width */
          height: auto; /* Maintain aspect ratio */
          max-height: 90vh; /* Increase max height of the image */
        }

        /* Make the modal larger */
        .modal-dialog {
          max-width: 50%; /* Increase modal width */
          margin: 5% auto; /* Center the modal vertically and horizontally */
        }

.cube {

width: 100%;
height: 100%;
position: relative;
transform-style: preserve-3d;
transform: rotateY(0deg); /* Initial rotation */
transition: transform 1s ease-in-out;
}

    /* Card group styles */
    .card-group {
      display: flex;
      flex-direction: column; /* Vertical stacking by default */
      gap: 1rem; /* Space between cards */
    }


 /* Container for the rectangular block */
 .cube-container {
    width: 250px; /* Width to maintain 16:9 aspect ratio */
height: 140.625px; /* Desired height */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(125px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(125px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(125px);
      }
      .right {
        transform: rotateY(90deg) translateZ(125px);
      }

.rotation-controls {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  justify-content: space-between;
  width: 100%;
  z-index: 10;
}

.rotation-controls .btn {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  font-size: 20px;
  cursor: pointer;
}

.rotation-controls .btn:hover {
  background-color: rgba(0, 0, 0, 0.8);
}


@media (min-width: 500px) {

 /* Container for the rectangular block */
 .cube-container {
    width: 350px; /* Width to maintain 16:9 aspect ratio */
height: 196.875px; /* Desired height */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(175px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(175px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(175px);
      }
      .right {
        transform: rotateY(90deg) translateZ(175px);
      }

}


@media (min-width: 768px) {

 /* Container for the rectangular block */
 .cube-container {
    width: 450px; /* Width to maintain 16:9 aspect ratio */
height: 253.125px; /* Desired height */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(225px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(225px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(225px);
      }
      .right {
        transform: rotateY(90deg) translateZ(225px);
      }


}


@media (min-width: 1000px) {

 /* Container for the rectangular block */
 .cube-container {
    width: 600px; /* Width to maintain 16:9 aspect ratio */
height: 337.5px; /* Desired height */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
    margin-bottom: 100px;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(300px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(300px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(300px);
      }
      .right {
        transform: rotateY(90deg) translateZ(300px);
      }


}






    @media (min-width: 1200px) {


 /* Container for the rectangular block */
 .cube-container {
    width: 400px; /* Width to maintain 16:9 aspect ratio */
height: 225px; /* Desired height */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(200px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(200px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(200px);
      }
      .right {
        transform: rotateY(90deg) translateZ(200px);
      }

      /* Horizontal layout for medium screens and above */
      .card-group {
        flex-direction: row;
        justify-content: space-between;
      }
}

    /* Ensure images scale properly within cards */
    .card-img-top {
      object-fit: cover;
      aspect-ratio: 16 / 9; /* Maintain 16:9 ratio for images */
    }



.cube-face {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    border-radius: 5px;
}


.cube-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}

  </style>
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
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ Auth::user()->role === 'admin' ? __('Admin Dashboard') : __('User Dashboard') }}
    </h2>
  </x-slot>

  <nav class="justify-content-center my-5">
    <div class="nav nav-pills justify-content-center" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
        Approve Post
      </button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
         Manage user
      </button>
      <button class="nav-link" id="nav-reported-tab" data-bs-toggle="tab" data-bs-target="#nav-reported" type="button" role="tab" aria-controls="nav-reported" aria-selected="false">
        Reported Post
    </button>
    </div>
  </nav>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in as Admin!") }}


          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="container">
                    <h1 class="mb-4">Admin Dashboard - Car Posts</h1>


                    <!-- Card Group Example -->
                    <div class="container">


                        <!-- Dynamic Card Groups -->
                        @forelse ($cars as $car)
                        <div class="card-group mb-4">
                            <!-- Card 1: Image -->
                            <div class="card cubecard my-5">
                                <div class="card-body">
                                    <!-- Cube Container -->
                                    <div class="cube-container">
                                        <!-- Cube -->
                                        <div class="cube">
                                            @php
                                            $photos = $car->photos; // Array of photo paths for the current car
                                        @endphp
                                            <!-- Front Face -->
                                            <div
                                                class="cube-face front"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                data-image="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}"
                                            >
                                                <img
                                                    src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}"
                                                    alt="Front"
                                                    class="cube-image"
                                                />
                                            </div>

                                            <!-- Back Face -->
                                            <div
                                                class="cube-face back"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                data-image="{{ isset($photos[1]) ? asset('storage/' . $photos[1]) : '/default_back.png' }}"
                                            >
                                                <img
                                                    src="{{ isset($photos[1]) ? asset('storage/' . $photos[1]) : '/default_back.png' }}"
                                                    alt="Back"
                                                    class="cube-image"
                                                />
                                            </div>

                                            <!-- Left Face -->
                                            <div
                                                class="cube-face left"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                data-image="{{ isset($photos[2]) ? asset('storage/' . $photos[2]) : '/default_left.png' }}"
                                            >
                                                <img
                                                    src="{{ isset($photos[2]) ? asset('storage/' . $photos[2]) : '/default_left.png' }}"
                                                    alt="Left"
                                                    class="cube-image"
                                                />
                                            </div>

                                            <!-- Right Face -->
                                            <div
                                                class="cube-face right"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                data-image="{{ isset($photos[3]) ? asset('storage/' . $photos[3]) : '/default_right.png' }}"
                                            >
                                                <img
                                                    src="{{ isset($photos[3]) ? asset('storage/' . $photos[3]) : '/default_right.png' }}"
                                                    alt="Right"
                                                    class="cube-image"
                                                />
                                            </div>
                                        </div>

                                        <!-- Rotation Controls -->
                                       <!-- Rotation Controls -->
                                <div class="rotation-controls">
                                    <button id="rotateBackward" class="btn">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button id="rotateForward" class="btn">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>

                                    </div>
                                     <!-- Card Header -->
            <div class="card-header ">
                <h5 class="mb-0 text-center">
                    {{ $car->make ?? 'Unknown Make' }}  {{ $car->model ?? 'Unknown Model' }} ({{ $car->year ?? 'Unknown Year' }})
                </h5>
            </div>
                                    <table class="table table-striped mt-5" style="margin-top: 80px">
                                        <tbody>
                                            <tr>
                                                <th>Make</th>
                                                <td> {{ $car->make ?? 'Unknown Make' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Model</th>
                                                <td> {{ $car->model ?? 'Unknown Model' }} </td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>{{ $car->year ?? 'Unknown Year' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mileage</th>
                                                <td><div class="d-flex justify-content-between">{{ $car->mileage ?? 'N/A' }} <span>Miles</span> </div></td>
                                            </tr>
                                            <tr>
                                                <th>Fuel Type</th>
                                                <td>{{ $car->fuel_type ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Transmission</th>
                                                <td>{{ $car->transmission ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Engine Size</th>
                                                <td><div class="d-flex justify-content-between">{{ $car->engine_size ?? 'N/A' }} <span>inches</span> </div></td>
                                            </tr>
                                            <tr>
                                                <th>Engine Power</th>
                                                <td><div class="d-flex justify-content-between">{{ $car->engine_power ?? 'N/A' }} <span>hp</span></div></td>
                                            </tr>
                                            <tr>
                                                <th>Body Type</th>
                                                <td>{{ $car->body_type ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>VIN</th>
                                                <td>{{ $car->vin ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Insurance Status</th>
                                                <td>{{ $car->insurance_status ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Warranty Status</th>
                                                <td>{{ $car->warranty_status ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tire Condition</th>
                                                <td>{{ $car->tire_condition ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mechanical Health</th>
                                                <td>{{ $car->mechanical_health ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td>
                                                    <div class="d-flex justify-content-between">{{ isset($car->price) ? number_format($car->price, 2) : 'N/A' }}<span>USD</span></div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <!-- Card 2: Video, Photos, Header, and Table -->
                            <div class="card my-5">
                                <!-- Video -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    @if($car->video_walkaround)
            <div
              style="

                background-color: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                border: 2px dashed #007bff;
              "
            >
              <video
                autoplay
                loop
                controls
                muted
                style="width: 100%; height: 100%; object-fit: contain"
              >
                <source
                  src="{{ asset('storage/' . $car->video_walkaround) }}"
                  type="video/mp4"
                />
                Your browser does not support the video tag.
              </video>
            </div>
            @else
            <p>Video not available for this car.</p>
            @endif

                                </div>

                                <!-- Row for 3 Photos -->
                                <!-- Row for 3 Photos -->
        <div class="row mt-3 px-3">
            <div class="col-4">
              <div class="embed-responsive embed-responsive-16by9" data-bs-toggle="modal" data-bs-target="#imageModal">
                <img
                  src="{{ isset($photos[4]) ? asset('storage/' . $photos[4]) : '/photo4.png' }}"
                  class="embed-responsive-item modal-trigger"
                  alt="Photo 4"
                  data-image="{{ isset($photos[4]) ? asset('storage/' . $photos[4]) : '/photo4.png' }}"
                />
              </div>
            </div>
            <div class="col-4">
              <div class="embed-responsive embed-responsive-16by9" data-bs-toggle="modal" data-bs-target="#imageModal">
                <img
                  src="{{ isset($photos[5]) ? asset('storage/' . $photos[5]) : '/photo5.png' }}"
                  class="embed-responsive-item modal-trigger"
                  alt="Photo 5"
                  data-image="{{ isset($photos[5]) ? asset('storage/' . $photos[5]) : '/photo5.png' }}"
                />
              </div>
            </div>
            <div class="col-4">
              <div class="embed-responsive embed-responsive-16by9" data-bs-toggle="modal" data-bs-target="#imageModal">
                <img
                  src="{{ isset($photos[6]) ? asset('storage/' . $photos[6]) : '/photo6.png' }}"
                  class="embed-responsive-item modal-trigger"
                  alt="Photo 6"
                  data-image="{{ isset($photos[6]) ? asset('storage/' . $photos[6]) : '/photo6.png' }}"
                />
              </div>
            </div>
          </div>

                                <!-- Header and Table -->
                                <div class="card-header mt-3 text-center">
                                    <h5>More Details</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Seller Name</th>
                                                <td>{{ $car->seller_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>{{ $car->location ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact Information</th>
                                                <td>{{ $car->contact_information ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td> {{ $car->make ?? 'Unknown Make' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Model</th>
                                                <td> {{ $car->model ?? 'Unknown Model' }} </td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>{{ $car->year ?? 'Unknown Year' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registration Details</th>
                                                <td>{{ $car->registration_details ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Test Drive Availability</th>
                                                <td>{{ $car->test_drive_availability ?? 'N/A' }}</td>
                                            </tr>
                                            @if(!empty($car->test_drive_availability) && $car->test_drive_availability == 'Yes')
                                            <tr>
                                                <th>Test Drive Start Date</th>
                                                <td>{{ $car->test_drive_start ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Test Drive End Date</th>
                                                <td>{{ $car->test_drive_end ?? 'N/A' }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>


                                </div>
                                        <!-- Approve or Reject Buttons -->
                @if($car->status === 'pending')


                                <div class="card-footer d-flex justify-content-between">
                                    <!-- Approve Button -->
        <form  action="{{ route('cars.updateStatus', ['id' => $car->id, 'status' => 'approved']) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Indicate that this is a PUT request -->
            <button type="submit" class="btn btn-success">Approve</button>
        </form>

           <!-- Reject Button -->
           <button id="reject-btn-{{ $car->id }}" type="button" class="btn btn-danger mt-2" onclick="toggleRejectionForm({{ $car->id }})">Reject</button>

           <!-- Rejection Form (Hidden initially) -->
           <form id="reject-form-{{ $car->id }}" action="{{ route('cars.updateStatus', ['id' => $car->id, 'status' => 'rejected']) }}" method="POST" class="mt-2" style="display: none;">
               @csrf
               @method('PUT')

               <div class="form-group">
                   <label for="rejection_reason">Reason for Rejection</label>
                   <textarea id="rejection_reason" name="rejection_reason" class="form-control" rows="3" required></textarea>
               </div>

               <button type="submit" class="btn btn-danger mt-2">Reject</button>

               <!-- Cancel Button -->
               <button type="button" class="btn btn-secondary mt-2" onclick="cancelRejectionForm({{ $car->id }})">Cancel</button>
           </form>
                                </div>
                                @endif
                            </div>
                        </div>

                        @empty
                            <p>No cars available at the moment.</p>
                        @endforelse
                    </div>


                    <!-- Add additional card groups here -->
                  </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <form method="GET" action="{{ route('dashboard.admin') }}" class="mb-4">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name or email"
                            value="{{ $searchQuery ?? '' }}">
                        <input type="hidden" name="activeTab" value="nav-profile"> <!-- Added activeTab -->
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Users Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @if($user->role !== 'admin') <!-- Check if the user is not an admin -->
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE') <!-- Method spoofing for PUT -->
                                            <input type="hidden" name="activeTab" value="nav-profile">
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.promoteToAdmin', $user->id) }}" style="display:inline;">
                                            @csrf
                                            @method('PUT') <!-- Method spoofing for PUT -->
                                            <input type="hidden" name="activeTab" value="nav-profile">
                                            <button class="btn btn-success btn-sm" type="submit">Promote to Admin</button>
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <!-- Optionally, you can add a row indicating this user is an admin, if needed -->
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>No actions available</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="nav-reported" role="tabpanel" aria-labelledby="nav-reported-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Car Name</th>
                            <th>Reported By</th>
                            <th>Reason</th>
                            <th>Reported On</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportedCars as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $report->car->make }}

                                </td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                <td><a href="{{ route('car.show', $report->car->id) }}" class="text-decoration-none">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
<<!-- Modal for displaying the full image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="fullImage" src="" alt="Full Image" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
document.querySelectorAll(".cube").forEach((cube, index) => {
    let rotationY = 0;
    let autoRotateInterval;
    let isAutoRotating = false;
    let stopAutoRotationTimeout;

    // Function to rotate the cube based on the current rotationY angle
    function rotateCube() {
        cube.style.transform = `rotateY(${rotationY}deg)`;
    }

    // Function to start the automatic rotation of the cube
    function startAutoRotation() {
        if (isAutoRotating) return;

        isAutoRotating = true;
        autoRotateInterval = setInterval(() => {
            rotationY += 90;
            rotateCube();
        }, 3000); // Cube rotates every 3 seconds
    }

    // Function to stop auto-rotation temporarily and restart after a delay
    function stopAutoRotationTemporarily() {
        clearInterval(autoRotateInterval);
        isAutoRotating = false;

        clearTimeout(stopAutoRotationTimeout);
        stopAutoRotationTimeout = setTimeout(() => {
            startAutoRotation();
        }, 5000); // Restart auto-rotation after 5 seconds of inactivity
    }

    // Initialize auto-rotation for each cube
    startAutoRotation();

     // Add event listeners to control buttons within the same scope for each card
  const rotateBackwardBtn = cube.closest('.cubecard').querySelector('#rotateBackward');
  const rotateForwardBtn = cube.closest('.cubecard').querySelector('#rotateForward');

  if (rotateBackwardBtn) {
    rotateBackwardBtn.addEventListener('click', () => {
      rotationY -= 90;
      rotateCube();
      stopAutoRotationTemporarily();
    });
  }

  if (rotateForwardBtn) {
    rotateForwardBtn.addEventListener('click', () => {
      rotationY += 90;
      rotateCube();
      stopAutoRotationTemporarily();
    });
  }
});

// JavaScript to update the modal image source when a cube face or new photo is clicked
document.querySelectorAll(".cube-face, .modal-trigger").forEach((element) => {
  element.addEventListener("click", function () {
    const imageUrl = element.getAttribute("data-image");
    document.getElementById("fullImage").setAttribute("src", imageUrl);
  });
});

function toggleRejectionForm(carId) {
        const form = document.getElementById('reject-form-' + carId);
        const button = document.getElementById('reject-btn-' + carId);

        // Toggle the form visibility
        form.style.display = form.style.display === 'block' ? 'none' : 'block';

        // Hide the "Reject" button after it's clicked
        button.style.display = 'none';
    }

    function cancelRejectionForm(carId) {
        const form = document.getElementById('reject-form-' + carId);
        const button = document.getElementById('reject-btn-' + carId);

        // Hide the rejection form and show the "Reject" button again
        form.style.display = 'none';
        button.style.display = 'inline-block'; // Show the "Reject" button again
    }
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('activeTab') || 'nav-home'; // Default tab is 'nav-home'

        // Activate the tab
        const tabButton = document.querySelector(`[data-bs-target="#${activeTab}"]`);
        if (tabButton) {
            tabButton.click();
        }
    });
</script>
</x-app-layout>
