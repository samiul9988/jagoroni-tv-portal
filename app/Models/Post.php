<?php

namespace App\Models;

use App\Helpers\LocalizationHelper;
use App\Helpers\PostHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\Feed\FeedItem;


class Post extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_title',
        'post_summary',
        'post_name',
        'post_content',
        'post_image',
        'post_image_alt',
        'post_hits',
        'post_author',
        'post_language',
        'trans_order',
        'post_type',
        'post_status',
        'post_visibility',
        'post_mime_type',
        'post_guid',
        'post_image_meta',
        'meta_description',
        'meta_keyword',
        'post_source'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'post_name';
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user',
        'language',
        'terms',
        'language',
        'translations'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'post_name' => [
                'source' => 'post_title'
            ]
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    /**
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'post_language');
    }

    /**
     * @return BelongsToMany
     */
    public function terms()
    {
        return $this->belongsToMany(Term::class)->withTimestamps();
    }

    /**
     * Term Category
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany(Term::class)->where('taxonomy', 'category')->withTimestamps();
    }

    /**
     * Term Tag
     *
     * @return void
     */
    public function tags()
    {
        return $this->belongsToMany(Term::class)->where('taxonomy', 'tag')->withTimestamps();
    }

    /**
     * Term Category
     *
     * @param mixed $query
     * @return void
     */
    public function scopeWithTaxonomy($query, $taxonomy)
    {
        return $query->whereHas('terms', function ($subQuery) use ($taxonomy) {
            return $subQuery->where('taxonomy', $taxonomy);
        });
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function translations()
    {
        return $this->belongsToMany(Translation::class,'post_translations','post_id','translation_id');
    }

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeOfType($query, $type)
    {
        return $query->wherePostType($type);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->wherePostStatus('publish')
                        ->where('created_at', '<=', now());
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query->wherePostVisibility('public');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePrivate($query)
    {
        return $query->wherePostVisibility('private');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeArticle($query)
    {
        return $query->wherePostType('post');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVideo($query)
    {
        return $query->whereIn('post_type', ['video_file', 'video_url', 'video_embed']);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAudio($query)
    {
        return $query->whereIn('post_type', ['audio_file', 'audio_url', 'audio_embed']);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVideoAudioPost($query)
    {
        return $query->whereIn('post_type', ['post', 'video_file', 'video_url', 'video_embed', 'audio_file', 'audio_url', 'audio_embed']);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePage($query)
    {
        return $query->wherePostType('page');
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeLanguageCurrentSession($query): mixed
    {
        $id = LocalizationHelper::getCurrentLocaleId();
        return $query->wherePostLanguage($id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeLanguageCurrentAuthSession($query): mixed
    {
        $id = Auth::user()->language;
        return $query->wherePostLanguage($id);
    }

    /**
     * @return FeedItem
     */
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id'      => $this->id,
            'title'   => $this->post_title,
            'summary' => $this->post_summary == null ? "" : $this->post_summary,
            'updated' => $this->updated_at,
            'link'    => PostHelper::getUriPost($this),
            'author'  => $this->user()->first()->name,
        ]);
    }

    /**
     * @return mixed
     */
    public static function getFeedItems()
    {
        return Post::where('post_type', 'post')->with('user')->get();
    }

    /**
     * @param $query
     * @return void
     */
    public static function scopePost($query) {
        $id = LocalizationHelper::getCurrentLocaleId();

        $qry = $query->wherePostType('post')
            ->wherePostLanguage($id)
            ->wherePostStatus('publish');

        if (Auth::check()) {
            if (Auth::user()->hasRole('super-admin')) {
                return $qry;
            } else {
                if (Auth::user()->can('read-private-post')) {
                    if (Auth::user()->hasRole('admin')) {
                        return $qry->where(function($query_post){
                            foreach($query_post->with('user.roles')->get() as $post) {
                                if ($post->user->getRoleNames()->first()== 'admin') {
                                    $query_post->wherePostVisibility('public')
                                        ->orWhere(function($q) {
                                            $q->wherePostVisibility('private')->where('post_author', Auth::id());
                                        });
                                } else{
                                    $query_post->wherePostVisibility('public');
                                }
                            }
                        });
                    }
                } else {
                    if(Auth::user()->hasRole(['author'])) {
                        return $qry->where(function($query_post){
                            $posts = $query_post->get();
                            foreach($posts as $post) {
                                if (User::find($post->post_author)->getRoleNames()->first() == 'author') {
                                    $query_post->wherePostVisibility('public')
                                        ->orWhere(function($q) {
                                            $q->wherePostVisibility('private')->where('post_author', Auth::id());
                                        });
                                } else {
                                    $query_post->wherePostVisibility('public');
                                }
                            }
                        });
                    } else{
                        return $qry->wherePostVisibility('public')
                            ->orWhere(function($query_post) {
                                $query_post->wherePostVisibility('private')->where('post_author', Auth::id());
                            });
                    }
                }
            }
        } else {
            return $qry->wherePostVisibility('public');
        }
    }
}
