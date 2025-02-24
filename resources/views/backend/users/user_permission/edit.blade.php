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
                  <h4>Add User Permissions Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('user-list.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add User Permissions</li>
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
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form action="{{ route('user-permissions.update', $user_permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Since this is an update, use PUT method -->
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <h5 class="mb-4">User Permission Details</h5>

                                            <!-- User Dropdown -->
                                            <div class="row mb-3">
                                                <label for="user_id" class="col-sm-3 col-form-label">Select User <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="user_id" name="user_id" required>
                                                        <option value="">-- Select User --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" {{ $user_permission->user_id == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                             <!-- Permissions Section -->
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label">Permissions <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                @foreach ($permissions as $groupName => $groupedPermissions)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h6 class="me-3 mb-0">{{ $groupName }}</h6>
                                                        
                                                        @if ($groupedPermissions->isNotEmpty())
                                                            @php $firstPermission = $groupedPermissions->shift(); @endphp
                                                            
                                                            <!-- Select All Checkbox -->
                                                            <div class="form-check me-3">
                                                                <input 
                                                                    type="checkbox" 
                                                                    class="form-check-input select-all" 
                                                                    id="select_all_{{ $groupName }}" 
                                                                    data-group="{{ $groupName }}">
                                                                <label class="form-check-label" for="select_all_{{ $groupName }}">
                                                                    Select All
                                                                </label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                                <input 
                                                                    type="checkbox" 
                                                                    class="form-check-input" 
                                                                    id="permission_{{ $firstPermission->id }}" 
                                                                    name="permissions[]" 
                                                                    value="{{ $firstPermission->id }}"
                                                                    {{ in_array($firstPermission->id, $permission_ids) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="permission_{{ $firstPermission->id }}">
                                                                    {{ ucfirst(last(explode('-', $firstPermission->slug))) }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="row mb-4">
                                                        @foreach ($groupedPermissions as $permission)
                                                            <div class="col-sm-3 mb-2">
                                                                <div class="form-check">
                                                                    <input 
                                                                        type="checkbox" 
                                                                        class="form-check-input permission-checkbox" 
                                                                        id="permission_{{ $permission->id }}" 
                                                                        name="permissions[]" 
                                                                        value="{{ $permission->id }}"
                                                                        {{ in_array($permission->id, $permission_ids) ? 'checked' : '' }}
                                                                        data-group="{{ $groupName }}">
                                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                                        {{ ucfirst(last(explode('-', $permission->slug))) }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 text-end">
                                                <a href="{{ route('user-permissions.index') }}" class="btn btn-danger px-4">Cancel</a>
                                                <button class="btn btn-primary" type="submit">Update Permissions</button>
                                            </div>
                                        </div>
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
    document.querySelectorAll('.select-all').forEach(selectAllCheckbox => {
        selectAllCheckbox.addEventListener('change', function() {
            const groupName = this.dataset.group;
            const checkboxes = document.querySelectorAll(`.permission-checkbox[data-group="${groupName}"]`);
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>


</body>

</html>