<style>
    .image-container {
        display: flex; /* Optional: to align multiple images side by side */
        justify-content: center; /* Center the image horizontally */
        align-items: center; /* Center the image vertically */
        overflow: hidden; /* Hide overflow if the image is larger than the container */
        width: 100%; /* Set your desired container width */
        max-width: 400px; /* Optional: Set a maximum width for the container */
        height: 300px; /* Set the height of the container */
        background-color: #f0f0f0; /* Optional: Set a background color for aesthetics */
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Crop the image to fill the container while preserving aspect ratio */
    }
</style>
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                @if($product->images()->count() > 0)
                                    <div class="product-detai-imgs">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3 col-4">
                                                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    @foreach($product->images as $key => $image)
                                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="product-{{ $key + 1 }}-tab" data-bs-toggle="pill" href="#product-{{ $key + 1 }}" role="tab" aria-controls="product-{{ $key + 1 }}" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                                                            <img src="{{ $image->image_url }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    @foreach($product->images as $key => $image)
                                                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="product-{{ $key + 1 }}" role="tabpanel" aria-labelledby="product-{{ $key + 1 }}-tab">
                                                            <div class="image-container">
                                                                <img src="{{ $image->image_url }}" style="width: auto;" alt="" class="img-fluid mx-auto d-block">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="mt-4 mt-xl-3">
                                    <a href="javascript: void(0);" class="text-primary">{{ $product->category->name }}</a>
                                    <h4 class="mt-1 mb-3">{{ $product->name }} ({{ $product->code }})</h4>
                                    <h5 class="mb-4">Materials : <b>{{ $product->material != '' ? $product->material : '-' }}</b></h5>
                                    @if($product->price_per != '' && $product->price_per != 'none')
                                        <h5 class="mb-4">Rate Per : <b>{{ $product->price_per != '' && $product->price_per != 'none' ? ucwords($product->price_per) : '-' }}</b></h5>
                                    @endif
                                    @if ($product->MRP != '' && $product->MRP != 0)
                                        <h5 class="mb-4">MRP : <b>{{ $product->MRP != '' ? $product->MRP : '-' }}</b></h5>
                                    @endif
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @if ($product->attributes()->count() > 0)
                            <div class="mt-5">
                                <h5 class="mb-3">Specifications :</h5>
                                <p>Note : <b style="color: red">Red font</b> value is currently not available in the display.</p>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table mb-0 table-striped mb-0">
                                                    <thead class="table-light">
                                                    <tr>
                                                        @if($product->attributes()->count() > 0)
                                                            @foreach($product->attributes as $attribute)
                                                                <th style="background-color: #939598;color: white;">{{ $attribute->name }}</th>
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        // Find the maximum number of rows in the values for any attribute
                                                        $maxRows = $attributes->map(function($attribute) {
                                                            return $attribute->attributeValues->count();
                                                        })->max();
                                                    @endphp
                                                    @for ($i = 0; $i < $maxRows; $i++)
                                                        <tr>
                                                            {{-- Loop through each attribute --}}
                                                            @foreach ($attributes as $attribute)
                                                                <td>
                                                                    {{-- Check if there is a value for the current row ($i) --}}
                                                                    @if (isset($attribute->attributeValues[$i]))
                                                                        <p style="{{ $attribute->attributeValues[$i]->is_available == 0 ? 'color:red;' : '' }}">{{ $attribute->attributeValues[$i]->value }}</p>
                                                                    @else
                                                                        {{-- If there is no value, leave the cell empty --}}
                                                                        &nbsp;
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                                @if($product->price_per != '' && $product->price_per != 'none')
                                                    <p class="mt-2">Rate Per {{ ucwords($product->price_per) }}</p>
                                                @endif
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- end Specifications -->
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->
    
    </div> <!-- container-fluid -->
</div>