<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons (Optional for icons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<style>

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

    .cube {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transform: rotateY(0deg); /* Initial rotation */
      transition: transform 1s ease-in-out;
    }

    /* Card group styles */



 /* Container for the rectangular block */
 .cube-container {
    width: 213.33px; /* Width based on 16:9 ratio for height of 120px */
    height: 120px; /* New height for the container */
    perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
    position: relative;
}


 /* Adjust face positions to form a rectangular block */
      .front {
        transform: translateZ(105px); /* Adjust to half of the container's width */
      }
      .back {
        transform: rotateY(180deg) translateZ(105px);
      }
      .left {
        transform: rotateY(-90deg) translateZ(105px);
      }
      .right {
        transform: rotateY(90deg) translateZ(105px);
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



    @media (min-width: 440px) and (max-width: 559px) {


/* Container for the rectangular block */
.cube-container {
   width: 300px; /* Width based on desired size */
height: 168.75px; /* Height to maintain 16:9 aspect ratio */


   perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
   position: relative;
}


/* Adjust face positions to form a rectangular block */
     .front {
       transform: translateZ(150px); /* Adjust to half of the container's width */
     }
     .back {
       transform: rotateY(180deg) translateZ(150px);
     }
     .left {
       transform: rotateY(-90deg) translateZ(150px);
     }
     .right {
       transform: rotateY(90deg) translateZ(150px);
     }



}

@media (min-width: 560px) and (max-width: 767px) {


/* Container for the rectangular block */
.cube-container {
   width: 400px; /* Width based on desired size */
height: 225px; /* Height to maintain 16:9 aspect ratio */
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



}

@media (min-width: 992px) and (max-width: 1169px) {


/* Container for the rectangular block */
.cube-container {
   width: 177.78px; /* Width to maintain 16:9 aspect ratio */
height: 100px; /* Desired height */
   perspective: 1000px; /* Adds perspective for 3D effect */
margin-left: auto;
margin-right: auto;
   position: relative;
}


/* Adjust face positions to form a rectangular block */
     .front {
       transform: translateZ(88px); /* Adjust to half of the container's width */
     }
     .back {
       transform: rotateY(180deg) translateZ(88px);
     }
     .left {
       transform: rotateY(-90deg) translateZ(88px);
     }
     .right {
       transform: rotateY(90deg) translateZ(88px);
     }


}


@media (max-width: 768px) {
   .upload-square {
       max-width: 100%; /* Make each upload square take full width on small screens */
   }
}


</style>

<div class="container mt-4">

    <!-- Filter Form -->
    <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" name="make" placeholder="Make" value="{{ request('make') }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="model" placeholder="Model" value="{{ request('model') }}">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="year" placeholder="Year" value="{{ request('year') }}">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <!-- Clear button that resets form fields -->
            <div class="col-md-2 mt-2">
                <button type="reset" class="btn btn-secondary w-100" onclick="window.location.href='{{ route('cars.index') }}'">Clear</button>
            </div>
        </div>
    </form>


    <div class="row"> <!-- Add a row for Bootstrap grid -->
        @forelse ($cars as $car)
            <div class="col-12 col-md-6 col-lg-3 mb-3"> <!-- Responsive column -->
                <div class="card cubecard">
                    <div class="card-body">
                        <!-- Cube Container -->
                        <div class="cube-container mb-5">
                            <div class="cube">
                                @php $photos = $car->photos; @endphp
                                <div class="cube-face front" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}">
                                    <img src="{{ isset($photos[0]) ? asset('storage/' . $photos[0]) : '/default_front.png' }}" alt="Front" class="cube-image" />
                                </div>
                                <div class="cube-face back" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ isset($photos[1]) ? asset('storage/' . $photos[1]) : '/default_back.png' }}">
                                    <img src="{{ isset($photos[1]) ? asset('storage/' . $photos[1]) : '/default_back.png' }}" alt="Back" class="cube-image" />
                                </div>
                                <div class="cube-face left" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ isset($photos[2]) ? asset('storage/' . $photos[2]) : '/default_left.png' }}">
                                    <img src="{{ isset($photos[2]) ? asset('storage/' . $photos[2]) : '/default_left.png' }}" alt="Left" class="cube-image" />
                                </div>
                                <div class="cube-face right" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ isset($photos[3]) ? asset('storage/' . $photos[3]) : '/default_right.png' }}">
                                    <img src="{{ isset($photos[3]) ? asset('storage/' . $photos[3]) : '/default_right.png' }}" alt="Right" class="cube-image" />
                                </div>
                            </div>
                        </div>
                        <div class="card-header ">
                            <h5 class="mb-0 text-center">
                                {{ $car->make ?? 'Unknown Make' }}  {{ $car->model ?? 'Unknown Model' }} ({{ $car->year ?? 'Unknown Year' }})
                            </h5>
                        </div>
                        <table class="table table-striped mt-3">
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
                                    <th>Body Type</th>
                                    <td>{{ $car->body_type ?? 'N/A' }}</td>
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
                    <div class="card-footer text-center">
                        <a href="{{ route('car.show', $car->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No cars found matching your criteria.</p>
        @endforelse
    </div>
</div>




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
      const rotateBackwardBtn = cube
        .closest(".cubecard")
        .querySelector("#rotateBackward");
      const rotateForwardBtn = cube
        .closest(".cubecard")
        .querySelector("#rotateForward");

      if (rotateBackwardBtn) {
        rotateBackwardBtn.addEventListener("click", () => {
          rotationY -= 90;
          rotateCube();
          stopAutoRotationTemporarily();
        });
      }

      if (rotateForwardBtn) {
        rotateForwardBtn.addEventListener("click", () => {
          rotationY += 90;
          rotateCube();
          stopAutoRotationTemporarily();
        });
      }
    });


</script>

</x-app-layout>
