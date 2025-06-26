<?php

namespace App\Http\Controllers\ApiController;


use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $articles = Articles::latest()->get();
            return response()->json($articles, 200);
        }catch (\Exception $e){
            
            return response()->json(
                [
            'error'=>'failed to fetch data',
            'massage'=> $e->getMessage()
        ],
        500
        );
    }
}

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([

    //     ]);

    //     try {}
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       try{
        $articles = Articles::findOrFail($id);
        return response()->json($articles,200);
       } catch (ModelNotFoundException $e){
        return response()->json(['error'=>'Data not found'], 404);
       }catch (\Exception $e) {
        return response()->json(['error'=> 'Failed to fetch data','massage'=> $e->getMessage()],500);
       }
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'required|string|max:200',
        'content' => 'required|string',
        'image_url' => 'nullable|string|max:255',
    ]);

    $article = Articles::findOrFail($id);

    $article->update([
        'title' => $request->title,
        'content' => $request->content,
        'image_url' => $request->image_url,
    ]);

    return response()->json([
        'message' => 'Artikel berhasil diperbarui',
        'data' => $article
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $article = Articles::findOrFail($id);
    $article->delete();

    return response()->json([
        'message' => 'Artikel berhasil dihapus'
    ]);
}

}
