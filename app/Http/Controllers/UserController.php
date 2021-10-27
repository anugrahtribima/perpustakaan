<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    //
    public function index(){
        $users = User::all();

        return view("Users.index", compact('users'));
    }

    public function create(){
        return view('Users.create');
    }

    public function store(Request $request){
        $request->validate([
            'nis' => ['required', 'unique:users'],
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'no_hp' => ['required', 'unique:users'],
            'alamat' => ['required'],
            'akses' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        $users = User::create([
            'nis' => $request->input('nis'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'akses' => $request->input('akses'),
            'password' => Hash::make($request->password)
        ]);

        return redirect('users')->with('update-message', 'Data successfully updated');

    }

    public function edit($id){
        $users = User::all()->find($id);
        return view("Users.edit", compact('users'));
    }

    public function update(Request $request){
        $request->validate([
            'nis' => ['required', 'unique:users'],
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'no_hp' => ['required', 'unique:users'],
            'alamat' => ['required'],
            'akses' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        User::where('id', $request->id)->update([
            'nis' => $request->input('nis'),
            'nis' => $request->input('nis'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'akses' => $request->input('akses'),
            'password' => Hash::make($request->password)
        ]);

        return redirect('users')->with('update-message', 'Data successfully updated');
    }

    public function destroy($id){
        $user = User::all()->find($id);
        $user->delete();

        return redirect('users')->with('delete-message', 'Data successfully deleted');
    }


}
