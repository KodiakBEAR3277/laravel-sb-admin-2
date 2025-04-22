<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students\Students;

class StudentController extends Controller
{
    public function index()
    {
        $students = Students::withTrashed()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'StudentNumber' => 'required|unique:students',
            'FirstName' => 'required|string|max:30',
            'LastName' => 'required|string|max:30',
            'MiddleName' => 'nullable|string|max:30',
            'DateOfBirth' => 'required|date',
            'Course' => 'required|string|max:100',
            'YearLevel' => 'required|numeric|between:1,5',
            'Section' => 'required|string|max:20',
            'AcademicStatus' => 'required|in:Regular,Irregular,LOA,Graduated',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'nullable|string',
            'ContactNumber' => 'nullable|string|max:20',
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyContactNumber' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:255'
        ]);

        $student = new Students();
        $student->StudentNumber = $request->StudentNumber;
        $student->FirstName = $request->FirstName;
        $student->LastName = $request->LastName;
        $student->MiddleName = $request->MiddleName;
        $student->DateOfBirth = $request->DateOfBirth;
        $student->Course = $request->Course;
        $student->YearLevel = $request->YearLevel;
        $student->Section = $request->Section;
        $student->AcademicStatus = $request->AcademicStatus;
        $student->Gender = $request->Gender;
        $student->Address = $request->Address;
        $student->ContactNumber = $request->ContactNumber;
        $student->EmergencyContact = $request->EmergencyContact;
        $student->EmergencyContactNumber = $request->EmergencyContactNumber;
        $student->Email = $request->Email;
        $student->created_by = auth()->id(); // Track who created the record
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function edit(Request $request)
    {
        $StudentID = decrypt($request->StudentID);
        $student = Students::findOrFail($StudentID);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $student = Students::findOrFail($request->id);

        $request->validate([
            'StudentNumber' => 'required|unique:students,StudentNumber,'.$student->id,
            'FirstName' => 'required|string|max:30',
            'LastName' => 'required|string|max:30',
            'MiddleName' => 'nullable|string|max:30',
            'DateOfBirth' => 'required|date',
            'Course' => 'required|string|max:100',
            'YearLevel' => 'required|numeric|between:1,5',
            'Section' => 'required|string|max:20',
            'AcademicStatus' => 'required|in:Regular,Irregular,LOA,Graduated',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'nullable|string',
            'ContactNumber' => 'nullable|string|max:20',
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyContactNumber' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:255'
        ]);

        $student->StudentNumber = $request->StudentNumber;
        $student->FirstName = $request->FirstName;
        $student->LastName = $request->LastName;
        $student->MiddleName = $request->MiddleName;
        $student->DateOfBirth = $request->DateOfBirth;
        $student->Course = $request->Course;
        $student->YearLevel = $request->YearLevel;
        $student->Section = $request->Section;
        $student->AcademicStatus = $request->AcademicStatus;
        $student->Gender = $request->Gender;
        $student->Address = $request->Address;
        $student->ContactNumber = $request->ContactNumber;
        $student->EmergencyContact = $request->EmergencyContact;
        $student->EmergencyContactNumber = $request->EmergencyContactNumber;
        $student->Email = $request->Email;
        $student->updated_by = auth()->id(); // Track who updated the record
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Request $request)
    {
        $StudentID = decrypt($request->segment(3));
        $student = Students::findOrFail($StudentID);
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    public function restore(Request $request)
    {
        $StudentID = decrypt($request->segment(3));
        $student = Students::withTrashed()->findOrFail($StudentID);
        $student->restore();
        
        return redirect()->route('students.index')
            ->with('success', 'Student restored successfully.');
    }
}