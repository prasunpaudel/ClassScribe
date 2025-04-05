<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Scribe</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 800px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-weight: bold;
            color: #212529;
        }

        .subtitle {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .form-select,
        .form-control {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        textarea.form-control {
            min-height: 120px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
            border-radius: 6px;
            padding: 10px 20px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }

        .resource-input-group {
            display: flex;
            margin-bottom: 10px;
        }

        .resource-input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .resource-input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .select-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .select-group .form-select {
            flex-grow: 1;
        }
    </style>
</head>
@include('layouts.navigation')
<body>
    <div class="container">
        <h1>Class Scribe</h1>
        <p class="subtitle">Organize and document your classroom sessions with ease</p>

        <!-- Class Selection -->
        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="selectClass" class="form-label">Select Subject Name</label>
                        <div class="select-group">
                            <input type="text" readonly class="form-control" id="className" value="{{ $selected_class->name ?? 'Software Engineering' }}" placeholder="Class Name">
                        </div>
                </div>

                <!-- Week Selection -->
                <div class="col-md-6 mb-3">
                    <label for="selectWeek" class="form-label">Select Week</label>
                    <form action="{{ route('teacher.selectWeek') }}" method="POST">
                        @csrf
                        <div class="select-group">
                            <select class="form-select" id="selectWeek" name="week_id">
                                <option value="0" selected>Select a week</option>
                                @foreach ($weeks as $week)
                                    <option value="{{ $week->id }}" @if (session('selected_week') && session('selected_week') == $week->week_id) selected @endif>Week {{ $week->week_id }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary" type="submit" id="selectWeekBtn">Select</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <!-- Lesson Details Form -->
        <form action="{{ route('teacher.store', ['week_id' => session('selected_week'),0]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @dd(session('selectedWeek')) --}}
            <div class="card p-4">
                <h2 class="section-title">Lesson Details</h2>
        
                <div class="mb-3">
                    <label for="topicCovered" class="form-label">Topic Covered</label>
                    <input type="text" class="form-control" id="topicCovered" name="topic_covered" value="{{ old('topic_covered', $selected_week->topic_covered ?? '') }}" placeholder="What was the main topic of this session?">
                </div>
        
                <div class="mb-3">
                    <label for="resources" class="form-label">Resources</label>
                    <div class="resource-input-group">
                        <!-- This will allow users to add a new resource link -->
                        <input type="text" class="form-control" id="resources" name="resources[]" value="{{ old('resources.0') }}" placeholder="Link to slide, reading, or other material...">
                        <button class="btn btn-outline-secondary" type="button" id="addResource">+</button>
                    </div>
                    <div id="resourcesList">
                        <!-- Loop through the existing resources and display them -->
                        @foreach($resources as $index => $resource)
                            <div class="resource-input-group">
                                <input type="text" class="form-control" value="{{ $resource->link }}" name="resources[]" placeholder="Link to slide, reading, or other material...">
                                <button class="btn btn-outline-secondary remove-resource" type="button">-</button>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        
            <!-- Key Takeaways -->
            <div class="card p-4">
                <h2 class="section-title">Key Takeaways</h2>
                <div class="mb-3">
                    <label for="importantPoints" class="form-label">Important Points</label>
                    <textarea class="form-control" id="importantPoints" name="important_points" placeholder="List the key points students should remember...">{{ old('important_points', $selected_week->important_points ?? '') }}</textarea>
                </div>
        
                <div class="mb-3">
                    <label for="practicalImplementation" class="form-label">Practical Implementation</label>
                    <textarea class="form-control" id="practicalImplementation" name="practical_implementation" placeholder="How can students apply these concepts in practice?">{{ old('practical_implementation', $selected_week->practical_implementation ?? '') }}</textarea>
                </div>
        
                <div class="mb-3">
                    <label for="weekSummary" class="form-label">Week Session Summary</label>
                    <textarea class="form-control" id="weekSummary" name="week_summary" placeholder="Provide an overall summary of this week's session...">{{ old('week_summary', $selected_week->week_summary ?? '') }}</textarea>
                </div>
            </div>
        
            <!-- Looking Forward -->
            <div class="card p-4">
                <h2 class="section-title">Looking Forward</h2>
                <div class="mb-3">
                    <label for="nextTopic" class="form-label">Topic To Be Discussed</label>
                    <textarea class="form-control" id="nextTopic" name="next_topic" placeholder="What topic will be covered in the next session?">{{ old('next_topic', $selected_week->next_topic ?? '') }}</textarea>
                </div>
        
                <div class="mb-3">
                    <label for="nextSessionPrep" class="form-label">Next Session Preparation</label>
                    <textarea class="form-control" id="nextSessionPrep" name="next_session_prep" placeholder="What should students prepare for the next session?">{{ old('next_session_prep', $selected_week->next_session_prep ?? '') }}</textarea>
                </div>
            </div>
        
            <!-- Submit Button -->
            <div class="button-container">
                <button class="btn btn-primary" type="submit" id="submitSummary">Save</button>
            </div>
        </form>
        
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Add Resource Input Field
        document.getElementById('addResource').addEventListener('click', function () {
            const resourceInputGroup = document.createElement('div');
            resourceInputGroup.classList.add('resource-input-group');
            resourceInputGroup.innerHTML = `
                <input type="text" class="form-control" name="resources[]" placeholder="Link to slide, reading, or other material...">
                <button class="btn btn-outline-secondary remove-resource" type="button">-</button>
            `;
            document.getElementById('resourcesList').appendChild(resourceInputGroup);
        });

        // Remove Resource Input Field
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-resource')) {
                event.target.closest('.resource-input-group').remove();
            }
        });
    </script>
</body>

</html>
