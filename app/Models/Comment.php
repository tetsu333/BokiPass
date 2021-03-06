<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'body',
    ];

    // テーブル間のリレーションの設定
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
