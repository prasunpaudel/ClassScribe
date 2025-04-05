<?php

namespace App\Http\Controllers;

use App\Models\week;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\StudentNote;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function index()
    {
        if (session('selected_week')) {
            $week_id = session('selected_week');
            $selectedWeek = Week::where('id', $week_id)->first();
            $resources = Resource::where('week_id', $week_id)->get();
            $data=[
                'topic_covered' => $selectedWeek->topic_covered,
                'important_points' => $selectedWeek->important_points,
                'practical_implementation' => $selectedWeek->practical_implementation,
                'week_summary' => $selectedWeek->week_summary,
                'next_topic' => $selectedWeek->next_topic,
                'next_session_prep' => $selectedWeek->next_session_prep,
                'resources' => $resources,
                'notes' => StudentNote::where('week_id', $week_id)->first()->note,
                'weeks' => Week::all(),
            ];
        } else {
            // If no week is selected, show the form to select a week
            
            $data = [
                'weeks' => Week::all(),
            ];
        }   
        return view('studentIndex', $data);
    }
    public function selectWeek(Request $request)
    {
        // Store the selected week ID in the session
        if($request->week_id == 0){
            session(['selected_week' => null]);
        }else{
            session(['selected_week' => $request->week_id]);
        }
        // Redirect back to the form
        return redirect()->route('student.display');
    }
    public function saveNote(Request $request, $week_id)
    {
        // Validate the request data
        $request->validate([
            'note' => 'required',
        ]);

        if ($request->week_id == 0) {
            Alert::error('Please select a week before adding a note.');
           return redirect()->back();
        } elseif($week_id == StudentNote::where('week_id', $week_id)->first()->week_id){
            $studentNote = StudentNote::where('week_id', $week_id)->first();
            $studentNote->note = $request->note;
            $studentNote->save();
        } else {
            // Store the selected week ID in the session
                $studentNote = new StudentNote();
                $studentNote->week_id = $week_id;
                $studentNote->note = $request->note;
                $studentNote->save();
        }
        Alert::success('Note saved successfully.');
        // Redirect back to the form with a success message
        return redirect()->route('student.display');
    }
}
