<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Scribe - Student View</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #e7f0ff;
            font-family: 'Arial', sans-serif;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #ffffff;
            border-left: 8px solid #393939;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-weight: bold;
            color: #0d0d0d;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #6c757d;
            margin-bottom: 25px;
        }

        .section-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-top: 30px;
            color: #2a2a2a;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        .readonly-field {
            background-color: #f8f9fa;
            border: none;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 5px;
        }

        textarea.form-control {
            min-height: 150px;
        }

        #saveNotesBtn {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        #loadContentBtn {
            background-color: transparent;
            color: #0d6efd;
            border: 2px solid #0d6efd;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 576px) {

            #saveNotesBtn,
            #loadContentBtn {
                width: 100%;
            }

            .button-group {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
@include('layouts.navigation')
@include('sweetalert::alert')
<body>
    <div class="container">
        <h1>Class Scribe</h1>
        <p class="subtitle">Organize and document your classroom sessions with ease</p>

        <form action="{{ route('student.selectWeek') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="selectClass" class="form-label">Module</label>
                    <input type="text" readonly class="form-control" id="className"
                        value="{{ $selected_class->name ?? 'Software Engineering' }}" placeholder="Class Name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="selectWeek" class="form-label">Select Week</label>
                    <select class="form-select" id="selectWeek" name="week_id">
                        <option value="" disabled {{ !session('selected_week') ? 'selected' : '' }}>Select a week</option>
                        @foreach ($weeks as $week)
                            <option value="{{ $week->id }}" {{ session('selected_week') == $week->id ? 'selected' : '' }}>
                                {{ $week->week_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="button-group mb-4">
                <button class="btn" id="loadContentBtn">
                    <i class="bi bi-cloud-download"></i> Load Content
                </button>
            </div>
        </form>

        {{-- LESSON DETAILS --}}
        <div>
            <div class="section-title">Lesson Details</div>
            <div class="mb-3">
                <label for="topicCovered" class="form-label">Topic Covered</label>
                <input type="text" class="form-control readonly-field" value="{{ $topic_covered ?? '' }}" id="topicCovered" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Resources</label>
                <ul id="resourcesList">
                    @if (!empty($resources))
                        @foreach ($resources as $resource)
                            <li>{{ $resource->link }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        {{-- KEY TAKEAWAYS --}}
        <div>
            <div class="section-title">Key Takeaways</div>
            <div class="mb-3">
                <label class="form-label">Important Points</label>
                <div class="readonly-field">
                    <ul id="pointsList">
                        @if (!empty($important_points))
                            @foreach (explode("\n", $important_points) as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Practical Implementation</label>
                <div class="readonly-field">
                    <ul id="implementationList">
                        @if (!empty($practical_implementation))
                            @foreach (explode("\n", $practical_implementation) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Week Session Summary</label>
                <div class="readonly-field" id="summaryText">
                    {{ $week_summary ?? '' }}
                </div>
            </div>
        </div>

        {{-- LOOKING FORWARD --}}
        <div>
            <div class="section-title">Looking Forward</div>
            <div class="mb-3">
                <label class="form-label">Topic To Be Discussed</label>
                <div class="readonly-field" id="nextTopic">
                    {{ $next_topic ?? '' }}
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Next Session Preparation</label>
                <div class="readonly-field">
                    <ul id="preparationList">
                        @if (!empty($next_session_prep))
                            @foreach (explode("\n", $next_session_prep) as $prep)
                                <li>{{ $prep }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        {{-- NOTES --}}
        <form action="{{ route('student.saveNote',['week_id' => session('selected_week'),0]) }}" method="post">
            @csrf
            <div>
                <div class="section-title">My Notes</div>
                <div class="mb-3">
                    <textarea class="form-control" id="notesArea" name="note" placeholder="Type your notes here...">{{ $notes ?? '' }}</textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-primary" id="saveNotesBtn">
                        <i class="bi bi-save"></i> Save Notes
                    </button>
                </div>
            </div>
        </form>        
    </div>
</body>


</html>
