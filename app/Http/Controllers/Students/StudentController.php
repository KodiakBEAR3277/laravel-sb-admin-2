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
            'StudentNumber' => [
                'required',
                'unique:students',
                'regex:/^\d{4}-\d{5}$/',  // Format: YYYY-XXXXX
                function ($attribute, $value, $fail) {
                    $year = substr($value, 0, 4);
                    if ($year < 1900 || $year > date('Y')) {
                        $fail('The year in student number must be valid.');
                    }
                },
            ],
            'FirstName' => 'required|string|max:30',
            'LastName' => 'required|string|max:30',
            'MiddleName' => 'nullable|string|max:30',
            'Password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/' // Optional: requires at least one letter and one number
            ],
            'DateOfBirth' => 'required|date',
            'Course' => 'required|string|max:100',
            'YearLevel' => 'required|numeric|between:1,5',
            'Section' => 'required|string|max:20',
            'AcademicStatus' => 'required|in:Regular,Irregular,LOA,Graduated',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'nullable|string',
            'TelephoneNumber' => [
                'nullable',
                'string',
                'regex:/^(\+63|0)[2-8]\d{7}$/' // Philippines landline format
            ],
            'ContactNumber' => [
                'nullable',
                'string',
                'regex:/^(09|\+639)\d{9}$/' // Philippines mobile number format
            ],
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyContactNumber' => [
                'nullable',
                'string',
                'regex:/^(09|\+639)\d{9}$/' // Philippines mobile number format
            ],
            'Email' => 'nullable|email|max:255'
        ]);

        $student = new Students();
        $student->StudentNumber = $request->StudentNumber;
        $student->FirstName = $request->FirstName;
        $student->LastName = $request->LastName;
        $student->MiddleName = $request->MiddleName;
        $student->Password = bcrypt($request->Password); // Hash the password
        $student->DateOfBirth = $request->DateOfBirth;
        $student->Course = $request->Course;
        $student->YearLevel = $request->YearLevel;
        $student->Section = $request->Section;
        $student->AcademicStatus = $request->AcademicStatus;
        $student->Gender = $request->Gender;
        $student->Address = $request->Address;
        $student->TelephoneNumber = $request->TelephoneNumber;
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
            'StudentNumber' => [
                'required',
                'regex:/^\d{4}-\d{5}$/',  // Format: YYYY-XXXXX
                'unique:students,StudentNumber,'.$student->id,
                function ($attribute, $value, $fail) {
                    $year = substr($value, 0, 4);
                    if ($year < 1900 || $year > date('Y')) {
                        $fail('The year in student number must be valid.');
                    }
                },
            ],
            'FirstName' => 'required|string|max:30',
            'LastName' => 'required|string|max:30',
            'MiddleName' => 'nullable|string|max:30',
            'Password' => [
                'nullable', // Make password optional during update
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'
            ],
            'DateOfBirth' => 'required|date',
            'Course' => 'required|string|max:100',
            'YearLevel' => 'required|numeric|between:1,5',
            'Section' => 'required|string|max:20',
            'AcademicStatus' => 'required|in:Regular,Irregular,LOA,Graduated',
            'Gender' => 'required|in:Male,Female,Other',
            'Address' => 'nullable|string',
            'TelephoneNumber' => [
                'nullable',
                'string',
                'regex:/^(\+63|0)[2-8]\d{7}$/'
            ],
            'ContactNumber' => [
                'nullable',
                'string',
                'regex:/^(09|\+639)\d{9}$/'
            ],
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyContactNumber' => [
                'nullable',
                'string',
                'regex:/^(09|\+639)\d{9}$/'
            ],
            'Email' => 'nullable|email|max:255'
        ]);

        $student->StudentNumber = $request->StudentNumber;
        $student->FirstName = $request->FirstName;
        $student->LastName = $request->LastName;
        $student->MiddleName = $request->MiddleName;
        if ($request->filled('Password')) {
            $student->Password = bcrypt($request->Password);
        }
        $student->DateOfBirth = $request->DateOfBirth;
        $student->Course = $request->Course;
        $student->YearLevel = $request->YearLevel;
        $student->Section = $request->Section;
        $student->AcademicStatus = $request->AcademicStatus;
        $student->Gender = $request->Gender;
        $student->Address = $request->Address;
        $student->TelephoneNumber = $request->TelephoneNumber;
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
        try {
            $StudentID = decrypt($request->StudentID);
            $student = Students::findOrFail($StudentID);
            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('students.index')
                ->with('error', 'Invalid student ID.');
        }
    }

    public function restore(Request $request)
    {
        try {
            $StudentID = decrypt($request->StudentID);
            $student = Students::withTrashed()->findOrFail($StudentID);
            $student->restore();
            
            return redirect()->route('students.index')
                ->with('success', 'Student restored successfully.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('students.index')
                ->with('error', 'Invalid student ID.');
        }
    }
}