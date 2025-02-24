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
                                    <a href="{{ route('product-prints.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product Prints List</li>
                            </ol>
                        </nav>

                        <a href="{{ route('product-prints.create') }}" class="btn btn-primary px-5 radius-30">+ Add Product Prints</a>
                    </div>
                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product Prints</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($product_prints as $key => $category)
                              <tr>
                                  <td>{{ $key + 1 }}</td>
                                  <td>{{ $category->print_name }}</td>
                                  <td>{{ $category->creator_name }}</td>
                                  <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y') }}</td>
                                  <td>
                                      <a href="{{ route('product-prints.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                      <form action="{{ route('product-prints.destroy', $category->id) }}" method="POST" style="display:inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this print?')">Delete</button>
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