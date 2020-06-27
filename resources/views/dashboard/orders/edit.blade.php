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


{!! Form::open(['route' => ['dashboard.orders.update',$order->id]]) !!}
@method('PUT')
<div class="row">
                        
                <div class="col-md-6">

                    <div class="form-group">
                    {!! Form::label(trans('software.client_name')) !!}
                    {!! Form::text('client_name',$order->client_name,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.client_name") 
                    ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label(trans('software.client_address')) !!}
                        {!! Form::text('client_address', $order->client_address,[
                            'class'       => 'form-control',
                            'placeholder' => trans("software.client_address") 
                        ]) !!}
                  </div>
                   <div class="form-group">
                        {!! Form::label(trans('software.client_phone1')) !!}
                        {!! Form::text('client_phone1',$order->client_phone1,[
                            'class'       => 'form-control',
                            'placeholder' => trans("software.client_phone1") 
                        ]) !!}
                  </div>
                   <div class="form-group">
                        {!! Form::label(trans('software.client_phone2')) !!}
                        {!! Form::text('client_phone2',$order->client_phone2,[
                            'class'       => 'form-control',
                            'placeholder' => trans("software.client_phone2") 
                        ]) !!}
                  </div>

                   <div class="form-group">
                        {!! Form::label(trans('software.province')) !!}
                        {!! Form::select('province_id',$provinces_choices,$order->province_id,[
                            'class'       => 'form-control',
                            'placeholder' => trans("software.province") 
                        ]) !!}
                  </div>


                  <div class="form-group">
                    {!! Form::label(trans('software.markter_note')) !!}
                    {!! Form::textarea('markter_note',$order->markter_note,[
                        'class'       => 'form-control',
                        'placeholder' => trans("software.markter_note") 
                    ]) !!}
                </div>

                <div class="form-group">
                  <button class="btn btn-success btn-lg btn-block" type="submit">
                     @lang('software.edit_order')
                  </button>
                </div>

          </div>

<div class="col-md-6">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">@lang('software.product')</th>
            <th scope="col">@lang('software.price')</th>
            <th scope="col">@lang('software.quantity')</th>
            <th scope="col">@lang('software.commission')</th>
            <th scope="col">@lang('software.action')</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ( $order->products as $product )

                <tr>

                    <td>{{ $product->name }}</td>
    
                    <td>
                      {{ $product->pivot->price }}
                    </td>

                    <td>
                      {{ $product->pivot->qty }}
                    </td>

                    <td>
                        {{ $product->pivot->commission * $product->pivot->qty  }}
                    </td>


                    @if ( $order->products->count() > 1 )


                    <td>
                      <form method="POST"
                        action="{{ url("orders/{$order->id}/{$product->id}/plus") }}"
                        >
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                          @lang('software.plus_qty')  
                        </button>
                      </form>
                    </td>


                    @if ( $product->pivot->qty != 1  )
                    <td>
                      <form method="POST"
                        action="{{ url("orders/{$order->id}/{$product->id}/minus") }}"
                       >
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">
                          @lang('software.minus_qty')  
                        </button>
                      </form>
                    </td>
                    @endif

                    @endif





                    <td>
                      <form method="POST"
                        action='{{ url("orders/{$order->id}/{$product->id}/remove") }}'
                        >
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">
                          @lang('software.destroy_product')  
                        </button>
                      </form>
                    </td>


                </tr>

            @endforeach

        </tbody>
      </table>
</div>

</div>
{!! Form::close() !!}



@endsection







