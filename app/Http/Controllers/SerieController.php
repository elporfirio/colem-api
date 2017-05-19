<?php
/**  */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    private $serie;

    public function show(Request $request, $id = null){
        if($request->query('mangas') !== null){
            if($id){
                $this->serie = Serie::with('mangas')->find($id);
            } else {
                $this->serie = Serie::with('mangas')->get();
            }
        } else {
            if($id){
                $this->serie = Serie::find($id);
            } else {
                $this->serie = Serie::all();
            }
        }
        return response()->json($this->serie);
    }

    public function showWithMangas($id = null){
        if($id){
            $this->serie = Serie::with('mangas')->find($id);
        } else {
            $this->serie = Serie::with('mangas')->get();
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile');
            $inputFileName =  str_limit(str_random(10).$file->getClientOriginalName(), 200);
            $inputFileName = str_slug($inputFileName, '-').'.'.$file->getClientOriginalExtension();
            $destination = storage_path() . '/app/covers';
            $file->move($destination, $inputFileName);
            $request->merge(['cover' => $inputFileName]);
        }
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