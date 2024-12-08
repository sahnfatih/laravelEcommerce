<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("backend.users.index", ["users" => $users]);
    }

    public function create()
    {
        return view("backend.users.insert_form");
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        User::create($data);
        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("backend.users.update_form", ["user" => $user]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->except('_token', '_method', 'password', 'password_confirmation');
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(["message" => "Done", "id" => $id]);
    }
    public function passwordForm($id)
    {
        $user = User::findOrFail($id);
        return view("backend.users.password_form", ["user" => $user]);
    }

    public function changePassword(Request $request, $id) // Request sınıfını doğru şekilde kullanın
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('users.index')
                ->with('success', 'Şifre başarıyla güncellendi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Şifre güncellenirken bir hata oluştu.')
                ->withInput();
        }
    }
}
