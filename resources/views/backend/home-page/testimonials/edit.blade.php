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
                  <h4>Edit Testimonials Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('testimonials.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Testimonials</li>
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
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('testimonials.update', $testimonials->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- To specify that this is an update request -->

                                    <!-- Section Heading-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="section_heading">Section Heading </label>
                                        <input class="form-control" id="section_heading" type="text" name="section_heading" placeholder="Enter Section Heading" value="{{ old('section_heading', $testimonials->section_heading) }}" required>
                                        <div class="invalid-feedback">Please enter a Section Heading.</div>
                                    </div>

                                    <!-- Section Title-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="section_title">Section Title </label>
                                        <input class="form-control" id="section_title" type="text" name="section_title" placeholder="Enter Section Title" value="{{ old('section_title', $testimonials->section_title) }}" required>
                                        <div class="invalid-feedback">Please enter a Section Title.</div>
                                    </div>

                                    <!-- Testimonials Heading-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="heading">Testimonials Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Testimonials Heading" value="{{ old('heading', $testimonials->heading) }}" required>
                                        <div class="invalid-feedback">Please enter a Testimonials Heading.</div>
                                    </div>

                                    <!-- Star Rating Dropdown -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="star_rating">Rating <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="star_rating" name="star_rating" required>
                                            <option value="" disabled>Select Rating</option>
                                            <option value="1" {{ old('star_rating', $testimonials->star_rating) == 1 ? 'selected' : '' }}>1 Star</option>
                                            <option value="2" {{ old('star_rating', $testimonials->star_rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                                            <option value="3" {{ old('star_rating', $testimonials->star_rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                                            <option value="4" {{ old('star_rating', $testimonials->star_rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                                            <option value="5" {{ old('star_rating', $testimonials->star_rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a star rating.</div>
                                    </div>

                                    <!-- Testimonials Reviewer-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="reviewer">Reviewer <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="reviewer" type="text" name="reviewer" placeholder="Enter Reviewer" value="{{ old('reviewer', $testimonials->reviewer) }}" required>
                                        <div class="invalid-feedback">Please enter a Reviewer.</div>
                                    </div>

                                    <!-- Testimonials Description-->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="description">Testimonials Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" placeholder="Enter Testimonials Description" required>{{ old('description', $testimonials->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Testimonials Description.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('testimonials.index') }}" class="btn btn-danger px-4">Cancel</a>
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

</body>

</html>