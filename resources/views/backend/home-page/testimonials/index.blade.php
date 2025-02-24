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
											<a href="{{ route('testimonials.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Testomonials</li>
									</ol>
								</nav>

								<a href="{{ route('testimonials.create') }}" class="btn btn-primary px-5 radius-30">+ Add Testomonials</a>
							</div>


                  
                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Testimonial Heading</th>
                                <th>Rating</th>
                                <th>Reviewer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $index => $testimonial)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>{{ $testimonial->heading }}</td> 
                                  
                                    <td>{{ $testimonial->star_rating }} Stars</td> 
                                    <td>{{ $testimonial->reviewer }}</td> 
                                    <td>
                                        <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</button>
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
<script>
    $(document).ready(function() {
        $('#basic').DataTable(); // Initialize the DataTable on the table with id "basic"
    });
</script>
</body>

</html>