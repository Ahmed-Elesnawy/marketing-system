@extends('layouts.dashboard.app')





@section('title',$title)

@section('content_header')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('software.my_cards')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.markter.myCards') }}">@lang('software.my_cards')</a></li>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCard">@lang('software.add_new_card')</button>

      <div class="modal fade" id="createCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">@lang('software.add_new_card')</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('dashboard.tech-cards.store') }}" >
                @method('POST')
                @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">@lang('software.card_title')</label>
                  <input name="title" value="{{ old('title') }}" type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">@lang('software.card_content')</label>
                  <textarea rows="8" class="form-control" id="message-text" name="content">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
              <button type="submit" class="btn btn-primary">@lang('software.add')</button>
            </div>
          </form>

          </div>
        </div>
      </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
        <table class="table table-hover">
          <tbody>
            <tr>
                <th>@lang('software.card_title')</th>
                <th>@lang('software.card_content')</th>
                <th>@lang('software.card_reply')</th>
                <th>@lang('software.action')</th>
          </tr>

          @forelse ( $cards as $card )
           
          <tr>
              <td>{{ $card->title }}</td>
              <td>{{ $card->content }}</td>
              <td>
                  @if ( $card->is_opend )
                    <span class="label label-warning">
                        البطاقة تحت المراجعة
                    </span>
                  @else
                    {{ $card->reply }}
                  @endif
              </td>
              <td>
                  @if ( $card->is_opend )
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCard-{{ $card->id }}">@lang('software.edit')</button>
                  <div class="modal fade" id="editCard-{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">@lang('software.add_new_card')</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('dashboard.tech-cards.update',$card->id) }}" >
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">@lang('software.card_title')</label>
                              <input name="title" value="{{ $card->title }}" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">@lang('software.card_content')</label>
                              <textarea rows="8" class="form-control" id="message-text" name="content">{{ $card->content }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
                          <button type="submit" class="btn btn-primary">@lang('software.add')</button>
                        </div>
                      </form>
                  
                      </div>
                    </div>
                  </div>
                  
                  
                  @else
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCard-{{ $card->id }}">@lang('software.delete')</button>
                  <div class="modal fade" id="deleteCard-{{ $card->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">@lang('software.add_new_card')</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('dashboard.tech-cards.destroy',$card->id) }}" >
                            @method('DELETE')
                            @csrf
                            <h4>@lang('software.card_confirm_delete')</h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('software.close')</button>
                          <button type="submit" class="btn btn-danger">@lang('software.yes')</button>
                        </div>
                      </form>
                  
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




@endsection







