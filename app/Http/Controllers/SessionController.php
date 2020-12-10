<?php

namespace App\Http\Controllers;

use App\Http\Resources\JsonResource;
use App\Models\Session;
use Illuminate\Http\Request;
use Illiminate\Support\Carbon;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->query('user_id');
        $lesson_id = $request->query('lesson_id');

        return new JsonResource(
            Session::where('user_id', '=', $user_id)
                ->where('lesson_id', '=', $lesson_id)
                ->orderBy('id', 'DESC')->get()
        );
    }

    public function log (Request $request) 
    {
        $seconds_interval = 10; // in seconds

        $data = $request->all();
        $this->validator($request);

        $lastSession = Session::where('user_id', '=', $data['user_id'])
            ->where('lesson_id', '=', $data['lesson_id'])
            ->latest()
            ->first();
        
        if($lastSession->updated_at->timestamp + $seconds_interval > now()->timestamp)
        {
            Session::where('id', $lastSession->id)->update($data);
            $lastSession = Session::find($lastSession->id);
        }
        else 
            $lastSession = Session::create($data);

        return new JsonResource($lastSession);
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
            'user_id' => ['required', 'int'],
            'lesson_id' => ['required', 'int'],
        ];

        return $request->validate($validation);
    }
}
