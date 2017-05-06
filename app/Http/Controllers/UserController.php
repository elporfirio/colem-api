<?php
/**
 * Created by PhpStorm.
 * User: porfirio.chavez
 * Date: 05/05/17
 * Time: 11:11
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    private $user;

    public function show($id = null){

        if($id){
            $this->user = User::find($id);
        } else {
            $this->user = User::all();
        }

        return response()->json($this->user);
    }

    public function create(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users',
        ]);

        $this->user = User::create($request->all());
//        var_dump($id);
//        var_dump($request->query());
//        var_dump($request->input('hola'));

        return response()->json($this->user);
    }

    public function testManga(Request $request){

        $user = User::with('mangas')->find(1);
        //$user->mangas()->attach(1);

        return response()->json($user);
    }
}