<article class="products-table-alt2">
    <header class="products-header-alt2">
        <h2>Products</h2>
        <section class="header-actions-alt2">
            <a href="{{ route('admin.products.create') }}" class="btn-alt2 btn-success-alt2">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </section>
    </header>

    <section class="table-container-alt2">
        <table class="styled-table2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price (KES)</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <span class="no-image2">No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->description}}</td>
                        <td class="action-cell">
                            <div class="action-group">
                                <a href="{{ route('admin.products.index', $product->id) }}" class="btn-action2 btn-view2">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.products.edit',$product->id) }}" class="btn-action2 btn-edit2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action2 btn-delete2" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="no-records2">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</article>

<style>
/* New Font Import */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

.products-table-alt2 {
    background: #f8fafc;
    border: none;
    border-radius: 4px;
    padding: 16px;
    margin: 15px 0;
    font-family: 'Roboto', sans-serif;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* Header */
.products-header-alt2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e2e8f0;
}

.products-header-alt2 h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.header-actions-alt2 {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Add product button */
.btn-alt2 {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 16px;
    border-radius: 2px;
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-success-alt2 {
    background: linear-gradient(90deg, #06b6d4, #3b82f6);
    color: white;
}

.btn-success-alt2:hover {
    background: linear-gradient(90deg, #0891b2, #2563eb);
}

/* Table */
.table-container-alt2 {
    overflow-x: auto;
    border-radius: 2px;
}

.styled-table2 {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
    background: #fff;
    border-radius: 2px;
    overflow: hidden;
}

/* Table Head */
.styled-table2 thead tr {
    background: #1e293b;
}

.styled-table2 thead th {
    color: #f1f5f9;
    text-transform: uppercase;
    font-weight: 600;
    padding: 10px 12px;
    text-align: left;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
   
}

/* Table Body */
.styled-table2 td {
    padding: 8px 12px;
    text-align: left;
    vertical-align: middle;
    color: #334155;
    border-bottom: 1px solid #e2e8f0;
     font-size: 0.9rem;
}

/* New flex container for actions */
.action-group {
    display: flex;
    gap: 6px;              /* space between buttons */
    align-items: center;   /* keep them perfectly aligned */
    justify-content: center;
}

.action-group form {
    margin: 0;             /* remove form default spacing */
}

/* Rows */
.styled-table2 tbody tr:nth-child(even) {
    background: #f1f5f9;
}

.styled-table2 tbody tr:hover {
    background: #e2e8f0;
}

/* Images */
.styled-table2 img {
    height: 50px;
    width: 50px;
    object-fit: cover;
    border-radius: 2px;
    border: 1px solid #cbd5e1;
}

.no-image2 {
    color: #94a3b8;
    font-style: italic;
    font-size: 0.85rem;
}

/* Action buttons */
.btn-action2 {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 2px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-view2 {
    background-color: #3b82f6;
    color: white;
}
.btn-view2:hover { background-color: #1d4ed8; }

.btn-edit2 {
    background-color: #f59e0b;
    color: white;
}
.btn-edit2:hover { background-color: #d97706; }

.btn-delete2 {
    background-color: #ef4444;
    color: white;
}
.btn-delete2:hover { background-color: #b91c1c; }

/* Empty records */
.no-records2 {
    text-align: center;
    padding: 24px;
    color: #64748b;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .products-header-alt2 {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .btn-action2 {
        padding: 5px 9px;
        font-size: 0.8rem;
    }
}
</style>
