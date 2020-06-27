@extends('layouts.dashboard.app')





@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.cart')</h1>
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




    
<div class="box box-primary">
  <div class="box-body">  
      <div class="row">
        <div class="col-md-8">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">@lang('software.product')</th>
                <th scope="col">@lang('software.total_price')</th>
                <th scope="col">@lang('software.price')</th>
                <th scope="col">@lang('software.quantity')</th>
                <th scope="col">@lang('software.commission')</th>
                <th scope="col">@lang('software.action')</th>

              </tr>
            </thead>
            <tbody>
              
              @forelse( Cart::session(user()->id)->getContent() as $item )
             
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price * $item->quantity }}</td>

                {!! Form::open(['route' => ['dashboard.cart.updateItem',$item->id]]) !!}

                <td>
                  <input style="width:80px" type="number" name="price" value="{{ $item->price }}">
                </td>
                <td>
                  <input style="width:50px" type="number" name="qty" value="{{ $item->quantity }}">
                </td>
                <td>{{ $item->attributes->commission * $item->quantity }}</td>
                <td>
                   
                        @method('PUT')

                        <button
                        class="btn btn-info"
                        type="submit"
                        >
                          @lang('software.cart_update_item')
                        </button>

                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['dashboard.cart.clearItem',$item->id]]) !!}
                    
                        @method('PUT')

                        <button
                        class="btn btn-danger"
                        type="submit"
                        >
                          @lang('software.cart_clear_item')
                        </button>

                    {!! Form::close() !!}
                </td>
              </tr>
              @empty
                <p>@lang('software.empty_shopping_cart')</p>
              @endforelse

              <h5>@lang('software.total_price'):{{ Cart::session(user()->id)->getTotal() }}</h5>

              <button style="margin-left:3px" type="button" class="btn btn-success" data-toggle="modal" data-target="#complete-order">
                
                @lang('software.complete_order')


              </button>              
              
              
              {!! Form::open(['route' => ['dashboard.cart.clear']]) !!}
              
               @method('PUT')

               <button
               class="btn btn-danger"
               type="submit"
               >
                 @lang('software.make_cart_empty')
              </button>

              {!! Form::close() !!}
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>




@endsection








<!-- Modal  --> 


<div class="modal fade" id="complete-order" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.complete_order')</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['dashboard.orders.store']]) !!}
          
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


        <div class="form-group">
          {!! Form::label(trans('software.markter_note')) !!}
          {!! Form::textarea('markter_note',old('markter_note'),[
              'class'       => 'form-control',
              'placeholder' => trans("software.markter_note") 
          ]) !!}
      </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">@lang('software.complete_order')</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
      </div>
      {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



