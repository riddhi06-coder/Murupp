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
                  <h4>Add Social Media Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('social-media.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Social Media</li>
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
                        <h4>Testimonials Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('social-media.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Section Heading-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading" required>
                                        <div class="invalid-feedback">Please enter a Section Heading.</div>
                                    </div>

                                    <!-- Section Title-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="section_title">Section Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" required>
                                        <div class="invalid-feedback">Please enter a Section Title.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('social-media.index') }}" class="btn btn-danger px-4">Cancel</a>
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