@extends('layouts.dashboard.app')




@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.tech_cards')</h1>
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
      <h3 class="box-title">{{ trans('software.tech_cards') }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-md-12">
    <table class="table table-bordered">
        <tbody>
        <tr>
          <th>@lang('software.id')</th>
          <th>@lang('software.card_title')</th>
          <th>@lang('software.card_content')</th>
          <th>@lang('software.card_reply')</th>
          <th>@lang('software.card_user')</th>
          <th>@lang('software.action')</th>
        </tr>

        @forelse( $cards as $card )
            <tr>
                <td>{{ $card->id }}</td>
                <td>{{ $card->title }}</td>
                <td>{{ $card->content }}</td>
                <td>
                    @if( $card->is_opend )
                      <span class="label label-warning">
                          @lang('software.card_no_reply')
                      </span>
                    @else
                      {{ $card->reply }}
                    @endif
                </td>
                <td>{{ $card->user->name }}</td>
                <td>
                    @if( $card->is_opend )

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reply-{{ $card->id }}">
                            <i class="fa fa-reply"></i>
                            @lang('software.card_reply_now')   
                        </button>


                        <div class="modal fade" id="reply-{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">@lang('software.card_reply_now')</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::open(['route' => ['dashboard.tech-cards.reply',$card->id]]) !!}
                                  @method('PUT')
                                    <div class="form-group">
                                      <label for="message-text" class="col-form-label">@lang('software.reply')</label>
                                      <textarea 
                                      name="reply" 
                                      value="{{ old('content') }}" 
                                      class="form-control" 
                                      id="message-text"
                                      rows="8"
                                      >
                                      {{ old('reply') }}</textarea>
                                    </div>
                                 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">@lang('software.card_reply_now')</button>
                                {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                          </div>
                          

                    @else


                    <button class="btn btn-danger btn-sm" type="button"  data-toggle="modal" data-target="#delete-{{ $card->id }}">
                        <i class="fa fa-trash"></i>
                        @lang('software.card_delete')   
                    </button>

                    <div class="modal fade" id="delete-{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">@lang('software.card_reply_now')</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              {!! Form::open(['route' => ['dashboard.tech-cards.destroy',$card->id]]) !!}
                              @method('DELETE')
                              <h3>@lang('software.card_confirm_delete')</h3>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.no')</button>
                              <button type="submit" class="btn btn-danger">@lang('software.delete')</button>
                            {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>
                      
            
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











