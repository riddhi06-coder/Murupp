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
											<a href="{{ route('fabric-composition.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Order Tracking List</li>
									</ol>
								</nav>
                                <a href="#" class="btn btn-primary px-5 radius-30" data-bs-toggle="modal" data-bs-target="#updateOrderModal">
                                    Update Status
                                </a>

					</div>


                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Status</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->order_status == 'Order Placed') bg-success 
                                            @elseif($order->order_status == 'Pending') bg-warning 
                                            @else bg-danger @endif">
                                            {{ $order->order_status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y, h:i A') }}</td>
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

        <!-- Update Order Modal -->
        <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateOrderModalLabel">Update Order Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateOrderForm" method="POST" action="{{ route('order.update') }}">
                        @csrf
                        <div class="modal-body">

                            <!-- Order ID Dropdown -->
                            <div class="mb-3">
                                <label for="orderId" class="form-label">Select Order ID <span class="txt-danger">*</span></label>
                                <select class="form-select" id="orderId" name="order_id" required>
                                    <option value="">Select Order</option>
                                    @foreach($uniqueOrders as $order)
                                        <option value="{{ $order->order_id }}">{{ $order->order_id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Order Status Dropdown -->
                            <div class="mb-3">
                                <label for="orderStatus" class="form-label">Order Status <span class="txt-danger">*</span></label>
                                <select class="form-select" id="orderStatus" name="order_status" required>
                                    <option value=" ">Select Status</option>
                                    <option value="Order Placed">Order Placed</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Delivery Date -->
                            <div class="mb-3">
                                <label for="deliveryDate" class="form-label">Tentative Delivery Date</label>
                                <input type="date" class="form-control" id="deliveryDate" name="delivery_date" >
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

        <!-----to auto fetch the latest status as per the order id selectdd--->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                console.log("Script is running!");

                let orderIdDropdown = document.getElementById("orderId");
                let orderStatusDropdown = document.getElementById("orderStatus");

                console.log("Order ID Dropdown:", orderIdDropdown);
                console.log("Order Status Dropdown:", orderStatusDropdown);

                // Define the correct status order
                let statusOrder = ["Order Placed", "Processing", "Shipped", "Delivered", "Completed", "Cancelled"];

                if (orderIdDropdown) {
                    console.log("Adding event listener to Order ID dropdown...");

                    orderIdDropdown.addEventListener("change", function () {
                        console.log("Change event triggered!");

                        let selectedOrderId = this.value;
                        console.log("Selected Order ID:", selectedOrderId);

                        let orderStatusesRaw = @json($latestStatuses);
                        let orderStatuses = {};

                        Object.keys(orderStatusesRaw).forEach(key => {
                            orderStatuses[key] = orderStatusesRaw[key].order_status;
                        });

                        console.log("Parsed Order Statuses:", orderStatuses);

                        if (selectedOrderId && orderStatuses[selectedOrderId]) {
                            let latestStatus = orderStatuses[selectedOrderId];
                            console.log("Latest Status Found:", latestStatus);

                            // Set the value in the dropdown
                            orderStatusDropdown.value = latestStatus;

                            // Disable all statuses before the latest one
                            let latestStatusIndex = statusOrder.indexOf(latestStatus);
                            let options = orderStatusDropdown.options;

                            for (let option of options) {
                                let optionIndex = statusOrder.indexOf(option.value);

                                if (optionIndex < latestStatusIndex) {
                                    option.disabled = true;
                                } else {
                                    option.disabled = false;
                                }
                            }
                        } else {
                            console.log("No status found for Order ID:", selectedOrderId);
                        }
                    });
                } else {
                    console.error("Order ID dropdown not found in DOM!");
                }
            });
        </script>





</body>

</html>