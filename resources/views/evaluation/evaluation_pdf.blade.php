<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Observation Checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Dare Arqam Schools</h2>
        <h3 class="text-center">CLASS OBSERVATION CHECKLIST (GRADE 1-7)</h3>

        <!-- Teacher Information Section -->
        <form action="{{ route('evaluation.save', $evaluation->id ?? '') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="teacherName" class="form-label">Teacher’s Name:</label>
                    <input type="text" class="form-control" id="teacherName" name="teacher_name"
                        value="{{ old('teacher_name', $evaluation->teacher_name ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label for="qualification" class="form-label">Qualification:</label>
                    <input type="text" class="form-control" id="qualification" name="qualification"
                        value="{{ old('qualification', $evaluation->qualification ?? 'B.Ed.') }}">
                </div>
                <div class="col-md-4">
                    <label for="joiningDate" class="form-label">Joining Date:</label>
                    <input type="date" class="form-control" id="joiningDate" name="joining_date"
                        value="{{ old('joining_date', $evaluation->joining_date ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="classSec" class="form-label">Class/Sec:</label>
                    <input type="text" class="form-control" id="classSec" name="class_sec"
                        value="{{ old('class_sec', $evaluation->class_sec ?? '1-A') }}">
                </div>
                <div class="col-md-4">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject"
                        value="{{ old('subject', $evaluation->subject ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label for="topic" class="form-label">Topic:</label>
                    <input type="text" class="form-control" id="topic" name="topic"
                        value="{{ old('topic', $evaluation->topic ?? 'Islamic Studies') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="campus" class="form-label">Campus:</label>
                    <input type="text" class="form-control" id="campus" name="campus"
                        value="{{ old('campus', $evaluation->campus ?? 'Main Campus') }}">
                </div>
                <div class="col-md-4">
                    <label for="totalStudents" class="form-label">Total Students:</label>
                    <input type="number" class="form-control" id="totalStudents" name="total_students"
                        value="{{ old('total_students', $evaluation->total_students ?? 30) }}">
                </div>
                <div class="col-md-4">
                    <label for="observationDate" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="observationDate" name="observation_date"
                        value="{{ old('observation_date', $evaluation->observation_date ?? '') }}">
                </div>
            </div>

            <!-- Observation Checklist Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr. #</th>
                        <th>Teacher Centered (60%)</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                        <th>Remarks (if any)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Appearance/Dress code</td>
                        <td>3</td>
                        <td><input type="number" class="form-control" name="checklist[1][obtained_marks]"
                                value="{{ old('checklist.1.obtained_marks', $evaluation->checklist[1]['obtained_marks'] ?? 0) }}">
                        </td>
                        <td><input type="text" class="form-control" name="checklist[1][remarks]"
                                value="{{ old('checklist.1.remarks', $evaluation->checklist[1]['remarks'] ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lesson plan + standard of lesson plan</td>
                        <td>5</td>
                        <td><input type="number" class="form-control" name="checklist[2][obtained_marks]"
                                value="{{ old('checklist.2.obtained_marks', $evaluation->checklist[2]['obtained_marks'] ?? 0) }}">
                        </td>
                        <td><input type="text" class="form-control" name="checklist[2][remarks]"
                                value="{{ old('checklist.2.remarks', $evaluation->checklist[2]['remarks'] ?? '') }}">
                        </td>
                    </tr>
                    <!-- Continue adding rows for other checklist items based on the PDF -->
                    <!-- Example rows for 3 to 7 -->
                    <tr>
                        <td>3</td>
                        <td>Assessment (seen + unseen) Oral/Written</td>
                        <td>4</td>
                        <td><input type="number" class="form-control" name="checklist[3][obtained_marks]"
                                value="{{ old('checklist.3.obtained_marks', $evaluation->checklist[3]['obtained_marks'] ?? 0) }}">
                        </td>
                        <td><input type="text" class="form-control" name="checklist[3][remarks]"
                                value="{{ old('checklist.3.remarks', $evaluation->checklist[3]['remarks'] ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Introduction/P.K testing</td>
                        <td>3</td>
                        <td><input type="number" class="form-control" name="checklist[4][obtained_marks]"
                                value="{{ old('checklist.4.obtained_marks', $evaluation->checklist[4]['obtained_marks'] ?? 0) }}">
                        </td>
                        <td><input type="text" class="form-control" name="checklist[4][remarks]"
                                value="{{ old('checklist.4.remarks', $evaluation->checklist[4]['remarks'] ?? '') }}">
                        </td>
                    </tr>
                    <!-- Continue to add other rows based on the PDF -->
                </tbody>
            </table>

            <!-- Signature Section -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <label for="observerName" class="form-label">Observer Name:</label>
                    <input type="text" class="form-control" id="observerName" name="observer_name"
                        value="{{ old('observer_name', $evaluation->observer_name ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="signature" class="form-label">Signature:</label>
                    <input type="text" class="form-control" id="signature" name="signature"
                        value="{{ old('signature', $evaluation->signature ?? '') }}">
                </div>
            </div>

            <!-- Guidance and Teacher’s Views -->
            <div class="form-group mt-4">
                <label for="guidance">Guidance by Observer:</label>
                <textarea class="form-control" id="guidance" name="guidance" rows="3">{{ old('guidance', $evaluation->guidance ?? '') }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="teacherViews">Teacher’s Views:</label>
                <textarea class="form-control" id="teacherViews" name="teacher_views" rows="3">{{ old('teacher_views', $evaluation->teacher_views ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
