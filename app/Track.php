<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['title', 'artist', 'path_lq', 'path_hq', 'current_downloads'];
}
