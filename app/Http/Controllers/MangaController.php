<?php
/**
 * Created by PhpStorm.
 * User: porfirio.chavez
 * Date: 09/05/17
 * Time: 11:35
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Serie;

class MangaController extends Controller
{
    private $manga;

    public function show($id = null){

        if($id){
            $this->manga = Manga::find($id);
        } else {
            $this->manga = Manga::all();
        }

        return response()->json($this->manga);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        //TODO: Add Cover Image
        $this->validate($request, [
            'title' => 'required|max:255',
            'publishedAt' => 'required',
            'volume' => 'required',
            'price' => 'required',
            'isbn' => 'required|max:255',
            'serie_id' => 'required'
        ]);
        $this->manga = Manga::create($request->all());

        //$this->manga->series()->associate($serie);
        //$this->manga->save();

        return response()->json($this->manga);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        //TODO: Add Cover Image
        $this->validate($request, [
            'title' => 'required|max:255',
            'publishedAt' => 'required',
            'volume' => 'required',
            'price' => 'required',
            'isbn' => 'required|max:255',
            'serie_id' => 'required'
        ]);

        $this->manga = Manga::findOrFail($id);
        $this->manga->title = $request->input('title');
        $this->manga->publishedAt = $request->input('publishedAt');
        $this->manga->volume = $request->input('volume');
        $this->manga->price = $request->input('price');
        $this->manga->isbn = $request->input('isbn');
        $this->manga->serie_id = $request->input('serie_id');
        $this->manga->save();

        return response()->json($this->manga);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id){
        $this->manga = Manga::findOrFail($id);
        $this->manga->delete();

        return response()->json($this->manga);
    }
}