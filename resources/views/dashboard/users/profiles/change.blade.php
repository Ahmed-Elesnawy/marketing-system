@extends('layouts.dashboard.app')


@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('software.home')</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')


<div class="row">
   <div class="col-md-8 col-md-offset-2">
          <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">{{ $title }}</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              {!! Form::open(['route' => ['dashboard.users.changePassword']]) !!}
              @method('PUT')
                <div class="box-body">
                  <div class="form-group">

                    {!! Form::label(trans('software.old_password')) !!}

                    {!! Form::password('old_password',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.old_password') ,
                    ]) !!}

                    {!! Form::label(trans('software.new_password')) !!}

                    {!! Form::password('password',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.new_password') ,
                    ]) !!}

                    {!! Form::label(trans('software.new_password_confirmation')) !!}

                    {!! Form::password('password_confirmation',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.new_password_confirmation'),
                    ]) !!}


                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">@lang('software.change_password') <i class="fa fa-edit"></i></button>
                </div>
              {!! Form::close() !!}
            </div>

         
        </div>
</div>


@endsection






