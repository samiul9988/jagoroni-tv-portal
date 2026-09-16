@extends('adminlte::page')

@section('title', __('title.comments'))

@section('content_top_nav_right')
    <x-navbar-language-widget />
@endsection

@section('content_header')
    <x-breadcrumbs title="{{ __('title.comments') }}" currentActive="{{ __('title.comments') }}"/>
@stop

@section('plugins.Flag', true)
@section('plugins.Datatables', true)
@section('plugins.Pace', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials._table')
    </div>
</div>

<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">{{ __('title.comment') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="commentForm" action="{{ route('comments.store') }}" data-action="" class="comment-form row" method="POST" role="form">
        <input id="postId" type="hidden" name="postId">
        <input id="replyId" type="hidden" name="replyId">
        <input id="mainReply" type="hidden" name="mainReply">
        <input type="hidden" name="userid" value="{{ Auth::id() }}">
        <div class="form-group col-md-12 mb-3 ">
            <label for="comment" class="col-form-label">{{ __('form.reply_to_comment') }} <span class="required"></span></label>
            <textarea id="comment" class="form-control" rows="3" name="comment" placeholder="{{ __('jagoronitv::magz.write_your_response') }}" required></textarea>
            <div id="validationComment" class="invalid-feedback">
              {{ __('jagoronitv::magz.cannot_be_empty') }}
            </div>
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button id="comment-submit" type="submit" class="btn btn-primary comment-btn">{{ __('button.reply') }}</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('css')
    @include('admin.comments._style')
@endpush

@push('js')
    @include('layouts.partials._datatables')
    @include('layouts.partials._switch_lang')
    @include('layouts.partials._notification')
    @include('admin.comments._script')
@endpush

@section('footer')
@include('layouts.partials._footer')
@stop
