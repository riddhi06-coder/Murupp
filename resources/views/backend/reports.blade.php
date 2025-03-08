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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration Starts -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('stock-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Reports</li>
                            </ol>
                        </nav>

                        <!-- Wrapper to align label and select properly -->
                        <div class="d-flex align-items-center gap-2">
                            <label for="reportType" class="form-label mb-0"><strong>Select Report Type: </strong></label>
                            <select id="reportType" class="form-select w-auto">
                                <option value="sales">Sales Report</option>
                                <option value="inventory">Inventory Report</option>
                                <option value="customers">Customer Report</option>
                                <option value="category">Category Report</option>
                                <option value="product">Product Report</option>
                            </select>
                        </div>
                    </div>


                        <div class="table-responsive custom-scrollbar">
                        <table id="reportTable" class="table table-bordered">
                            <thead>
                                <tr id="tableHeaders"></tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Footer -->
        @include('components.backend.footer')

            
        @include('components.backend.main-js')

        
        <script>
            const reportData = {
                sales: {
                    headers: ["#", "Order ID", "Customer Name", "Total Amount", "Order Date"],
                    url: '{{ route("getReportData", ["sales"]) }}'
                },
                inventory: {
                    headers: ["#", "Product Name", "Category", "Stock Available"], // Correct order: Product Name, Category, Stock Available
                    url: '{{ route("getReportData", ["inventory"]) }}'
                },
                customers: {
                    headers: ["#", "Customer Name", "Email", "Total Orders", "Last Purchase"],
                    url: '{{ route("getReportData", ["customers"]) }}'
                },
                category: {
                    headers: ["#", "Category Name", "Total Products", "Total Sales", "Last Updated"],
                    url: '{{ route("getReportData", ["category"]) }}'
                },
                product: {
                    headers: ["#", "Product Name", "Category", "Stock Left", "Total Sales"], // Correct order: Product Name, Category, Stock Left
                    url: '{{ route("getReportData", ["product"]) }}'
                }
            };

            function loadReport(reportType) {
                // Check if DataTable is already initialized
                if ($.fn.DataTable.isDataTable("#reportTable")) {
                    $("#reportTable").DataTable().destroy(); // Destroy only if exists
                }

                // Update table headers
                $("#tableHeaders").html(reportData[reportType].headers.map(h => `<th>${h}</th>`).join(""));

                // Fetch data from the server
                $.get(reportData[reportType].url, function(data) {
                    // Update table body with incremental IDs
                    $("#reportTable tbody").html(
                        data.map((row, index) => {
                            const incrementalId = index + 1;

                            // Format the date in DD-MM-YYYY format if it exists (for sales reports)
                            if (row.created_at) {
                                row.created_at = formatDate(row.created_at);
                            }

                            // For inventory, adjust the columns to match the correct order
                            if (reportType === "inventory") {
                                // The order should be: Product Name, Category, Stock Available
                                const productName = row.product_name || '--';
                                const category = row.category_name || '--';
                                const stockAvailable = row.available_quantity !== null ? row.available_quantity : '--';
                                return `<tr><td>${incrementalId}</td><td>${productName}</td><td>${category}</td><td>${stockAvailable}</td></tr>`;
                            }

                            // For product, adjust the columns to match the correct order
                            if (reportType === "product") {
                                // The order should be: Product Name, Category, Stock Left
                                const productName = row.product_name || '--';
                                const category = row.category_name || '--';
                                const stockLeft = row.stock_left !== null ? row.stock_left : '--';
                                return `<tr><td>${incrementalId}</td><td>${productName}</td><td>${category}</td><td>${stockLeft}</td></tr>`;
                            }

                            // Map the row data into table cells for other report types
                            const rowData = Object.values(row).map(d => {
                                return d === null || d === undefined ? `<td>--</td>` : `<td>${d}</td>`;
                            }).join("");
                            return `<tr><td>${incrementalId}</td>${rowData}</tr>`;
                        }).join("")
                    );

                    // Re-initialize DataTable
                    $("#reportTable").DataTable({
                        destroy: true,
                        responsive: true,
                        autoWidth: false
                    });
                });
            }

            // Function to format the date to DD-MM-YYYY
            function formatDate(dateString) {
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0'); // Ensure 2-digit day
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Ensure 2-digit month
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            // On dropdown change, load the selected report
            $("#reportType").on("change", function () {
                loadReport(this.value);
            });

            // Load default report on page load
            $(document).ready(function () {
                loadReport("sales"); // Default to Sales Report
            });
        </script>



</body>

</html>