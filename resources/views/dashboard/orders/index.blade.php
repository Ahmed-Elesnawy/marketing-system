@extends('layouts.dashboard.app')


@push('css')
 <link rel="stylesheet" href="{{ asset('dashboard') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush


@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.home')</h1>
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
  <div class="box-header">
      <h3 class="box-title">{{ trans('software.orders') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-sm-12">
              {!! $dataTable->table([
              'class' => 'table table-bordered table-hover dataTable'
              ],true) !!}
          </div>
      </div>





      




@endsection



@push('js')

<!-- DataTables -->
<script src="{{ asset('dashboard') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('dashboard') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}


@endpush






@foreach ($orders as $order)





<!-- Show Order Modal -->


<div class="modal fade" id="{{ 'show-order-'. $order->id }}" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.show_order')</h4>
      </div>
      <div class="modal-body">

        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <small class="pull-right">@lang('software.date'):{{ $order->created_at->format('d/m/Y') }}</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              @lang('software.from')
              <address>
                 {{ $order->user->name }}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              @lang('software.to')
              <address>
                <strong>{{ $order->client_name }}</strong><br>
                @lang('software.client_address'): {{ $order->client_address }}<br>
                @lang('software.client_phone1'): {{ $order->client_phone1 }}<br>
                @lang('software.client_phone2'): {{ $order->client_phone2 }}<br>
              </address>
            </div>
            
          </div>
          <!-- /.row -->
      
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>@lang('software.quantity')</th>
                  <th>@lang('software.product')</th>
                  <th>@lang('software.product_price')</th>
      
                  <th>@lang('software.subtotal')</th>
                </tr>
                </thead>
                <tbody>
               @foreach ( $order->products as $product )
                <tr>
                  <td>{{ $product->pivot->qty }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->pivot->price }} L.E</td>
                  <td>{{ $product->pivot->price * $product->pivot->qty }} L.E</td>
                </tr>
              @endforeach
               
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      
          <div class="row">
            
            <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">{{ $order->created_at->format('d/m/Y') }}</p>
      
              <div class="table-responsive">
                <table class="table">
      
                  <tr>
                    <th style="width:50%">@lang('software.orderId')</th>
                    <td>{{ $order->orderId }}</td>
                  </tr>
                  <tr>
                    <th style="width:50%">@lang('software.price')</th>
                    <td>{{ $order->total_price }}</td>
                  </tr>
                  <tr>
                    <th>@lang('software.shipping_price')</th>
                    <td>{{ $order->province->shipping_price }}</td>
                  </tr>
                  <tr>
                    <th>@lang('software.total_price')</th>
                    <td>{{ $order->price_with_shipping }}</td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
      
            <!-- col -->
      
            <div class="col-md-3">
              @if ( $order->is_alive )
              <h4>
                @if( $order->is_pending )
                 
                    <span class="label label-warning">
                      @lang('software.order_pending')
                    </span>
                @elseif ( $order->is_processing )
                    
                  <span class="label label-primary">
                    @lang('software.order_processing')
                  </span>
      
                @elseif ( $order->is_shipped )
                    
                  <span class="label label-success">
                    @lang('software.order_shipped')
                  </span>
                  
                @endif
              </h4>
              @else
                
                   <h2>
                    
                      <span class="label label-danger">
                        @if ( $order->is_discarded )
                          @lang('software.order_discarded')
                        @elseif ( $order->is_canceld )
                          @lang('software.order_canceld')
                        @endif
                      </span>
                   
      
                   </h2>
                
              @endif
      
              
            </div>
            
      
            <div class="col-md-3">
              @if( $order->is_alive )
      
                  @if( !$order->is_shipped )
                  {!! Form::open(['route' => ['dashboard.orders.cancel',$order->id]]) !!}
                    @method('PUT')
                    <button class="btn btn-danger btn-block" style="margin-bottom:3px">
                      @lang('software.cancel_order')  
                    </button>
                  {!! Form::close() !!}
                  @endif
      
                  @if( $order->is_shipped )
                  {!! Form::open(['route' => ['dashboard.orders.discard',$order->id]]) !!}
                    @method('PUT')
                    <button class="btn btn-danger btn-block">
                      @lang('software.discard_order')  
                    </button>
                  {!! Form::close() !!}
                  @endif
      
              @endif
            </div>
          </div>
          <!-- /.row -->
      
        
      

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
      
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


    

<!-- Change Status Modal  --> 

<div class="modal fade" id="{{ 'order-'. $order->id }}" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.money_request')</h4>
      </div>
      <div class="modal-body">

        {!! Form::open(['route' => ['dashboard.orders.change',$order->id],'class' => 'change_status_form','data-id' => $order->id]) !!}
        @method('PUT')
        <div class="form-group">
         
          {!! Form::label(trans('software.order_status')) !!}
          {!! Form::select('shipping_status',get_shipping_status(),$order->shipping_status,[
              'class' => 'form-control',
          ]) !!}
        </div>
        <br/>
        <div style="margin-top:20px" class="form-group">
          {!! Form::number('shipping_number',$order->shipping_number,[
            'class' => 'form-control',
            'placeholder' => trans('software.shipping_number')
          ]) !!}
        </div>

        <div class="modal-footer">
          <button data-id="order-{{ $order->id }}"  type="button" class="btn btn-success change_status_btn">@lang('software.change_status')</button>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
      
        {!! Form::close() !!}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<div class="modal fade" id="{{ 'delete-order-'. $order->id }}" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.money_request')</h4>
      </div>
      <div class="modal-body">

        {!! Form::open(['route' => ['dashboard.orders.destroy',$order->id]]) !!}
        @method('DELETE')
     
        <h4>
          @lang('software.confirm_delete')
        </h4>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">@lang('software.yes')</button>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
      
        {!! Form::close() !!}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>





@endforeach

