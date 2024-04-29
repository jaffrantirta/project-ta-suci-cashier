<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Queries\UserQuery;

class UserController extends Controller
{
    public function index(UserQuery $userQuery)
    {
        return view('user/index', [
            'users' => $userQuery->includes()->filterSortPaginateWithAppend()
        ]);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());
        return redirect('user')->with('success', 'User created successfully.');
    }

    public function show($user, UserQuery $query)
    {
        return view('user/show', [
            'user' => $query->includes()->findAndAppend($user)
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect('user')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
