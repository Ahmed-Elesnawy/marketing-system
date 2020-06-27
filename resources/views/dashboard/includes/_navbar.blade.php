<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            @if ( user()->is_markter )
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="label label-warning">
                         {{ $cart_count }}
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">

                        <!-- Modal  --> 

                            @if ( !Cart::session(user()->id)->isEmpty() )
                            <button style="margin-left:3px" type="button" class="btn btn-success" data-toggle="modal" data-target="#complete-order">
                                            
                                @lang('software.complete_order')
                            
                            
                            </button>
                            @else
                            العربة فارغة
                            @endif
                            
                            
  
  

                    </li>
                    
                    <li class="footer"><a href="/cart">عربة التسوق</a></li>
                </ul>
            </li>
            @endif
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                  <a data-link="{{ route('dashboard.notification.read') }}" class="notification-bell" href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">
                          {{ $notifications_count }}
                      </span>
                  </a>
                  <ul class="dropdown-menu">
                      <li class="header">
                          {{ trans('software.new_notifications',['count' => $notifications_count ] ) }}
                      </li>
                      <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                              @foreach  ($notifications as $not)
                               @if ( $not->type == 'App\Notifications\NewUserCreated' )
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-aqua"></i> @lang('software.new_user_created',['name' => $not->data['username']])
                                    </a>
                                </li>
                                @endif

                                @if ( $not->type == 'App\Notifications\NewOrderCreated' )
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-aqua"></i> @lang('software.new_order_created',['id' => $not->data['orderId']])
                                    </a>
                                </li>
                                @endif
                              @endforeach
                          </ul>
                      </li>
                      <li class="footer"><a href="{{ route('dashboard.notifications.index') }}">View all</a></li>
                  </ul>
              </li>

              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ auth()->user()->image_path}}" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{ auth()->user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                          <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">

                          <p>
                              {{ auth()->user()->name }}
                              <small> مسجل {{ auth()->user()->created_at->diffForHumans() }}</small>
                          </p>
                      </li>
                      
                      <!-- Menu Footer-->
                      <li class="user-footer">
                          <div class="pull-left">
                              <a href="{{ route('dashboard.users.editProfile') }}" class="btn btn-default btn-flat">@lang('software.profile')</a>
                          </div>
                          <div class="pull-right">
                              <form method="post" action="{{ route('logout') }}">
                                @csrf
                                    <button type="submit" class="btn btn-default btn-flat">@lang('software.logout')</a>
                              </form>
                          </div>
                      </li>
                  </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
          </ul>
      </div>
  </nav>
</header>




@if ( request()->segment(1) != 'cart'  )
<div class="modal fade" id="complete-order" style="display: none;">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.complete_order')</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route' => ['dashboard.orders.store']]) !!}
            
        <div class="form-group">
            {!! Form::label(trans('software.client_name')) !!}
            {!! Form::text('client_name',old('client_name'),[
                'class'       => 'form-control',
                'placeholder' => trans("software.client_name") 
            ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('software.client_address')) !!}
                {!! Form::text('client_address',old('client_address'),[
                    'class'       => 'form-control',
                    'placeholder' => trans("software.client_address") 
                ]) !!}
        </div>
        <div class="form-group">
                {!! Form::label(trans('software.client_phone1')) !!}
                {!! Form::text('client_phone1',old('client_phone1'),[
                    'class'       => 'form-control',
                    'placeholder' => trans("software.client_phone1") 
                ]) !!}
        </div>
        <div class="form-group">
                {!! Form::label(trans('software.client_phone2')) !!}
                {!! Form::text('client_phone2',old('client_phone2'),[
                    'class'       => 'form-control',
                    'placeholder' => trans("software.client_phone2") 
                ]) !!}
        </div>

        <div class="form-group">
                {!! Form::label(trans('software.province')) !!}
                {!! Form::select('province_id',$provinces_choices,old('province'),[
                    'class'       => 'form-control',
                    'placeholder' => trans("software.province") 
                ]) !!}
        </div>


        <div class="form-group">
            {!! Form::label(trans('software.markter_note')) !!}
            {!! Form::textarea('markter_note',old('markter_note'),[
                'class'       => 'form-control',
                'placeholder' => trans("software.markter_note") 
            ]) !!}
        </div>
        
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success">@lang('software.complete_order')</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif