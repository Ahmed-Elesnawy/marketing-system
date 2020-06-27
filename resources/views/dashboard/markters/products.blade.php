@extends('layouts.dashboard.app')





@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.products')</h1>
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


    <div class="box-header">
        <h3 class="box-title">{{ trans('software.products') }}</h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div style="width:100%;margin:auto">
                {{ $products->links() }}
            </div>
        </div>
        @forelse( $products as $product )
            @include('dashboard.includes._product')
        @empty
            <p>@lang('software.no_records')</p>
        @endforelse
    </div>
    <!-- /.box-header -->




@endsection



