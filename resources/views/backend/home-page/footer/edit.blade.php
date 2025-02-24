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
                  <h4>Edit Footer Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('footer.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Footer</li>
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
                        <h4>Footer Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- For updating -->

    <!-- Email -->
    <div class="col-xxl-4 col-sm-6">
        <label class="form-label" for="email">Email <span class="txt-danger">*</span></label>
        <input class="form-control" id="email" type="text" name="email" value="{{ old('email', $footer->email) }}" placeholder="Enter Email" required>
        <div class="invalid-feedback">Please enter an Email.</div>
    </div>

    <!-- Gmap URL -->
    <div class="col-xxl-4 col-sm-6">
        <label class="form-label" for="url">Gmap URL <span class="txt-danger">*</span></label>
        <input class="form-control" id="url" type="text" name="url" value="{{ old('url', $footer->map_url) }}" placeholder="Enter Gmap URL" required>
        <div class="invalid-feedback">Please enter a Gmap URL.</div>
    </div>

    <!-- Contact Number -->
    <div class="col-xxl-4 col-sm-6">
        <label class="form-label" for="contact_number">Contact Number <span class="txt-danger">*</span></label>
        <input class="form-control" id="contact_number" type="text" name="contact_number" value="{{ old('contact_number', $footer->contact_number) }}" placeholder="Enter Contact Number" required pattern="^\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$"  maxlength="12">
        <div class="invalid-feedback">Please enter a valid Contact Number.</div>
    </div>

    <!-- About Us -->
    <div class="col-xxl-4 col-sm-12 mb-5">
        <label class="form-label" for="about">About Us <span class="txt-danger">*</span></label>
        <textarea class="form-control" id="summernote" name="about" placeholder="Enter About Us" required>{{ old('about', $footer->about) }}</textarea>
        <div class="invalid-feedback">Please enter an About Us.</div>
    </div>

    <!-- Social Media Links Table -->
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="form-label" for="social_media_links"><strong>Social Media Links </strong></label>
            <button type="button" id="add-social-media-row" class="btn btn-success">Add Link</button>
        </div>
        <table class="table table-bordered p-3" id="dynamicTable" style="border: 2px solid #dee2e6;">
            <thead>
                <tr>
                    <th>Social Media Platform <span class="txt-danger">*</span></th>
                    <th>Link <span class="txt-danger">*</span></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="social-media-table-body">
                @foreach (json_decode($footer->media_platform, true) as $key => $platform)
                    <tr>
                        <td>
                            <select name="social_media[{{ $key }}][platform]" class="form-control" required>
                                <option value="">Select Platform</option>
                                <option value="1" {{ $platform == 1 ? 'selected' : '' }}>Facebook</option>
                                <option value="2" {{ $platform == 2 ? 'selected' : '' }}>Twitter</option>
                                <option value="3" {{ $platform == 3 ? 'selected' : '' }}>Instagram</option>
                                <option value="4" {{ $platform == 4 ? 'selected' : '' }}>LinkedIn</option>
                                <option value="5" {{ $platform == 5 ? 'selected' : '' }}>YouTube</option>
                                <option value="6" {{ $platform == 6 ? 'selected' : '' }}>Pinterest</option>
                            </select>
                        </td>
                        <td>
                            <input type="url" name="social_media[{{ $key }}][link]" class="form-control" placeholder="Enter Social Media URL" value="{{ json_decode($footer->media_link, true)[$key] }}" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-social-media-row">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Form Actions -->
    <div class="col-12 text-end">
        <a href="{{ route('footer.index') }}" class="btn btn-danger px-4">Cancel</a>
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

=
    <!-- JavaScript to dynamically add/remove rows -->
<script>
    document.getElementById('add-social-media-row').addEventListener('click', function () {
        var tableBody = document.getElementById('social-media-table-body');
        var rowCount = tableBody.rows.length;
        var row = tableBody.insertRow();

        // Platform Dropdown
        var cell1 = row.insertCell(0);
        var platformSelect = document.createElement('select');
        platformSelect.name = `social_media[${rowCount}][platform]`;
        platformSelect.classList.add('form-control');
        platformSelect.required = true;

        // Add options to the dropdown with numerical values
        var platforms = [
            { id: 1, name: 'Facebook' },
            { id: 2, name: 'Twitter' },
            { id: 3, name: 'Instagram' },
            { id: 4, name: 'Linkedin' },
            { id: 5, name: 'Youtube' },
            { id: 6, name: 'Pintrest' }
        ];
        platformSelect.innerHTML = '<option value="">Select Platform</option>';
        platforms.forEach(function (platform) {
            var option = document.createElement('option');
            option.value = platform.id; // Numerical value
            option.textContent = platform.name.charAt(0).toUpperCase() + platform.name.slice(1); // Capitalized name
            platformSelect.appendChild(option);
        });

        cell1.appendChild(platformSelect);

        // URL Input
        var cell2 = row.insertCell(1);
        var urlInput = document.createElement('input');
        urlInput.type = 'url';
        urlInput.name = `social_media[${rowCount}][link]`;
        urlInput.classList.add('form-control');
        urlInput.placeholder = 'Enter Social Media URL';
        urlInput.required = true;
        cell2.appendChild(urlInput);

        // Remove Button
        var cell3 = row.insertCell(2);
        var removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-danger', 'remove-social-media-row');
        removeBtn.textContent = 'Remove';
        removeBtn.addEventListener('click', function () {
            tableBody.deleteRow(row.rowIndex);
        });
        cell3.appendChild(removeBtn);
    });


    // Event delegation to remove rows
    document.getElementById('social-media-table-body').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-social-media-row')) {
            var row = e.target.closest('tr');
            row.remove();
        }
    });
</script>

</body>

</html>