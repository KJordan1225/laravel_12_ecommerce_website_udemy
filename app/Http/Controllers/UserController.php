<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegisterForm() : View
    {
        return view('auth.register');
    }

    /**
     * Store new user
     */
    public function store(AddUserRequest $request) : RedirectResponse
    {
        User::create($request->validated());
        return to_route('login')->with('success','Account created successfully');
    }

    /**
     * Show the login form
     */
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    /**
     * Log in user
     */
    public function auth(AuthUserRequest $request) : RedirectResponse
    {
        if(auth()->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.'
            ])->onlyInput('email');
        }
    }

    /**
     * Log out the user
     */
    public function logout(Request $request) : RedirectResponse
    {
        auth()->logout();
        // $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login')->with('success','Logged out successfully');
    }

    /**
     * Show the profile page
     */
    public function showProfilePage() : View
    {
        return view('profile.index');
    }

    /**
     * Update the user profile image
     */
    public function updateUserProfileImage(Request $request) : RedirectResponse
    {
        //validate the input field
        $request->validate([
            'profile_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);
        //remove the old profile image if it exists
        $this->removeUserImageFromStorage(auth()->user()->profile_image);
        //store the user profile image
        $userImagePath = $this->saveImage($request->file('profile_image'));
        //update the user profile image
        auth()->user()->update([
            'profile_image' => $userImagePath
        ]);
        //return the success message
        return back()->with([
            'success' => 'Profile image updated successfully'
        ]);
    }

    /**
     * Save the user image
     */
    public function saveImage($file)
    {
        $image_name = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('images/users',$image_name,'public');
        //return a link to the image https://your-domain-url/storage/images/name.jpg
        return Storage::url($path);
    }

    /**
     * Remove the user image from storage
     */
    public function removeUserImageFromStorage($file)
    {
        $path = str_replace('/storage/','',$file);
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }   
    }

    /**
     * Update user data
     */
    public function updateUserData(UpdateUserRequest $request) : RedirectResponse
    {
        //update the user data
        auth()->user()->update([
            ...$request->validated(),
            'profile_completed' => 1
        ]);
        //return the success message
        return back()->with([
            'success' => 'Profile updated successfully'
        ]);
    }

    /**
     * Show the user orders page
     */
    public function showUserOrdersPage() : View
    {
        $orders = auth()->user()->orders()->paginate(5);
        return view('profile.user-orders',compact('orders'));
    }
}
