<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;

class AddressController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $addrs = $user->addrs;
        return view("backend.addresses.index", ["user" => $user, "addrs" => $addrs]);
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view("backend.addresses.insert_form", ["user" => $user]);
    }

    public function store(AddressRequest $request, $userId)
    {
        $data = $request->validated();
        $data['user_id'] = $userId;
        $data['is_default'] = $request->has('is_default') ? 1 : 0;

        if ($data['is_default']) {
            Address::where('user_id', $userId)->update(['is_default' => 0]);
        }

        Address::create($data);
        return redirect()->route('users.addresses.index', $userId)
            ->with('success', 'Adres başarıyla eklendi.');
    }

    public function edit($userId, $addressId)
    {
        $user = User::findOrFail($userId);
        $addr = Address::findOrFail($addressId);
        return view("backend.addresses.update_form", ["user" => $user, "addr" => $addr]);
    }

    public function update(AddressRequest $request, $userId, $addressId)
    {
        try {
            $user = User::findOrFail($userId);
            $addr = Address::where('user_id', $userId)
                          ->where('address_id', $addressId)
                          ->firstOrFail();

            $data = $request->only(['city', 'district', 'zipcode', 'address']);
            $data['is_default'] = $request->has('is_default') ? 1 : 0;

            if ($data['is_default']) {
                Address::where('user_id', $userId)
                      ->where('address_id', '!=', $addressId)
                      ->update(['is_default' => 0]);
            }

            $addr->update($data);

            return redirect()
                ->route('users.addresses.index', $userId)
                ->with('success', 'Adres başarıyla güncellendi.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Adres güncellenirken bir hata oluştu: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($userId, $addressId)
    {
        $addr = Address::findOrFail($addressId);
        $addr->delete();
        return response()->json(["message" => "Done", "id" => $addressId]);
    }
}
