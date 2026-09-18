<div class="customer-sidebar">


    <div class="sidebar-title">
        My Account
    </div>



    <ul class="sidebar-menu">


        <li>
            <a href="{{ route('customer.dashboard') }}"
               class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">

                <i class="fas fa-home"></i>
                Dashboard

            </a>
        </li>



        <li>
            <a href="{{ route('customer.orders') }}"
               class="{{ request()->routeIs('customer.orders*') ? 'active' : '' }}">

                <i class="fas fa-shopping-bag"></i>
                My Orders

            </a>
        </li>



        <li>
            <a href="{{ route('customer.cart') }}"
               class="{{ request()->routeIs('customer.cart') ? 'active' : '' }}">

                <i class="fas fa-shopping-cart"></i>
                Cart

            </a>
        </li>




        <li>
            <a href="{{ route('customer.profile') }}"
               class="{{ request()->routeIs('customer.profile') ? 'active' : '' }}">

                <i class="fas fa-user"></i>
                Profile

            </a>
        </li>




        <li>
            <a href="{{ route('customer.addresses') }}"
               class="{{ request()->routeIs('customer.addresses') ? 'active' : '' }}">

                <i class="fas fa-map-marker-alt"></i>
                Addresses

            </a>
        </li>




        <li>
            <a href="{{ route('customer.security') }}"
               class="{{ request()->routeIs('customer.security') ? 'active' : '' }}">

                <i class="fas fa-lock"></i>
                Security

            </a>
        </li>



        <li>

            <form method="POST"
                  action="{{ route('customer.logout') }}">

                @csrf


                <button type="submit"
                        class="logout-btn">

                    <i class="fas fa-sign-out-alt"></i>
                    Logout

                </button>


            </form>


        </li>


    </ul>


</div>