@extends('layouts.dashboard.app')





@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.notifications')</h1>
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

<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">@lang('software.notifications')</h3>

      <div class="box-tools">
        {{ $notifications->links() }}
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <table class="table">
        <tbody><tr>
          <th>@lang('software.notification')</th>
          <th>@lang('software.timesince')</th>
        </tr>
        
       
       @forelse($notifications as $not)

        <tr>
          <td>
            @if ( $not->type == 'App\Notifications\NewUserCreated' )

               @lang('software.new_user_created',['name' => $not->data['username']])

            @elseif ( $not->type == 'App\Notifications\NewOrderCreated' )

               @lang('software.new_order_created',['id' => $not->data['orderId']])

            @elseif ( $not->type == 'App\Notifications\NewMoneyRequestCreated' )

               @lang('software.new_request_created',['name' => $not->data['name']])

            @elseif ( $not->type == 'App\Notifications\NewCardCreated' )

               @lang('software.new_card_created',['name' => $not->data['username']])

            @elseif ( $not->type == 'App\Notifications\OrderCanceld' )

               @lang('software.order_canceld_notify',['name' => $not->data['name'],'id' => $not->data['orderId']])

            @elseif ( $not->type == 'App\Notifications\MoneyRequestCanceld' )

              @lang('software.request_canceld')

            @elseif ( $not->type == 'App\Notifications\OrderProccessing' )

             @lang('software.order_processing',['id' => $not->data['orderId']])

            @elseif ( $not->type == 'App\Notifications\OrderShipped' )

             @lang('software.order_shipped',['id' => $not->data['orderId']])

            @elseif ( $not->type == 'App\Notifications\NewMessageCreated' )

             @lang('software.new_message_created',['title' => $not->data['title']])
               
            @endif
          </td>
          <td>
            {{ $not->created_at->diffForHumans() }}
          </td>
        </tr>

      @empty

      <p>@lang('software.no_records')</p>
          
  
      @endforelse



      </tbody></table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

@endsection





