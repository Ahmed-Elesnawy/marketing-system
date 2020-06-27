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
              {!! Form::open(['route' => ['dashboard.users.update',$user->id],'files' => true]) !!}
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

                    {!! Form::label(trans('software.password')) !!}

                    {!! Form::password('password',[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.password') ,
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






                  <div class="form-group">
                    {!! Form::label(trans('software.status')) !!}
                    @php
                      $status_choices = ['pending' => 'منتظر التفعيل','active' => 'مفعل'];
                    @endphp
                    {!! Form::select('status',$status_choices,$user->status,[
                        'class' => 'form-control',
                    ]) !!}
                </div>

                <div class="form-group">
                  {!! Form::label('software.type') !!}
                  @php
                    $type_choices = ['admin' => trans('software.admin'),'markter' => trans('software.markter')];
                  @endphp
                  {!! Form::select('type',$type_choices,$user->type,[

                      'class' => 'form-control',
                      'placeholder' => trans('software.select_user_type')
                      
                  ]) !!}
              </div>



              <div class="form-group">

                {!! Form::label(trans('software.commission')) !!}
                {!! Form::number('commission',$user->commission,[
                    'class'       => 'form-control',
                    'placeholder' => trans('software.commission') ,
                ]) !!}

              </div>

                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">تعديل <i class="fa fa-edit"></i></button>
                </div>
              {!! Form::close() !!}
            </div>

         
        </div>
</div>


@endsection



