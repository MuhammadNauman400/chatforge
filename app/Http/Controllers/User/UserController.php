<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function UserProfile() {
        $id = Auth::user()->id;     //get authenticated or loginned user id
        $profileData = User::find($id);

        return view('client.client_profile', compact('profileData'));
    }

    public function UserProfileStore(Request $request) {

        $id = Auth::user()->id;    
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //deleteOldimage function
    private function deleteOldImage(string $oldPhotoPath): void {
        $fullPath = public_path('upload/admin_images/'.$oldPhotoPath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function UserChangePassword() {
        return view('client.client_change_password');
    }

    public function UserPasswordUpdate(Request $request) {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array(
            'message' => 'Your old password does not match',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);

    }

    public function BillingUpgrade() {
        $plans = Plan::all();
        return view('client.backend.plans.upgrade', compact('plans'));
    }

    public function Microsoft() {
        return view('microsoft.chatbot_test');
    }

}
