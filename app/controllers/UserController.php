<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found', 404);
});


class UserController extends BaseController {

    public function getUsers()
    {
        
        $users = User::all();
        
        return $users->toJson();
        
    }

    public function getUser($id)
    {

        $user = User::findOrFail($id);
        
        return $user->toJson();
    }

}

?>