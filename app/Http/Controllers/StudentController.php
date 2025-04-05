<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.form');
    }

    public function selectSubject(Request $request)
    {
        // Handle the subject selection logic here
        // For example, you can store the selected subject in the session or database
        $request->session()->put('selected_subject', $request->input('subject'));
        return redirect()->route('student.selectWeek');
    }

    public function selectWeek(Request $request)
    {
        // Handle the week selection logic here
        // For example, you can store the selected week in the session or database
        $request->session()->put('selected_week', $request->input('week'));
        return redirect()->route('student.store');
    }

    public function store(Request $request, $week_id)
    {
        // Handle the resource storage logic here
        // For example, you can save the resource link to the database
        $resource = new Resource();
        $resource->week_id = $week_id;
        $resource->link = $request->input('link');
        $resource->save();

        return redirect()->route('student.form')->with('success', 'Resource stored successfully!');
    }
}
