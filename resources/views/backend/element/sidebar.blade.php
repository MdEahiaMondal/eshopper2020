@php
    use Illuminate\Support\Facades\Session;
    $url = url()->current();
    $adminDeatil = Session::get('adminDetails');
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{url('backend/img/profile_small.jpg')}}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('admin.setting') }}">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a class="{{ preg_match("/dashboard/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li>
                @if($adminDeatil->category_access == 1)
                    <a class="{{ preg_match("/category/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.category.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Categories</span></a>
                @endif
                @if($adminDeatil->product_all_access == 1 || $adminDeatil->product_edit_access == 1 || $adminDeatil->product_view_access == 1 || $adminDeatil->product_delete_access == 1)
                <a class="{{ preg_match("/product/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.product.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Products</span></a>
                @endif
                @if($adminDeatil->coupon_access == 1)
                    <a class="{{ preg_match("/coupon/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.coupon.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Coupons</span></a>
                @endif
                    <a class="{{ preg_match("/banner/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Banners</span></a>
                @if($adminDeatil->order_access == 1)
                    <a class="{{ preg_match("/order/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.order.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Order</span></a>
                @endif
                <a class="{{ preg_match("/cms_page/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.cms_page.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Cms Page</span></a>
                <a class="{{ preg_match("/currencie/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.currencie.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Currency</span></a>
                <a class="{{ preg_match("/shipping_charge/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.shipping_charge.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Shipping Charge</span></a>
                <a class="{{ preg_match("/role_permission/i",$url) ? 'sidebar_active' : '' }}" href="{{ route('admin.role_permission.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">User Role Permission</span></a>
            </li>

        </ul>
    </div>
</nav>
