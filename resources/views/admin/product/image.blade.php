<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
<div class="card">
    <form method="post" id="edit_product_img" enctype="multipart/form-data" action="{{ route('admin.product.image',['product' => $product->id]) }}">
        @csrf
        <div class="card-body">
            <h4 class="card-title mb-3">Product Images</h4>
            <h6>Old Images</h6>
            <ul class="list-unstyled mb-0" id="dropzone-previews">
                    @foreach($product->images as $key => $image)
                        <li class="mt-2 dz-processing dz-image-preview dz-success dz-complete" id="old_{{ $image->id }}">
                            <div class="border rounded">
                                <div class="d-flex p-2">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-light rounded">
                                            <img data-dz-thumbnail="" class="img-fluid rounded d-block" src="{{ $image->image_url }}">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="pt-1">
                                            <h5 class="fs-md mb-1" data-dz-name="">{{ $image->image }}</h5>
                                            <strong class="error text-danger" data-dz-errormessage=""></strong>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <input type="hidden" name="old_images[]" value="{{ $image->id }}">
                                        {{-- delete button for delete current li--}}
                                        <button type="button" class="btn btn-sm btn-danger delete-image" data-id="{{ $image->id }}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
            </ul>
            <div class="dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple="multiple" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="dz-message needsclick">
                    <div class="mb-3">
                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                    </div>
                    
                    <h4>Drop files here or click to upload.</h4>
                </div>
            </div>
            
            <ul class="list-unstyled mb-0" id="dropzone-preview">
                <li class="mt-2" id="dropzone-preview-list">
                    <!-- This is used as the file preview template -->
                    <div class="border rounded">
                        <div class="d-flex p-2">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm bg-light rounded">
                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="../../../img.themesbrand.com/judia/new-document.png" alt="Dropzone-Image">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="pt-1">
                                    <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                    <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="d-flex flex-wrap gap-2 mt-5">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </div>
    </form>
</div> <!-- end card-->
<!-- select 2 plugin -->
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

<!-- Plugins js -->
<script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>

<script>
    // onclick delete button remove li
    $(document).on('click', '.delete-image', function(){
        var id = $(this).data('id');
        $('#old_'+id).remove();
    });
</script>