@extends('layouts.dashboard.app')





@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.my_orders')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.markter.orders') }}">@lang('software.my_orders')</a></li>
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
      <h3 class="box-title">{{ trans('software.my_orders') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
        <table class="table table-hover">
          <div class="col-md-12">
          {{ $orders->links() }}
          </div>
          <form method="GET">
            <div class="col-md-3">
                <div class="form-group">
                  <select name="status" class="form-control">
                    <option value="">@lang('software.select_status')</option>
                    <option {{ request('status') == 'canceld' ? 'selected' :'' }} value="canceld">@lang('software.canceld')</option>
                    <option {{ request('status') == 'discarded' ? 'selected' :'' }} value="discarded">@lang('software.discarded')</option>
                  </select>
                </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <select name="shipping_status" class="form-control">
                  <option value="">@lang('software.select_shipping_status')</option>
                  <option {{ request('shipping_status') == 'shipped' ? 'selected' : '' }} value="shipped">@lang('software.shipped')</option>
                  <option {{ request('shipping_status') == 'processing' ? 'selected' : '' }} value="processing">@lang('software.processing')</option>
                  <option {{ request('shipping_status') == 'pending' ? 'selected' : '' }} value="pending">@lang('software.pending')</option>
                </select>
              </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
             <button type="submit" class="btn btn-primary">
               @lang('software.search')
             </button>
            </div>
        </div>
         </form>
          
          <tbody>
            <tr>
                <th>@lang('software.orderId')</th>
                <th>@lang('software.client_name')</th>
                <th>@lang('software.client_address')</th>
                <th>@lang('software.shipping_status')</th>
                <th>@lang('software.shipping_number')</th>
                <th>@lang('software.status')</th>
                <th>@lang('software.note')</th>
                <th>@lang('software.price')</th>
                <th>@lang('software.commission')</th>
                <th>@lang('software.action')</th>
          </tr>
          @forelse( $orders as $order )
          <tr>
            <td>{{ $order->orderId }}</td>
            <td>{{ $order->client_name }}</td>
            <td>{{ $order->client_address }}</td>
            <td>
                @if ( $order->shipping_status == 'shipped' )

                    <span class="label label-success">@lang('software.shipped')</span>

                @elseif ( $order->shipping_status == 'pending' )

                    <span class="label label-info">@lang('software.pending')</span>

                @elseif ( $order->shipping_status == 'processing' )

                    <span class="label label-warning">@lang('software.processing')</span>

                @endif
            </td>
            <td>
              @if ( !is_null($order->shipping_number) )
                {{ $order->shipping_number }}
              @else
                لم يتم وضع رقم التوصيل بعد 
              @endif
            </td>
            <td>
               @if( $order->is_alive )
                <span class="label label-success"> 
                  @lang('software.alive')
                </span>
               @else
                  <span 
                  class="label label-danger">
                    @if ( $order->is_canceld )
                      @lang('software.canceld')
                    @else
                      @lang('software.discarded')
                    @endif
                  </span>
               @endif
            </td>

            <td>
              @if ( $order->is_alive )
                الطلب لم يتم الغائه او ارجاعه
              @else
               {{ $order->note }}
              @endif
            </td>
            

            <td>{{ $order->total_price }}</td>

            <td>
              {{ $order->total_commission }}
            </td>
            @if ( $order->is_alive )
            <td>
                @if ( $order->is_pending )


                <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#show-order-{{ $order->id }}">
                  @lang('software.show_order')
                </button>


                   <!-- Modal  --> 

                   <div class="modal fade" id="show-order-{{ $order->id }}" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">@lang('software.show_order')</h4>
                         </div>
                        <div class="modal-body">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>@lang('software.product')</th>
                                <th>@lang('software.quantity')</th>
                                <th>@lang('software.price')</th>
                                <th>@lang('software.commission')</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                              @foreach( $order->products as $product )
                              <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->qty }}</td>
                                <td>{{ $product->pivot->price * $product->pivot->qty  }}</td>
                                <td>{{ $product->pivot->commission * $product->pivot->qty }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                            <h5>@lang('software.price_without_shipping'):{{ $order->total_price }}</h5>
                            <h5>@lang('software.shipping_price'):{{ $order->province->shipping_price }}</h5>
                            <h5>@lang('software.total_price'):{{ $order->price_with_shipping }}</h5>

                            <h5></h5>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
                        </div>
                  
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- End Modal -->

                <a href="{{ route('dashboard.orders.edit',$order->id) }}" style="margin:4px 0" class="btn btn-warning btn-block">
                   @lang('software.edit_order')
                </a>

                




                {!! Form::open(['route' => ['dashboard.orders.cancel',$order->id]]) !!}

                  @method("PUT")

                  <button type="submit" class="btn btn-danger btn-block">
                     @lang('software.cancel_order')
                  </button>

                {!! Form::close() !!}
                @else

                  <p>@lang('software.edit_not_availble')</p>

                @endif
            </td>
            @else

             <td><p>@lang('software.order_canceld')</p></td>

            @endif
          </tr>
          @empty

           <p>@lang('software.no_records')</p>    

          @endforelse
          
        </tbody>
    </table>
      </div>




@endsection



