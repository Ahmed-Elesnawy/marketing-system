

@extends('auth.app')


@section('title',trans('software.pending'))

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <div class="alert alert-warning">
      <p class="text-center">
        @lang('software.pending_user')
      </h2>
    </p>
  </div>
  <!-- /.login-box-body -->

  <div class="logout_form">
     {!! Form::open(['url' => 'logout']) !!}
      <button class="btn btn-danger btn-block" type="submit">
        @lang('software.logout')
      </button>
     {!! Form::close() !!}
  </div>
</div>
<!-- /.login-box -->

@stop