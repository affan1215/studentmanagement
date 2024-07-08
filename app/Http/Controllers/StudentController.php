<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $students = Student::all();
        return view('student.student', compact('students'));
    }
    public function savedata(Request $request)
    {
        $student = new Student;
        parse_str($request->input('data'), $formData);

        $student->name = $formData['name'];
        $student->roll_no = $formData['roll_no'];
        $student->stdclass = $formData['stdclass'];
        $student->phone_no = $formData['phone_no'];

        if(empty($formData['id']) || ($formData['id'] == "")){
            $student->save();
        }
        else{
            $student = Student::find($formData['id']);
            $student->name = $formData['name'];
            $student->roll_no = $formData['roll_no'];
            $student->stdclass = $formData['stdclass'];
            $student->phone_no = $formData['phone_no'];
            $student->update();
        }
        echo "Student Data Saved Sucesfully";
    }
    public function getdata()
    {
        return Student::orderBy('id', 'asc')->get();
    }
    public function editdata(Request $request){
        return Student::find($request->id);
    }
    public function deletedata(Request $request){
        Student::where('id', $request->id)->delete();
        echo "Data Deleted Successfully";
    }
}
