
<table class="table table-borders">
    <tbody>
    <tr>
    <th>@lang('software.product')</th>
    <th>@lang('software.quntity')</th>
    <th>@lang('software.price')</th>
    </tr>
    @foreach( \App\Order::with("products")->find($id)->products as $product )
    <tr>
        <td>{{ $product->code }}</td>
        <td>{{ $product->pivot->qty }}</td>
        <td>{{ $product->pivot->price * $product->pivot->qty }}</td>
    </tr>
    @endforeach
    @lang('software.total_price'):{{ \App\Order::with('products')->find($id)->total_price }}
    </tbody>
</table>