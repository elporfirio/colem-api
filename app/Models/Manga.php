<?php
/**
 * Created by PhpStorm.
 * User: elporfirio
 * Date: 05/05/17
 * Time: 8:38 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{

    protected $fillable = [
        'title', 'publishedAt', 'volume', 'price', 'isbn', 'serie_id'
    ];

    public function series()
    {
        return $this->belongsTo('App\Models\Serie');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'manga_user');
    }
}