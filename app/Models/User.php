<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name','username', 'email', 'password','country','city','date_of_birth','status','url_avatar','phone','link_fb'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function interests()
    {
        return $this->belongstoMany(Interest::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'from');
    }
}
