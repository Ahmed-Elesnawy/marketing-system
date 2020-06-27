@extends('layouts.dashboard.app')


@section('title',$title)




@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $orders_count }}</h3>
            <p>{{ user()->is_admin  ? trans('software.total_orders') : trans('software.my_orders') }}</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>
      
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $shipped_orders_count }}</h3>
            <p>@lang('software.shipped_orders')</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $discarded_orders_count }}</h3>
            <p>@lang('software.discarded_orders')</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $canceld_orders_count }}</h3>
            <p>@lang('software.canceld_orders')</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $total_porfits }}</h3>
            <p>@lang('software.total_porfits')</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
          <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>


      @if ( user()->is_markter )
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $availble_porfits }}</h3>
                <p>@lang('software.availble_porfits')</p>
            </div>
            <div class="icon">
                <i class="fa fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $pending_porfits }}</h3>
                <p>@lang('software.pending_porfits')</p>
            </div>
            <div class="icon">
                <i class="fa fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">@lang('software.more_info') <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        
    @endif

    
</div>
@endsection