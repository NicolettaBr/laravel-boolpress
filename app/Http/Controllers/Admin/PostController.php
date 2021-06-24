<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts'=> $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories'=>$categories,
            'tags' => $tags
           
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //validazione
        //aggiungere html error a create.blade.php
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        //per vedere se i nuovi dati vengono salvati
        //dd($request->all());
        
        $new_post_data = $request->all();

        //Creo lo slug
        $new_slug = Str::slug($new_post_data['title'], '-');
        //dd($new_slug);

        //creo slug base uguale a new_slug
        $base_slug = $new_slug;

        //cerco se esiste già uno slug occupato
        $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        //se ne esiste già uno occupato entra nel while e con counter aggiunge +1
        while($post_with_existing_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            //ciclo while continua finche non trova uno slug libero
            $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
        }
        
        //quando trovo slug libero popolo i data da salvare
        $new_post_data['slug'] = $new_slug;

        $new_post = new Post();
        $new_post->fill($new_post_data);
        $new_post->save();

        //dd('post salvato');
        
        //Tags

        //se il tag esiste lo salviamo 
        //in create al posto di sync puoi usare anche attach
        //aggiungi tags alla validazione
        if(isset($new_post_data['tags']))
        $new_post->tags()->sync($new_post_data['tags']);
        
        //reindirizza al dettaglio
        return redirect()->route('admin.posts.show', ['post'=> $new_post->id]);
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        $data = [
            'post'=> $post,
            'post_category' => $post->category,
            'post_tags' => $post->tags
        ];
        //dd($post->tags);
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        $data = [
            'post' => $post,
            'categories' => $categories

        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validazione
        //aggiungere html error a create.blade.php
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65000',
            'category_id' => 'nullable|exists:categories,id'
        ]); 

        $modified_post = $request->all();
        //controlla che i dati modificati vengano salvati
        //dd($modified_post);

        $post = Post::findOrFail($id);

        $modified_post['slug'] = $post->slug;

        //modifica lo slug SOLO SE cambia il titolo del post, altrimenti resta lo stesso
        if($modified_post['title'] != $post->title) {

            //Creo lo slug
            $new_slug = Str::slug($modified_post['title'], '-');
            //dd($new_slug);

            //creo slug base uguale a new_slug
            $base_slug = $new_slug;

            //cerco se esiste già uno slug occupato
            $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
            $counter = 1;

            //se ne esiste già uno occupato entra nel while e con counter aggiunge +1
            while($post_with_existing_slug) {
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                //ciclo while continua finche non trova uno slug libero
                $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
            }

            //quando trovo slug libero popolo i data da salvare
            $modified_post['slug'] = $new_slug;

        }
        
        //dd('post modificato');
        
        $post->update($modified_post);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);

        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');

    }
}
