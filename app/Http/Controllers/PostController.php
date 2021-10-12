<?php
// Bonjour tous le monde
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
// use App\Models\PostModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        // On doit être connecté pour accéder aux fonctionnalités du PostController
        // Sauf la méthode show
        $this->middleware('auth')->except('show');
    }
    
    public function show(string $slug)
    {
        // Récupération de l'article
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Récupération des commentaires de l'article
        // Triés du plus récent au plus ancien
        $comments = $post->comments()->latest()->get();
        
        // Récupération des catégories de l'article
        $categories = $post->categories;
        
        // $model = new PostModel();
        // $results = $model->find($id);
        
        // if (empty($results)) {
        //     abort(404);
        // }
        
        // $post = $results[0];
        
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
            'categories' => $categories
        ]);
    }
    
    public function create()
    {
        // Récupération des catégories triées par nom
        $categories = Category::orderBy('name')->get();
        
        return view('posts.create', [
            'categories' => $categories    
        ]);
    }
    
    public function store(Request $request)
    {
        // Validation du formulaire
        $request->validate([
            'title' => 'required|unique:posts|min:5',
            'content' => 'required|min:5',
            'categories' => 'required'
        ]);
        
        // Création de l'article
        $post = new Post();
        
        // On récupère les valeurs du formulaire
        // et on les donne aux différents champs de l'article
        $post->title = $request->input('title');
        $post->slug = Str::of($request->input('title'))->slug('-');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        
        // Enregistrement de l'article
        $post->save();
        
        // Enregistrement des catégories pour l'article
        $post->categories()->sync($request->input('categories'));
        
        // Redirection vers la route qui s'appelle home (l'accueil)
        return redirect()->route('home');
    }
}
