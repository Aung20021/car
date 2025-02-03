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




 /* Styling the Tab Navigation */
 .nav-pills .nav-link {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    font-size: 1.1rem;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
  }

  .nav-pills .nav-link.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
  }

  .nav-pills .nav-link:hover {
    background-color: #e9ecef;
  }

  .tab-content {
    padding: 20px;
    background-color: #f1f3f5;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .tab-pane {
    display: none;
  }

  .tab-pane.fade.show {
    display: block;
  }

  .bi {
    margin-right: 8px;
  }



.upload-square {
    width: 100%; /* Allow width to adjust based on the container */
        max-width: 300px; /* Limit maximum width to 300px */
        aspect-ratio: 16 / 9; /* Maintain a 16:9 aspect ratio */
        min-width: 200px; /* Minimum width */
        min-height: calc(
          200px * 9 / 16
        ); /* Adjust minimum height to maintain 16:9 ratio */

    border: 2px solid #007bff;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    box-sizing: border-box; /* Include padding and border in total size */
}

.upload-square .upload-text {
    font-size: 16px;
    color: #007bff;
    text-align: center;
}

.upload-square .image-preview {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%; /* Ensure the preview fills the square */
    height: 100%; /* Ensure the preview fills the square */
    display: none; /* Initially hidden */
}

.upload-square .image-preview img {
    width: 100%; /* Scale the image to the container's width */
    height: 100%; /* Scale the image to the container's height */
    object-fit: cover; /* Ensure the image is fully visible without cropping */
    border-radius: inherit; /* Match the square's border radius */
    display: block; /* Remove inline-block spacing issues */
    margin: 0; /* Ensure no extra margin is added */
    padding: 0;
}

.upload-square input[type="file"] {
    display: none; /* Hide the default file input */
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



.video-upload-container {
    position: relative;
    display: inline-block;
}

.video-preview {
    border-radius: 8px;
    cursor: pointer;
}

.video-preview span {
    font-size: 16px;
}


</style>





    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role === 'admin' ? __('Admin Dashboard') : __('User Dashboard') }}
        </h2>

    </x-slot>
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






<!-- Tab Navigation with Bootstrap 5 & Custom Styling -->
<nav class="justify-content-center">
    <div class="nav nav-pills justify-content-center" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
         Post Car
      </button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
         Approved Car
      </button>
      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
       Pending Car
      </button>
      <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">
        Rejected Car
      </button>
    </div>
  </nav>


</div>
</div>





  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

      <!-- Content for Home Tab -->
      <div class="p-0 m-0 g-0">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Create Car Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf



                        <div class="row">
                          <!-- Photo 1 -->
                          <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label for="photo_1" class="form-label">Front Photo</label>
                            <div
                              class="upload-square"
                              onclick="document.getElementById('photo_1').click()"
                            >
                              <input
                                type="file"
                                name="photos[]"
                                id="photo_1"
                                class="form-control"
                                onchange="previewImage(1)"
                              />
                              <div class="upload-text">Click to upload</div>
                              <div class="image-preview" id="image_preview_1">
                                <img
                                  id="preview_1"
                                  src=""
                                  alt="Preview"
                                  class="img-fluid rounded"
                                />
                              </div>
                            </div>
                          </div>

                          <!-- Photo 2 -->
                          <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label for="photo_2" class="form-label">Back Photo</label>
                            <div
                              class="upload-square"
                              onclick="document.getElementById('photo_2').click()"
                            >
                              <input
                                type="file"
                                name="photos[]"
                                id="photo_2"
                                class="form-control"
                                onchange="previewImage(2)"
                              />
                              <div class="upload-text">Click to upload</div>
                              <div class="image-preview" id="image_preview_2">
                                <img
                                  id="preview_2"
                                  src=""
                                  alt="Preview"
                                  class="img-fluid rounded"
                                />
                              </div>
                            </div>
                          </div>

                          <!-- Photo 3 -->
                          <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label for="photo_3" class="form-label">Right Photo</label>
                            <div
                              class="upload-square"
                              onclick="document.getElementById('photo_3').click()"
                            >
                              <input
                                type="file"
                                name="photos[]"
                                id="photo_3"
                                class="form-control"
                                onchange="previewImage(3)"
                                style="display: none"
                              />
                              <div class="upload-text">Click to upload</div>
                              <div class="image-preview" id="image_preview_3" style="display: none">
                                <img
                                  id="preview_3"
                                  src=""
                                  alt="Preview"
                                  class="img-fluid rounded"
                                />
                              </div>
                            </div>
                          </div>

                          <!-- Photo 4 -->
                          <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label for="photo_4" class="form-label">Left Photo</label>
                            <div
                              class="upload-square"
                              onclick="document.getElementById('photo_4').click()"
                            >
                              <input
                                type="file"
                                name="photos[]"
                                id="photo_4"
                                class="form-control"
                                onchange="previewImage(4)"
                              />
                              <div class="upload-text">Click to upload</div>
                              <div class="image-preview" id="image_preview_4">
                                <img
                                  id="preview_4"
                                  src=""
                                  alt="Preview"
                                  class="img-fluid rounded"
                                />
                              </div>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                            <!-- Video Walkaround -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                              <div class="form-group mb-3">
                                <!-- Label Text Above -->
                                <label for="video_walkaround" class="form-label">Video Walkaround</label>
                                <!-- Flexbox Container for Label and Video Preview -->
                                <div class="d-flex flex-column align-items-start">
                                  <!-- Video Preview Square (initially fixed size) -->
                                  <div id="videoPreview" class="video-preview"
                                       style="width: 100%; height: 250px; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; border: 2px dashed #007bff; cursor: pointer;">
                                    <span class="text-muted">Click to upload a video</span>
                                  </div>
                                  <!-- Hidden Input for File Upload -->
                                  <input type="file" name="video_walkaround" id="video_walkaround" class="d-none" accept="video/*" onchange="previewVideo(event)">
                                </div>
                              </div>
                            </div>

                            <!-- Photo 5 -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                              <label for="photo_5" class="form-label">Interior Photo</label>
                              <div class="upload-square" onclick="document.getElementById('photo_5').click()">
                                <input type="file" name="photos[]" id="photo_5" class="form-control" onchange="previewImage(5)" />
                                <div class="upload-text">Click to upload</div>
                                <div class="image-preview" id="image_preview_5">
                                  <img id="preview_5" src="" alt="Preview" class="img-fluid rounded" />
                                </div>
                              </div>
                            </div>

                            <!-- Photo 6 -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                              <label for="photo_6" class="form-label">Interior Front Photo</label>
                              <div class="upload-square" onclick="document.getElementById('photo_6').click()">
                                <input type="file" name="photos[]" id="photo_6" class="form-control" onchange="previewImage(6)" />
                                <div class="upload-text">Click to upload</div>
                                <div class="image-preview" id="image_preview_6">
                                  <img id="preview_6" src="" alt="Preview" class="img-fluid rounded" />
                                </div>
                              </div>
                            </div>

                            <!-- Photo 7 -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                              <label for="photo_7" class="form-label">Interior Back Photo</label>
                              <div class="upload-square" onclick="document.getElementById('photo_7').click()">
                                <input type="file" name="photos[]" id="photo_7" class="form-control" onchange="previewImage(7)" />
                                <div class="upload-text">Click to upload</div>
                                <div class="image-preview" id="image_preview_7">
                                  <img id="preview_7" src="" alt="Preview" class="img-fluid rounded" />
                                </div>
                              </div>
                            </div>
                          </div>



                          <div class="row">
                            <!-- Column 1 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="make" class="form-label">Make</label>
                                    <input type="text" name="make" id="make" class="form-control" value="{{ old('make') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" name="model" id="model" class="form-control" value="{{ old('model') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" required min="1500" max="2025">
                                    @if ($errors->has('year'))
                                        <div class="text-danger mt-2">{{ $errors->first('year') }}</div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    <div class="input-group">
                                    <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage') }}" required>
                                    <span class="input-group-text" id="<Miles_label">Miles</span>
                                    </div>
                                </div>
                                 <!-- Tire Condition -->
                                 <div class="form-group mb-3">
                                    <label for="tire_condition" class="form-label">Tire Condition</label>
                                    <select name="tire_condition" id="tire_condition" class="form-control" required>
                                        <option value="" disabled selected>Select tire condition</option>
                                        <option value="bad" {{ old('tire_condition') == 'bad' ? 'selected' : '' }}>Bad</option>
                                        <option value="good" {{ old('tire_condition') == 'good' ? 'selected' : '' }}>Good</option>
                                        <option value="excellent" {{ old('tire_condition') == 'excellent' ? 'selected' : '' }}>Excellent</option>
                                    </select>
                                </div>
                            </div>




                            <!-- Column 2 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control" required>
                                        <option value="" disabled selected>Select Fuel Type</option>
                                        <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <select name="transmission" id="transmission" class="form-control" required>
                                        <option value="" disabled selected>Select Transmission Type</option>
                                        <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Hybrid" {{ old('transmission') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine_size" class="form-label">Engine Size</label>
                                    <div class="input-group">
                                        <input
                                            type="number"
                                            name="engine_size"
                                            id="engine_size"
                                            class="form-control"
                                            value="{{ old('engine_size') }}"
                                            required
                                            min="0"
                                            step="0.1"
                                            oninput="updateInchesLabel()"
                                        >
                                        <span class="input-group-text" id="engine_size_label">inches</span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="engine_power" class="form-label">Engine Power</label>
                                    <div class="input-group">
                                        <input
                                            type="number"
                                            name="engine_power"
                                            id="engine_power"
                                            class="form-control"
                                            value="{{ old('engine_power') }}"
                                            required
                                            min="0"
                                            step="1"
                                            oninput="updateHpLabel()"
                                        >
                                        <span class="input-group-text" id="engine_power_label">hp</span>
                                    </div>
                                </div>

                                  <!-- Mechanical Health -->
                                  <div class="form-group mb-3">
                                    <label for="mechanical_health" class="form-label">Mechanical Health</label>
                                    <select name="mechanical_health" id="mechanical_health" class="form-control" required>
                                        <option value="" disabled selected>Select mechanical health</option>
                                        <option value="bad" {{ old('mechanical_health') == 'bad' ? 'selected' : '' }}>Bad</option>
                                        <option value="good" {{ old('mechanical_health') == 'good' ? 'selected' : '' }}>Good</option>
                                        <option value="excellent" {{ old('mechanical_health') == 'excellent' ? 'selected' : '' }}>Excellent</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Column 3 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="body_type" class="form-label">Body Type</label>
                                    <input type="text" name="body_type" id="body_type" class="form-control" value="{{ old('body_type') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="vin" class="form-label">VIN</label>
                                    <input type="text" name="vin" id="vin" class="form-control" value="{{ old('vin') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="insurance_status" class="form-label">Insurance Status</label>
                                    <select name="insurance_status" id="insurance_status" class="form-control" required>
                                        <option value="" disabled selected>Select Insurance Status</option>
                                        <option value="Active" {{ old('insurance_status') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Expired" {{ old('insurance_status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="warranty_status" class="form-label">Warranty Status</label>
                                    <select name="warranty_status" id="warranty_status" class="form-control">
                                        <option value="" disabled selected>Select Warranty Status</option>
                                        <option value="Remaining" {{ old('warranty_status') == 'Remaining' ? 'selected' : '' }}>Remaining</option>
                                        <option value="Expired" {{ old('warranty_status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>


                               <!-- Test Drive Availability -->
<div class="form-group mb-3">
    <label for="test_drive_availability" class="form-label">Test Drive Availability</label>
    <select
        name="test_drive_availability"
        id="test_drive_availability"
        class="form-control"
        onchange="toggleCalendar()"
        required
    >
        <option value="No" {{ old('test_drive_availability') == 'No' ? 'selected' : '' }}>No</option>
        <option value="Yes" {{ old('test_drive_availability') == 'Yes' ? 'selected' : '' }}>Yes</option>
    </select>
</div>

<div id="calendar-section" style="display: none;">
    <label for="test_drive_start" class="form-label">Start Date and Time</label>
    <input
        type="datetime-local"
        name="test_drive_start"
        id="test_drive_start"
        class="form-control"
        value="{{ old('test_drive_start') }}"
    >

    <label for="test_drive_end" class="form-label mt-3">End Date and Time</label>
    <input
        type="datetime-local"
        name="test_drive_end"
        id="test_drive_end"
        class="form-control"
        value="{{ old('test_drive_end') }}"
    >
</div>




                            </div>

                            <!-- Column 4 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <div class="input-group">
                                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                                    <span class="input-group-text" id="<Price_label">USD</span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="seller_name" class="form-label">Seller Name</label>
                                    <input type="text" name="seller_name" id="seller_name" class="form-control" value="{{ old('seller_name') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_information" class="form-label">Contact Information</label>
                                    <input type="text" name="contact_information" id="contact_information" class="form-control" value="{{ old('contact_information') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="registration_details">Registration Details</label>
                                  <input type="text" name="registration_details" id="registration_details" class="form-control" value="{{ old('registration_details') }}">
                              </div>
                            </div>

                        </div>


                    <button type="submit" class="btn btn-primary">Create Car Post</button>
                </form>
            </div>
    </div>

</div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div>
          <div class="row"> <!-- Add a row for Bootstrap grid -->
            @php
              // Get the cars associated with the logged-in user and filter only the approved ones
            // Get the cars associated with the logged-in user and filter only the approved ones that are not sold
$userCars = $cars->where('user_id', auth()->id());
$approvedCars = $userCars->filter(function($car) {
    return $car->status === 'approved' && $car->is_sold === 0;
});

            @endphp

            @if ($userCars->isEmpty())
              <p class="text-center">You have not posted a car yet.</p>
            @else
              @forelse ($approvedCars as $car)
                <div class="col-12 col-md-6 col-lg-3 mb-3"> <!-- Responsive column -->
                  <div class="card cubecard">
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
                        <div class="rotation-controls">
                          <button id="rotateBackward" class="btn"><i class="bi bi-chevron-left"></i></button>
                          <button id="rotateForward" class="btn"><i class="bi bi-chevron-right"></i></button>
                        </div>
                      </div>
                      <table class="table table-striped my-5">
                        <tbody>
                            <tr>
                                <th>Make</th>
                                <td>{{ $car->make ?? 'N/A' }}</td>
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
                            <td>{{ isset($car->price) ? number_format($car->price, 2) : 'N/A' }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer d-flex justify-between">
                        @if(auth()->id() === $car->user_id)
                        <button><a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a></button>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                        </div>
                  </div>
                </div>
              @empty
                <p class="text-center">Your car has not been approved yet.</p>
              @endforelse
            @endif
          </div>
        </div>


      </div>


    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
      <!-- Content for Contact Tab -->
      <div>
        <div class="row"> <!-- Add a row for Bootstrap grid -->
            @php
              // Get the cars associated with the logged-in user and filter only the approved ones
              $userCars = $cars->where('user_id', auth()->id());
$approvedCars = $userCars->filter(function($car) {
    return $car->status === 'pending' && $car->is_sold === 0;
});
            @endphp

            @if ($userCars->isEmpty())
              <p class="text-center">You have not posted a car yet.</p>
            @else
              @forelse ($approvedCars as $car)
                <div class="col-12 col-md-6 col-lg-3 mb-3"> <!-- Responsive column -->
                  <div class="card cubecard">
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
                        <div class="rotation-controls">
                          <button id="rotateBackward" class="btn"><i class="bi bi-chevron-left"></i></button>
                          <button id="rotateForward" class="btn"><i class="bi bi-chevron-right"></i></button>
                        </div>
                      </div>
                      <table class="table table-striped my-5">
                        <tbody>
                            <tr>
                                <th>Make</th>
                                <td>{{ $car->make ?? 'N/A' }}</td>
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
                            <td>{{ isset($car->price) ? number_format($car->price, 2) : 'N/A' }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer d-flex justify-between">
                    @if(auth()->id() === $car->user_id)
                    <button><a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a></button>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                    </div>
                  </div>
                </div>
              @empty
                <p class="text-center">Your car has already been approved and reday for sale</p>
              @endforelse
            @endif
          </div>
      </div>


    </div>
     <!-- Content for the Disabled Tab -->
  <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
    <div>
        <div class="row"> <!-- Add a row for Bootstrap grid -->
            @php
              // Get the cars associated with the logged-in user and filter only the approved ones
              $userCars = $cars->where('user_id', auth()->id());
$approvedCars = $userCars->filter(function($car) {
    return $car->status === 'rejected' && $car->is_sold === 0;
});
            @endphp

            @if ($userCars->isEmpty())
              <p class="text-center">You have not posted a car yet.</p>
            @else
              @forelse ($approvedCars as $car)
                <div class="col-12 col-md-6 col-lg-3 mb-3"> <!-- Responsive column -->
                  <div class="card cubecard">
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
                        <div class="rotation-controls">
                          <button id="rotateBackward" class="btn"><i class="bi bi-chevron-left"></i></button>
                          <button id="rotateForward" class="btn"><i class="bi bi-chevron-right"></i></button>
                        </div>
                      </div>
                      <table class="table table-striped my-5">
                        <tbody>
                            <tr class="text-center">
                                <th>Rejected Reason</th>
                                <th>{{ $car->rejection_reason ?? 'N/A' }}</th>
                            </tr>
                            <tr>
                                <th>Make</th>
                                <td>{{ $car->make ?? 'N/A' }}</td>
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
                            <td>{{ isset($car->price) ? number_format($car->price, 2) : 'N/A' }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer d-flex justify-between">
                        @if(auth()->id() === $car->user_id)
                        <button><a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a></button>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                        </div>
                  </div>
                </div>
              @empty
                <p class="text-center">Your car has already been approved and reday for sale</p>
              @endforelse
            @endif
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
<script>
   // Function to preview image before upload
function previewImage(index) {
    const fileInput = document.getElementById('photo_' + index);
    const file = fileInput.files[0];
    const preview = document.getElementById('preview_' + index);
    const imagePreview = document.getElementById('image_preview_' + index);

    // Check if file is selected
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Set the image source to the selected file
            preview.src = e.target.result;
            preview.style.display = 'block';
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    } else {
        preview.style.display = 'none';
        imagePreview.style.display = 'none';
    }
}



     // Function to preview the video
     function previewVideo(event) {
        var file = event.target.files[0];
        var videoPreview = document.getElementById('videoPreview');

        // Check if the file is a valid video type
        if (file && file.type.startsWith('video/')) {
            var videoUrl = URL.createObjectURL(file);

            // Create a video element and set the source to the selected video
            var videoElement = document.createElement('video');
            videoElement.src = videoUrl;
            videoElement.controls = true;
            videoElement.autoplay = true;  // Automatically play the video
            videoElement.loop = true;      // Loop the video
            videoElement.style.width = '100%';
            videoElement.style.height = '100%';
            videoElement.style.objectFit = 'contain';  // Ensures the video covers the square

            // Clear the preview area and append the video element
            videoPreview.innerHTML = '';
            videoPreview.appendChild(videoElement);
        } else {
            videoPreview.innerHTML = '<span class="text-danger">Invalid video file. Please upload a valid video.</span>';
        }
    }

    // Trigger file input when the video preview area is clicked
    document.getElementById('videoPreview').addEventListener('click', function() {
        document.getElementById('video_walkaround').click();
    });


    function toggleCalendar() {
    const testDriveAvailability = document.getElementById('test_drive_availability');
    const calendarSection = document.getElementById('calendar-section');
    const startDate = document.getElementById('test_drive_start');
    const endDate = document.getElementById('test_drive_end');

    if (testDriveAvailability.value === 'Yes') {
        calendarSection.style.display = 'block';
        startDate.setAttribute('required', 'required');
        endDate.setAttribute('required', 'required');
    } else {
        calendarSection.style.display = 'none';
        startDate.removeAttribute('required');
        endDate.removeAttribute('required');
        startDate.value = '';
        endDate.value = '';
    }
}

// Initialize visibility and requirements based on old value
window.onload = function () {
    toggleCalendar();
};






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


// JavaScript to update the modal image source when a cube face or new photo is clicked
document.querySelectorAll(".cube-face, .modal-trigger").forEach((element) => {
  element.addEventListener("click", function () {
    const imageUrl = element.getAttribute("data-image");
    document.getElementById("fullImage").setAttribute("src", imageUrl);
  });
});



    </script>
</x-app-layout>
