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
											<a href="{{ route('user-list.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">User List</li>
									</ol>
								</nav>

								<a href="{{ route('user-list.create') }}" class="btn btn-primary px-5 radius-30">+ Add User</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td>
                                    <span id="statusBadge{{ $user->id }}" class="badge bg-{{ $user->status == 1 ? 'success' : 'danger' }} d-flex align-items-center">
                                        <i class="bx {{ $user->status == 1 ? 'bx-check-circle' : 'bx-x-circle' }} me-2"></i>
                                        {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('user-list.edit', $user->id) }}">
                                            <i class="fa fa-edit me-2" style="font-size: 24px;"></i> 
                                        </a>
                                        <form action="{{ route('user-list.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="fa fa-trash-o me-2" style="font-size: 24px; color: #003366;"></i> 
                                            </button>
                                        </form>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" style="font-size: 12px;" role="switch" id="statusSwitch{{ $user->id }}"
                                                {{ $user->status == 1 ? 'checked' : '' }} data-user-id="{{ $user->id }}" />
                                            </label>
                                        </div>
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

<!--For Status Management---->
<script>
    $(document).ready(function () {
        $('input[type="checkbox"][role="switch"]').on('change', function () {
            var userId = $(this).data('user-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('update.status') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    user_id: userId,
                    status: status
                },
                success: function (response) {
                    var badge = $('#statusBadge' + userId); 

                    if (status === 1) {
                        badge.removeClass('bg-danger').addClass('bg-lightgreen').text('Active');
                        alert(response.message);  
                    } else {
                        badge.removeClass('bg-lightgreen').addClass('bg-danger').text('Inactive');
                        alert(response.message);  
                    }
                },
                error: function (error) {
                    alert('Error updating status');  
                }
            });
        });
    });
</script>


</body>

</html>