<?php
/**  */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    private $serie;

    public function show($id = null){

        if($id){
            $this->serie = Serie::find($id);
        } else {
            $this->serie = Serie::all();
        }

        return response()->json($this->serie);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        //TODO: Add Cover Image
        $this->validate($request, [
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'editorial' => 'required|max:255'
        ]);
        $this->serie = Serie::create($request->all());

        return response()->json($this->serie);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        //TODO: Add Cover Image
        $this->validate($request, [
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'editorial' => 'required|max:255'
        ]);

        $this->serie = Serie::findOrFail($id);
        $this->serie->name = $request->input('name');
        $this->serie->author = $request->input('author');
        $this->serie->editorial = $request->input('editorial');
        $this->serie->save();

        return response()->json($this->serie);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id){
        $this->serie = Serie::findOrFail($id);
        $this->serie->delete();

        return response()->json($this->serie);
    }
}