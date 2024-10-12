<div class="vertical-menu">
    
    <div data-simplebar class="h-100">
        
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                </li>
                
                <li class="{{ request()->is('admin/product') || request()->is('admin/product/*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ request()->is('admin/product') || request()->is('admin/product/*') ? 'mm-active' : '' }}">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ request()->is('admin/product') ? 'mm-active' : '' }}"><a class="{{ request()->is('admin/product')  ? 'active' : '' }}" href="{{ route('admin.product.index') }}" key="t-shops">List</a></li>
                        <li class="{{ request()->is('admin/product/create') || request()->is('admin/product/*/edit') ? 'mm-active' : '' }}"><a href="{{ route('admin.product.create') }}" key="t-add-product" class="{{ request()->is('admin/product/create') || request()->is('admin/product/*/edit') ? 'active' : '' }}">Add</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('admin.product.print') }}" class="waves-effect {{ request()->is('admin/product/print') || request()->is('admin/product/print/*') ? 'active' : '' }}">
                        <i class="bx bx-printer"></i>
                        <span key="t-chat">Print Code</span>
                    </a>
                </li>
            
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>