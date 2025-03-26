
<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')

        <style>
            #ordersTable th, #ordersTable td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: center;
            }

            #ordersTable th {
                background-color: #f4f4f4;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            #ordersTable tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            #ordersTable tbody tr:hover {
                background-color: #f1f1f1;
            }

            /* Fixing column widths */
            #ordersTable {
                width: 100%;
                table-layout: fixed; 
                white-space: nowrap;
            }

            #ordersTable th, #ordersTable td {
                text-align: left;
                padding: 14px;
            }

            /* Set specific column widths */
            #ordersTable th:nth-child(1), #ordersTable td:nth-child(1) {
                width: 30%;
            }

            #ordersTable th:nth-child(2), #ordersTable td:nth-child(2) {
                width: 20%;
            }

            #ordersTable th:nth-child(3), #ordersTable td:nth-child(3) {
                width: 22%;
            }

            #ordersTable th:nth-child(4), #ordersTable td:nth-child(4) {
                width: 18%;
            }

            /* Search Box Styling */
            .dataTables_filter {
                margin-bottom: 15px; 
            }

            .dataTables_filter input {
                border: 1px solid #ccc;
                padding: 8px;
                border-radius: 5px;
                width: 200px;
            }

            /* Pagination */
            .dataTables_paginate .paginate_button {
                background: #007bff;
                color: #fff !important;
                padding: 5px 10px;
                border-radius: 4px;
                margin: 2px;
                font-size: 15px;
            }

            .dataTables_paginate .paginate_button.disabled {
                background: #ccc;
            }

        </style>
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">My Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                My Account
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- my-account -->
        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                            <div class="image">
                                <img src="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : asset('frontend/assets/images/user-account.png') }}" 
                                    alt="Profile Picture">
                            </div>

                                @if(Auth::check())
                                    <h6 class="mb_4">{{ $user->name }} {{ $user->last_name }}</h6>
                                    <div class="body-text-1">{{ $user->email }}</div>
                                @endif
                            </div>
                            <ul class="my-account-nav">
                                <li>
                                    <a href="{{ route('my.account') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Account Details
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('my.account.orders') }}" class="my-account-nav-item active">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Your Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.logout') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Logout
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="my-account-content">
                        <div class="account-orders">
                            <div class="wrap-account-order">
                                <table id="ordersTable" class="display nowrap table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <!-- <th>Status</th> -->
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F, Y') }}</td>
                                                <!-- <td>{{ ucfirst($order->status) }}</td> -->
                                                <td>
                                                    <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($order->total_price) }} for {{ collect(json_decode($order->quantities, true))->sum() }}
                                                    items
                                                </td>
                                                <td>
                                                    <a href="{{ route('my.account.order.details', ['order_id' => $order->order_id]) }}" 
                                                    class="tf-btn btn-fill radius-4" 
                                                    style="padding: 5px 10px; font-size: 12px; min-width: 100px; height: auto;">
                                                        <span class="text" style="font-size: 14px;">View</span>
                                                    </a>
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
        </section>
        <!-- /my-account -->

             
        @include('components.frontend.footer')

        <!-- jQuery (MUST BE LOADED FIRST) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        @include('components.frontend.main-js')

        <!-- DataTables Dependencies -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

        <!-- DataTables -->
        <script>
            jQuery.noConflict();
            jQuery(document).ready(function ($) {
                if (!$.fn.DataTable) {
                    console.error("DataTable plugin not loaded!");
                    return;
                }

                let table = $('#ordersTable').DataTable({
                    responsive: false, // Prevents collapsing into dropdown
                    autoWidth: false,
                    lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
                    scrollX: true, // Enables horizontal scrolling if needed
                    paging: true, // Enable pagination
                    lengthChange: true, // Allow user to change number of items per page
                    ordering: true,
                    order: [[1, 'desc']], // Sort by date (descending)
                    columnDefs: [
                        { targets: [3], orderable: false } // Disable sorting for "Actions" column
                    ],
                    language: {
                        search: "Search Orders:",
                        info: "Showing _START_ to _END_ of _TOTAL_ orders",
                        emptyTable: "No orders found",
                        zeroRecords: "No matching orders"
                    }
                });

                // Display total orders count
                let totalOrders = table.rows().count();
                $("#totalOrdersCount").text("Total Orders: " + totalOrders);
            });
        </script>


        <!-----Number format function---->
        <script>
            function number_format_indian($num) {
                    $num = round($num); 
                    $num = (string) $num;
                    $len = strlen($num);
                    
                    if ($len <= 3) {
                        return $num;
                    }
                    
                    $lastThree = substr($num, -3);
                    $remaining = substr($num, 0, -3);
                    $remaining = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $remaining);
                    
                    return $remaining . ',' . $lastThree;
                }
        </script>

</body>

</html>