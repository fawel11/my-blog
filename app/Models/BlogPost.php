<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = ['title', 'body', 'user_id','status'];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (is_null($post->user_id)) {
                $post->user_id = auth()->user()->id;
            }
        });
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'author' => $this->author->name ?? '',
        ];
    }

    public static function createPost($request)
    {
        return self::create($request);
    }
    public static function updatePost($id,$newDetails)
    {
        return BlogPost::find($id)->update($newDetails);
    }

    public static function destroyBlog($id)
    {
        return BlogPost::find($id)->delete();
    }

// set post created by
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAuthorNameAttribute()
    {
        return $this->author->name;
    }

    public function isTheOwner($user)
    {
        return $this->user_id === $user->id;
    }
}
