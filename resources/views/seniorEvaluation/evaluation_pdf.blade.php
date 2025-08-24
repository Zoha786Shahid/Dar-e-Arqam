<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Class Observation Checklist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 4px 8px;
            border: 1px solid #000;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
            width: 32%;
            font-size: 14px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="header">

        {{-- <img src="{{ asset('images/school.jpeg') }}" alt="School Image"> --}}

        <img src="{{ public_path('images/school.jpeg') }}" alt="School Image">




        <h2>Dare Arqam Schools</h2>

    </div>
    <h3>CLASS OBSERVATION CHECKLIST (GRADE 8-10)</h3>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Teacher's Name:</strong>
            {{ $evaluation->teacher->first_name ?? 'N/A' }}
            {{ $evaluation->teacher->last_name ?? '' }} </p>
        <p style=" display: inline-block;"><strong>Qualification:</strong>
            {{ $evaluation->teacher->qualification ?? 'N/A' }}</p>
        <p style="display: inline-block;"><strong>Joining
                Date:</strong>{{ \Carbon\Carbon::parse($evaluation->teacher->joining_date)->format('d-m-Y') ?? 'N/A' }}
        </p>
    </div>


    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        {{-- <p style=" display: inline-block;"><strong>Class/Sec:</strong> 5th C</p> --}}
        <p style=" display: inline-block;"><strong>Class/Sec:</strong> {{ $evaluation->schoolClass->name ?? 'N/A' }}</p>
        {{-- <p style=" display: inline-block;"><strong>Subject:</strong> Math</p> --}}
        {{-- <p style="display: inline-block;"><strong>Topic:</strong> Algebra</p> --}}
        <p style=" display: inline-block;"><strong>Subject:</strong>  {{ $evaluation->subject->name ?? 'N/A' }} </p>
    </div>

  <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
    <p style=" display: inline-block;"><strong>Campus:</strong> {{ $evaluation->campus->name ?? 'N/A' }}</p>
    <p style=" display: inline-block;"><strong>Total Students:</strong> {{ $evaluation->total_students ?? 'N/A' }} </p>
    <p style="display: inline-block;"><strong>Evaluation Date:</strong> 
        {{ $evaluation->evaluation_date ? \Carbon\Carbon::parse($evaluation->evaluation_date)->format('d-m-Y') : 'N/A' }}
    </p>


    <table>
        <thead>
            <tr>
                <th>S.#</th>
                <th>Particulars</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
                <th>Remarks (if any)</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Entrance (Salam/Welcome)</td>
                <td>5</td>
                <td>{{ $evaluation->entrance_welcome_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_entrance_welcome ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Appearance (Dress Code)</td>
                <td>5</td>
                <td>{{ $evaluation->appearance_dress_code_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_appearance_dress_code ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Seating Arrangement & Cleanliness</td>
                <td>5</td>
                <td>{{ $evaluation->seating_cleanliness_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_seating_cleanliness ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Writing Board Preparation & Sketching</td>
                <td>5</td>
                <td>{{ $evaluation->writing_board_prep_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_writing_board_prep ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Use of Writing Board & Teacher's Writing</td>
                <td>5</td>
                <td>{{ $evaluation->writing_board_use_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_writing_board_use ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Day-wise Division of Syllabus</td>
                <td>5</td>
                <td>{{ $evaluation->syllabus_division_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_syllabus_division ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Assessment (at the start)</td>
                <td>5</td>
                <td>{{ $evaluation->assessment_start_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_assessment_start ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>P.K. Testing</td>
                <td>5</td>
                <td>{{ $evaluation->pk_testing_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_pk_testing ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Use of A.V. Aids/Activities</td>
                <td>5</td>
                <td>{{ $evaluation->av_activities_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_av_activities ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Teaching Strategies/Techniques/Methods</td>
                <td>5</td>
                <td>{{ $evaluation->teaching_methods_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_teaching_methods ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Command on Subject</td>
                <td>5</td>
                <td>{{ $evaluation->subject_command_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_subject_command ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Concept Clarity of Students</td>
                <td>5</td>
                <td>{{ $evaluation->student_clarity_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_student_clarity ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Involvement of Students</td>
                <td>5</td>
                <td>{{ $evaluation->student_involvement_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_student_involvement ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Individual Attention</td>
                <td>5</td>
                <td>{{ $evaluation->individual_attention_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_individual_attention ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Copy Work</td>
                <td>5</td>
                <td>{{ $evaluation->copy_work_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_copy_work ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Islamization/Moral Training</td>
                <td>5</td>
                <td>{{ $evaluation->moral_training_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_moral_training ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Reading & Marking of Objective</td>
                <td>5</td>
                <td>{{ $evaluation->reading_marking_objective_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_reading_marking_objective ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Lecture Delivery and Lecture Planning Relationship</td>
                <td>5</td>
                <td>{{ $evaluation->lecture_planning_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_lecture_planning ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Time Management</td>
                <td>5</td>
                <td>{{ $evaluation->time_management_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_time_management ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Spoken English</td>
                <td>5</td>
                <td>{{ $evaluation->spoken_english_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_spoken_english ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Evaluation</td>
                <td>5</td>
                <td>{{ $evaluation->evaluation_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_evaluation ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Home Task/Prayers Checking</td>
                <td>5</td>
                <td>{{ $evaluation->home_task_checking_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_home_task_checking ?? '' }}</td>
            </tr>
            <tr>
                <td>{{ $serial++ }}</td>
                <td>Class Discipline</td>
                <td>5</td>
                <td>{{ $evaluation->class_discipline_marks ?? '' }}</td>
                <td>{{ $evaluation->remarks_class_discipline ?? '' }}</td>
            </tr>
        </tbody>
    </table>



    <p style="margin-top: 20px;"><strong>Observer Name:</strong>
        {{ $evaluation->observer_name ?? '___________________' }}</p>
    <p style="margin-top: 10px;">
        <strong>Signature:</strong>
        <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>

    <p style="margin-top: 10px;"><strong>Guidance by Observer:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        {{ $evaluation->observer_guidance ?? '__________________________________________________________________________' }}
    </p>

    <p style="margin-top: 10px;"><strong>Teacher Views:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        {{ $evaluation->teacher_views ?? '__________________________________________________________________________' }}
    </p>

    <p style="margin-top: 20px;">
        <strong>Signature:</strong>
        <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>



</body>

</html>
