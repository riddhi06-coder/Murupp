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
                  <h4>Edit Stock Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('stock-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Stock</li>
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
                        <h4>Stock Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('stock-details.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Product Dropdown (Disabled to prevent changing product) -->
                                    <div class="col-6">
                                        <label class="form-label" for="product">Select Product <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="product" name="product" disabled>
                                            <option value="">Select Product</option>
                                            <option value="{{ $product->id }}" selected>{{ $product->product_name }}</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a product.</div>
                                    </div>

                                    <!-- Quantity Input -->
                                    <div class="col-6">
                                        <label class="form-label" for="quantity">Available Quantity <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="quantity" type="number" name="quantity" min="1" required 
                                            placeholder="Enter Quantity" value="{{ $product->available_quantity }}">
                                        <div class="invalid-feedback">Please enter a valid quantity.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('stock-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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