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
            <h1 class="m-0 text-dark">@lang('software.my_wallet')</h1>
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
      <h3 class="box-title">{{ trans('software.my_wallet') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
    <table class="table table-bordered">
        <tbody>
        <tr>
          <th>@lang('software.confirmed_commission')</th>
          <th>@lang('software.pending_commission')</th>
        </tr>
        <tr>
            <td>{{ $confirmed }}</td>
            <td>{{ $pending }}</td>
        </tr>
        
      </tbody>
    </table>
          </div>

          <div class="col-md-6 col-md-offset-3">
            @if ( $unconfirmed_requests_count >= 1 )
            <span class="label label-warning">
              @lang('software.money_requested')
            </span>
            @else
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-money"></i>
                @lang('software.money_request')
            </button>
            @endif
          </div>

          <div style="margin-top:20px" class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <tbody>
                <tr>
                  <th>@lang('software.request_time')</th>
                  <th>@lang('software.money_needed')</th>
                  <th>@lang('software.request_status')</th>
                  <th>@lang('software.canceld_or_confirmed')</th>
                  <th>@lang('software.action')</th>

                </tr>
                @forelse( $requests as $request )
                  <tr>
                      <td>{{ $request->created_at }}</td>
                      <td>{{ $request->money_needed }}</td>
                      <td>
                        @if( $request->is_pending )
                           <span class="label label-info">طلب السحب تحت المراجعة ...</span>
                        @elseif ( $request->is_canceld )
                           <span class="label label-danger">تم رفض طلبك للسحب<span>
                        @elseif ( $request->is_confirmed )
                            <span class="label label-success">تم قبول طلبك وتحويل المبلغ المطلوب<span>
                        @endif
                      </td>
                      <td>
                        @if( $request->is_pending )
                          {{ $request->created_at->diffForHumans() }}
                        @endif
                         {{ $request->is_confirmed ? $request->confirmed_at : $request->canceld_at }}
                      </td>
                      <td>
                        @if ( $request->is_pending )
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-request-{{ $request->id }}">
                          <i class="fa fa-edit"></i>
                          @lang('software.edit')
                        </button>

                        <!-- Modal  --> 

<div class="modal fade" id="edit-request-{{ $request->id }}" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.money_request')</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['dashboard.requests.update',$request->id]]) !!}
         @method('PUT')
          <div class="form-group">
            {!! Form::label(trans('software.phone')) !!}
            {!! Form::text('phone',$request->phone,[
              'class'       => 'form-control',
              'placeholder' => trans('software.phone')
            ]) !!}
          </div>

          <div class="form-group">
              {!! Form::label(trans('software.money_needed')) !!}
              {!! Form::number('money_needed',$request->money_needed,[
                'class'       => 'form-control',
                'placeholder' => trans('software.money_needed')
              ]) !!}
            </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">@lang('software.edit')</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
      </div>
      {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


                        @else 
                         تم التعامل مع طلب السحب 
                        @endif
                      </td>
                  </tr>
                @empty
                  <p>@lang('software.no_records')</p>
                @endforelse
                
              </tbody>
            </table>
            </div>
      </div>
    </div>




@endsection




<!-- Modal  --> 

<div class="modal fade" id="modal-default" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">@lang('software.money_request')</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['dashboard.requests.store']]) !!}
          <div class="form-group">
            {!! Form::label(trans('software.phone')) !!}
            {!! Form::text('phone',old('phone'),[
              'class'       => 'form-control',
              'placeholder' => trans('software.phone')
            ]) !!}
          </div>

          <div class="form-group">
              {!! Form::label(trans('software.money_needed')) !!}
              {!! Form::number('money_needed',auth()->user()->commission,[
                'class'       => 'form-control',
                'placeholder' => trans('software.money_needed')
              ]) !!}
            </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">@lang('software.order_now')</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('software.close')</button>
      </div>
      {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



