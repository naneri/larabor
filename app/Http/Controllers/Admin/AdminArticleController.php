<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zabor\Mysql\Article;
class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(30);

        return view('admin.article.list', compact('articles'));
    }

    public function getAdd()
    {
        return view('admin.article.add');
    }

    public function postAdd(Request $request)
    {
    	$image = Image::make($request->file('image'));

    	$image_path = "images/content/articles/" . time() . str_random(5) . ".jpg";

    	$image->fit(1100,400)->save(public_path($image_path));

    	Article::create([
    		'user_id'	=> Auth::id(),
    		'title'		=> $request->input('title'),
    		'slug'		=> str_slug($request->input('title')),
    		'text'		=> $request->input('text'),
    		'image'		=> $image_path
    		]);

    	return redirect('admin/article/add');
    }

    public function delete($id)
    {
        $article = Article::find($id);

        File::delete(public_path($article->image));

        $article->delete();

        return redirect()->back();
    }
}
