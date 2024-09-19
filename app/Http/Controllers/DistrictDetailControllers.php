<?php

namespace App\Http\Controllers;

use App\Models\District_detail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DistrictDetailControllers extends Controller
{
    //delete district Details
    public function deleteDistrictDetail(int $id)
    {
        $district = District_detail::find($id);
        if ($district == null) {
            return response()->json(['message' => ' district Details is Empty'], 500);
        } else {
            $district->delete();
            return response()->json(['message' => ' District deleted successfully'], 200);
        }
    }


    //update district Details
    public function updateDistrictDetail(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'district_id' => 'required|string|max:191',
            'teacher_id' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $district = District_detail::find($id);
            $district->district_id = $request->district_id;
            $district->teacher_id = $request->teacher_id;
            $result = $district->save();
        }
        return response()->json($result, 201);
    }

    //get all district details
    public function getAllDistrictDetail()
    {
        $districts = DB::table('district_details')
            ->get();
        return response()->json($districts, 200);
    }

    //save district Details
    public function saveDistrictDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'district_id' => 'required|string|max:191',
            'teacher_id' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $district = new District_detail();
            $district->district_id = $request->district_id;
            $district->teacher_id = $request->teacher_id;
            $result = $district->save();
        }
        return response()->json($result, 201);
    }

    //get district Details by id
    public function searchDistrictDetail($input)
    {
        $districts = District_detail::with('teachers')
            ->where('district_detail_id', 'LIKE', '%' . $input . '%')
            ->get();
        return response()->json($districts, 201);
    }
}
