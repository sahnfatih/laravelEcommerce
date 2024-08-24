<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("backend.users.index", ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.users.insert_form");


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:2',
        ]);

       $name = $request->get("name");
       $email = $request->get("email");
       $password = $request->get("password");
       $is_admin = $request->get("is_admin", default: 0);
       $is_active = $request->get("is_active", default: 0);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->is_admin = $is_admin;
        $user->is_active = $is_active;

        $user->save();


        return redirect('/users')->with('success', 'Kullanıcı başarıyla kaydedildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "show => $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application\Illuminate\Contracts\View\Factory\Illuminate\Contracts\View\View\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::find($id);
        return view("backend.users.update_form", ["user"=> $user]);
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
        $name = $request->get("name");
        $email = $request->get("email");
        $is_admin = $request->get("is_admin", default: 0);
        $is_active = $request->get("is_active", default: 0);
        $user= User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->is_admin = $is_admin;
        $user->is_active = $is_active;

        $user->save();

         return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy";
    }
}
