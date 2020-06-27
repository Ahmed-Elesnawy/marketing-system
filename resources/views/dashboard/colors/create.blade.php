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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.colors.index') }}">@lang('software.colors')</a></li>
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
              {!! Form::open(['route' => 'dashboard.colors.store']) !!}
                <div class="box-body">
                  <div class="form-group">

                    {!! Form::label(trans('software.name')) !!}

                    {!! Form::text('name',old('name'),[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.name') ,
                        'required'    => 'required'
                    ]) !!}

                  </div>
                  <div class="form-group">
                    {!! Form::label(trans("software.color")) !!}

                    {!! Form::color('code',old('code'),[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.color") ,
                        'required'    => 'required'
                    ]) !!}
                  </div>


                  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">@lang('software.add') <i class="fa fa-plus"></i></button>
                </div>
              {!! Form::close() !!}
            </div>

         
        </div>
</div>


@endsection



