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
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb mb-0">
										<li class="breadcrumb-item">
											<a href="{{ route('product-policies.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Product Policies</li>
									</ol>
								</nav>

								<a href="{{ route('product-policies.create') }}" class="btn btn-primary px-5 radius-30">+ Add Product Policies</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Policy Heading</th>
                                <th>Policy Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($policy as $index => $item)
                          <tr>
                              <td>{{ $index + 1 }}</td> 
                              <td>{{ $item->heading }}</td> 
                              <td>{{ $item->description }}</td> 
                              <td>
                                  @if ($item->policy_image)
                                      <img 
                                          src="{{ asset('/murupp/home/product-policies/' . $item->policy_image) }}" 
                                          alt="Policy Image" 
                                          style="max-height: 100px; border: 1px solid #ddd; padding: 5px;">
                                  @else
                                      <span class="text-muted">No Image</span>
                                  @endif
                              </td>
                              <td>
                                  <a href="{{ route('product-policies.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                      Edit
                                  </a>
                                  <form 
                                      action="{{ route('product-policies.destroy', $item->id) }}" 
                                      method="POST" 
                                      style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                          Delete
                                      </button>
                                  </form>
                              </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>

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