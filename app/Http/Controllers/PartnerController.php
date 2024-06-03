<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PartnerController extends Controller
{
    private $fillable_attributes = ["name", "logo", "website"];

    public function getPartners(): JsonResponse {
        $partners = Partner::all();
        return response()->json($partners);
    }

    public function getPartnerById(int $id): JsonResponse {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['message' =>'Partner not found'], 404);
        }

        return response()->json($partner);
    }

    public function createPartner(Request $request): JsonResponse {
        $partner = new Partner();

        foreach ($this->fillable_attributes as $attribute) {
            $partner->$attribute = $request->input($attribute);
        }
        $partner->save();

        return response()->json($partner);
    }

    public function updatePartner(Request $request, int $id) {
        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $partner->$attribute = $request->input($attribute);
            }
        }
        $partner->save();

        return response()->json($partner);
    }

    public function deletePartner($id) {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }
        $partner->delete();

        return response()->json(['message' => 'Partner deleted successfully']);
    }
}
