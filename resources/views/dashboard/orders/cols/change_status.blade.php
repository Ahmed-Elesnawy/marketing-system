

@if ( $is_alive )
<button data-orderId="{{ $id }}" id="btn-{{ $id }}" type="button" class="btn btn-info" data-toggle="modal" data-target="#{{ 'order-'. $id }}">
    <i class="fa fa-car-o"></i>
    @lang('software.change_shipping_status')
</button>
@else
   <span class="label label-danger">
       @lang('software.order_discarded_or_canceld')
   </span>
@endif













