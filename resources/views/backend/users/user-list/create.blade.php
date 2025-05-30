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
                  <h4>Add User Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('user-list.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add User</li>
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
                        <h4>User Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate  action="{{ route('user-list.store') }}" method="POST">
                                    @csrf
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="validationCustom0-a">Enter Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter Name" required>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid status.</div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="validationemail-b">Email <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="validationemail-b" type="email" name="email" required placeholder="Enter Email">
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="password">Password <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="password" type="password" name="password" required placeholder="Enter Password">
                                    </div>
                                    
                                    <div class="col-12 text-end">
                                        <a href="{{ route('user-list.index') }}" class="btn btn-danger px-4">Cancel</a>
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