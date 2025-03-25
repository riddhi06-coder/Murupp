<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Invoice</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f9f9f9;
         color: #333;
      }

      .container {
         max-width: 800px;
         margin: 20px auto;
         background: #fff;
         padding: 20px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         border-radius: 8px;
      }

      .invoice-two-col-sec {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 20px;
      }

      .invoice-logo-sec img {
         max-width: 200px;
         height: auto;
      }

      .invoice-header-sec {
         text-align: right;
      }

      .invoice-header-sec h1 {
         font-size: 26px;
         margin: 0;
         color: #333;
      }

      .invoice-header-sec p {
         margin: 0;
         font-weight: 600;
         font-size: 14px;
         color: #666;
      }

      .address-section {
         display: flex;
         justify-content: space-between;
         align-items: flex-start;
         margin-bottom: 20px;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 5px;
         background: #f4f4f4;
      }

      .bill-section,
      .ship-section {
         width: 48%;
      }

      .bill-section h2,
      .ship-section h2 {
         font-size: 16px;
         font-weight: bold;
         margin-bottom: 8px;
      }

      .bill-section p,
      .ship-section p {
         font-size: 14px;
         line-height: 1.6;
         margin: 0;
      }

      .bold-text {
         font-weight: bold;
      }

      .table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      .table th,
      .table td {
         border: 1px solid #ddd;
         padding: 10px;
         text-align: left;
      }

      .table th {
         background-color: #333;
         color: white;
         font-weight: bold;
      }

      .table tr:nth-child(even) {
         background-color: #f9f9f9;
      }

      .table td {
         font-size: 14px;
      }

      .footer {
         text-align: center;
         margin-top: 25px;
         font-size: 14px;
         color: #000;
         padding: 10px 0;
         border-top: 1px solid #ddd;
      }

      @media (max-width: 600px) {
         .invoice-two-col-sec {
            flex-direction: column;
            align-items: center;
            text-align: left;
         }

         .invoice-header-sec {
            text-align: left;
         }

         .address-section {
            flex-direction: column;
            align-items: center;
            text-align: left;
         }

         .bill-section,
         .ship-section {
            width: 100%;
         }
      }
   </style>
</head>
<body>
   <div class="container">
      <!-- Invoice Header -->
      <div class="invoice-two-col-sec">
         <div class="invoice-logo-sec">
            <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" alt="Murupp" class="logo">
         </div>
         <div class="invoice-header-sec">
            <h1>INVOICE</h1>
            <p># {{ data_get($order, 'invoice_id', 'N/A') }}</p>
         </div>
      </div>

      <!-- Address Section -->
      <div class="address-section">
         <div class="bill-section">
            <h2>Billing Details :</h2>
            <p class="bold-text">{{ data_get($order, 'customer_name', 'N/A') }}</p>
            <p>{{ data_get($order, 'billing_address', 'N/A') }}</p>
         </div>
         <div class="ship-section">
            <h2>Shipping Address :</h2>
            <p>{{ data_get($order, 'shipping_address', 'N/A') }}</p>
         </div>
      </div>

      <!-- Table Section -->
      <table class="table">
         <thead>
            <tr>
               <th>#</th>
               <th>Product Name</th>
               <th>Qty</th>
               <th>Rate</th>
               <th>Amount</th>
            </tr>
         </thead>
         <tbody>
            @php
               $items = json_decode(data_get($order, 'product_names', '[]'), true);
               $quantities = json_decode(data_get($order, 'quantities', '[]'), true);
               $prices = json_decode(data_get($order, 'prices', '[]'), true);
            @endphp

            @if(!empty($items) && is_array($items))
                @foreach($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item }}</td>
                        <td>{{ $quantities[$index] ?? 'N/A' }}</td>
                        <td>₹{{ number_format($prices[$index] ?? 0, 2) }}</td>
                        <td>₹{{ number_format(($prices[$index] ?? 0) * ($quantities[$index] ?? 1), 2) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center;">No items found.</td>
                </tr>
            @endif

            <!-- Total Row -->
            <tr>
               <td colspan="4" style="text-align: right;"><b>Total</b></td>
               <td>₹{{ number_format(data_get($order, 'total_price', 0), 2) }}</td>
            </tr>
         </tbody>
      </table>

      <!-- Footer -->
      <div class="footer">
         <div class="copyright">© {{ date('Y') }} Murupp. All rights reserved.</div>
      </div>
   </div>
</body>
</html>
