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
                  <h4>Edit User Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('user-list.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit User</li>
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
                        <h4>Edit User Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('user-list.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Since you're updating the user, use the PUT method -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="name">Enter Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter Name" required>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid status.</div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="email">Email <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Enter Email">
                                    </div>
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="password">Password <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Enter Password">
                                        <div class="invalid-feedback">Please enter a valid password.</div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <a href="{{ route('user-list.index') }}" class="btn btn-danger px-4">Cancel</a>
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