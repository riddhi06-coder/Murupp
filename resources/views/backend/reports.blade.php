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
                            <table class="display" id="reportTable">
                                <thead>
                                    <tr id="tableHeaders">
                                        <!-- Table Headers will be dynamically loaded -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table Data will be dynamically loaded -->
                                </tbody>
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
                data: [
                    [1, "ORD123", "John Doe", "₹5000", "2024-03-08"],
                    [2, "ORD124", "Jane Smith", "₹3000", "2024-03-07"]
                ]
            },
            inventory: {
                headers: ["#", "Product Name", "Category", "Stock Available", "Price"],
                data: [
                    [1, "Laptop", "Electronics", "10", "₹50000"],
                    [2, "Shoes", "Fashion", "25", "₹2000"]
                ]
            },
            customers: {
                headers: ["#", "Customer Name", "Email", "Total Orders", "Last Purchase"],
                data: [
                    [1, "John Doe", "john@example.com", "5", "2024-03-07"],
                    [2, "Jane Smith", "jane@example.com", "3", "2024-03-06"]
                ]
            },
            category: {
                headers: ["#", "Category Name", "Total Products", "Total Sales", "Last Updated"],
                data: [
                    [1, "Electronics", "50", "₹500000", "2024-03-06"],
                    [2, "Fashion", "120", "₹150000", "2024-03-07"]
                ]
            },
            product: {  // NEW PRODUCT REPORT
                headers: ["#", "Product Name", "Category", "Total Sales", "Stock Left"],
                data: [
                    [1, "iPhone 14", "Electronics", "₹1,50,000", "5"],
                    [2, "Adidas Shoes", "Fashion", "₹25,000", "15"]
                ]
            }
        };

        function loadReport(reportType) {
            // Check if DataTable is already initialized
            if ($.fn.DataTable.isDataTable("#reportTable")) {
                $("#reportTable").DataTable().destroy(); // Destroy only if exists
            }

            // Update table headers
            $("#tableHeaders").html(reportData[reportType].headers.map(h => `<th>${h}</th>`).join(""));

            // Update table body
            $("#reportTable tbody").html(
                reportData[reportType].data.map(row => `<tr>${row.map(d => `<td>${d}</td>`).join("")}</tr>`).join("")
            );

            // Re-initialize DataTable
            $("#reportTable").DataTable({
                destroy: true,
                responsive: true,
                autoWidth: false
            });
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