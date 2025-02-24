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
                  <h4>Edit Banner Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('banner-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Banner Details</li>
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
                        <h4>Banner Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('banner-details.update', $banner_details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')  

                                    <!-- Banner Heading-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_heading" type="text" name="banner_heading" value="{{ old('banner_heading', $banner_details->banner_heading) }}" placeholder="Enter Banner Heading" required>
                                        <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                    </div>

                                    <!-- Banner Title-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_title" type="text" name="banner_title" value="{{ old('banner_title', $banner_details->banner_title) }}" placeholder="Enter Banner Title" required>
                                        <div class="invalid-feedback">Please enter a Banner Title.</div>
                                    </div>

                                    <!-- Banner Image -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="banner_image">Banner Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept=".jpg, .jpeg, .png, .webp" onchange="previewBannerImage()">
                                        <div class="invalid-feedback">Please upload a Banner Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Preview Section -->
                                    <div class="col-xxl-4 col-sm-12" id="bannerImagePreviewContainer" style="display: none;">
                                        <img id="banner_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                    </div>

                                    <!-- Existing Banner Image -->
                                    <div class="col-xxl-4 col-sm-12" id="existingBannerImageContainer" @if (!$banner_details->banner_images) style="display: none;" @endif>
                                        @if ($banner_details->banner_images)
                                            <img id="existing_banner_image" src="{{ asset('/murupp/home/banner/' . $banner_details->banner_images) }}" alt="Current Banner Image" style="max-height: 100px; border: 1px solid #ddd; padding: 5px;">
                                        @endif
                                    </div>


                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('banner-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    const file = document.getElementById('banner_image').files[0];
    const previewContainer = document.getElementById('bannerImagePreviewContainer');
    const previewImage = document.getElementById('banner_image_preview');
    const existingImageContainer = document.getElementById('existingBannerImageContainer');

    // Clear the previous preview
    previewImage.src = '';
    previewContainer.style.display = 'none';

    if (file) {
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (validImageTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Hide existing image container if present
                if (existingImageContainer) {
                    existingImageContainer.style.display = 'none';
                }

                // Display the new preview
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
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