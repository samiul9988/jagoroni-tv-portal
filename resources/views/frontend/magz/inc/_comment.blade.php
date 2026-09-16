<div class="comments">
    <h2 class="title">
        <span id="countComment">@if(count($comments)) {{ count($comments) }} {{ __('jagoronitv::magz.response') }} @endif</span> 
        <span class="reply">{{ __('jagoronitv::magz.write_a_response') }}</span>
    </h2>
    <div class="comment-list">
        {!! UtlHelper::displayComment($comments) !!}
    </div>
    @if(count($comments) > 2)
    <div class="text-center mt-5">
        <span class="reply">{{ __('jagoronitv::magz.write_a_new_response') }}</span>
    </div>
    @endif
</div>

<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">{{ __('jagoronitv::magz.leave_your_response') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="commentForm" action="{{ route('comment') }}" data-action="" class="comment-form row" method="POST" role="form">
        <input id="postId" type="hidden" name="postId" value="{{ $post->id }}">
        <input id="replyId" type="hidden" name="replyId">
        <input id="mainReply" type="hidden" name="mainReply">
        @if(Auth::check())
        <input type="hidden" name="userid" value="{{ Auth::id() }}">
        @endif
        @if(!Auth::check()) 
        <div class="row">
        <div class="form-group col-md-4 mb-3">
            <label for="name" class="col-form-label">{{ __('jagoronitv::magz.name') }} <span class="required"></span></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('jagoronitv::magz.your_name') }}" required>
            <div id="validationName" class="invalid-feedback">
              {{ __('jagoronitv::magz.cannot_be_empty') }}
            </div>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="email" class="col-form-label">{{ __('jagoronitv::magz.email') }} <span class="required"></span></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="yourmail@domain.com" required>
            <div id="validationEmail" class="invalid-feedback">
              {{ __('jagoronitv::magz.cannot_be_empty') }}
            </div>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="url" class="col-form-label">{{ __('jagoronitv::magz.website') }}</label>
            <input type="url" id="url" name="url" class="form-control" placeholder="http://www.example.com">
            <div id="validationUrl" class="invalid-feedback">
              {{ __('jagoronitv::magz.cannot_be_empty') }}
            </div>
        </div>
        </div>
        
        @endif
        <div class="form-group col-md-12 mb-3 ">
            <label for="comment" class="col-form-label">{{ __('jagoronitv::magz.response') }} <span class="required"></span></label>
            <textarea id="comment" class="form-control" rows="3" name="comment" placeholder="{{ __('jagoronitv::magz.write_your_response') }}" required></textarea>
            <div id="validationComment" class="invalid-feedback">
              {{ __('jagoronitv::magz.cannot_be_empty') }}
            </div>
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button id="comment-submit" type="submit" class="btn btn-primary comment-btn" data-loading-text="{{ __('message.sending') }}">{{ __('jagoronitv::magz.send_response') }}</button>
      </div>
    </div>
  </div>
</div>

