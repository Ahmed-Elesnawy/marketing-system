
  <aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

        <li class="{{ is_active('home') }}">
            <a href="{{ route('dashboard.home') }}">
              <i class="fa fa-home"></i>
              <span>@lang('software.home')</span>
            </a>
        </li>

        <li class="{{ is_active('products') }}">
          <a href="{{ route('dashboard.products.index') }}">
            <i class="fa fa-product-hunt"></i> 
            <span>@lang('software.products')</span>
          </a>
        </li>

      @if ( auth()->user()->is_admin )

      <li class="{{ is_active('users') }}">
        <a href="{{ route('dashboard.users.index') }}">
          <i class="fa fa-users"></i> 
          <span>@lang('software.users')</span>
        </a>
      </li>


      <li class="{{ is_active('categories') }}">
        <a href="{{ route('dashboard.categories.index') }}">
          <i class="fa fa-list-alt"></i> <span>@lang('software.categories')</span>
        </a>
      </li>

      <li class="{{ is_active('provinces') }}">
        <a href="{{ route('dashboard.provinces.index') }}">
          <i class="fa fa-flag"></i> <span>@lang('software.provinces')</span>
        </a>
      </li>

      <li class="{{ is_active('colors') }}">
        <a href="{{ route('dashboard.colors.index') }}">
          <i class="fa fa-tint"></i> <span>@lang('software.colors')</span>
        </a>
        
      </li>

      


      <li class="{{ is_active('orders') }}">
        <a href="{{ route('dashboard.orders.index') }}">
          <i class="fa fa-shopping-cart"></i> <span>@lang('software.orders')</span>
        </a>


        
      </li>


      <li class="{{ is_active('money-requests') }}">
        <a href="{{ route('dashboard.requests.index') }}">
          <i class="fa fa-money"></i>
         <span> @lang('software.money_requests') </span>
        </a>
      </li>


      <li class="{{ is_active('tech-cards') }}">
        <a href="{{ route('dashboard.tech-cards.index') }}">
          <i class="fa fa-id-card-o"></i>
          <span>@lang('software.tech_cards')</span>
        </a>
      </li>


      <li class="{{ is_active('reports') }}">
        <a href="{{ route('dashboard.reports.index') }}">
          <i class="fa fa-bar-chart"></i>
          <span>@lang('software.reports')</span>
        </a>
      </li>

      @else

      


      <li class="{{ is_active('my-cards') }}">
        <a href="{{ route('dashboard.markter.myCards') }}">
          <i class="fa fa-credit-card"></i> 
          <span>@lang('software.my_cards')</span>
        </a>
      </li>


        <li class="{{ is_active('my-orders') }}">
            <a href="{{ route('dashboard.markter.orders') }}">
              <i class="fa fa-shopping-cart"></i>
              <span>@lang('software.my_orders')</span>
            </a>
        </li>

          <li class="{{ is_active('my-wallet') }}">
            <a href="{{ route('dashboard.markter.wallet') }}">
              <i class="fa fa-briefcase"></i>
              <span>@lang('software.my_wallet')</span>
            </a>
          </li>

         

        <li class="{{ is_active('profile') }}">
            <a href="{{ route('dashboard.users.editProfile') }}">
              <i class="fa fa-user"></i>
              <span>@lang('software.profile')</span>
            </a>
        </li>

      @endif


      <li class="{{ is_active('messages') }}">
        <a href="{{ route('dashboard.messages.index') }}">
          <i class="fa fa-envelope"></i>
          <span>@lang('software.admin_messages')</span>
        </a>
    </li>



      <li class="{{ is_active('notifications') }}">
        <a href="{{ route('dashboard.notifications.index') }}">
          <i class="fa fa-bell-o"></i>
          <span>@lang('software.notifications')</span>
        </a>
    </li>






    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

  