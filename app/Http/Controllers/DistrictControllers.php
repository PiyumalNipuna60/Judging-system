<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\District_detail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DistrictControllers extends Controller
{
    //delete district
    public function deleteDistrict(int $id)
    {
        $district = District::find($id);
        if ($district == null) {
            return response()->json(['message' => ' District is Empty'], 500);
        } else {
            $district->delete();
            return response()->json(['message' => ' District deleted successfully'], 200);
        }
    }


    //update district
    public function updateDistrict(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $district = District::find($id);
            $district->name = $request->name;
            $result = $district->save();
        }
        return response()->json($result, 201);
    }

    //get all district  details
    public function getAllDistrict()
    {
        $districts = DB::table('districts')
            ->get();
        return response()->json($districts, 200);
    }

    //save district
    public function saveDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $district = new District();
            $district->name = $request->name;
            $result = $district->save();
        }
        return response()->json($result, 201);
    }

    //get district by id
    public function searchDistrict($input)
    {
        $districts = District_detail::with('teachers')
            ->where('district_id', 'LIKE', '%' . $input . '%')
            ->get();
        return response()->json($districts, 201);

    }
}
