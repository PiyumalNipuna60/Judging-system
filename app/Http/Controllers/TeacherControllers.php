<?php

namespace App\Http\Controllers;

use App\Models\District_detail;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeacherControllers extends Controller
{
  //delete teacher
  public function deleteTeacher(int $id)
  {
    $teacher = Teacher::find($id);
    $teacher->delete();
    return response()->json(['message' => ' Teacher deleted successfully'], 200);
  }


  //update teacher
  public function updateTeacher(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'admin_id' => 'required|int|max:191',
      'user_name' => 'required|string|max:191',
      'stream' => 'required|string|max:191',
      'language' => 'required|string|max:191'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!",
        'errors' => $validator->errors(),
      ], 500);
    } else {
      $teacher = Teacher::find($id);
      $teacher->admin_id = $request->admin_id;
      $teacher->user_name = $request->user_name;
      $teacher->language = $request->language;
      $teacher->stream= $request->stream;
      $result = $teacher->save();
    }
    return response()->json($result, 201);
  }

  //get all teacher  details
  public function getAllTeacher()
  {
    $teachers = Teacher::with(['DistrictDetails','DistrictDetails.Districts'])->get();
    return response()->json($teachers, 200);
  }

  //save teacher
  public function saveTeacher(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'adminId' => 'required|int|max:191',
      'availableDistricts' => 'required|array|max:191',
      'userName' => 'required|string|max:191',
      'contact' => 'required|int',
      'password' => 'required|string|max:191',
      'stream' => 'required|string|max:191',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'message' => "Validations faild",
        'errors' => $validator->errors(),
      ], 500);
    } else {
        // dd($request->all());

      $teacher = new Teacher();
      $teacher->admin_id = $request->adminId;
      $teacher->user_name = $request->userName;
      $teacher->password = bcrypt($request->password);
      $teacher->stream= $request->stream;
      $teacher->language = $request->language;
      $teacher->contact = $request->contact;
      $teacher->save();

      foreach ($request->availableDistricts as $value) {
            $districtDetails = new District_detail();
            $districtDetails->teacher_id = $teacher->teacher_id;
            $districtDetails->district_id = $value;
            $teacher->DistrictDetails()->save($districtDetails);

    }
    }
    return response()->json([
      'status' => 200,
      'message' => "Teacher saved successfully",
      'request_data' => $request->all(),
    ], 200);
  }

  //get teacher by id
  public function searchTeacher($input)
  {
    $teachers = Teacher::with(['DistrictDetails','DistrictDetails.Districts'])
      ->where('teacher_id', 'LIKE', '%' . $input . '%')
      ->orWhere('user_name', 'LIKE', '%' . $input . '%')
      ->orWhere('language', 'LIKE', '%' . $input . '%')
      ->get();
    return response()->json($teachers, 201);
  }

}
