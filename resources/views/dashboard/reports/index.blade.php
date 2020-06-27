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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('software.home')</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reportModal">@lang('software.generate_report')</button>
            </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                        <th style="width: 10px">@lang('software.id')</th>
                        <th>@lang('software.orders_count')</th>
                        <th>@lang('software.shipped_orders_count')</th>
                        <th>@lang('software.discarded_orders_count')</th>
                        <th>@lang('software.canceld_orders_count')</th>
                        <th>@lang('software.total_porfits')</th>
                        <th>@lang('software.report_user')</th>
                        <th>@lang('software.shipped_to_total')</th>
                        <th>@lang('software.from')</th>
                        <th>@lang('software.to')</th>
                        <th>@lang('software.controls')</th>
                    </tr>

                    @forelse ( $reports as $report )
                    <tr>
                      <td>{{ $report->id }}</td>
                      <td>{{ $report->total_orders }}</td>
                      <td>{{ $report->shipped_orders }}</td>
                      <td>{{ $report->discarded_orders }}</td>
                      <td>{{ $report->canceld_orders }}</td>
                      <td>{{ $report->total_porfits }}</td>
                      <td>
                          @if ( $report->has_user )
                            {{ $report->user->name }}
                          @else
                            @lang('software.public_report')
                          @endif
                      </td>
                      <td>
                         @if ( $report->has_user )
                            {{ $report->shipped_to_total }}
                         @else
                            @lang('software.public_report')
                         @endif
                      </td>
                      <td>{{ $report->from }}</td>
                      <td>{{ $report->to }}</td>
                      <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-report-{{ $report->id }}">@lang('software.delete')</button>
  
                        <!-- Modal -->
  
                          <div class="modal fade" id="delete-report-{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">@lang('software.generate_report')</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::open(['route' => ['dashboard.reports.destroy',$report->id]]) !!}
                                  @method('DELETE')
                                    <h4>@lang('software.confirm_delete')</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
                                  <button type="submit" class="btn btn-danger">@lang('software.yes')</button>
                                </div>
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
  
                        </td>
                    </tr>
                    
                    @empty

                        <p>@lang('software.no_records')</p>
                        
                    @endforelse

                 </tbody>
            </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                 {{ $reports->links() }}
              </div>
            </div>
            <!-- /.box -->
          </div>
    </div>
</section>



@endsection






<!-- Modal -->

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('software.generate_report')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['route' => ['dashboard.reports.store']]) !!}


            <div class="form-group">
                {!! Form::label(trans('software.from')) !!}
                {!! Form::date('from',old('from'),[
                    'class' => 'form-control',
                ]) !!}
            </div>


            <div class="form-group">
                {!! Form::label(trans('software.to')) !!}
                {!! Form::date('to',now(),[
                    'class' => 'form-control',
                ]) !!}
            </div>


            <div class="form-group">
                {!! Form::label(trans('software.report_user')) !!}
                {!! Form::select('user_id',$users_choices,old('user_id'),[
                    'class' => 'form-control',
                    'placeholder' => '......',
                ]) !!}
            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
          <button type="submit" class="btn btn-success">@lang('software.generate_report')</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>



