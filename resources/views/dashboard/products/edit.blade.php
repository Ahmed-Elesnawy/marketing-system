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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">@lang('software.products')</a></li>
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
              {!! Form::open(['route' => ['dashboard.products.update',$product->id],'files' => true]) !!}
              @method('PUT')
                <div class="box-body">
                  <div class="form-group col-md-6">

                    {!! Form::label(trans('software.name')) !!}

                    {!! Form::text('name',$product->name,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.name') ,
                        'required'    => 'required'
                    ]) !!}

                  </div>



                  <div class="form-group col-md-6">

                    {!! Form::label(trans('software.product_code')) !!}

                    {!! Form::text('code',$product->code,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.product_code') ,
                        'required'    => 'required'
                    ]) !!}

                  </div>


                  <div class="form-group">
                    {!! Form::label('software.category') !!}
                    {!! Form::select('category_id',$cat_choices,$product->category_id,[

                      'class'       => 'form-control',
                      'required'    => 'required',
                      'placeholder' => trans('software.select_category') 
                      
                    ]) !!}
                  </div>

                  
                  <div class="form-group col-md-4">
                    {!! Form::label(trans("software.price")) !!}

                    {!! Form::number('price',$product->price,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.price") ,
                        'required'    => 'required'
                    ]) !!}
                  </div>

                   <div class="form-group col-md-4">
                    {!! Form::label(trans("software.commission")) !!}

                    {!! Form::number('commission',$product->commission,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.commission") ,
                        'required'    => 'required'
                    ]) !!}
                  </div>
                  

                   <div class="form-group col-md-4">
                    {!! Form::label(trans("software.stock")) !!}

                    {!! Form::number('stock',$product->stock,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.stock") ,
                        'required'    => 'required'
                    ]) !!}
                  </div>

                  <div class="form-group">
                     {!! Form::label(trans("software.desc")) !!}

                    {!! Form::textarea('desc',$product->desc,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.desc") ,
                        'required'    => 'required'
                    ]) !!}
                  </div>



                   <div class="form-group">

                    {!! Form::label(trans("software.image")) !!}

                    {!! Form::file('image',[
                        'class'       => 'form-control',
                        'id'          => 'image-input'
                    ]) !!}
                  </div>



                   <div class="form-group">
                    
                    <img id="image-file" src="{{ $product->image_path }}"  style="width:350px;height:350px;"/>

                   </div>


                   <div class="form-group">

                    {!! Form::label(trans('software.images_url')) !!}

                    {!! Form::text('images_url',$product->images_url,[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.images_url') ,
                    ]) !!}

                  </div>

                  <div class="form-group">
                    {!! Form::label(trans('software.products')) !!}
                    <select multiple name="colors[]" class="form-control">
                      @foreach( $colors_choices as $id => $name )
                       <option {{ $product->colors->contains($id) ? 'selected' : '' }} value="{{ $id }}">
                          {{ $name }}
                      </option>
                      @endforeach
                    </select>
                  </div>


                  <div class="form-group">

                    {!! Form::label(trans('software.sizes')) !!}

                    {!! Form::text('sizes',isset($product->sizes) ? implode(',',$product->sizes): "",[
                        'class'       => 'form-control',
                        'placeholder' => trans('software.sizes') ,
                    ]) !!}

                  </div>
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">@lang('software.edit') <i class="fa fa-edit"></i></button>
                </div>
              {!! Form::close() !!}
            </div>

         
        </div>
</div>


@endsection



