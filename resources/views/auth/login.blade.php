
@extends('auth.app')



@section('title',trans('software.login'))


@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#">@lang('software.login')</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">@lang('software.login')</p>

    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input id="email" name="email" type="email" class="form-control" placeholder="@lang('software.email')">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-red">{{ $message }}</strong>
                </span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="@lang('software.password')">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
        @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"> @lang('software.remember_me')
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('software.login_now')</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="{{ route('password.request') }}">@lang('software.forget_pass?')</a><br>
    <a href="{{ route('register') }}" class="text-center">@lang('software.register')</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection

