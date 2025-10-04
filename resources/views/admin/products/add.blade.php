{{-- resources/views/admin/products/create.blade.php --}}
<x-app-layout>
    <div class="add-product-container">
        <h2 class="form-title">Add Product</h2>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="product-form">
            @csrf

            {{-- Product Name --}}
            <div class="form-group">
                <label class="input-label" for="name">Product Name</label>
                <input class="text-input" id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Enter product name">
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label class="input-label" for="description">Description</label>
                <textarea class="textarea-input" id="description" name="description" required placeholder="Enter product description">{{ old('description') }}</textarea>
            </div>

            {{-- Stock & Price --}}
            <div class="form-group flex gap-3">
                <div class="flex-1">
                    <label class="input-label" for="stock">Stock</label>
                    <input class="text-input" id="stock" type="number" name="stock" value="{{ old('stock') }}" required min="0" placeholder="Available stock">
                </div>

                <div class="flex-1">
                    <label class="input-label" for="price">Price</label>
                    <input class="text-input" id="price" type="number" name="price" value="{{ old('price') }}" step="0.01" required placeholder="Enter price">
                </div>
            </div>

            {{-- Product Image --}}
            <div class="form-group">
                <label class="input-label" for="image">Product Image</label>
                <input id="image" type="file" name="image" required>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="cancel-btn">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('cancel-btn').addEventListener('click', function() {
            if (confirm('Cancel adding this product?')) {
                window.location.href = "{{ route('admin.products.index') }}";
            }
        });

        // Enhanced form validation
        document.getElementById('product-form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const description = document.getElementById('description').value.trim();
            const stock = document.getElementById('stock').value;
            const price = document.getElementById('price').value;
            const image = document.getElementById('image').files[0];

            let errors = [];
            if (!name) errors.push('Product name is required');
            if (!description) errors.push('Description is required');
            if (!stock || stock < 0) errors.push('Valid stock quantity is required');
            if (!price || price <= 0) errors.push('Valid price is required');
            if (!image) errors.push('Product image is required');

            if (errors.length > 0) {
                e.preventDefault();
                alert('Please fix the following errors:\n\n' + errors.join('\n'));
            }
        });
    </script>
</x-app-layout>
