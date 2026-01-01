<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class UserController extends Controller
{
    public function index()
    {
        $user = $user = Auth::guard('admin')->check()
            ? Auth::guard('admin')->user()
            : Auth::guard('web')->user();
        return view('dashboard.profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $user = Auth::guard('admin')->check()
            ? Auth::guard('admin')->user()
            : Auth::guard('web')->user();

        $userId = $user->id;

        $request->validate(
            [
                'firstName' => 'required|string|max:50',
                'lastName'  => 'required|string|max:50',
                'phone'     => ['nullable', 'regex:/^[0-9+\-\(\) ]+$/', 'max:20'],
                'email' => 'required|email|unique:users,email,' . $user->id,
            ],
        );
        $table = Auth::guard('admin')->check() ? 'admins' : 'users';

        DB::table($table)
            ->where('id', $userId)
            ->update([
                'firstName' => $request->firstName,
                'lastName'  => $request->lastName,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'updated_at' => now(),
            ]);
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function uploadProfile(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            ],
            [
                'image.required' => 'Please select an image to upload.',
                'image.image' => 'The selected file must be an image.',
                'image.mimes' => 'Only JPG, JPEG, PNG, or WEBP files are allowed.',
                'image.max' => 'The image size must not exceed 4 MB.',
            ]
        );
        /** @var \App\Models\User|\App\Models\Admin $user */
        $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('web')->user();

        if (!$user) {
            return back()->with('error', 'User not authenticated');
        }

        if (!$request->hasFile('image')) {
            return back()->with('error', 'No image file uploaded');
        }

        // ! Delete Old Image if exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Todo: Unique Filename
        $filename = Str::uuid() . "." . $request->image->extension();
        $directory = 'uploads/profiles';
        $path = $directory . '/' . $filename;

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory, 0755, true);
        }

        Image::read($request->file('image'))
            ->cover(300, 300)
            ->save(Storage::disk('public')->path($path));

        $user->profile_image = $path;
        $user->save();

        return back()->with('success', 'Profile image updated successfully!');
    }

    // !Change Password
    public function changePassword(Request $request)
    {

        /** @var \App\Models\User|\App\Models\Admin $user */
        $user = Auth::guard('web')->user() ?? Auth::guard('admin')->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])
                ->with('error', 'Current password you entered is wrong!');
        }
        if (Hash::check($request->new_password, $user->password)) {
            return back()
                ->with('error', 'New password cannot be the same as your current password');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
