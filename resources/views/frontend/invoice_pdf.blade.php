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
         background-color: #f5f5f5;
         color: #333;
      }

      .container {
         max-width: 850px;
         margin: 30px auto;
         background: #fff;
         padding: 25px;
         box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
         border-radius: 10px;
      }

      /* Header Section */
      .invoice-header {
         border-bottom: 3px solid #333;
         padding-bottom: 15px;
         margin-bottom: 25px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .invoice-logo img {
         max-width: 180px;
         height: auto;
      }

      .invoice-details {
         text-align: right;
      }

      .invoice-details h1 {
         font-size: 28px;
         margin: 0;
         color: #333;
         font-weight: bold;
      }

      .invoice-details p {
         margin: 3px 0;
         font-size: 14px;
         font-weight: 600;
         color: #666;
      }

      /* Customer & Address Section */
      .customer-info {
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 6px;
         background: #f8f8f8;
         margin-bottom: 20px;
      }

      .customer-row {
         display: flex;
         justify-content: space-between;
         align-items: center;
         font-size: 14px;
         padding: 5px 0;
      }

      .customer-row .left {
         text-align: left;
         font-weight: 600;
      }

      .customer-row .right {
         text-align: right;
         font-weight: 600;
      }

      /* Address Section */
      .address-section {
         display: flex;
         justify-content: space-between;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 6px;
         background: #f8f8f8;
         margin-bottom: 20px;
      }

      .bill-section, .ship-section {
         width: 48%;
      }

      .bill-section h2, .ship-section h2 {
         font-size: 16px;
         font-weight: bold;
         margin-bottom: 10px;
         color: #333;
      }

      .bill-section p, .ship-section p {
         font-size: 14px;
         line-height: 1.6;
         margin: 0;
      }

      .bold-text {
         font-weight: bold;
         font-size: 15px;
         color: #333;
      }

      /* Table Section */
      .table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      .table th, .table td {
         border: 1px solid #ddd;
         padding: 12px;
         text-align: left;
         font-size: 14px;
      }

      .table th {
         background-color: #333;
         color: white;
         font-weight: bold;
         text-transform: uppercase;
      }

      .table tr:nth-child(even) {
         background-color: #f9f9f9;
      }

      .table td {
         font-size: 14px;
      }

      /* Total Row */
      .table tfoot tr td {
         font-weight: bold;
         text-align: right;
         padding: 12px;
         background: #333;
         color: white;
         font-size: 16px;
      }

      /* Footer */
      .footer {
         text-align: center;
         font-size: 14px;
         color: #000;
         padding: 8px 0;
         border-top: 1px solid #ddd;
         font-weight: bold;
         max-width: 850px;
         margin: 10px auto 0;
      }
   </style>
</head>
<body>
   <div class="container">
      <!-- Invoice Header -->
      <div class="invoice-header">
         <div class="invoice-logo">
            <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" alt="Murupp">
         </div>
         <div class="invoice-details">
            <h1>INVOICE</h1>
            <p># {{ data_get($order, 'invoice_id', 'N/A') }}</p>
         </div>
      </div>

      <!-- Customer Information -->
      <div class="customer-info">
         <div class="customer-row">
            <div class="left"><strong>Name:</strong> {{ data_get($order, 'customer_name', 'N/A') }}</div>
            <div class="right"><strong>Email:</strong> {{ data_get($order, 'customer_email', 'N/A') }}</div>
         </div>
         <div class="customer-row">
            <div class="left"><strong>Phone:</strong> {{ data_get($order, 'customer_phone', 'N/A') }}</div>
            <div class="right"><strong>Order ID:</strong> {{ data_get($order, 'invoice_id', 'N/A') }}</div>
         </div>
      </div>

      <!-- Address Section -->
      <div class="address-section">
         <div class="bill-section">
            <h2>Billing Details</h2>
            <p class="bold-text">{{ data_get($order, 'customer_name', 'N/A') }}</p>
            <p>{{ data_get($order, 'billing_address', 'N/A') }}</p>
         </div>

         <div class="ship-section">
            <h2>Shipping Address</h2>
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

            @foreach($items as $index => $item)
               <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $item }}</td>
                  <td>{{ $quantities[$index] ?? 'N/A' }}</td>
                  <td>INR {{ number_format($prices[$index] ?? 0, 2) }}</td>
                  <td>INR {{ number_format(($prices[$index] ?? 0) * ($quantities[$index] ?? 1), 2) }}</td>
               </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <td colspan="4">Total</td>
               <td>INR {{ number_format(data_get($order, 'total_price', 0), 2) }}</td>
            </tr>
         </tfoot>
      </table>
   </div> <!-- Closing container div -->

   <!-- Footer moved outside the container -->
   <div class="footer">
      © {{ date('Y') }} Murupp. All rights reserved.
   </div>
</body>
</html>
