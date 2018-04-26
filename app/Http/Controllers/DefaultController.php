<?php

namespace App\Http\Controllers;

use App\Position;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index(){
        $per = Permission::all();
        if(!count($per)){
            $permission = new Permission();
            $permission->description = 'create';
            $permission->isLock =0;
            $permission->save();

            $permission = new Permission();
            $permission->description = 'list';
            $permission->isLock =0;
            $permission->save();
            
            $permission = new Permission();
            $permission->description = 'delete';
            $permission->isLock =0;
            $permission->save();
            
            $permission = new Permission();
            $permission->description = 'edit';
            $permission->isLock =0;
            $permission->save();
        }
        $role = Role::all();
        if(!count($role)){

            $Role = new Role();
            $Role->name = "administrator";
            $Role->description="Administrator";
            $Role->user_id=1;
            $Role->save();

            $Role = new Role();
            $Role->name = "user";
            $Role->description="Users";
            $Role->user_id=1;
            $Role->save();

            $Role = new Role();
            $Role->name = "guest";
            $Role->description="Guest";
            $Role->user_id=1;
            $Role->save();
        }

        $position = Position::all();
        if(!count($position)){
           $pos = new Position();
           $pos->name = "Administrator";
           $pos->description="Administrator";
            $pos->active=1;
           $pos->user_id=1;
           $pos->save();
        }

        $user = User::all();
        if(!count($user)){
           $users = new User();
           $users->active       =  1;
           $users->role_id      =   1;
           $users->position_id  =   1;
           $users->name         =   "admin";
           $users->username     =  "Administrator";
           $users->email        =  "admin@gmail.com";
           $users->password     =  bcrypt('admin');
           $users->photo        =  "default_user.png";
           $users->save();

        }
        if(Auth::check()) {

            return view('admin.dashboard');
        }
        return view('welcome');
    }

    public function AdminPanel(){

        return view(' admin.dashboard');
    }
}
