

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @php
                $prefix = Request::route()->getPrefix();
                $route = Route::current()->getName();
            @endphp
        @if (Auth::user()->role == 'admin')
        <li class="nav-item has-treeview {{ ($prefix =='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.view') }}" class="nav-link {{ ($route =='users.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View User</p>
                    </a>
                </li>
            </ul>
      </li>
        @endif

      <li class="nav-item has-treeview {{ ($prefix =='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('profiles.view') }}" class="nav-link {{ ($route =='profiles.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Your Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profiles.password.view') }}" class="nav-link {{ ($route =='profiles.password.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Change Password</p>
                    </a>
                </li>
            </ul>
      </li>


         <li class="nav-item has-treeview {{ ($prefix =='/logos')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Logo
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('logos.view') }}" class="nav-link {{ ($route =='logos.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Logo</p>
                    </a>
                </li>
            </ul>
      </li>


        <li class="nav-item has-treeview {{ ($prefix =='/sliders')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Slider
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('sliders.view') }}" class="nav-link {{ ($route =='sliders.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Slider</p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview {{ ($prefix =='/contacts')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Contact
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('contacts.view') }}" class="nav-link {{ ($route =='contacts.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Contact</p>
                    </a>
                </li>
            </ul>
             <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('contacts.communicate') }}" class="nav-link {{ ($route =='contacts.communicate')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Communicate</p>
                    </a>
                </li>
            </ul>
        </li>


          <li class="nav-item has-treeview {{ ($prefix =='/abouts')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Abouts
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('abouts.view') }}" class="nav-link {{ ($route =='abouts.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Abouts</p>
                    </a>
                </li>
            </ul>
        </li>


         <li class="nav-item has-treeview {{ ($prefix =='/categories')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Categoty
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('categories.view') }}" class="nav-link {{ ($route =='categories.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Categoty</p>
                    </a>
                </li>
            </ul>
        </li>



          <li class="nav-item has-treeview {{ ($prefix =='/brands')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Brand
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('brands.view') }}" class="nav-link {{ ($route =='brands.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Brand</p>
                    </a>
                </li>
            </ul>
        </li>




         <li class="nav-item has-treeview {{ ($prefix =='/colors')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Color
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('colors.view') }}" class="nav-link {{ ($route =='colors.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Color</p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview {{ ($prefix =='/sizes')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Size
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('sizes.view') }}" class="nav-link {{ ($route =='sizes.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Size</p>
                    </a>
                </li>
            </ul>
        </li>



          <li class="nav-item has-treeview {{ ($prefix =='/products')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Product
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('products.view') }}" class="nav-link {{ ($route =='products.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Product</p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview {{ ($prefix =='/customers')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Customer
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('customers.view') }}" class="nav-link {{ ($route =='customers.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Customer</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('customers.draft.view') }}" class="nav-link {{ ($route =='customers.draft.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Draft Customer</p>
                    </a>
                </li>
            </ul>
        </li>


         <li class="nav-item has-treeview {{ ($prefix =='/orders')?'menu-open':''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Manage Orders
                <i class="fas fa-angle-left right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('orders.pending.list') }}" class="nav-link {{ ($route =='orders.pending.list')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Orders</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('orders.approved.list') }}" class="nav-link {{ ($route =='orders.approved.list')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Approved Orders</p>
                    </a>
                </li>
            </ul>
        </li>





    </ul>
</nav>

<!-- /.sidebar-menu -->


