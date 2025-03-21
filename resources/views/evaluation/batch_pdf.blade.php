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
            margin-top: 10px;
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
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
            width: 32%;
            font-size: 13px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body>
    @foreach ($evaluations as $evaluation)
    <div class="header">
        <img src="{{ public_path('images/school.jpeg') }}" alt="School Image">
    </div>
    <h2>Dare Arqam Schools</h2>
    <h3>CLASS OBSERVATION CHECKLIST (GRADE 1-7)</h3>
    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Teacher's Name:</strong>
            {{ $evaluation->teacher->first_name ?? 'N/A' }}
            {{ $evaluation->teacher->last_name ?? '' }} </p>
        <p style=" display: inline-block;"><strong>Qualification:</strong>
            {{ $evaluation->teacher->qualification ?? 'N/A' }}</p>
        {{-- <p style="display: inline-block;"><strong>Joining
                Date:</strong>{{ \Carbon\Carbon::parse($evaluation->teacher->joining_date)->format('d-m-Y') ?? 'N/A' }}
        </p> --}}
    </div>


    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Class/Sec:</strong> {{ $evaluation->schoolClass->name ?? 'N/A' }}</p>
        {{-- <p style=" display: inline-block;"><strong>Section:</strong> {{ $evaluation->section->name ?? 'N/A' }}</p> </p> --}}
        <p style=" display: inline-block;"><strong>Subject:</strong>  {{ $evaluation->subject->name ?? 'N/A' }} </p>
        {{-- <p style="display: inline-block;"><strong>Topic:</strong> Algebra</p> --}}
    </div>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Campus:</strong> {{ $evaluation->campus->name ?? 'N/A' }}</p>
        <p style=" display: inline-block;"><strong>Total Students:</strong> 80</p>
        <p style="display: inline-block;"><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Sr #</th>
                <th>Criteria</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Appearance/Dress code</td>
                <td>5</td>
                <td>{{ $evaluation->appearance_dress_code ?? '' }}</td>
                <td>{{ $evaluation->remarks_appearance_dress_code ?? '' }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Lesson plan + Standard of lesson plan</td>
                <td>5</td>
                <td>{{ $evaluation->lesson_plan ?? '' }}</td>
                <td>{{ $evaluation->remarks_lesson_plan ?? '' }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Assessment (seen + unseen) Oral / Written</td>
                <td>5</td>
                <td>{{ $evaluation->assessment_seen_unseen ?? '' }}</td>
                <td>{{ $evaluation->remarks_assessment_seen_unseen ?? '' }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Introduction/P.K testing</td>
                <td>5</td>
                <td>{{ $evaluation->introduction_pk_testing ?? '' }}</td>
                <td>{{ $evaluation->remarks_introduction_pk_testing ?? '' }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Islamization (integration with lecture)</td>
                <td>5</td>
                <td>{{ $evaluation->islamization ?? '' }}</td>
                <td>{{ $evaluation->remarks_islamization ?? '' }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Gesture/Tone/Intonation/Body language</td>
                <td>5</td>
                <td>{{ $evaluation->gesture_tone_body_language ?? '' }}</td>
                <td>{{ $evaluation->remarks_gesture_tone_body_language ?? '' }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Communication skill/Accent</td>
                <td>5</td>
                <td>{{ $evaluation->communication_skill ?? '' }}</td>
                <td>{{ $evaluation->remarks_communication_skill ?? '' }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Strategies/Activities/Group work/Questioning</td>
                <td>5</td>
                <td>{{ $evaluation->strategies_activities ?? '' }}</td>
                <td>{{ $evaluation->remarks_strategies_activities ?? '' }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Discipline/Class control/Physical arrangement</td>
                <td>5</td>
                <td>{{ $evaluation->discipline_class_control ?? '' }}</td>
                <td>{{ $evaluation->remarks_discipline_class_control ?? '' }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Tools: A.V aids, Illustrative material, Writing board, Effective usage</td>
                <td>5</td>
                <td>{{ $evaluation->tools_av_aids ?? '' }}</td>
                <td>{{ $evaluation->remarks_tools_av_aids ?? '' }}</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Real life integration</td>
                <td>5</td>
                <td>{{ $evaluation->real_life_integration ?? '' }}</td>
                <td>{{ $evaluation->remarks_real_life_integration ?? '' }}</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Competency/Command on subject</td>
                <td>5</td>
                <td>{{ $evaluation->competency_command_on_subject ?? '' }}</td>
                <td>{{ $evaluation->remarks_competency_command_on_subject ?? '' }}</td>
            </tr>
            <tr>
                <td>13</td>
                <td>Time management</td>
                <td>5</td>
                <td>{{ $evaluation->time_management ?? '' }}</td>
                <td>{{ $evaluation->remarks_time_management ?? '' }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Evaluation/Conclusion</td>
                <td>5</td>
                <td>{{ $evaluation->evaluation_conclusion ?? '' }}</td>
                <td>{{ $evaluation->remarks_evaluation_conclusion ?? '' }}</td>
            </tr>
            <tr>
                <td>15</td>
                <td>Diary/Homework checking</td>
                <td>5</td>
                <td>{{ $evaluation->diary_hw_checking ?? '' }}</td>
                <td>{{ $evaluation->remarks_diary_hw_checking ?? '' }}</td>
            </tr>
            <!-- Additional rows -->
            <tr>
                <td>16</td>
                <td>Involvement/Effective participation of class/Engagement, Collaboration</td>
                <td>5</td>
                <td>{{ $evaluation->involvement_effective_participation ?? '' }}</td>
                <td>{{ $evaluation->remarks_involvement_effective_participation ?? '' }}</td>
            </tr>
            <tr>
                <td>17</td>
                <td>Call on board</td>
                <td>5</td>
                <td>{{ $evaluation->call_on_board ?? '' }}</td>
                <td>{{ $evaluation->remarks_call_on_board ?? '' }}</td>
            </tr>
            <tr>
                <td>18</td>
                <td>Knowledge gain/Understanding</td>
                <td>5</td>
                <td>{{ $evaluation->knowledge_gain ?? '' }}</td>
                <td>{{ $evaluation->remarks_knowledge_gain ?? '' }}</td>
            </tr>
            <tr>
                <td>19</td>
                <td>Skill gain (Spoken + Written)</td>
                <td>5</td>
                <td>{{ $evaluation->skill_gain_spoken ?? '' }}</td>
                <td>{{ $evaluation->remarks_skill_gain_spoken ?? '' }}</td>
            </tr>
            <tr>
                <td>20</td>
                <td>Personality trait/Confidence</td>
                <td>5</td>
                <td>{{ $evaluation->personality_trait_confidence ?? '' }}</td>
                <td>{{ $evaluation->remarks_personality_trait_confidence ?? '' }}</td>
            </tr>
            <tr>
                <td>21</td>
                <td>Response of previous knowledge</td>
                <td>5</td>
                <td>{{ $evaluation->response_of_previous_knowledge ?? '' }}</td>
                <td>{{ $evaluation->remarks_response_of_previous_knowledge ?? '' }}</td>
            </tr>
        </tbody>
    </table>
    
    <p style="margin-top: 10px;"><strong>Observer Name:</strong>
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

    <p style="margin-top: 10px;">
        <strong>Signature:</strong>
        <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>
    @endforeach
</body>

</html>