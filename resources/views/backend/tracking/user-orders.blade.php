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
											<a href="#">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Order Tracking List</li>
									</ol>
								</nav>
                                <!-- <a href="#" class="btn btn-primary px-5 radius-30" data-bs-toggle="modal" data-bs-target="#updateOrderModal">
                                    Update Status
                                </a> -->
					</div>

                    <div class="card-header">
                        <h4 class="mb-3">Order Details: <strong>{{ $user->name }}</strong></h4>
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
                                    <td>{{ \Carbon\Carbon::parse($order->status_updated_at)->format('d/m/Y, h:i A') }}</td>
                                    <td>
                                            <a href="{{ url('/order-tracking-details/' . $order->order_id) }}" class="btn btn-primary btn-sm">
                                                View Details
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <!-- Back Button After the Table -->
                        <div class="col-12 text-end mt-3">
                            <a href="{{ route('users.list') }}" class="btn btn-danger px-4">Back</a>
                        </div>
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
                                    @foreach($latestStatuses as $order)
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

      





</body>

</html>