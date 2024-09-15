<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <a href="{{ route('home') }}" class="cr-logo">
                        <img src="{{ asset('FE/assets/img/logo/logo.png') }}" alt="logo" class="logo">
                        <img src="{{ asset('FE/assets/img/logo/dark-logo.png') }}" alt="logo" class="dark-logo">
                    </a>
                    <form class="cr-search" action="{{ route('search') }}">
                        @csrf
                        <input class="search-input" value="{{ isset(request()->pcode) ? request()->pcode : ''  }}" name="pcode" type="text" placeholder="Search For products...">
                        <select class="form-select" name="cid" aria-label="Default select example">
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
            <div class="text-center mt-3" style="color: #009adc">
                <h4>Welcome To Proxima Beyond Decor</h4>
            </div>
        </div>
    </div>
</header>