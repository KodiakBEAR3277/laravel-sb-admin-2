<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students\Students;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index(){
        $students = Students::withTrashed()->get();
        return view('students.index', compact('students'));
    }

    public function edit(Request $request){
        $StudentID = decrypt($request->StudentID);
        $student = Students::find($StudentID);
        if (!$student) {
            return redirect()->route('students.index')->with('status', 'Student not found.');
        }
        return view('students.edit', compact('student'));
    }

    public function destroy(Request $request){
        $StudentID = decrypt($request->segment(3));
        $data = Students::find($StudentID);
        if(!$data) {
            return redirect()->route('students.index')->with('status', 'Student not found.');
        }
        $data->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function restore(Request $request){
        $StudentID = decrypt($request->segment(3));
        $data = Students::withTrashed()->find($StudentID);
        if(!$data) {
            return redirect()->route('students.index')->with('status', 'Student not found.');
        }
        $data->restore();
        
        return redirect()->route('students.index')->with('success', 'Student restored successfully.');
    }

    public function update(Request $request){
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'MiddleName' => 'nullable',
            'DateOfBirth' => 'required|date',
        ]);

        $s = Students::find($request->id);
        if (!$s) {
            return redirect()->route('students.index')->with('status', 'Student not found.');
        }
        
        $s->FirstName = $request->FirstName;
        $s->LastName = $request->LastName;
        $s->MiddleName = $request->MiddleName;  
        $s->DateOfBirth = $request->DateOfBirth;
        $s->save();

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function create(){
        return view('students.create');
    }

    public function store(Request $request){
        // dd(232323);
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'MiddleName' => 'nullable',
            'DateOfBirth' => 'required|date',
        ]);

        // dd($request->all());
        
        $s = new Students();
        $s->FirstName = $request->FirstName;
        $s->LastName = $request->LastName;
        $s->MiddleName = $request->MiddleName;  
        $s->DateOfBirth = $request->DateOfBirth;
        $s->save();

        return redirect()->route('students.create')->with('success', 'Student created successfully.');
    }
}
