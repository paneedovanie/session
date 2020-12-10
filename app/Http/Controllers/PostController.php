<?php

namespace App\Http\Controllers;

use App\Http\Resources\JsonResource;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $per_page = $request->query('per_page');

        try {
            if($request->query('search')) $posts = Post::search($request->query('search'))->paginate($per_page > 0 ? $per_page : null);
            else $posts = Post::paginate($per_page > 0 ? $per_page : null);
        } catch (\Throwable $th) { return new JsonResource([]); }
      
        $posts->map(function ($post) {
            $post->author = $post->user->firstname . ' ' . $post->user->lastname;
            return $post;
        });

        return new JsonResource($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validator($request);
        return new JsonResource(Post::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JsonResource(Post::find($id));
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
        $data = $request->all();
        $this->validator($request, $id);
        return new JsonResource(Post::where('id', $id)->update($data));
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Post::where('id', $id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return new JsonResource(Post::onlyTrashed()->get());
    }

    /**
     * Restore the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return new JsonResource(Post::where('id', $id)->restore());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return new JsonResource(Post::where('id', $id)->forceDelete());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        $validation = [
            'body' => ['string'],
            'user_id' => ['required', 'int'],
        ];

        return $request->validate($validation);
    }
}
