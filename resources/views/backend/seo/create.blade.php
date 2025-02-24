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
                  <h4>Add SEO Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('seo-tags.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add SEO</li>
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
                        <h4>SEO Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('seo-tags.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!--Page Name-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="page_name">Page Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="page_name" type="text" name="page_name" placeholder="Enter Page Name" required>
                                        <div class="invalid-feedback">Please enter Page Name.</div>
                                    </div>

                                    <!-- Page URL-->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="page_url">Page URL <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="page_url" type="text" name="page_url" placeholder="Enter Page URL" required>
                                        <div class="invalid-feedback">Please enter a Page URL.</div>
                                    </div>

                                    <!-- Meta Title  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="meta_title">Meta Title</label>
                                        <input class="form-control" id="meta_title" type="text" name="meta_title" placeholder="Enter Meta Title">
                                        <div class="invalid-feedback">Please enter a Meta Title.</div>
                                    </div>


                                    <!-- Meta Description  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="meta_description">Meta Description</label>
                                        <input class="form-control" id="meta_description" type="text" name="meta_description" placeholder="Enter Meta Description">
                                        <div class="invalid-feedback">Please enter a Meta Description.</div>
                                    </div>

                                    <!-- Meta Keywords  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                        <input class="form-control" id="meta_keywords" type="text" name="meta_keywords" placeholder="Enter Meta Keywords">
                                        <div class="invalid-feedback">Please enter a Meta Keywords.</div>
                                    </div>

                                    <!-- Meta Author  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="meta_author">Meta Author</label>
                                        <input class="form-control" id="meta_author" type="text" name="meta_author" placeholder="Enter Meta Author">
                                        <div class="invalid-feedback">Please enter a Meta Author.</div>
                                    </div>

                                    <!-- Canonical Tag  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="canonical_tag">Canonical Tag</label>
                                        <input class="form-control" id="canonical_tag" type="text" name="canonical_tag" placeholder="Enter Canonical Tag">
                                        <div class="invalid-feedback">Please enter a Canonical Tag.</div>
                                    </div>

                                    <!-- Hreflang Tag  -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="hreflang_tag">Hreflang Tag</label>
                                        <input class="form-control" id="hreflang_tag" type="text" name="hreflang_tag" placeholder="Enter Hreflang Tag">
                                        <div class="invalid-feedback">Please enter a Hreflang Tag.</div>
                                    </div>
                            
                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('seo-tags.index') }}" class="btn btn-danger px-4">Cancel</a>
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