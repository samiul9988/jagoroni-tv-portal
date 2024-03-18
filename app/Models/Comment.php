<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'subscribe',
        'url', 
        'comment',
        'avatar', 
        'reply_id',
        'main_reply',
        'user_id',
        'post_id',
        'status'
    ];

    /**
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    
    /**
     * reply
     *
     * @return void
     */
    public function reply()
    {
        return $this->hasMany(self::class, 'reply_id');
    }
    
    /**
     * parentReply
     *
     * @return void
     */
    public function parentReply()
    {
        return $this->belongsTo(self::class, 'reply_id');
    }
    
    /**
     * grandchildren
     *
     * @return void
     */
    public function grandchildren()
    {
        return $this->reply()->with('grandchildren');
    }
    
    /**
     * getDepth
     *
     * @return void
     */
    public function getDepth()
    {
        $depth = 0;
        $parent = $this->parentReply;

        while ($parent) {
            $depth++;
            $parent = $parent->parentReply;
        }

        return $depth;
    }
}
