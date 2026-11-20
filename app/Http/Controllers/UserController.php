<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('users.index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('users.create', ['title' => 'Create User']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100',
            'role' => 'nullable|string|max:30',
        ]);

        User::create($data);

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,'.$user->id,
            'full_name' => 'required|string|max:100',
            'role' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|max:2048',
        ]);

        unset($data['avatar']);

        if ($request->hasFile('avatar')) {
            $image = (new ImageManager(new Driver()))
                ->read($request->file('avatar')->getRealPath())
                ->scaleDown(200, 200)
                ->toJpeg(80);

            $path = 'avatars/'.Str::uuid().'.jpg';
            Storage::disk('public')->put($path, $image->toString());
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('users');
    }
}
