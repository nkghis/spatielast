<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Traits\Authorizable;

class UserController extends Controller
{
    use Authorizable;
    public function index()
    {
        $result = User::latest()->paginate();
        //dd($result);
        return view('user.index', compact('result'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('user.new', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        // Crypter mot de passe
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // Creation utilisateur
        if ( $user = User::create($request->except('roles', 'permissions')) ) {
            $this->syncPermissions($request, $user);
            flash('User has been created.');
        } else {
            flash()->error('Unable to create user.');
        }

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('user.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        // recuperation d'un utilisateur
        $user = User::findOrFail($id);

        // mise à jour d'un utilisateur
        $user->fill($request->except('roles', 'permissions', 'password'));

        // verification avant changement mot de passe.
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        // Manipuler les rôles de utilisateur.
        $this->syncPermissions($request, $user);

        $user->save();
        flash()->success('Utilisateur a été mis à jour avec succès.');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        if ( Auth::user()->id == $id ) {
            flash()->warning('La suppression de l\'utilisateur actuellement connecté n\'est pas autorisée :(')->important();
            return redirect()->back();
        }

        if( User::findOrFail($id)->delete() ) {
            flash()->success('L\'utilisateur a été supprimé');
        } else {
            flash()->success('Utilisateur non supprimé');
        }

        return redirect()->back();
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
