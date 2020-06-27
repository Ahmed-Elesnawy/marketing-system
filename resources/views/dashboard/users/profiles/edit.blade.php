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
              {!! Form::open(['route' => ['dashboard.users.updateProfile'],'files' => true]) !!}
              @method('PUT')
                <div class="box-body">
                  <div class="form-group">

                    {!! Form::label(trans('software.name')) !!}

                    {!! Form::text('name',$user->name,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.name') ,
                    ]) !!}

                  </div>
                  <div class="form-group">
                    {!! Form::label(trans('software.email')) !!}

                    {!! Form::email('email',$user->email,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.email') ,
                    ]) !!}
                  </div>
                

                  <div class="form-group">

                    {!! Form::label(trans('software.phone')) !!}
                    {!! Form::text('phone',$user->phone,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.phone') ,
                    ]) !!}

                  </div>


                  <div class="form-group">

                    {!! Form::label(trans('software.image')) !!}
                    {!! Form::file('image',[
                        'class'       => 'form-control',
                        'id'          => 'image-input'
                    ]) !!}

                  </div>

                  <div class="form-group">
                    
                      <img src="{{ $user->image_path }}" id="image-file"  style="width:50px;height:50px;"/>
  
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">@lang('software.edit_profile') <i class="fa fa-edit"></i></button>
                  <a
                   href="{{ route('dashboard.users.changePasswordForm') }}"
                   class="btn btn-info">
                      @lang('software.change_password')
                      <i class="fa fa-eye"></i>
                  </a>
                </div>
              {!! Form::close() !!}
            </div>

         
        </div>
</div>


@endsection






