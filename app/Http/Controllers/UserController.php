<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request){
        $users = DB::table('users')->when($request->input('name'), function($query, $name){
            return $query->where('name', 'like', '%'.$name.'%');
        })->orderBy('id', 'desc')->paginate(10);

        return view('pages.users.index', ['type_menu' => 'users'], compact('users'));
    }

    public function create(){
        return view('pages.users.create', ['type_menu' => 'users']);
    }

    public function store(StoreUserRequest $request){
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user){
        $user = User::findOrFail($user->id);
        return view('pages.users.edit', ['type_menu' => 'users'], compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){
        $data = $request->validated();
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user){
        $user = User::findOrFail($user->id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
