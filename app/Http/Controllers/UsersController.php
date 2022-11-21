<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id','desc')->get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Roles::Orderby('libelle', 'asc')->get();
        //dd($roles);
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new User();
        $user->setAttribute('name', $request->name);
        $user->setAttribute('roles_id', $request->roles_id);
        $user->setAttribute('email', $request->email);
        $user->setAttribute('password', Hash::make( $request->password));
        $user->setAttribute('created_at', new \DateTime());
        $user->save();
        return redirect()->route('user.index')->with('success', 'Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $roles = Roles::Orderby('libelle', 'asc')->get();
        $user = User::find($id);
        return view('user.edit',compact('user','roles'));
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
        //
        if(!empty($request->password)){
        $user = User::find($id);
        $user->setAttribute('name', $request->name);
        $user->setAttribute('roles_id', $request->roles_id);
        $user->setAttribute('email', $request->email);
        $user->setAttribute('password', Hash::make( $request->password));
        $user->setAttribute('updated_at', new \DateTime());
        $user->update();
        return redirect()->route('user.index')->with('success', 'Modification effectuée avec succès');
        }else{
                $user = User::find($id);
                $user->setAttribute('name', $request->name);
                $user->setAttribute('roles_id', $request->roles_id);
                $user->setAttribute('email', $request->email);
                $user->setAttribute('updated_at', new \DateTime());
                $user->update();
                return redirect()->route('user.index')->with('success', 'Modification effectuée avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
