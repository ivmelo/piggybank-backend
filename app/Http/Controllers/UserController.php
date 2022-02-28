<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneratesPasswords;
use Illuminate\Support\Facades\Gate;
use Auth;

class UserController extends Controller
{
    use GeneratesPasswords;

    private $userRoles = [
        'user' => 'User',
        'admin' => 'Admin'
    ];

    private $validationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string',
        'role' => 'required|in:user,admin'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('update-user', new User())) {
            abort(403);
        }

        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('update-user', new User())) {
            abort(403);
        }

        return view('users.create', [
            'temporary_password' => self::generatePassword(),
            'roles' => $this->userRoles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('update-user', new User())) {
            abort(403);
        }

        $validated = $request->validate($this->validationRules);

        $user = new User($validated);
        $user->password = bcrypt($validated['password']);
        
        if ($validated['role'] === 'admin') {
            $user->is_admin = true;
        } else {
            $user->is_admin = false;
        }

        $user->save();

        session()->flash('success', 'The user has been created.');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => $this->userRoles
        ]);
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
        $user = User::findOrFail($id);

        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }

        $this->validationRules['email'] = 'required|string|email|max:255|unique:users,email,' . $user->id;
        unset($this->validationRules['password']);
        $validated = $request->validate($this->validationRules);

        $user->fill($validated);
        if ($request->get('role') === 'admin') {
            $user->is_admin = true;
        } else {
            $user->is_admin = false;
        }
        $user->save();

        session()->flash('success', 'The user has been updated.');
        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (! Gate::allows('update-user', $user)) {
            abort(403);
        }

        $validated = $request->validate([
            'password' => 'required|string|confirmed|min:12'
        ]);

        $user->password = bcrypt($validated['password']);

        $user->save();

        session()->flash('success', 'The password has been updated.');
        return redirect()->route('users.edit', $user->id);
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
