<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $users = User::latest()->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Delete users
     */
    public function destroy(User $user) : RedirectResponse
    {
        //remove the profile image if it exists
        $this->removeUserImageFromStorage($user->profile_image);
        $user->delete();
        return to_route('admin.users.index')->with('success','User deleted successfully');
    }

    /**
     * Remove the user image from storage
     */
    public function removeUserImageFromStorage($file) : void
    {
        $path = str_replace('/storage/','',$file);
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }   
    }
}
