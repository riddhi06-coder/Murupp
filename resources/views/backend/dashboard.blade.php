<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.3.0/apexcharts.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.3.0/apexcharts.min.js"></script>
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
              <div class="col-xl-6 box-col-7"> 
                <div class="card">
                  <div class="card-header sales-chart card-no-border pb-0">
                    <h4>Sales Chart </h4>
                    <div class="sales-chart-dropdown">
                      <div class="sales-chart-dropdown-select">
                        <div class="card-header-right-icon online-store">
                          <div class="dropdown">
                            <button class="btn dropdown-toggle dropdown-toggle-store" id="dropdownMenuButtonToggle" data-bs-toggle="dropdown" aria-expanded="false">Online Store</button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonToggle" role="menu"><span class="dropdown-item">All </span><span class="dropdown-item">Employee</span><span class="dropdown-item">Client    </span></div>
                          </div>
                        </div>
                        <div class="card-header-right-icon"> 
                          <div class="dropdown"> 
                            <button class="btn dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Last Year  </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1" role="menu"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week </span><span class="dropdown-item">Today  </span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-body p-2 pt-0">
                    <div class="sales-wrapper">
                      <div id="saleschart"> </div>
                    </div>
                  </div>
                </div>
              </div>


                <div class="col-xl-6 col-md-12 box-col-5 total-revenue-total-order">
                  <div class="row">
                    <!-- Total Revenue -->
                    <div class="col-xl-12">
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="total-revenue mb-2"> 
                                    <span>Total Revenue</span>
                                </div>
                                <h3 class="f-w-600">₹{{ number_format($totalRevenueAmount, 2) }}</h3> 
                                <div class="total-revenue-chart">
                                    <div id="revenue" style="width: 100%; height: 250px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                 <!-- Total Order -->
                <div class="col-xl-12">
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="total-revenue mb-2">
                                    <span>Total Orders</span>
                                    <a href="index.html">View Report</a>
                                </div>
                                <h3 class="f-w-600" id="totalOrderCount">{{ $totalOrderCount }}</h3> 
                                <div class="total-chart">
                                    <div class="total-order">
                                        <div id="totalOrder" style="width: 200%; height: 250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

              
              <div class="col-xxl-6 box-col-12"> 
                <div class="row">
                  <div class="col-xl-5 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                              <svg>
                                <use href="../assets/svg/icon-sprite.svg#activity"></use>
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
                                <use href="../assets/svg/icon-sprite.svg#people"></use>
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
                                <use href="../assets/svg/icon-sprite.svg#task-square"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Orders</span>
                              <h2 class="f-w-600">5,125</h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">We have total +5k orders this week.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-danger-light">
                              <svg>
                                <use href="../assets/svg/icon-sprite.svg#money-recive"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Refunded</span>
                              <h2 class="f-w-600">₹20,000</h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">We got +66k refund this week.</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-7 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-header pb-0 total-revenue card-no-border"> 
                        <h4>Sale History </h4><a href="index.html">View All</a>
                      </div>
                      <div class="card-body"> 
                        <ul>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="category.html">Oxford shirt with rolled sleeve</a><span class="mb-0 txt-primary f-w-600 f-16">₹1500.14</span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0">United States</span><span class="f-w-400 f-14 f-light">50 min ago</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="category.html">Jordans 1 high neck tshirt</a><span class="mb-0 txt-primary f-w-600 f-16">₹1800.87</span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0">Canada</span><span class="f-w-400 f-14 f-light">40 min ago</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="category.html">Graphic Print Men Round Neck Whi...</a><span class="mb-0 txt-primary f-w-600 f-16">₹2000.84</span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0">United States</span><span class="f-w-400 f-14 f-light">35 min ago</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="category.html">Full Sleeve Solid Women Denim Jac...</a><span class="mb-0 txt-primary f-w-600 f-16">₹1500.14</span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0">Australia</span><span class="f-w-400 f-14 f-light">50 min ago</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="category.html">Slim Women Black Jeans</a><span class="mb-0 txt-primary f-w-600 f-16">₹780.25</span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0">UK</span><span class="f-w-400 f-14 f-light">28 min ago</span></div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xxl-3 col-md-6 box-col-6">
                <div class="card">
                  <div class="card-header total-revenue card-no-border">
                    <h4>Top Revenue Product</h4>
                    <div class="sales-chart-dropdown-select">
                      <div class="card-header-right-icon">
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" id="dropdownMenuButtonup" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonup" role="menu"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week  </span><span class="dropdown-item">Last Day </span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0"> 
                    <div class="revenueproduct" id="revenueproduct"> </div>
                    <div class="sales-chart-dropdown"> 
                      <ul class="balance-data flex-wrap flex">
                        <li><span class="circle bg-primary"></span><span class="f-light ms-1">Men & Women Jeans</span></li>
                        <li><span class="circle bg-warning"></span><span class="f-light ms-1">Men & Women T-shirts</span></li>
                        <li><span class="circle bg-secondary"></span><span class="f-light ms-1">Men & Women Shoes</span></li>
                        <li><span class="circle bg-light"></span><span class="f-light ms-1">Kurtas & Kurti</span></li>
                      </ul>
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

    
    <!-- Total Revenue graphh ajaxx-->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          var revenueOptions = {
              chart: {
                  type: "scatter",  
                  height: 250, 
                  width: "100%",
                  toolbar: { show: false }
              },
              series: [{
                  name: "Revenue",
                  data: @json($revenues)  
              }],
              xaxis: {
                  categories: @json($months), 
                  title: { text: "Months" },
                  labels: {
                      rotate: -45, 
                      style: { fontSize: '12px' }
                  }
              },
              yaxis: {
                  title: { text: "Revenue (₹)" }
              },
              colors: ["#008FFB"],
              markers: {
                  size: 6, 
                  colors: ["#008FFB"],
                  strokeColors: "#fff",
                  strokeWidth: 2
              },
              tooltip: {
                  shared: false,
                  y: {
                      formatter: function (val) {
                          return "₹" + val.toFixed(2);
                      }
                  }
              },
              grid: {
                  padding: {
                      left: 10,
                      right: 10,
                      top: 10,
                      bottom: 10
                  }
              }
          };

          var chart = new ApexCharts(document.querySelector("#revenue"), revenueOptions);
          chart.render();
      });
    </script>

    <!-- Total Total Orders graph ajaxx-->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          var orderOptions = {
              chart: {
                  type: "bar",
                  height: 300,
                  width: "140%",
                  toolbar: { show: false },
                  zoom: { enabled: false }
              },
              series: [{
                  name: "Total Orders",
                  data: @json($orders)
              }],
              xaxis: {
                  categories: @json($months),
                  title: { text: "Months" },
                  labels: { rotate: -45 }
              },
              yaxis: {
                  title: { text: "Total Orders" },
                  labels: {
                      formatter: function (val) {
                          return val.toLocaleString("en-IN");
                      }
                  }
              },
              plotOptions: {
                  bar: {
                      columnWidth: "35%",
                      borderRadius: 6,
                      distributed: true  // Ensures each bar gets a different color
                  }
              },
              colors: ["#FF5733", "#36A2EB", "#4CAF50", "#FFC107", "#9B59B6", "#E91E63", "#8E44AD", "#2ECC71", "#F39C12", "#3498DB"],
              tooltip: {
                  theme: "light",
                  y: {
                      formatter: function (val) {
                          return val.toLocaleString("en-IN") + " Orders";
                      }
                  }
              },
              grid: {
                  borderColor: "#ddd",
                  strokeDashArray: 4,
                  padding: {
                      left: 20,
                      right: 20,
                      top: 10,
                      bottom: 10
                  }
              }
          };

          var chart = new ApexCharts(document.querySelector("#totalOrder"), orderOptions);
          chart.render();
      });
    </script>

    <!-- Total Sales Chart graph ajaxx-->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          // Ensure data is not null/undefined, default to empty arrays
          var ordersCurrentYear = @json($orders_current_year) || [];
          var revenuesCurrentYear = @json($revenues_current_year) || [];
          var monthsCurrentYear = @json($months_current_year) || [];

          var ordersCurrentMonth = @json($orders_last_month) || [];
          var revenuesCurrentMonth = @json($revenues_last_month) || [];
          var monthsCurrentMonth = @json($months_last_month) || [];

          var ordersLastYear = @json($orders_last_year) || [];
          var revenuesLastYear = @json($revenues_last_year) || [];
          var monthsLastYear = @json($months_last_year) || [];

          var ordersLastWeek = @json($orders_last_week) || [];
          var revenuesLastWeek = @json($revenues_last_week) || [];
          var daysLastWeek = @json($days_last_week) || [];

          var ordersToday = @json($orders_today) || [];
          var revenuesToday = @json($revenues_today) || [];
          var hoursToday = @json($hours_today) || [];

          // **Default to Current Year, then Current Month, then Last Year**
          var defaultOrders = ordersCurrentYear.length ? ordersCurrentYear :
                              ordersCurrentMonth.length ? ordersCurrentMonth : ordersLastYear;
          var defaultRevenues = revenuesCurrentYear.length ? revenuesCurrentYear :
                                revenuesCurrentMonth.length ? revenuesCurrentMonth : revenuesLastYear;
          var defaultCategories = monthsCurrentYear.length ? monthsCurrentYear :
                                  monthsCurrentMonth.length ? monthsCurrentMonth : monthsLastYear;

          // Debugging: Check if data exists
          console.log("Default Orders:", defaultOrders);
          console.log("Default Revenues:", defaultRevenues);
          console.log("Default Categories:", defaultCategories);

          // If still empty, warn the user
          if (defaultOrders.length === 0 || defaultRevenues.length === 0) {
              console.warn("No data available. Defaulting to Last Year data.");
          }

          var chartOptions = {
              chart: {
                  type: "line",
                  height: 350,
                  zoom: { enabled: false },
                  toolbar: { show: false }
              },
              series: [
                  { name: "Total Orders", data: defaultOrders },
                  { name: "Total Revenue", data: defaultRevenues }
              ],
              xaxis: {
                  categories: defaultCategories,
                  title: { text: "Time Period" }
              },
              yaxis: {
                  title: { text: "Values" },
                  labels: {
                      formatter: function (val) {
                          return val.toLocaleString("en-IN");
                      }
                  }
              },
              stroke: { curve: "smooth", width: 3 },
              colors: ["#28A745", "#FFC107"], 
              markers: {
                  size: 5,
                  colors: ["#17A2B8", "#E83E8C"],
                  strokeColors: "#fff",
                  strokeWidth: 2
              },
              tooltip: {
                  theme: "light",
                  y: { formatter: function (val) { return val.toLocaleString("en-IN"); } }
              },
              grid: {
                  borderColor: "#ddd",
                  strokeDashArray: 4,
                  padding: { left: 20, right: 20, top: 10, bottom: 10 }
              }
          };

          var chart = new ApexCharts(document.querySelector("#saleschart"), chartOptions);
          chart.render();

          // **Dropdown filter event listener**
          document.querySelectorAll(".dropdown-menu .dropdown-item").forEach(item => {
              item.addEventListener("click", function () {
                  let selectedPeriod = this.textContent.trim();
                  let updatedData = { series: [], categories: [] };

                  if (selectedPeriod === "Current Year") {
                      updatedData.series = [
                          { name: "Total Orders", data: ordersCurrentYear },
                          { name: "Total Revenue", data: revenuesCurrentYear }
                      ];
                      updatedData.categories = monthsCurrentYear;
                  } else if (selectedPeriod === "Last Month") {
                      updatedData.series = [
                          { name: "Total Orders", data: ordersCurrentMonth },
                          { name: "Total Revenue", data: revenuesCurrentMonth }
                      ];
                      updatedData.categories = monthsCurrentMonth;
                  } else if (selectedPeriod === "Last Week") {
                      updatedData.series = [
                          { name: "Total Orders", data: ordersLastWeek },
                          { name: "Total Revenue", data: revenuesLastWeek }
                      ];
                      updatedData.categories = daysLastWeek;
                  } else if (selectedPeriod === "Today") {
                      updatedData.series = [
                          { name: "Total Orders", data: ordersToday },
                          { name: "Total Revenue", data: revenuesToday }
                      ];
                      updatedData.categories = hoursToday;
                  } else {
                      // Default: Show Current Year or Month
                      updatedData.series = [
                          { name: "Total Orders", data: defaultOrders },
                          { name: "Total Revenue", data: defaultRevenues }
                      ];
                      updatedData.categories = defaultCategories;
                  }

                  // Debugging: Check updated data
                  console.log("Updated Data for:", selectedPeriod);
                  console.log("Orders:", updatedData.series[0].data);
                  console.log("Revenue:", updatedData.series[1].data);
                  console.log("Categories:", updatedData.categories);

                  // Update Chart Properly
                  chart.updateSeries(updatedData.series);
                  chart.updateOptions({ xaxis: { categories: updatedData.categories } });

                  // Update Button Label
                  document.querySelector("#dropdownMenuButton1").textContent = selectedPeriod;
              });
          });
      });
    </script>











        
</body>

</html>