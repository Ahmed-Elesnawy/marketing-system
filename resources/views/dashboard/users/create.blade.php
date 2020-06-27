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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">الأعضاء</a></li>
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
              {!! Form::open(['route' => 'dashboard.users.store','files' => true]) !!}
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
                    {!! Form::label(trans('software.email')) !!}

                    {!! Form::email('email',old('email'),[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.email') ,
                        'required'    => 'required'
                    ]) !!}
                  </div>
                  <div class="form-group">

                    {!! Form::label(trans('software.password')) !!}

                    {!! Form::password('password',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.password') ,
                        'required'    => 'required'
                    ]) !!}

                  </div>


                  <div class="form-group">

                    {!! Form::label(trans('software.password_confirmation')) !!}
                    {!! Form::password('password_confirmation',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.password_confirmation'),
                        'required'    => 'required'
                    ]) !!}

                  </div>


                  <div class="form-group">

                    {!! Form::label(trans('software.phone')) !!}
                    {!! Form::text('phone',old('phone'),[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.phone') ,
                        'required'    => 'required'
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
                    
                      <img id="image-file"  style="width:50px;height:50px;"/>
  
                  </div>





                  <div class="form-group">
                      {!! Form::label('الحاله') !!}
                      @php
                        $status_choices = ['pending' => 'منتظر التفعيل','active' => 'مفعل'];
                      @endphp
                      {!! Form::select('status',$status_choices,old('status'),[
                          'class' => 'form-control',
                      ]) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label(trans('software.type')) !!}
                    @php
                      $type_choices = ['admin' => trans('software.admin'),'markter' => trans('software.markter')];
                    @endphp
                    {!! Form::select('type',$type_choices,old('status'),[

                        'class' => 'form-control',
                        'placeholder' => trans('software.select_user_type')

                    ]) !!}
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



