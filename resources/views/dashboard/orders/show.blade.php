@extends('layouts.dashboard.app')


@section('title',$order->orderId)

@section('content_header')
<div class="content-header">
    <h1>
        @lang('software.inovice')
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> @lang('software.home')</a></li>
        <li><a href="{{ route('dashboard.orders.index') }}">@lang('software.orders')</a></li>
        <li class="active">@lang('software.inovice')</li>
      </ol>
    </div>
@endsection


@section('content')


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

  


@endsection



