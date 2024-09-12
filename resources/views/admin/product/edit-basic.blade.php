<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="post" id="edit_product_form" enctype="multipart/form-data" action="{{ route('admin.product.update',['product' => $product->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="code">Product Code</label>
                                <input id="code" value="{{ $product->code }}" name="code" required type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="name">Product Name</label>
                                <input id="name" value="{{ $product->name }}" name="name" type="text" required class="form-control @error('name') is-invalid @enderror" placeholder="Product Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="material">Category</label>
                                <select id="category" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="material">Materials</label>
                                <input id="material" value="{{ $product->material }}" name="material" type="text" class="form-control @error('material') is-invalid @enderror" placeholder="Stainless steel">
                                @error('material')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="finishes">Description</label>
                                <textarea id="elm1" name="description">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-5">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--tinymce js-->
<script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script>

</script>