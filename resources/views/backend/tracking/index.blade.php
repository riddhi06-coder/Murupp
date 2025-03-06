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
							</div>


                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
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
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#updateOrderModal" 
                                            data-id="{{ $order->order_id }}" 
                                            data-status="{{ $order->order_status }}"
                                            data-delivery="{{ $order->delivery_date ?? '' }}"
                                            data-remarks="{{ $order->order_remarks  ?? '' }}">
                                            Update
                                        </button>
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
                            <input type="hidden" id="orderId" name="order_id">

                            <!-- Order Status Dropdown -->
                            <div class="mb-3">
                                <label for="orderStatus" class="form-label">Order Status <span class="txt-danger">*</span></label>
                                <select class="form-select" id="orderStatus" name="order_status" required>
                                    <option value="Order Placed" disabled {{ $order->order_status == 'Order Placed' ? 'selected' : '' }}>Order Placed</option>
                                    <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <!-- Delivery Date -->
                            <div class="mb-3">
                                <label for="deliveryDate" class="form-label">Tentative Delivery Date <span class="txt-danger">*</span></label>
                                <input type="date" class="form-control" id="deliveryDate" name="delivery_date" required>
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks <span class="txt-danger">*</span></label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
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

        <!--- js for order status update--->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var updateOrderModal = document.getElementById('updateOrderModal');

                if (updateOrderModal) {
                    updateOrderModal.addEventListener('show.bs.modal', function (event) {
                        var button = event.relatedTarget; 

                        var orderId = button.getAttribute('data-id'); 
                        var orderStatus = button.getAttribute('data-status'); 
                        var deliveryDate = button.getAttribute('data-delivery'); 
                        var remarks = button.getAttribute('data-remarks'); 

                        document.getElementById('orderId').value = orderId; 
                        document.getElementById('orderStatus').value = orderStatus; 
                        document.getElementById('deliveryDate').value = deliveryDate; 
                        document.getElementById('remarks').value = remarks; 
                    });
                }
            });

        </script>
</body>

</html>