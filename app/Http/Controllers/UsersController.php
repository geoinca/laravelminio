<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {   //
        //$users = User::with('user')->orderBy('id', 'desc')->paginate(10);
        //$users=DB::table('users')->where('name', 'John')->get()->paginate(10);
        // SELECT u.`id`,u.`name`, u.`email`,u.`created_at`,r.`name` as `type` FROM `users` u 
        //    inner join `role_user` ru on u.`id`= ru.`user_id` 
        //     inner join `roles` r on r.`id`= ru.`role_id` where   r.`id` <> 1
        $users =User::select('users.*','roles.name as type')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.id', '<>', 1)
            ->get();
        return view('users.index')->with(['users' => $users]);
    }
}
