<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Edit Collection Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('collection-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Collection Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Collection Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('collection-details.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Heading -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="heading">Heading <span class="txt-danger">*</span></label>
                                        <input 
                                            class="form-control" 
                                            id="heading" 
                                            type="text" 
                                            name="heading" 
                                            placeholder="Enter Heading" 
                                            value="{{ old('heading', $collection->heading) }}" 
                                            required>
                                        <div class="invalid-feedback">Please enter a Heading.</div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="product_description">Description <span class="txt-danger">*</span></label>
                                        <textarea 
                                            class="form-control" 
                                            id="summernote" 
                                            name="description" 
                                            placeholder="Enter Description" 
                                            required>{{ old('description', $collection->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Description.</div>
                                    </div>

                                    <!-- Product Image -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="product_image">Image <span class="txt-danger">*</span></label>
                                        <input 
                                            class="form-control" 
                                            id="product_image" 
                                            type="file" 
                                            name="product_image" 
                                            accept=".jpg, .jpeg, .png, .webp" 
                                            onchange="previewBannerImage()">
                                        <div class="invalid-feedback">Please upload a Product Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Preview Existing Image -->
                                    @if($collection->image)
                                        <div class="col-xxl-4 col-sm-12 existing-image">
                                            <img 
                                                src="{{ asset('/murupp/home/collection-details/' . $collection->image) }}" 
                                                alt="Current Product Image" 
                                                class="img-fluid" 
                                                style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    @endif


                                    <!-- Preview Section for New Image -->
                                    <div class="col-xxl-4 col-sm-12" id="bannerImagePreviewContainer" style="display: none;">
                                        <img 
                                            id="banner_image_preview" 
                                            src="" 
                                            alt="Preview" 
                                            class="img-fluid" 
                                            style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('collection-details.index') }}" class="btn btn-danger px-4">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>


                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>


       
       @include('components.backend.main-js')

<script>
function previewBannerImage() {
    const file = document.getElementById('product_image').files[0];
    const previewContainer = document.getElementById('bannerImagePreviewContainer');
    const previewImage = document.getElementById('banner_image_preview');
    
    // Clear the existing image preview and remove the old image preview section
    previewImage.src = '';
    previewContainer.style.display = 'none'; // Hide the preview section

    // Clear the existing image if a new image is selected
    const existingImage = document.querySelector('.existing-image');
    if (existingImage) {
        existingImage.remove();  // Remove the current image preview from DOM
    }

    // Check if a file is selected
    if (file) {
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        // Validate image type
        if (validImageTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Display the new image preview
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block'; // Show the preview section
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please upload a valid image file (jpg, jpeg, png, webp).');
        }
    }
}

</script>
</body>

</html>