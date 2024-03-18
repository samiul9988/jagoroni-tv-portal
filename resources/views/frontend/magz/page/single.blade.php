@extends('frontend.magz.index')

@inject('termHelper', 'App\Helpers\TermHelper')
@inject('themeHelper', 'App\Helpers\ThemeHelper')
@inject('postHelper', 'App\Helpers\PostHelper')

@section('content')
<section class="single top">
    <div class="container-md">
        <div class="row">
            @if($sidebarPosition === "left" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
            <div class="col-lg-8 @if($sidebarActive === false) offset-lg-2 @endif">
            @if($post->post_title)
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{ __('dhakawatch::magz.home') }}</a></li>
                    @if($post->categories->first() AND $post->categories->first()->name)
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->terms()->category()->first()->name }}</li>
                    @endif
                </ol>
                <article class="article main-article">
                    <header>
                        <h1>{{ $post->post_title }}</h1>
                        <ul class="details">
                            <li>{{ __('dhakawatch::magz.posted_on') }} {{ $post->created_at->locale(LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</li>
                            @if($post->categories->first() AND $post->categories->first()->name)
                                <li>
                                    <a href="{{ $termHelper->resolveUrl($post, $post->terms()->category()->first()->slug) }}">
                                        {{ $termHelper->resolveLabel($post, $post->terms()->category()->first()->slug)}}
                                    </a>
                                </li>
                            @endif
                            <li>{{ __('dhakawatch::magz.by') }} <span>{{ $post->user->name }}</span></li>
                            <li>{{ $post->post_hits }} {{ __('dhakawatch::magz.views') }}</li>
                        </ul>
                    </header>
                    <div class="main">
                        <div class="summary">
                        {!! $post->post_summary !!}
                        </div>
                        @if($post->post_type == "page" OR $post->post_type == "post")
                            @if(!empty($post->post_image) && App\Helpers\ImageHelper::isExists('images', $post->post_image) || App\Helpers\PostHelper::isImageUrlAvailable($post))
                            <figure class="figure d-block text-center mb-4">
                                <img src="{{ $postHelper->displayThumbnailForSinglePost($post) }}" class="figure-img img-fluid rounded" alt="{{ $post->post_image }}" width="736" height="552">
                                <figcaption class="figure-caption">{!! $postHelper->getPostThumbnailCaption($post->post_image_meta) !!}</figcaption>
                            </figure>
                            @else
                            <hr>
                            @endif
                        @else
                            @php
                                $postSource = json_decode($post->post_source);
                                $postImageMeta = $postHelper->isImageUrlAvailable($post);

                                if ($postImageMeta) {
                                    $poster = json_decode($post->post_image_meta)->image_url;
                                } else {
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                }
                            @endphp
                            @if($post->post_type == "video_embed" OR $post->post_type == "audio_embed")
                                @if($post->post_type == "video_embed")
                                    <figure class="player">  
                                        <div id="player" data-plyr-provider="{{ $postSource->provider }}" data-plyr-embed-id="{{ $postSource->embed_id }}" data-poster="{{ $poster }}" style="--plyr-color-main: #eb0254;"></div>
                                    </figure>
                                @elseif($post->post_type == "audio_embed")
                                <div class="plyr__audio-embed" id="player" style="--plyr-color-main: #eb0254; margin-bottom: 3rem;">
                                    {!! $post->post_source !!}
                                </div>
                                @endif
                            @elseif($post->post_type == "audio_file" OR $post->post_type == "audio_url")
                                @php
                                    $postSource = json_decode($post->post_source);
                                    $postImageMeta = $postHelper->isImageUrlAvailable($post);

                                    $poster = '';

                                    if ($post->post_image ) {
                                        if ($postImageMeta) {
                                            $poster = json_decode($post->post_image_meta)->image_url;
                                        } else {
                                            $poster = asset('storage/images/'.$post->post_image);
                                        }
                                    }
                                @endphp
                                @if(!empty($poster))
                                    <div class="featured">
                                        <figure>
                                            <img src="{{ $poster }}" alt="{{ $post->post_title }}">
                                        </figure>
                                    </div>
                                @endif
                                <div class="container-plyr mt-3 mb-5">
                                    @php
                                    $source = ($post->post_type == 'audio_file') ? asset('storage/audios/'.$post->post_source) : $post->post_source;
                                    @endphp
                                    <audio id="player" style="--plyr-color-main: #eb0254;" controls>
                                        <source src="{{ $source }}"/>
                                    </audio>
                                </div>
                            @elseif($post->post_type == "video_url")
                                @php
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                @endphp
                                <figure class="player">
                                    <div id="player" data-plyr-provider="youtube" data-poster="{{ $poster }}" data-plyr-embed-id="{{ $post->post_source }}" style="--plyr-color-main: #eb0254;"></div>
                                </figure>
                            @else
                                <div class="container-plyr mb-5">
                                    @php
                                    $width = ($post->post_type == "video_file") ? '100%' : '640';
                                    $poster = ($post->post_image) ? asset('storage/images/'.$post->post_image) : asset('img/cover-video.webp');
                                    @endphp
                                    <figure>
                                    <video id="player" playsinline controls data-plyr-config='{ "ratio": "16:9" }' data-poster="{{ $poster }}" style="--plyr-color-main: #eb0254;">
                                        <source src="{{ asset('storage/videos/'.$post->post_source) }}"/>
                                    </video>
                                    </figure>
                                </div>
                            @endif
                        @endif
                             
                        {!! $post->post_content !!}
                    </div>
                    <footer>
                        <div class="col-m">
                            <ul class="tags">
                                @foreach( $tags as $tag )
                                    <li><a href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-m">
                            <span class="love" data-id="{{ $hashids->encode($post->id) }}"><i class="fa-regular fa-thumbs-up"></i>
                                <div>{{ $post->like }}</div>
                            </span>
                        </div>
                    </footer>
                </article>
                <div class="sharing">
                    <div class="title"><i class="ion-android-share-alt"></i> {{ __('dhakawatch::magz.sharing_is_caring') }}</div>
                    {!! Share::page(request()->url(), $post->post_title, [], '<ul class="social">', '</ul>')
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp()
                    ->telegram()!!}
                </div>
                <div class="line">
                    <div>{{ __('dhakawatch::magz.author') }}</div>
                </div>
                <div class="author">
                    <figure>
                        @if($post->user->photo)
                            @if($post->user->photo)
                                @if(\App\Helpers\ImageHelper::isExists('avatar', $post->user->photo))
                                    <img src="{{ asset('storage/avatar/'.$post->user->photo) }}" alt="{{ $post->user->name }}" width="100" height="100">
                                @else
                                    <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('dhakawatch::magz.no_image') }}" width="100" height="100">
                                @endif
                            @else
                                <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('dhakawatch::magz.no_image') }}" width="100" height="100">
                            @endif
                        @else
                            <img src="{{ asset('img/noavatar.png') }}" alt="{{ __('dhakawatch::magz.no_image') }}" width="100" height="100">
                        @endif
                    </figure>
                    <div class="details">
                        @if($post->user->occupation) <div class="job">{{ $post->user->occupation }}</div> @endif
                        <div class="name">{{ $post->user->name }}</div>
                        <p>@if($post->user->about) {{ $post->user->about }} @endif</p>

                        @if ($post->user->links)
                            <ul class="social trp sm">
                                @foreach ( json_decode($post->user->links) as $link )
                                    <li>
                                        <a href="{{ $link->url }}" aria-label="{{ $link->label }}" target="_blank" style="background-color: {{ $link->color }};color:#fff">
                                            <i class="{{ $link->icon }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <x-related-post :mainPostTitle="$post->post_title" :page="$page" :post="$post" layout="body" widgetName="related_post" :widgetData="$relatedPost"/>
                <div class="line thin"></div>
                @include('frontend.magz.inc._comment-disqus')
                @include('frontend.magz.inc._comment')
            @endif
            </div>
            @if($sidebarPosition === "right" AND $sidebarActive)
                @include('frontend.magz.template-parts.sidebar')
            @endif
        </div>
    </div>
</section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/prism.js/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/plyr/plyr.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('vendor/prism.js/prism.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{ asset('vendor/plyr/plyr.min.js') }}"></script>

    <script>
        const player = new Plyr('#player');
    </script>

    <script>
        var commentModal = document.getElementById('commentModal')
        commentModal.addEventListener('hidden.bs.modal', function (event) {
            var url = '{{ route("comment") }}';
            $('input[name="_method"]').detach();
            $("#comment").val('');
            $('#replyId').val('');
            $('#mainReply').val('');
            $('#name').val('');
            $('#email').val('');
            $('#url').val('');
            $('.comment-form').attr('action', url);
            $('.comment-form').attr('data-action', '');
            $('.form-control').removeClass('is-invalid');
            $('#comment-submit').html("{{ __('dhakawatch::magz.send_response') }}");
            $(".spinner-grow").attr("hidden");  
        })
    </script>

@endpush
