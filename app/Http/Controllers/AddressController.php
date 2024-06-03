<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class AddressController extends Controller
{
    private $fillable_attributes = ["building", "street", "number", "postal_code", "city"];

    public function getAddresses(): JsonResponse {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    public function getAddressById(int $id): JsonResponse {
        $address = Address::find($id);
        if (!$address) {
            return response()->json(['message' =>'Address not found'], 404);
        }

        return response()->json($address);
    }

    public function createAddress(Request $request): JsonResponse {
        $address = new Address();

        foreach ($this->fillable_attributes as $attribute) {
            $address->$attribute = $request->input($attribute);
        }
        $address->save();

        return response()->json($address);
    }

    public function updateAddress(Request $request, int $id) {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $address->$attribute = $request->input($attribute);
            }
        }
        $address->save();

        return response()->json($address);
    }

    public function deleteAddress($id) {
        $address = Address::find($id);
        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully']);
    }
}
