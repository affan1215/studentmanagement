<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::all();
        return view('result.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('result.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array();
        $data['student_id'] = $request->student_id;
        $data['roll_no'] = $request->roll_no;
        $data['stdclass'] = $request->stdclass;
        $data['phone_no'] = $request->phone_no;
        $data['obt_marks'] = $request->obt_marks;
        $data['total_marks'] = $request->total_marks;
        $data['term'] = $request->term;
        $data['remarks'] = $request->remarks;


        $result = Result::create($data);

        $result->save();


        return redirect()->route('result.index')->with('message', 'Result Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = Student::all();
        $result = Result::find($id);
        return view('result.edit', compact('result', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array();
        $data['student_id'] = $request->student_id;
        $data['roll_no'] = $request->roll_no;
        $data['stdclass'] = $request->stdclass;
        $data['phone_no'] = $request->phone_no;
        $data['obt_marks'] = $request->obt_marks;
        $data['total_marks'] = $request->total_marks;
        $data['term'] = $request->term;
        $data['remarks'] = $request->remarks;

        $result = Result::where('id', $id)->update($data);
        return redirect()->route('result.index')->with('message', 'Result Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result = Result::where('id', $result->id)->delete();
        return redirect()->route('result.index')->with('warning', 'Result Deleted Successfully!');
    }
    public function getStudentDetails(string $id)
    {
        $student = Student::find($id);
        return response()->json([
            'roll_no' => $student->roll_no,
            'stdclass' => $student->stdclass,
            'phone_no' => $student->phone_no
        ]);
    }
}
