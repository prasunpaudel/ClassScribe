<?php
namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\Week;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    // Show the form for selecting class and week
    public function index(Request $request)
    {
        $selectedWeek = $request->session()->get('selected_week', null); // Default to null if not set
        $data = [
            'classes' => ClassName::all(),
            'selected_class' => $request->session()->get('selected_class'),
            'weeks' => Week::all(),
            'resources' => Resource::where('week_id', $selectedWeek)->get(), // Filter resources by selected week
            'selected_week' => Week::find($selectedWeek), // Find the selected week by ID
        ];
        return view('index', $data);
    }

    // Handle class selection
    public function selectSubject(Request $request)
    {
        // Store the selected class ID in the session
        session(['selected_class' => $request->subject_id]);

        // Redirect back to the form with updated weeks
        return redirect()->route('teacher.form');
    }

    // Handle week selection
    public function selectWeek(Request $request)
    {
        // Store the selected week ID in the session
        if($request->week_id == 0){
            session(['selected_week' => null]);
        }else{
            session(['selected_week' => $request->week_id]);
        }

        // Redirect back to the form
        return redirect()->route('teacher.form');
    }

    // Store lesson details
    public function store(Request $request, $week_id)
    {
        // Validate the data
        // return $request;
        if($request->week_id == 0){
            Alert::error('Error', 'Please select a week.');
            return redirect()->route('teacher.form')->with('error', 'Please select a week.');
        }
        $validated = $request->validate([
            'topic_covered' => 'required|string|max:255',
            'important_points' => 'nullable|string',
            'practical_implementation' => 'nullable|string',
            'week_summary' => 'nullable|string',
            'next_topic' => 'nullable|string',
            'next_session_prep' => 'nullable|string',
            'resources' => 'nullable|array',
        ]);

        // Find the selected week
        $week = Week::findOrFail($week_id);

        // Update the week details
        $week->update([
            'topic_covered' => $validated['topic_covered'],
            'important_points' => $validated['important_points'],
            'practical_implementation' => $validated['practical_implementation'],
            'week_summary' => $validated['week_summary'],
            'next_topic' => $validated['next_topic'],
            'next_session_prep' => $validated['next_session_prep'],
        ]);

        // Handle resources
        if ($request->has('resources') && is_array($validated['resources'])) {
            // Step 1: Delete resources that are no longer in the list
            $existingResources = Resource::where('week_id', $week->id)->pluck('link')->toArray();
            $newResources = $validated['resources'];
    
            // Find resources that are no longer part of the new list and delete them
            $resourcesToDelete = array_diff($existingResources, $newResources);
            if (!empty($resourcesToDelete)) {
                Resource::whereIn('link', $resourcesToDelete)
                    ->where('week_id', $week->id)
                    ->delete();
            }
    
            // Step 2: Add new resources
            foreach ($newResources as $resourceLink) {
                if ($resourceLink) {
                    // Check if the resource already exists for the given week
                    $existingResource = Resource::where('week_id', $week->id)
                                                ->where('link', $resourceLink)
                                                ->first();
                    if (!$existingResource) {
                        // If it doesn't exist, create a new resource record
                        Resource::create([
                            'week_id' => $week->id,
                            'link' => $resourceLink,
                        ]);
                    }
                }
            }
        }
        Alert::success('Success', 'Week details saved successfully.');
        return redirect()->route('teacher.form');
    }
}
