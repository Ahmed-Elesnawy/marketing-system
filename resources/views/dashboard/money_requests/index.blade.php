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
            <h1 class="m-0 text-dark">@lang('software.money_requests')</h1>
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
      <h3 class="box-title">{{ trans('software.money_requests') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-md-12">
    <table class="table table-bordered">
        <tbody>
        <tr>
          <th>@lang('software.id')</th>
          <th>@lang('software.name')</th>
          <th>@lang('software.phone')</th>
          <th>@lang('software.money_needed')</th>
          <th>@lang('software.action')</th>
        </tr>
        @forelse ( $requests as $request )
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->phone }}</td>
            <td>{{ $request->money_needed }}</td>
            @if ( $request->is_confirmed )
             <td>
                 <span class="label label-success">تم تأكيد الطلب</span>
             </td>
            @elseif ( $request->is_canceld )
              <td>
                <span class="label label-danger">تم رفض الطلب</span>
              </td>
            @elseif ( $request->is_pending )
            <td>
                <form
                 action="{{ route('dashboard.requests.confirm',$request->id) }}" 
                 method="post" 
                 style="display:inline-block">
                 @csrf
                 @method('PUT')
                  <button class="btn btn-success" type="submit">
                      @lang('software.confirm_request')
                  </button>
                </form>

                <form
                 action="{{ route('dashboard.requests.cancel',$request->id) }}" 
                 method="post" 
                 style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                      @lang('software.cancel_request')
                  </button>
                </form>
            </td>
            @endif
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





