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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">@lang('software.orders')</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')


<div class="row">
     <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('software.categories')</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            @foreach ($categories as $category)
                                
                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name_en) }}">{{ $category->name_ar }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name_en) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('software.name')</th>
                                                            <th>@lang('software.stock')</th>
                                                            <th>@lang('software.price')</th>
                                                            <th>@lang('software.add')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->price, 2) }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->price }}"
                                                                       class="btn btn-success btn-sm add-product-btn">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>@lang('software.no_records')</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->
                            @endforeach
                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->


                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('software.orders')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            <form action="{{ route('dashboard.orders.store') }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('post') }}


                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('software.product')</th>
                                        <th>@lang('software.quantity')</th>
                                        <th>@lang('software.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">


                                    </tbody>

                                </table><!-- end of table -->

                                <h4>@lang('software.total') : <span class="total-price">0</span></h4>

                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('software.add_order')</button>

                            

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

              
                </div><!-- end of col -->

                <div class="col-md-6 offset-md-6 my-5">
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
                  

                </form>

</div>



@endsection



