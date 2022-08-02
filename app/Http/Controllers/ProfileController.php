<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit(Request $request){
        if($request->isMethod("get")){
            $user = User::where('id', auth()->user()->id)->first();
            return view('profile.edit', compact('user'));
        }else if($request->isMethod("patch")){

        //Checking for validation records from the frontend
        $validator = Validator::make($request->all(), [
            'name'            => 'required|max:255',
            'surname'         => 'required|max:255',
            'email'           => 'required|email|unique:users|max:255',
            'cell'            => 'required',
            'password'        => ['required', 'confirmed', Password::min(8)
                                    ->mixedCase()
                                    ->letters()
                                    ->numbers()
                                    ->symbols()
                                ],
            'address'         => 'nullable',
            'job_title'       => 'nullable',
        ]);

        //Return error message if validation fails
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('profile.edit')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        //Adding user to the database
        $user                    = User::find(auth()->user()->id);
        $user->name              = $request->input('name');
        $user->surname           = $request->input('surname');
        $user->email             = $request->input('email');
        $user->cell              = $request->input('cell');
        $user->address           = $request->input('address');
        $user->job_title         = $request->input('job_title');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        //Return results if success
            return redirect()->route('profile.view')->with('success', 'Updated successfully');
        }

    }

    public function view(Request $request){
        $user = User::find(auth()->user()->id);
        return view('profile.view', compact('user'));
    }
}
