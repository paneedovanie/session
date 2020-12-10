<?php

namespace App\Http\Controllers;

use App\Http\Resources\JsonResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            if($request->query('search')) $users = User::search($request->query('search'))->paginate($per_page > 0 ? $per_page : null);
            else $users = User::paginate($per_page > 0 ? $per_page : null);
        } catch (\Throwable $th) { return new JsonResource([]); }

        $users->map(function ($user) {
            $user->displayname = $user->firstname . ' ' . $user->lastname;
            return $user;
        });
        
        return new JsonResource($users);
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
        $data['password'] = Hash::make($data['password']);
        $this->validator($request);
        return new JsonResource(User::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JsonResource(User::find($id));
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
        return new JsonResource(User::where('id', $id)->update($data));
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::where('id', $id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return new JsonResource(User::onlyTrashed()->get());
    }

    /**
     * Restore the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return new JsonResource(User::where('id', $id)->restore());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return new JsonResource(User::where('id', $id)->forceDelete());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request, $id = null)
    {
        $validation = [
            'prefixname' => ['string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffixname' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'photo' => ['string'],
            'type' => ['required', 'string', 'max:255'],
        ];

        if(!isset($id))
            $validation['password'] = ['required', 'string', 'min:8', 'confirmed'];

        return $request->validate($validation);
    }
}
