@extends('auth.app')


@section('title',trans('software.register'))

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{ 'dashboard' }}/index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">@lang('software.register')</p>

    <form action="{{ route('register') }}" method="post">
       @csrf
      <div class="form-group has-feedback">
        <input name="name" type="text" class="form-control" placeholder="@lang('software.name')">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-red">{{ $message }}</strong>
                </span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="@lang('software.email')">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-red">{{ $message }}</strong>
                </span>
        @enderror
      </div>

      <div class="form-group has-feedback">
        <input name="phone" type="text" class="form-control" placeholder="@lang('software.phone')">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-red">{{ $message }}</strong>
                </span>
        @enderror
      </div>

      
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="@lang('software.password')">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-red">{{ $message }}</strong>
                </span>
        @enderror
      </div>


      
      <div class="form-group has-feedback">
        <input name="password_confirmation" type="password" class="form-control" placeholder="@lang('software.password_confirmation')">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('software.register_now')</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ route('login') }}" class="text-center">@lang('software.login')</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->


@endsection
