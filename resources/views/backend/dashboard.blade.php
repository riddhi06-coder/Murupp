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
                
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts -->
          <div class="container-fluid">
            <div class="row"> 
             
              <div class="col-xxl-6 box-col-12"> 
                <div class="row">
                  <div class="col-xl-5 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                              <svg>
                                <use href="{{ asset('admin/assets/svg/icon-sprite.svg#activity') }}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Sales</span>
                              <h2 class="f-w-600">₹98,459</h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">We have sale +18.2k this week.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-warning-light">
                              <svg>
                                <use href="{{ asset('admin/assets/svg/icon-sprite.svg#people') }}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Visitors</span>
                              <h2 class="f-w-600">54,156</h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">We have total +3.5k visitors this week.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-light">
                              <svg>
                                <use href="{{ asset('admin/assets/svg/icon-sprite.svg#task-square') }}"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Orders</span>
                              <h2 class="f-w-600">5,125</h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">We have total +5k orders this week.</span></li>
                        </ul>
                        
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
          <!-- Container-fluid Ends -->
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
      </div>
    </div>

        
     
        @include('components.backend.main-js')
</body>

</html>