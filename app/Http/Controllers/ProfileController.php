<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.profile.profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.profile.profile-edit',compact('user'));
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
        $user = User::find($id);
        if (!empty($request->password1) and !empty($request->password2)) {
            $request->validate([
                'password1' => 'min:8',
                'password2' => 'min:8'
            ]);
            if ($request->password1 == $request->password2) {
                $user->update(['password'=> Hash::make($request->password1)]);
            }else{
                return redirect()->back()->with('error','Password Tidak Sama!');
            }
        }elseif (!empty($request->password1) or !empty($request->password2)) {
            return redirect()->back()->with('error','Kedua Password Harus di Isi Atau Kosong Keduanya!');
           
        }

        if (!empty($request->foto)) {
            $request->validate([
                'foto'=>'image|mimes:jpeg,png,jpg,|max:2048'
            ]);
            $foto = time().'.'.$request->foto->extension();
            if ($user->foto != 'default.png') {
                if(file_exists(public_path('img/profile/'.$user->foto))){
                    unlink(public_path('img/profile/'.$user->foto));
                }
            }
            $request->foto->move(public_path('img/profile'), $foto);
            $user->update(['foto'=>$foto]);
        }
        return redirect()->route('profile.show',$user->id)->with('success','Profile Berhasil Di Update')->with(compact('user'));
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
