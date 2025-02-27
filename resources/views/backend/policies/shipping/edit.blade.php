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
                  <h4>Edit Shipping & Delivery Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('shipping.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Shipping & Delivery</li>
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
                        <h4>Shipping & Delivery Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('shipping.update', $term->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Heading -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="heading">Heading</label>
                                        <input class="form-control" id="heading" type="text" name="heading" value="{{ old('heading', $term->heading) }}" placeholder="Enter Heading">
                                        <div class="invalid-feedback">Please enter a Heading.</div>
                                    </div>

                                    <div class="col-12 mb-5">
                                        <label class="form-label" for="introduction">Introduction</label>
                                        <textarea class="form-control" id="introduction" name="introduction">{{ old('introduction', $term->introduction) }}</textarea>
                                        <div class="invalid-feedback">Please enter an Introduction.</div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="title" type="text" name="title" value="{{ old('title', $term->title) }}" placeholder="Enter Title" required>
                                        <div class="invalid-feedback">Please enter a Title.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" required>{{ old('description', $term->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Description.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('shipping.index') }}" class="btn btn-danger px-4">Cancel</a>
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
  $(document).ready(function() {
    $('#introduction').summernote({
      height: 200, // Adjust height as needed
      focus: true   // Focus the editor when initialized
    });
  });
</script>

</body>

</html>