<?php
/**
 * Created by PhpStorm.
 * User: porfirio.chavez
 * Date: 10/05/17
 * Time: 09:59
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\User;


class CollectionController extends Controller
{
    private $user;

    public function add(Request $request, $userId){
        $this->user = User::findOrFail($userId);
        $this->user->mangas()->attach($request->input('selected'));

        return response()->json($this->user);
    }

    public function show(Request $request, $userId, $serieId = null){
        if($serieId === null){
            $this->user = User::with('mangas')->findOrFail($userId);
        } else {
            $this->user = User::whereHas('mangas', function($query) use ($serieId){
                $query->where('serie_id', '=', $serieId);
            })->with('mangas')->get();
        }


        return response()->json($this->user);
    }

}