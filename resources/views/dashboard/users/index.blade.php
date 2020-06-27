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
            <h1 class="m-0 text-dark">@lang('software.home')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('software.home')</a></li>
              <li class="breadcrumb-item active">@lang('software.users')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection




@section('content')


<div class="box box-primary">
  <div class="box-header">
      <h3 class="box-title">{{ trans('software.home') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-sm-12">
              {!! $dataTable->table([
              'class' => 'table table-bordered table-hover dataTable'
              ],true) !!}
          </div>
      </div>



  </div>
  <!-- /.box-body -->


@endsection



@push('js')

<!-- DataTables -->
<script src="{{ asset('dashboard') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('dashboard') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}
@endpush