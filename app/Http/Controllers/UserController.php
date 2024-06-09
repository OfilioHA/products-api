<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserListResource;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasRole('administrador')) {
            return response()->json([
                'message' => '¡El usuario no es un administrador!'
            ], 422);
        }

        $users = \App\Models\User::with(['person', 'roles'])
            ->get();
        return UserListResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $body = $request->validated();

        $user = DB::transaction(function () use ($body) {
            $user = User::create([
                'name' => $body['username'],
                'email' => $body['email'],
                'password' => $body['password']
            ]);

            $person = new Person([
                'fullname' => $body['fullname'],
                'phone' => $body['phone'],
                'photo' => $body['photo'] ?? null,
                'gender' => $body['gender'],
            ]);

            $role = Role::where('name', $body['role'])->get();
            $user->person()->save($person);
            $user->roles()->sync($role);
            return $user;
        });


        return response()->json([
            'message' => '¡Usuario creado de manera exitosa!',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['person', 'roles']);
        return new UserListResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $body = $request->validated();
        $user = DB::transaction(function () use ($body, $user) {
            $user->name = $body['username'];
            $user->email = $body['email'];
            if ($body['password']) {
                $user->password = $body['password'];
            }
            $user->save();
            $person = $user->person()->first();
            $person->fullname = $body['fullname'];
            $person->phone = $body['phone'];
            $person->photo = $body['photo'] ?? null;
            $person->gender = $body['gender'];
            $person->save();
            return $user;
        });

        return response()->json([
            'message' => '¡Usuario editado de manera exitosa!',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser->hasRole('administrador')) {
            return response()->json([
                'message' => '¡El usuario no es un administrador!'
            ], 422);
        }
        $user->delete();
        return response()->json([
            'message' => '¡Usuario creado de manera exitosa!',
            'data' => $user,
        ]);
    }
}
