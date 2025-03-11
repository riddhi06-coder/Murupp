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
                            <div class="d-flex justify-content-end">
                                <button id="exportCsvBtn" class="btn btn-primary">Export CSV</button>
                            </div><br><br>


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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


        <!------- Script for Report Generation----->
        <script>
            const reportData = {
                sales: {
                    headers: ["#", "Order ID", "Customer Name", "Total Amount", "Order Date"],
                    url: '{{ route("getReportData", ["sales"]) }}'
                },
                inventory: {
                    headers: ["#", "Product Name", "Category", "Stock Available"], 
                    url: '{{ route("getReportData", ["inventory"]) }}'
                },
                customers: {
                    headers: ["#", "Customer Name", "Email", "Total Orders", "Last Purchase"],
                    url: '{{ route("getReportData", ["customers"]) }}'
                },
                category: {
                    headers: ["#", "Category Name", "Total Products", "Total Sales"],
                    url: '{{ route("getReportData", ["category"]) }}'
                },
                product: {
                    headers: ["#", "Product Name", "Category", "Stock Left", "Total Sales"], 
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
                    // Store the data for CSV export
                    window.reportDataForExport = data;
                    let tableBodyHtml = "";

                    // Update table body with incremental IDs
                    $("#reportTable tbody").html(
                        data.map((row, index) => {
                            const incrementalId = index + 1;     
                                 
                             // 🟢 Handle Sales Report
                            if (reportType === "sales") {
                                const orderId = row.order_id
                                    ? `<a href="/order-tracking-details/${row.order_id}" class="order-link" target="_blank">${row.order_id}</a>`
                                    : '--';
                                const customerName = row.customer_name || '--';
                                const totalAmount = row.total_price || '--';
                                const orderDate = row.created_at || '--';

                                return `<tr>
                                    <td>${incrementalId}</td>
                                    <td>${orderId}</td>
                                    <td>${customerName}</td>
                                    <td>${totalAmount}</td>
                                    <td>${orderDate}</td>
                                </tr>`;
                            }

                            
                            // Handle Product Data: Product Name, Category, Stock Left, and Total Sales Count
                            if (reportType === "product") {
                                const productName = row.product_name || '--';
                                const category = row.category_name || '--';
                                const stockLeft = row.available_quantity !== null ? row.available_quantity : '--'; // Use available_quantity
                                const totalSales = row.total_sales_count !== null ? row.total_sales_count : '--'; // Use the new total sales count
                                return `<tr><td>${incrementalId}</td><td>${productName}</td><td>${category}</td><td>${stockLeft}</td><td>${totalSales}</td></tr>`;
                            }

                            // Other report types are handled similarly
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

            // Function to convert HTML table data to CSV format
            function convertTableToCSV() {
                const headers = [];
                const rows = [];

                // Capture table headers
                $("#tableHeaders th").each(function () {
                    headers.push($(this).text().trim());
                });

                // Capture entire data from DataTables API
                const table = $("#reportTable").DataTable();
                const data = table.rows().nodes(); // Fetch all rows

                $(data).each(function () {
                    const row = [];
                    $(this).find("td").each(function () {
                        if ($(this).find("a").length) {
                            row.push($(this).find("a").text().trim()); // Extract only text from links
                        } else {
                            row.push($(this).text().trim());
                        }
                    });
                    rows.push(row.join(",")); 
                });

                // Combine headers and rows to form CSV
                const csv = [headers.join(','), ...rows].join('\n');
                return csv;
            }

            // Function to trigger CSV export
            function exportToCSV() {
                if ($("#reportTable tbody tr").length === 0) {
                    alert("No data available to export.");
                    return;
                }

                const csv = convertTableToCSV();
                const reportType = $("#reportType").val();
                const fileName = `${reportType}_report.csv`;
                const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                saveAs(blob, fileName); 
            }

            // On dropdown change, load the selected report
            $("#reportType").on("change", function () {
                loadReport(this.value);
            });

            // Load default report on page load
            $(document).ready(function () {
                loadReport("sales"); // Default to Sales Report
            });

            // Export CSV when the button is clicked
            $("#exportCsvBtn").on("click", function () {
                exportToCSV();
            });
        </script>

      


</body>

</html>