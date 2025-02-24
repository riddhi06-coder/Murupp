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
                  <h4>Add Product Sizes Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('product-sizes.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product Sizes</li>
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
                        <h4>Product Fabrics Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('product-sizes.store') }}" method="POST">
                                    @csrf
                                    <!-- Collection Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="sizes">Product Sizes Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="sizes" type="text" name="sizes" placeholder="Enter Product Sizes Name" required>
                                        <div class="invalid-feedback">Please enter a product sizes name.</div>
                                    </div>

                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="bust_sizes">Bust Size <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="bust_sizes" type="number" name="bust_sizes" placeholder="Enter Bust Size" required>
                                        <div class="invalid-feedback">Please enter a Bust Size.</div>
                                    </div>


                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="waist_sizes">Waist Size <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="waist_sizes" type="number" name="waist_sizes" placeholder="Enter Waist Size" required>
                                        <div class="invalid-feedback">Please enter a Waist Size.</div>
                                    </div>

                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="hips_sizes">Hips Size<span class="txt-danger">*</span></label>
                                        <input class="form-control" id="hips_sizes" type="number" name="hips_sizes" placeholder="Enter Hips Size" required>
                                        <div class="invalid-feedback">Please enter a Hips Size.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('product-sizes.index') }}" class="btn btn-danger px-4">Cancel</a>
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
</body>

</html>