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
                  <h4>Add Shop By Category Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('shop-category.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Shop By Category</li>
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
                        <h4>Shop By Category Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('shop-category.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Heading-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="heading">Heading </label>
                                        <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Heading">
                                        <div class="invalid-feedback">Please enter a Heading.</div>
                                    </div>

                                     <!-- Image Title-->
                                     <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="image_title">Select Product Category <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="image_title" name="image_title" required>
                                            <option value="" disabled selected>Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a category.</div>
                                    </div>


                                    <!-- Product Image-->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="product_image"> Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="product_image" type="file" name="product_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewBannerImage()">
                                        <div class="invalid-feedback">Please upload a Product Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Preview Section -->
                                    <div class="col-xxl-4 col-sm-12" id="bannerImagePreviewContainer" style="display: none;">
                                        <img id="banner_image_preview" src="" alt="Preview" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd; padding: 5px;">
                                    </div>


                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('shop-category.index') }}" class="btn btn-danger px-4">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
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

        // Clear the previous preview
        previewImage.src = '';
        
        if (file) {
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';  // Show the preview section
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