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

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id = null){

        if($id){
            $this->user = User::find($id);
        } else {
            $this->user = User::all();
        }

        return response()->json($this->user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'username' => 'required|max:255|unique:users,username,' . $id,
            'email' => 'required|unique:users,email,' . $id,
        ]);

        $this->user = User::find($id);
        $this->user->username = $request->input('username');
        $this->user->email = $request->input('email');
        $this->user->save();

        return response()->json($this->user);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id){
        $this->user = User::find($id);
        $this->user->delete();

        return response()->json($this->user);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function testManga(Request $request, $id){

        $this->user = User::with('mangas')->find($id);

        //$user->mangas()->attach(1);

        return response()->json($this->user);
    }
}