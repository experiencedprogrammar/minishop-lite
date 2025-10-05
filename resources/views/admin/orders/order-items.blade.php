<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Items Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Keep your existing CSS here */
        body { font-family: 'Inter', sans-serif; background: #f9fafb; padding: 12px; }
        .orders-table-alt { background: #fff; border: 1px solid #e5e7eb; border-radius: 4px; padding: 10px; max-width: 1280px; margin: 0 auto; }
        .orders-header-alt { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px; }
        .orders-header-alt h2 { font-size: 1.1rem; font-weight: 600; color: #111827; }
        .table-container-alt { overflow-x: auto; border-radius: 2px; border: 1px solid #e5e7eb; }
        table { width: 100%; border-collapse: collapse; font-size: 0.8rem; background: #fff; }
        thead { text-transform: uppercase; color: #2FC56D; border-bottom: 2px solid #e2e8f0; background-color: #e8f5e9; }
        th, td { padding: 6px 4px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        tbody tr:nth-child(odd) { background-color: #f9f9f9; }
        tbody tr:nth-child(even) { background-color: #f7fafc; }
        tbody tr:hover { background-color: #e0f2fe; cursor: pointer; }
    </style>
</head>
<body>
<main>
    <article class="orders-table-alt">
        <header class="orders-header-alt">
            <h2>Order Items</h2>
        </header>

        <section class="table-container-alt">
            @if(isset($orders) && count($orders) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price (KES)</th>
                        <th>Line Total (KES)</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Unknown' }}</td>
                            <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->line_total, 2) }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="no-orders">
                <i class="fas fa-box-open fa-4x" style="color:blue;"></i>
                <p>No order items found</p>
                <p>There are no order items to display at this time.</p>
            </div>
            @endif
        </section>
    </article>
</main>
</body>
</html>
