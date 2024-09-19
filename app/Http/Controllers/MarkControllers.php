<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkControllers extends Controller
{
    public function deleteMark(int $id)
  {
    $mark = Marks::find($id);
    $mark->delete();
    return response()->json(['message' => ' Mark deleted successfully'], 200);
  }


  //update student
  public function updateMark(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'mark' => 'required|array|max:190',
      'total' => 'required|string|max:190',
      'average'=> 'required|string|max:190',
      'teacher_id'=> 'required|string|max:190',
      'student_id'=> 'required|string|max:190',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!",
        'errors' => $validator->errors(),
      ], 500);
    } else {
      $mark = Marks::find($id);
      $mark->mark = $request->mark;
      $mark->total= $request->total;
      $mark->averages = $request->average;
      $mark->teacher_id= $request->teacher_id;
      $mark->student_id= $request->student_id;
      $result = $mark->save();
    }
    return response()->json($result, 201);
  }


  //get all student  details
  public function getAllMarks()
  {
    $marks = Marks::with(['students'])->get();
    return response()->json($marks, 200);
  }


  //save student
  public function saveMark(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'mark' => 'required|string|max:190',
        'teacher_id'=> 'required|int|max:190',
        'student_id'=> 'required|int|max:190',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!",
        'errors' => $validator->errors(),
      ], 500);
    } else {
      $mark = new Marks();
      $mark->mark = $request->mark;
      $mark->total= $request->total;
      $mark->averages = $request->average;
      $mark->teacher_id= $request->teacher_id;
      $mark->student_id= $request->student_id;
      $mark->save();
    }
    return response()->json([
      'status' => 200,
      'message' => "Teacher saved successfully",
      'request_data' => $request->all(),
    ], 200);
  }
}
