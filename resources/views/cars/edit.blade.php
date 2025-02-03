<x-app-layout>

<style>


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
    /* display: none; Initially hidden */
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
            {{ __('Edit Car Post') }}
        </h2>
    </x-slot>
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
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Edit Car Form -->
                    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Front Photo -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_1" class="form-label">Front Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_1').click()">
                                    <input type="file" name="photos[0]" id="photo_1" class="form-control" onchange="previewImage(1)" />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_1">
                                        <img id="preview_1"   src="{{ isset($car->photos[0]) && $car->photos[0] ? asset('storage/' . $car->photos[0]) : asset('car_photos/default_photo.jpg') }}"  alt="Preview" class="img-fluid rounded" />
                                    </div>
                                </div>
                            </div>

                            <!-- Left Photo -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_2" class="form-label">Back Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_2').click()">
                                    <input type="file" name="photos[1]" id="photo_2" class="form-control" onchange="previewImage(2)" />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_2">
                                        <img id="preview_2"   src="{{ isset($car->photos[1]) && $car->photos[1] ? asset('storage/' . $car->photos[1]) : asset('car_photos/default_photo.jpg') }}"  alt="Preview" class="img-fluid rounded" />
                                    </div>
                                </div>
                            </div>

                            <!-- Right Photo -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_3" class="form-label">Right Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_3').click()">
                                    <input type="file" name="photos[2]" id="photo_3" class="form-control" onchange="previewImage(3)" />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_3">
                                        <img id="preview_3"   src="{{ isset($car->photos[2]) && $car->photos[2] ? asset('storage/' . $car->photos[2]) : asset('car_photos/default_photo.jpg') }}"   alt="Preview" class="img-fluid rounded" />
                                    </div>
                                </div>
                            </div>

                            <!-- Back Photo -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_4" class="form-label">Left Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_4').click()">
                                    <input type="file" name="photos[3]" id="photo_4" class="form-control" onchange="previewImage(4)" />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_4">
                                        <img id="preview_4"   src="{{ isset($car->photos[3]) && $car->photos[3] ? asset('storage/' . $car->photos[3]) : asset('car_photos/default_photo.jpg') }}"   alt="Preview" class="img-fluid rounded" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           <!-- Video Walkaround -->
<div class="col-12 col-md-6 col-lg-3 mb-3">
    <label for="video_walkaround" class="form-label">Video Walkaround</label>
    <div class="d-flex flex-column align-items-start">
        <div id="videoPreview" class="video-preview"
             style="width: 100%; height: 250px; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; border: 2px dashed #007bff; cursor: pointer;"
             onclick="document.getElementById('video_walkaround').click()">
            <!-- Show existing video if available -->
            @if ($car->video_walkaround)
                <video src="{{ asset('storage/' . $car->video_walkaround) }}" muted controls autoplay loop
                       style="width: 100%; height: 100%; object-fit: contain;"></video>
            @else
                <span class="text-muted">Click to upload a video</span>
            @endif
        </div>
        <input type="file" name="video_walkaround" id="video_walkaround" class="d-none" accept="video/*" onchange="previewVideo(event)" />
    </div>
</div>

                            <!-- Interior Photos -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_5" class="form-label">Interior Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_5').click()">
                                    <input type="file" name="photos[4]" id="photo_5" class="form-control" onchange="previewImage(5)" />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_5">
                                        <img id="preview_5"   src="{{ isset($car->photos[4]) && $car->photos[4] ? asset('storage/' . $car->photos[4]) : asset('car_photos/default_photo.jpg') }}"   alt="Preview" class="img-fluid rounded" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_6" class="form-label">Interior Front Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_6').click()">
                                    <input
                                        type="file"
                                        name="photos[5]"
                                        id="photo_6"
                                        class="form-control"
                                        onchange="previewImage(6)"
                                    />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_6">
                                        <img
                                            id="preview_6"
                                            src="{{ isset($car->photos[5]) && $car->photos[5] ? asset('storage/' . $car->photos[5]) : asset('car_photos/default_photo.jpg') }}"
                                            class="img-fluid rounded"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Photo 7 -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label for="photo_7" class="form-label">Interior Back Photo</label>
                                <div class="upload-square" onclick="document.getElementById('photo_7').click()">
                                    <input
                                        type="file"
                                        name="photos[6]"
                                        id="photo_7"
                                        class="form-control"
                                        onchange="previewImage(7)"
                                    />
                                    <div class="upload-text">Click to upload</div>
                                    <div class="image-preview" id="image_preview_7">
                                        <img
                                            id="preview_7"
                                            src="{{ isset($car->photos[6]) && $car->photos[6] ? asset('storage/' . $car->photos[6]) : asset('car_photos/default_photo.jpg') }}"
                                            class="img-fluid rounded"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Column 1 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="make" class="form-label">Make</label>
                                    <input type="text" name="make" id="make" class="form-control" value="{{ old('make', $car->make) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $car->model) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $car->year) }}" required min="1500" max="2025">
                                    @if ($errors->has('year'))
                                        <div class="text-danger mt-2">{{ $errors->first('year') }}</div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    <div class="input-group">
                                    <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage', $car->mileage) }}" required>
                                    <span class="input-group-text" id="<Miles_label">Miles</span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tire_condition" class="form-label">Tire Condition</label>
                                    <select name="tire_condition" id="tire_condition" class="form-control" required>
                                        <option value="" disabled>Select tire condition</option>
                                        <option value="bad" {{ old('tire_condition', $car->tire_condition) == 'bad' ? 'selected' : '' }}>Bad</option>
                                        <option value="good" {{ old('tire_condition', $car->tire_condition) == 'good' ? 'selected' : '' }}>Good</option>
                                        <option value="excellent" {{ old('tire_condition', $car->tire_condition) == 'excellent' ? 'selected' : '' }}>Excellent</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control" required>
                                        <option value="" disabled>Select Fuel Type</option>
                                        <option value="Petrol" {{ old('fuel_type', $car->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="Diesel" {{ old('fuel_type', $car->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Electric" {{ old('fuel_type', $car->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="Hybrid" {{ old('fuel_type', $car->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <select name="transmission" id="transmission" class="form-control" required>
                                        <option value="" disabled>Select Transmission Type</option>
                                        <option value="Manual" {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="Automatic" {{ old('transmission', $car->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Hybrid" {{ old('transmission', $car->transmission) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine_size" class="form-label">Engine Size</label>
                                    <div class="input-group">
                                    <input type="number" name="engine_size" id="engine_size" class="form-control" value="{{ old('engine_size', $car->engine_size) }}" required min="0" step="0.1">
                                    <span class="input-group-text" id="engine_size_label">inches</span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine_power" class="form-label">Engine Power</label>
                                    <div class="input-group">
                                    <input type="number" name="engine_power" id="engine_power" class="form-control" value="{{ old('engine_power', $car->engine_power) }}" required min="0" step="1">
                                    <span class="input-group-text" id="engine_power_label">hp</span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mechanical_health" class="form-label">Mechanical Health</label>
                                    <select name="mechanical_health" id="mechanical_health" class="form-control" required>
                                        <option value="" disabled>Select mechanical health</option>
                                        <option value="bad" {{ old('mechanical_health', $car->mechanical_health) == 'bad' ? 'selected' : '' }}>Bad</option>
                                        <option value="good" {{ old('mechanical_health', $car->mechanical_health) == 'good' ? 'selected' : '' }}>Good</option>
                                        <option value="excellent" {{ old('mechanical_health', $car->mechanical_health) == 'excellent' ? 'selected' : '' }}>Excellent</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Column 3 -->
<div class="col-lg-3 col-md-6 col-sm-12">
    <div class="form-group mb-3">
        <label for="body_type" class="form-label">Body Type</label>
        <input type="text" name="body_type" id="body_type" class="form-control"
               value="{{ old('body_type', $car->body_type ?? '') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="vin" class="form-label">VIN</label>
        <input type="text" name="vin" id="vin" class="form-control"
               value="{{ old('vin', $car->vin ?? '') }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="insurance_status" class="form-label">Insurance Status</label>
        <select name="insurance_status" id="insurance_status" class="form-control" required>
            <option value="" disabled>Select Insurance Status</option>
            <option value="Active" {{ old('insurance_status', $car->insurance_status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Expired" {{ old('insurance_status', $car->insurance_status ?? '') == 'Expired' ? 'selected' : '' }}>Expired</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="warranty_status" class="form-label">Warranty Status</label>
        <select name="warranty_status" id="warranty_status" class="form-control">
            <option value="" disabled>Select Warranty Status</option>
            <option value="Remaining" {{ old('warranty_status', $car->warranty_status ?? '') == 'Remaining' ? 'selected' : '' }}>Remaining</option>
            <option value="Expired" {{ old('warranty_status', $car->warranty_status ?? '') == 'Expired' ? 'selected' : '' }}>Expired</option>
        </select>
    </div>


   <!-- Test Drive Availability -->
<div class="form-group mb-3">
    <label for="test_drive_availability" class="form-label">Test Drive Availability</label>
    <select name="test_drive_availability" id="test_drive_availability" class="form-control" onchange="toggleCalendar()" required>
        <option value="No" {{ old('test_drive_availability', $car->test_drive_availability ?? '') == 'No' ? 'selected' : '' }}>No</option>
        <option value="Yes" {{ old('test_drive_availability', $car->test_drive_availability ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
    </select>
</div>

<div id="calendar-section" style="{{ old('test_drive_availability', $car->test_drive_availability ?? '') == 'Yes' ? '' : 'display: none;' }}">
    <label for="test_drive_start" class="form-label">Start Date</label>
    <input type="datetime-local" name="test_drive_start" id="test_drive_start" class="form-control"
           value="{{ old('test_drive_start', $car->test_drive_start ? \Carbon\Carbon::parse($car->test_drive_start)->format('Y-m-d\TH:i') : '') }}">

    <label for="test_drive_end" class="form-label mt-3">End Date</label>
    <input type="datetime-local" name="test_drive_end" id="test_drive_end" class="form-control"
           value="{{ old('test_drive_end', $car->test_drive_end ? \Carbon\Carbon::parse($car->test_drive_end)->format('Y-m-d\TH:i') : '') }}">
</div>


</div>

<!-- Column 4 -->
<div class="col-lg-3 col-md-6 col-sm-12">
    <div class="form-group mb-3">
        <label for="price" class="form-label">Price</label>
        <div class="input-group">
        <input type="number" step="0.01" name="price" id="price" class="form-control"
               value="{{ old('price', default: $car->price ?? '') }}" required>
               <span class="input-group-text" id="<Price_label">USD</span>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="seller_name" class="form-label">Seller Name</label>
        <input type="text" name="seller_name" id="seller_name" class="form-control"
               value="{{ old('seller_name', $car->seller_name ?? '') }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" id="location" class="form-control"
               value="{{ old('location', $car->location ?? '') }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="contact_information" class="form-label">Contact Information</label>
        <input type="text" name="contact_information" id="contact_information" class="form-control"
               value="{{ old('contact_information', $car->contact_information ?? '') }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="registration_details" class="form-label">Registration Details</label>
        <input type="text" name="registration_details" id="registration_details" class="form-control"
               value="{{ old('registration_details', $car->registration_details ?? '') }}">
    </div>
</div>


                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

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



     // Function to preview the selected video
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
        videoElement.autoplay = true; // Automatically play the video
        videoElement.loop = true;     // Loop the video
        videoElement.style.width = '100%';
        videoElement.style.height = '100%';
        videoElement.style.objectFit = 'contain'; // Ensures the video fits well in the area

        // Clear the preview area and append the video element
        videoPreview.innerHTML = '';
        videoPreview.appendChild(videoElement);
    } else {
        videoPreview.innerHTML = '<span class="text-danger">Invalid video file. Please upload a valid video.</span>';
    }
}



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



    </script>
</x-app-layout>
