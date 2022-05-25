<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $menbers=[]; 
        if (Auth::user()->role_id==1) {
            $menbers=User::where('role_id',1)->where('state',1)->where('id','<>',Auth::user()->id)->get();
        }
        return view('profile.edit',['menbers'=>$menbers]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return back()->withStatus(__('Perfil actualizado correctamente'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        return back()->withPasswordStatus(__('Contraseña actualizada correctamente'));
    }

    public function photo(Request $request) {
        $photo = $request->file('photo');
        if(!empty($photo)) {
            $user = User::where('id', Auth::user()->id)->first();
            if(!empty($user)) {
                $nombre = $photo->getClientOriginalName();
                \Storage::disk('local')->put($nombre,  \File::get($photo));
                $user->photo = $nombre;
                if($user->update()) {
                    return back()->withStatus(__('Foto actualizada correctamente'));
                }
            }else{
                return back()->withErrorMessage(__('No encontramos al usuario.'));
            }
        }else{
            return back()->withErrorMessage(__('Debe enviar una foto para actualizar.'));
        }
    }
}
