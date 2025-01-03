<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;

class UserSettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.user.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Bilgileriniz başarıyla güncellendi.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifreniz yanlış.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Şifreniz başarıyla güncellendi.');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $user->addresses()->create([
            'title' => $request->title,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Adres başarıyla eklendi.');
    }

    public function updateAddress(Request $request, Address $address)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $address->update($request->all());

        return back()->with('success', 'Adres başarıyla güncellendi.');
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return back()->with('success', 'Adres başarıyla silindi.');
    }
}
