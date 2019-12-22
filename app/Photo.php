<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    protected $fillable = [
        'user_id', 'title', 'photo', 'delete_flg'
    ];

    // バリデーション
    public static $rules = array(
        'title' => 'required|string|max:255',
        'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
    );

    public function user(){
        return $this->belongsTo('APP\User');
    }
}
