<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
    <link hef="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: #f9fafb;
    color: #374151;
    line-height: 1.5;
    padding: 12px;
}

.orders-table-alt {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    padding: 10px 8px 4px 8px;
    margin: 0 auto;
    max-width: 1280px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.orders-header-alt {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
}

.orders-header-alt h2 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
}

.header-actions-alt {
    display: flex;
    gap: 16px;
    align-items: center;
}

.search-form-alt input {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 1px;
    font-size: 0.9rem;
    width: 240px;
    transition: all 0.2s ease;
}

.search-form-alt input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}

.btn-alt {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 2px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-success-alt {
    background-color: #10b981;
    color: white;
}

.btn-success-alt:hover {
    background-color: #059669;
}

.table-container-alt {
    overflow-x: auto;
    border-radius: 2px;
    border: 1px solid #e5e7eb;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.8rem;
    background: #fff;
}

thead {
    text-transform: uppercase;
    color: #2FC56D;
    border-bottom: 2px solid #e2e8f0;
    font-family: 'Inter', sans-serif;
    background-color: #e8f5e9;
}
th {
    padding: 6px 4px;
    text-align: left;
    font-weight: 500;
    color: #2FC56D;
    border-bottom: 2px solid #e5e7eb;
}

tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

tbody tr:nth-child(even) {
    background-color: #f7fafc;
}

tbody tr:hover {
    background-color: #e0f2fe !important;
    cursor: pointer;
}

tbody tr {
    font-size: 0.8rem;
    font-weight: 500;
    color: #1f2937;
}

td {
    padding: 6px 4px;
    border-bottom: 1px solid #e5e7eb;
}

/* Action buttons */
.action-buttons {
    display: flex;
    gap: 6px;
}

.action-btn {
    border: none;
    padding: 6px 10px;
    border-radius: 2px;
    cursor: pointer;
    font-size: 0.8rem;
    color: #fff;
    transition: background 0.2s ease;
}

.view-btn {
    background-color: #3b82f6;
}
.view-btn:hover {
    background-color: #2563eb;
}

.process-btn {
    background-color: #f59e0b;
}
.process-btn:hover {
    background-color: #d97706;
}

.delete-btn {
    background-color: #ef4444;
}
.delete-btn:hover {
    background-color: #dc2626;
}

/* No Orders Found Section */
.no-orders {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
    color: #6b7280;
    font-family: 'Inter', sans-serif;
}

.no-orders i {
    font-size: 2rem;
    color: #9ca3af;
    margin-bottom: 12px;
}

.no-orders p:first-of-type {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

.no-orders p:last-of-type {
    font-size: 0.85rem;
    color: #6b7280;
}

/* Responsive */
@media (max-width: 768px) {
    .orders-header-alt {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .header-actions-alt {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }

    .search-form-alt input {
        width: 100%;
    }

    .btn-alt {
        justify-content: center;
    }
}
    </style>
</head>
<body>
    <main>
        <article class="orders-table-alt">
            <header class="orders-header-alt">
                <h2>Orders</h2>
                <section class="header-actions-alt">
                    <form action="{{ route('admin.orders.view') }}" method="GET" class="search-form-alt">
                        <input type="text" name="search" placeholder="Search orders..." value="{{ request('search') }}">
                    </form>
                    <a href="" class="btn-alt btn-success-alt">
                        <i class="fas fa-plus"></i> Create order
                    </a>
                </section>
            </header>

            <section class="table-container-alt">
                @if(isset($orders) && is_countable($orders) && count($orders) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Number:</th>
                            <th>Customer</th>
                            <th>Total(KES)</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Unknown' }}</td>

                            <td>{{ number_format($order->total, 2) }}</td>
                            <td>
                             @if($order->status === 'processed')
                             <button class="btn btn-sm btn-outline-success">Processed</button>
                             @else($order->status === 'pending')
                             <button class="btn btn-sm btn-outline-primary">Pending</button>
                             @endif
                             </td>

                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                             <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.order-items', $order->id) }}" class="action-btn view-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <button class="action-btn delete-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @else
                <div class="no-orders">
                    <i class="fas fa-box-open fa-4x"style="color:blue;"></i>
                    <p>No orders found</p>
                    <p>There are no orders to display at this time.</p>
                </div>
                @endif
            </section>
        </article>
    </main>
</body>
</html>
