<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <a href="{{ route('home') }}" class="cr-logo d-flex">
                        <img src="{{ asset('FE/assets/img/logo/logo-light.svg') }}" style="margin-right: 10px;" alt="logo" >
                        <img src="{{ asset('FE/assets/img/logo/logo.png') }}" alt="logo" class="logo">
                    </a>
                    <form class="cr-search" id="product_search" action="{{ route('search') }}">
                        @csrf
                        <input class="search-input" value="{{ isset(request()->pcode) ? request()->pcode : ''  }}" name="pcode" id="pcode" type="text" placeholder="Search For products...">
                        <div id="suggesstion-box"></div>
                        <select class="form-select" name="cid" id="cid" aria-label="Default select example">
                            <option value="" selected>All Categories</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ isset(request()->cid) && request()->cid == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button href="javascript:void(0)" class="search-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-fix" id="cr-main-menu-desk">
        <div class="container">
            <div class="text-center mt-3" style="color: #f31f87">
                <h4>Welcome To Proxima Beyond Decor</h4>
            </div>
        </div>
    </div>
</header>