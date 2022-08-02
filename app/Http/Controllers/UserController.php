<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        if (!$request->ajax()) {
            return view('users.create',compact('roles'));
        } else {
            return view('users.modal.create');
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating records from the frontend
        $validator = Validator::make($request->all(), [
            'name'            => 'required|max:255',
            'surname'         => 'required|max:255',
            'username'        => 'required|unique:users|max:255',
            'email'           => 'required|email|unique:users|max:255',
            'cell'       => 'required',
            'password'        => ['required', 'confirmed', Password::min(8)
                                    ->mixedCase()
                                    ->letters()
                                    ->numbers()
                                    ->symbols()
                                ],
            'role'            => 'required|numeric',
            'address'         => 'nullable',
            'job_title'       => 'nullable',
        ]);
        //Return error message if validation fails
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('users.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        //Adding user to the database
        $user                    = new User();
        $user->name              = $request->input('name');
        $user->surname           = $request->input('surname');
        $user->username          = $request->input('username');
        $user->email             = $request->input('email');
        $user->cell              = $request->input('cell');
        $user->address           = $request->input('address');
        $user->job_title         = $request->input('job_title');
        $user->password          = Hash::make($request->password);
        $user->role_id           = $request->input('role');
        $user->save();

        //Return results if success
        if (!$request->ajax()) {
            return redirect()->route('users.show', $user->id)->with('success', 'New Client added successfully');
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => 'Saved successfully', 'data' => $user, 'table' => '#users_table']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $user = User::find($id);
        if (!$request->ajax()) {
            return view('users.show', compact('user', 'id'));
        } else {
            return view('users.modal.view', compact('user', 'id'));
        }

    }
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $user = User::find($id);
        $roles = Role::all();
        if (!$request->ajax()) {
            return view('users.edit', compact('user', 'id','roles'));
        } else {
            return view('users.modal.edit', compact('user', 'id','roles'));
        }

    }

    /**
     * Update the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
            'role'            => 'required|numeric',
            'address'         => 'nullable',
            'job_title'       => 'nullable',
        ]);

        //Return error message if validation fails
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('users.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        //Adding user to the database
        $user                    = User::find($id);
        $user->name              = $request->input('name');
        $user->surname           = $request->input('surname');
        $user->email             = $request->input('email');
        $user->cell              = $request->input('cell');
        $user->address           = $request->input('address');
        $user->job_title         = $request->input('job_title');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id           = $request->input('role');
        $user->save();

        //Return results if success
        if (!$request->ajax()) {
            return redirect()->route('users.show', $user->id)->with('success', 'Updated successfully');
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => 'Updated successfully', 'data' => $user, 'table' => '#users_table']);
        }
    }

    /**
     * Remove the specified user from database
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        if($id != auth()->user()->id){
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Deleted successfully');
        }
        else{
            return redirect()->route('users.index')->withErrors(["You can't kill yourself"]);
        }


    }
}
