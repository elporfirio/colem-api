<?php
/**
 * Created by PhpStorm.
 * User: porfirio.chavez
 * Date: 09/05/17
 * Time: 13:04
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'name', 'author', 'editorial', 'cover'
    ];

    public function mangas()
    {
        return $this->hasMany('App\Models\Manga');
    }
}