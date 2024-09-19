<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentControllers extends Controller
{
  //delete student
  public function deleteStudent(int $id)
  {
    $student = Student::find($id);
    $student->delete();
    return response()->json(['message' => ' Teacher deleted successfully'], 200);
  }


  //update student
  public function updateStudent(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'setial_no' => 'required',
        'medium' => 'required',
        'age' => 'required',
        'stream' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => 500,
            'message' => "Invalid input!",
            'errors' => $validator->errors(),
        ], 500);
    }

    $student = Student::find($id);

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $student->image = $path;
    }

    if ($request->hasFile('student_detail')) {
        $studentDetailPath = $request->file('student_detail')->store('student_detail', 'public');
        $student->student_detail = $studentDetailPath;
    }
    $student->fill($request->all());
    if ($student->save()) {
        return response()->json([
            'status' => 200,
            'message' => "Student updated successfully",
            'request_data' => $request->all(),
        ], 200);
    }
    return response()->json([
        'status' => 500,
        'message' => "Something went wrong!",
    ], 500);
}



  //get all student  details
  public function getAllStudents()
  {
    $students = Student::with(['marks'])->get();
    return response()->json($students, 200);
  }


  //save student
  public function saveStudent(Request $request,)
  {
    $validator = Validator::make($request->all(), [
      'setial_no' => 'required',
      'medium' => 'required',
      'age' => 'required',
      'stream' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Invalied input!",
        'errors' => $validator->errors(),
      ], 500);
    } else {
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = $image->store('images', 'public');
        $request->merge(['image' => $path]);
      } else {
        $request->image = null;
      }

      if ($request->hasFile('student_detail')) {
        $student_detail = $request->file('student_detail');
        $studentDetailPath = $student_detail->store('student_detail', 'public');
        $request->merge(['student_detail' => $studentDetailPath]);
      } else {
        $request->student_detail = null;
      }

      $student = new Student();
      $student->setial_no = $request->input('setial_no');
      $student->medium = $request->input('medium');
      $student->age = $request->input('age');
      $student->stream = $request->input('stream');
      $student->image = $request->image;
      $student->student_detail = $request->student_detail;

      $isSave = $student->save();

      // Check if student save successfully or not and return appropriate response.
      if ($isSave) {
        return response()->json([
          'status' => 200,
          'message' => "Student saved successfully",
          'request_data' => $request->all(),
        ], 200);
      } else {
        return response()->json([
          'status' => 500,
          'message' => "Something went wrong!",
        ], 500);
      }
    }
  }

}
