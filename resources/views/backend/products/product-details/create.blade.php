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
                  <h4>Add Product Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('product-prints.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product Details</li>
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
                        <h4>Product Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('product-details.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Collection Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="collection_name">Collection Name <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="collection_name" name="collection_name" placeholder="Select Collection Name" required>
                                            <option value="" disabled selected>Select Collection Name</option>
                                            @foreach($collections as $collection)
                                                <option value="{{ $collection->id }}">{{ $collection->collection_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a Collection Name.</div>
                                    </div>

                                    <!-- Full Look Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="look_name">Full Look Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="look_name" type="text" name="look_name" placeholder="Enter Product Full Look Name" required>
                                        <div class="invalid-feedback">Please enter a product full look name.</div>
                                    </div>

                                    <!-- Product Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_name">Product Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="product_name" type="text" name="product_name" placeholder="Enter Product Name" required>
                                        <div class="invalid-feedback">Please enter a product name.</div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_category">Product Category <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="product_category" name="product_category" placeholder="Select Product Category" required>
                                            <option value="" disabled selected>Select Product Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a product category.</div>
                                    </div>

                                    <!-- Fabric Composition -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="fabric_composition">
                                            Fabric Composition <span class="txt-danger">*</span>
                                        </label>
                                        <select class="form-control" id="fabric_composition" name="fabric_composition" placeholder="Select Fabric Composition" required>
                                            <option value="" disabled selected>Select Fabric Composition</option>
                                            @foreach($fabric_composition as $composition)
                                                <option value="{{ $composition->id }}">{{ $composition->composition_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a Fabric Composition.</div>
                                    </div>


                                     <!-- Style Code -->
                                     <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="style_code">Style Code <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="style_code" type="text" name="style_code" placeholder="Enter Product Style Code" required>
                                        <div class="invalid-feedback">Please enter a product style code.</div>
                                    </div>

                                     <!-- Fabric -->
                                     <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_fabric">
                                            Product Fabric <span class="txt-danger">*</span>
                                        </label>
                                        <select class="form-control" id="product_fabric" name="product_fabric" placeholder="Select Product Fabric" required>
                                            <option value="" disabled selected>Select Product Fabric</option>
                                            @foreach($product_fabric as $fabrics)
                                                <option value="{{ $fabrics->id }}">{{ $fabrics->fabrics_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a Product Fabric.</div>
                                    </div>


                                     <!-- Product Price -->
                                     <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_price">Product Price <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="product_price" type="text" name="product_price" placeholder="Enter Product Price" required>
                                        <div class="invalid-feedback">Please enter a product Price.</div>
                                    </div>

                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_size">Product Size <span class="txt-danger">*</span></label>
                                        <select class="form-control select2" id="product_size" name="product_size[]" multiple required>
                                            @foreach ($product_sizes as $id => $size)
                                                <option value="{{ $id }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select at least one product size.</div>
                                    </div>


                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_colors">Product Colors</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="color_dropdown" name="colors[]" multiple>
                                                <option value="Black">Black</option>
                                                <option value="White">White</option>
                                                <option value="Red">Red</option>
                                                <option value="Green">Green</option>
                                                <option value="Blue">Blue</option>
                                                <option value="Yellow">Yellow</option>
                                                <option value="Orange">Orange</option>
                                                <option value="Purple">Purple</option>
                                                <option value="Pink">Pink</option>
                                                <option value="Brown">Brown</option>
                                                <option value="Gray">Gray</option>
                                                <option value="Cyan">Cyan</option>
                                                <option value="Dark Green">Dark Green</option>
                                                <option value="Maroon">Maroon</option>
                                                <option value="Teal">Teal</option>
                                            </select>
                                        </div>
                                    </div>


                                     <!-- Product Description -->
                                    <div class="col-xxl-4 col-sm-12" style="margin-bottom: 20px;">
                                        <label class="form-label" for="description">Product Description <span class="txt-danger">*</span></label>
                                        <textarea id="summernote" class="form-control" name="description" rows="5" placeholder="Enter Product Description here" required value="{{ old('description') }}"></textarea>
                                        <div class="invalid-feedback">Please enter Product Description here.</div>
                                    </div>


                                    <div class="col-xxl-4 col-sm-12" style="margin-bottom: 20px;">
                                        <label class="form-label" for="shipping">Shipping & Timeline <span class="txt-danger">*</span></label>
                                        <textarea id="shipping" class="form-control" name="shipping" rows="5" placeholder="Enter Shipping & Timeline here" required value="{{ old('description') }}"></textarea>
                                        <div class="invalid-feedback">Please enter Shipping & Timeline here.</div>
                                    </div>


                                    <div class="col-xxl-4 col-sm-12" style="margin-bottom: 20px;">
                                        <label class="form-label" for="return">Return & Exchanges <span class="txt-danger">*</span></label>
                                        <textarea id="return" class="form-control" name="return" rows="5" placeholder="Enter Return & Exchanges here" required value="{{ old('description') }}"></textarea>
                                        <div class="invalid-feedback">Please enter Return & Exchanges here.</div>
                                    </div>

                                    <!-- Thumbnail Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Thumbnail Image Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="dynamicTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Uploaded Thumbnail Image: <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewThumbnail(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="thumbnail_image[]" id="thumbnail_image_0" class="form-control" placeholder="Upload Thumbnail Image" multiple required>
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <div id="preview-container-0"></div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addRow">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Gallery Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Gallery Image Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="galleryTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Uploaded Gallery Image: <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewGalleryImage(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="gallery_image[]" id="gallery_image_0" class="form-control" placeholder="Upload Gallery Image" multiple required>
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <div id="gallery-preview-container-0"></div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addGalleryRow">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Product Prints Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Product Prints Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="printsTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Print Name</th>
                                                    <th>Uploaded Print Image:</th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="print_name[]" id="print_name_0" class="form-control">
                                                            <option value="">Select Print Name</option>
                                                            @foreach($product_prints as $id => $print_name)
                                                                <option value="{{ $id }}">{{ $print_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="file" onchange="previewPrintImage(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="print_image[]" id="print_image_0" class="form-control" placeholder="Upload Print Image">
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <div id="print-preview-container-0"></div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addPrintRow">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>



                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('product-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



<!--Thumbnail Preview-->
<script>
    function previewThumbnail(input, index) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${index}`);
        
        previewContainer.innerHTML = "";

        if (file) {
            const validTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
            if (!validTypes.includes(file.type)) {
                alert("Please upload a valid image file (.jpg, .jpeg, .png, .webp).");
                return;
            }
            if (file.size > 3 * 3072 * 3072) {
                alert("The file size should be less than 2MB.");
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "100px";  
                img.style.maxHeight = "100px"; 
                img.alt = "Preview Image";
                
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }

</script>

<!--Thumbnail Add More Option-->
<script>
    $(document).ready(function () {
        let rowId = 0;
        $('#addRow').click(function () {
            rowId++;
            const newRow = `
                <tr>
                    <td>
                        <input type="file" onchange="previewThumbnail(this, ${rowId})" accept=".png, .jpg, .jpeg, .webp" name="thumbnail_image[]" id="thumbnail_image${rowId}" class="form-control" placeholder="Upload thumbnail Image">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    </td>
                    <td>
                        <div id="preview-container-${rowId}"></div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                    </td>
                </tr>`;
            $('#dynamicTable tbody').append(newRow);
        });

        // Remove a row
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });
    });

    // Preview function for thumbnail images
    function previewThumbnail(input, rowId) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${rowId}`);

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file) {
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Create an image element for preview
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '100px';
                    img.style.objectFit = 'cover';

                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '<p>Unsupported file type</p>';
            }
        }
    }
</script>


<!--Gallery Image Preview & Add More Option-->
<script>
    $(document).ready(function () {
        let rowId = 0;

        // Add a new gallery image row
        $('#addGalleryRow').click(function () {
            rowId++;
            const newRow = `
                <tr>
                    <td>
                        <input type="file" onchange="previewGalleryImage(this, ${rowId})" accept=".png, .jpg, .jpeg, .webp" name="gallery_image[]" id="gallery_image_${rowId}" class="form-control" placeholder="Upload Gallery Image">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    </td>
                    <td>
                        <div id="gallery-preview-container-${rowId}"></div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeGalleryRow">Remove</button>
                    </td>
                </tr>`;
            $('#galleryTable tbody').append(newRow);
        });

        // Remove a gallery image row
        $(document).on('click', '.removeGalleryRow', function () {
            $(this).closest('tr').remove();
        });
    });

     // Preview function for gallery images
     function previewGalleryImage(input, rowId) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`gallery-preview-container-${rowId}`);

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file) {
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Create an image element for preview
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '100px';
                    img.style.objectFit = 'cover';

                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '<p>Unsupported file type</p>';
            }
        }
    }
</script>


<!--Product Prints Image Preview & Add More Option-->
<script>

    document.addEventListener("DOMContentLoaded", function () {
        let rowIndex = 1; // Start row index for new rows

        // Add row functionality
        document.getElementById("addPrintRow").addEventListener("click", function () {
            const tableBody = document.querySelector("#printsTable tbody");
            const newRow = document.createElement("tr");

            newRow.innerHTML = `
                <td>
                    <select name="print_name[]" id="print_name_0" class="form-control">
                        <option value="">Select Print Name</option>
                        @foreach($product_prints as $id => $print_name)
                            <option value="{{ $id }}">{{ $print_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="file" onchange="previewPrintImage(this, ${rowIndex})" accept=".png, .jpg, .jpeg, .webp" name="print_image[]" id="print_image_${rowIndex}" class="form-control" placeholder="Upload Print Image" required>
                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                    <br>
                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                </td>
                <td>
                    <div id="print-preview-container-${rowIndex}"></div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removePrintRow">Remove</button>
                </td>
            `;

            tableBody.appendChild(newRow);
            rowIndex++; // Increment row index for unique IDs
        });

        // Remove row functionality
        document.querySelector("#printsTable").addEventListener("click", function (e) {
            if (e.target.classList.contains("removePrintRow")) {
                const row = e.target.closest("tr");
                row.remove();
            }
        });
    });

    // Image preview function
    function previewPrintImage(input, index) {
        const previewContainer = document.getElementById(`print-preview-container-${index}`);
        previewContainer.innerHTML = ""; // Clear previous preview
        if (input.files) {
            Array.from(input.files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "100px";
                    img.style.marginRight = "10px";
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    }

</script>

 <!--Product Size elect 2 opt-->      
<script>
    $(document).ready(function() {
        $('#product_size').select2({
            placeholder: "Select Product Sizes",
            allowClear: true
        });
    });
</script>


<!--Product Color select 2 opt-->  
<script>
   $(document).ready(function () {
    const colorDropdown = $('#color_dropdown');

    // Map color names to their respective hex values
    const colorMap = {
        "Black": "#000000",
        "White": "#FFFFFF",
        "Red": "#FF0000",
        "Green": "#00FF00",
        "Blue": "#0000FF",
        "Yellow": "#FFFF00",
        "Orange": "#FFA500",
        "Purple": "#800080",
        "Pink": "#FFC0CB",
        "Brown": "#A52A2A",
        "Gray": "#808080",
        "Cyan": "#00FFFF",
        "Dark Green": "#008000",
        "Maroon": "#800000",
        "Teal": "#006666"
    };

    // Initialize Select2 with color swatches
    colorDropdown.select2({
        placeholder: "Select Colors",
        allowClear: true,
        templateResult: formatColorOption,
        templateSelection: formatColorOption
    });

    // Format options to display color swatches
    function formatColorOption(option) {
        if (!option.id) return option.text; // Handle placeholder
        const colorHex = colorMap[option.id] || "#ccc"; // Fallback for unknown colors
        return $(
            `<span style="display: inline-flex; align-items: center;">
                <span style="display: inline-block; width: 20px; height: 20px; background-color: ${colorHex}; margin-right: 8px; border-radius: 3px; border: 1px solid #ccc;"></span>
                ${option.text}
            </span>`
        );
    }
    });

</script>



</body>

</html>