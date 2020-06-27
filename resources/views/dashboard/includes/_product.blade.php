<div class="product">
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img class="img-responsive" src="{{ $product->image_path }}" alt="{{ $product->name }}">
        <div class="caption">
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->limited_desc }}</p>
        <p>السعر: {{ $product->price }} جنية مصري</p>
        <p>العمولة: {{ $product->commission }} جنية مصري</p>
        <p>المخزن: {{ $product->stock }} قطعة</p>

        <p>
            @if ( Cart::session(user()->id)->get($product->id) )
            تمت اضافة هذا المنتج مسبقا
            @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart-{{ $product->id }}">
                <i class="fa fa-shopping-cart"></i>
            </button>            
            @endif

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#show-{{ $product->id }}">
                <i class="fa fa-eye"></i>
            </button>
        </p>
        </div>
    </div>
</div>
</div>









<!-- Modal  --> 

<div class="modal fade" id="cart-{{ $product->id }}" style="display: none;">
    <div class="modal-dialog">
     <form method="POST" action="{{ route('dashboard.cart.add',$product->id) }}">
       @method('PUT')
       @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">@lang('software.add_to_cart')</h4>
        </div>
        <div class="modal-body">
            
             <div class="form-group">
                 <label>@lang('software.quntity')</label>
                 <input 
                 class="form-control" 
                 type="number"
                 placeholder="@lang('software.quntity')" 
                 value="1"
                 min="1"
                 step=".5"

                 max="{{ $product->stock }}"
                 name="qty">
             </div>

             <div class="form-group">
                <label>@lang('software.price')</label>
                <input 
                class="form-control" 
                step=".5"
                type="number"
                placeholder="@lang('software.price')" 
                value="{{ $product->price }}"
                min="{{ $product->price - $product->commission / 2 }}"
                name="price">
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">@lang('software.add_to_cart')</button>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
      </div>
     </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




<!-- Modal  --> 

<div class="modal fade" id="show-{{ $product->id }}" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">@lang('software.product')</h4>
        </div>
        <div class="modal-body">
            <div class="image">
                <img class="img-responsive" src="{{ $product->image_path }}">
            </div>
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->desc }}</p>
            @if ( $product->has_colors )
                <p>@lang('software.colors'):</p>
                @foreach ( $product->colors as $color )
                <span
                style="display:inline-block;width:25px;height:25px;background:{{ $color->code }};"
                ></span>
                @endforeach
            @endif

            @if ( $product->has_sizes )
                <p>@lang('software.sizes'):</p>
                @foreach ( $product->sizes as $size )
                 <span>{{ $size }}</span> |
                @endforeach
            @endif


            @if( $product->images_url )
            <a style="display:block" target="_blank" href="{{ $product->images_url }}">
                @lang('software.images_url')
            </a>
            @endif


            

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  
  