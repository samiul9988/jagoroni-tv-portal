<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{LocalizationHelper, PostHelper, SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Models\Post;
use Hashids\Hashids;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ArticleController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        /** @var object Post */
        $postService = $this->postQuery();
        $posts = $postService->latest()->paginate(8);

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : __('jagoronitv::magz.page')." " . $posts->currentPage() . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.latest_news') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - ".__('jagoronitv::magz.page')." " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " .__('jagoronitv::magz.latest_news') ." $attr";
        }

        SeoHelper::getPage('posts', $seoTitle);

        return view(SettingHelper::activeTheme('page/posts'), compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show($post)
    {
        if (!$post instanceof Post) {
            abort(404);
        }

        $post->load('terms', 'comments');

        if($post) {
            $getCurrentLocale = LaravelLocalization::getCurrentLocale()
            ? LaravelLocalization::getCurrentLocale()
            : config('settings.default_language');

            $id = LocalizationHelper::getCurrentLocaleId();

            $translation = $post->translations->first();
            $translationValue = $translation?->value;
            $translatedPostIds = $translationValue ? json_decode($translationValue, true) : null;

            if (is_array($translatedPostIds) && count($translatedPostIds) > 1) {
                $postId = data_get($translatedPostIds, $getCurrentLocale);

                if (!$postId) {
                    abort(404);
                }
            } elseif ($post->post_language == $id) {
                $postId = $post->id;
            } else {
                abort(404);
            }

            $post = Post::with('terms')->findOrFail($postId);

            if ($post->post_visibility != "public" || $post->post_status == "draft") {
                if (!Auth::check() || $post->post_author != Auth::id()) {
                    return abort(404);
                }
            }

            $hits = $post->post_hits += 1;
            $post->update(['post_hits' => $hits]);

            $tags = $post->terms()->where('taxonomy', 'tag')->get();

            preg_match_all('/src="([^"]*)"/', $post->post_content, $result);


            if (!empty($post->post_image)) {
                $image = route('ogi.display', $post->post_image);
            } else {
                if ($result[0]) {
                    $image = route('ogi.display', last(explode('/', $result[1][0])));
                } else {
                    if ($post->post_type == 'post') {
                        $ogImage = (config('settings.ogi_article_post')) ? route('ogi.display', config('settings.ogi_article_post')) : asset('img/cover.webp');

                        if (config('settings.ogi_article_image')) {
                            $image = route('ogi.display', config('settings.ogi_article_image'));
                        } else {
                            $image = $ogImage;
                        }
                    } else if ($post->post_type == 'video_url' || $post->post_type == 'video_embed' || $post->post_type == 'video_file') {
                        $ogImage = (config('settings.ogi_video_post')) ? route('ogi.display', config('settings.ogi_video_post')) : asset('img/cover.webp');

                        if (config('settings.ogi_video_post')) {
                            $image = route('ogi.display', config('settings.ogi_video_post'));
                        } else {
                            $image = $ogImage;
                        }
                    } else {
                        $ogImage = (config('settings.ogi_audio_post')) ? route('ogi.display', config('settings.ogi_audio_post')) : asset('img/cover.webp');

                        if (config('settings.ogi_audio_post')) {
                            $image = route('ogi.display', config('settings.ogi_audio_post'));
                        } else {
                            $image = $ogImage;
                        }
                    }

                }
            }

            if ($post->meta_description) {
                $description = $post->meta_description;
            } else {
                if ($post->post_summary) {
                    $description = Str::limit(strip_tags($post->post_summary), 160);
                } else {
                    if ($post->post_content) {
                        $description = Str::limit(strip_tags($post->post_content), 160);
                    } else {
                        $description = config('settings.site_description');
                    }
                }
            }

            if ($post->meta_keyword) {
                $keyword = $post->meta_keyword;
            } else {
                if ($post->terms()->where('taxonomy', 'tag')->first()) {
                    foreach ($tags as $tag) {
                        $tag_array[] = $tag->name;
                    }
                    $keyword = implode(", ", $tag_array);
                } else {
                    $keyword = config('settings.meta_keyword');
                }
            }

            if ($post->terms()->where('taxonomy', 'tag')->first()) {
                foreach ($tags as $tag) {
                    $tag_array[] = $tag->name;
                }
                $meta_tags = implode(", ", $tag_array);
            } else {
                $meta_tags = "";
            }

            SeoHelper::getMeta($post->post_title, $description, $keyword, PostHelper::getUriPost($post));

            SeoHelper::getOpenGraphCustom(
                $post->post_title,
                $description,
                PostHelper::getUriPost($post),
                null,
                $image,
                [
                    'published_time' => $post->created_at,
                    'modified_time'  => $post->updated_at,
                    'author'         => $post->user->name,
                    'tag'            => $meta_tags
                ]
            );

            if (config('settings.twitter_username')) {
                SeoHelper::getTwitter($post->post_title, $description, PostHelper::getUriPost($post));
            }

            SeoHelper::getJsonLd($post->post_title, $description, PostHelper::getUriPost($post), $image);
        } else {
            $post = (object) [
                'post_title' => null,
                'post_summary' => null,
                'post_image' => null,
                'post_content' => null,
            ];
            $tags = null;
        }

        $comments = $post->comments()->where('status', 'approved')->get();

        $comments->load('reply');

        return view(SettingHelper::activeTheme('page/single'), compact(
            'post', 'tags', 'comments'
        ));
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function showPopular(): \Illuminate\Contracts\View\View|Factory|Application
    {
        $query = $this->postQuery();
        $posts = $query->orderBy('post_hits','DESC')->paginate(8);

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : $posts->currentPage() . " " . __('jagoronitv::magz.page') . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.all_popular_news') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - ".__('jagoronitv::magz.page') . " " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " . __('jagoronitv::magz.all_popular_news') . " $attr";
        }

        SeoHelper::getPage('popular_post', $seoTitle);

        return view(SettingHelper::activeTheme('page/popular'), compact('posts', ));
    }

    /**
     * @param Request $request
     */
    public function react(Request $request)
    {
        $hashids = new Hashids();
        $hashids = $hashids->decode($request->id);
        $id      = $hashids[0];
        $post    = Post::findOrFail($id);
        $like    = ($request->val == "true") ? $post->like += 1 : $post->like -= 1;
        $post->update(['like' => $like]);
    }

    /**
     * postQuery
     *
     * @return void
     */
    public function postQuery()
    {
        $id = LocalizationHelper::getCurrentLocaleId();
        $query = Post::with(['terms', 'user.roles', 'language'])
            ->article()
            ->where('post_language', $id)
            ->publish();

        if (Auth::check()) {
            /** @var object User */
            $currentUser = Auth::user();
            if ($currentUser->hasRole('super-admin')) {
                return $query;
            } else {
                if ($currentUser->can('read-private-post')) {
                    if ($currentUser->hasRole('admin')) {
                        return $query->where(function ($query_post) {
                            foreach ($query_post->with('user.roles')->get() as $post) {
                                if ($post->user->getRoleNames()->first() == 'admin') {
                                    $query_post->public()
                                        ->orWhere(function ($q) {
                                            $q->private()->where('post_author', Auth::id());
                                        });
                                } else {
                                    $query_post->public();
                                }
                            }
                        });
                    }
                } else {
                    if ($currentUser->hasRole(['author'])) {
                        return $query->where(function ($query_post) {
                            foreach ($query_post->with('user.roles')->get() as $post) {
                                if ($post->user->getRoleNames()->first() == 'author') {
                                    $query_post->public()
                                        ->orWhere(function ($q) {
                                            $q->private()->where('post_author', Auth::id());
                                        });
                                } else {
                                    $query_post->public();
                                }
                            }
                        });
                    } else {
                        return $query->public()
                            ->orWhere(function ($query_post) {
                                $query_post->private()
                                    ->where('post_author', Auth::id());
                            });
                    }
                }
            }
        } else {
            return $query->public();
        }
    }
}
