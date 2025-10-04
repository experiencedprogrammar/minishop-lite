{{-- resources/views/admin/products/edit.blade.php --}}
<x-app-layout>
    <div class="edit-product-container">
        <h2 class="form-title">Edit Product</h2>

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- show validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Product Name -->
            <div class="form-group">
                <label class="input-label" for="name">Product Name</label>
                <input class="text-input" id="name" type="text" name="name"
                       value="{{ old('name', $product->name) }}" required>
            </div>
            
            <!-- Description -->
            <div class="form-group">
                <label class="input-label" for="description">Description</label>
                <textarea class="textarea-input" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
            </div>
            
            <!-- Stock & Price -->
            <div class="form-row">
                <div class="form-group">
                    <label class="input-label" for="stock">Stock</label>
                    <input class="text-input" id="stock" type="number" name="stock"
                           value="{{ old('stock', $product->stock) }}" min="0" required>
                </div>
            
                <div class="form-group">
                    <label class="input-label" for="price">Price</label>
                    <input class="text-input" id="price" type="number" name="price" step="0.01"
                           value="{{ old('price', $product->price) }}" required>
                </div>
            </div>
                         
            <!-- Image + Buttons -->
            <div class="form-row">
                <div class="form-group" style="flex:1;">
                    <label class="input-label" for="image">Product Image</label>
                    <input id="image" type="file" name="image" accept="image/*" class="file-input">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80">
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-danger" id="cancel-btn">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('cancel-btn').addEventListener('click', function() {
            if (confirm('Cancel editing this product?')) {
                window.location.href = "{{ route('admin.products.index') }}";
            }
        });
    </script>
</x-app-layout>
