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
        'title', 'publishedAt', 'volume', 'price', 'isbn'
    ];

}