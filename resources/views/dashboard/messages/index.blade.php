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
                @if( user()->is_admin )
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reportModal">@lang('software.send_message')</button>
                @endif
            </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                        <th>@lang('software.message_title')</th>
                        <th>@lang('software.message_body')</th>
                        <th>@lang('software.message_type')</th>
                        @if ( user()->is_admin )

                        <th>@lang('software.message_user')</th>

                        @endif
                        <th>@lang('software.time')</th>

                        @can('delete-message')

                          <th>@lang('software.delete')</th>

                        @endCan


                    </tr>

                    @forelse ( $messages as $message )
                     <tr>
                         
                         <td>
                             {{ $message->title }}
                         </td>

                         <td>
                            @if ( $message->has_long_body )

                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message-{{ $message->id }}">@lang('software.show_message')</button>

                               <!-- Modal -->

                                <div class="modal fade" id="message-{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">{{ $message->title }}</h4>
                                            </div>
                                            <div style="overflow: scroll" class="modal-body">
                                                <p> {{ $message->body }} </p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            @else

                              {{ $message->body }}

                            @endif
                        </td>

                        <td>

                          @if ( $message->has_user )
                            
                             @lang('software.private_message')

                          @else

                            @lang('software.public_message')

                          @endif

                        </td>

                        @if ( user()->is_admin )
                          <td>
                              @if ( $message->has_user )
                                {{ $message->user->name }}
                              @else
                                @lang('software.public_message')
                              @endif
                          </td>
                        @endif

                        <td>
                          {{ $message->created_at }}
                        </td>


                        @can('delete-message')
                        <td>
                          <button class="btn btn-danger btn-sm" type="button"  data-toggle="modal" data-target="#delete-{{ $message->id }}">
                            <i class="fa fa-trash"></i>
                            @lang('software.delete')   
                        </button>
    
                        <div class="modal fade" id="delete-{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">@lang('software.card_reply_now')</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::open(['route' => ['dashboard.messages.destroy',$message->id]]) !!}
                                  @method('DELETE')
                                  <h3>@lang('software.confirm_delete')</h3>
                                 </div>
                                 <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.no')</button>
                                  <button type="submit" class="btn btn-danger">@lang('software.delete')</button>
                                {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </td>
                        @endCan


                     </tr>
                    @empty

                        <p>@lang('software.no_records')</p>
                        
                    @endforelse

                 </tbody>
            </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                 {{ $messages->links() }}
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
          <h5 class="modal-title" id="exampleModalLabel">@lang('software.send_message')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['route' => ['dashboard.messages.store']]) !!}


          <div class="form-group">
             {!! Form::text('title',old('title'),[
               'class' => 'form-control',
               'placeholder' => trans('software.message_title')
             ]) !!}
          </div>


          <div class="form-group">
            {!! Form::textarea('body',old('body'),[
              'class' => 'form-control',
              'placeholder' => trans('software.message_body')
            ]) !!}
         </div>



         <div class="form-group">

          {!! Form::select('user_id',$markter_choices,old('user_id'),[
            'class' => 'form-control',
            'placeholder' => trans('software.select_user_message')
          ]) !!}
        </div>
          



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
          <button type="submit" class="btn btn-success">@lang('software.send_message')</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>



