<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Observation Checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .container {
            margin-top: 30px;
        }

        h2,
        h3 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .teacher-info {
            margin-bottom: 30px;
            font-size: 16px;
        }

        .teacher-info label {
            font-weight: bold;
        }

        .teacher-info input {
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            padding: 0 5px;
            font-size: 14px;
        }

        .row {
            margin-bottom: 15px;
        }

        .table {
            margin-top: 30px;
        }

        .table-bordered th {
            text-align: center;
        }

        .table-bordered td {
            vertical-align: middle;
            padding: 8px;
            border-top: 1px solid #000;
        }

        .table-bordered input {
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            padding: 0 5px;
            width: 100%;
        }

        .signature-section,
        .guidance-section,
        .teacher-views-section {
            margin-top: 30px;
        }

        textarea {
            border: 1px solid #000;
            width: 100%;
            resize: none;
            padding: 5px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Dare Arqam Schools</h2>
        <h3 class="text-center">CLASS OBSERVATION CHECKLIST (GRADE 1-7)</h3>

        <form action="<?php echo e(route('evaluation.save', $evaluation->id ?? '')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row teacher-info">
                <div class="col-md-4">
                    <label>Teacher’s Name:</label>
                    <input type="text" name="teacher_name" class="form-control"
                        value="<?php echo e(old('teacher_name', $evaluation->teacher_name ?? '')); ?>">
                </div>
                <div class="col-md-4">
                    <label>Qualification:</label>
                    <input type="text" name="qualification" class="form-control"
                        value="<?php echo e(old('qualification', $evaluation->qualification ?? '')); ?>">
                </div>
                <div class="col-md-4">
                    <label>Joining Date:</label>
                    <input type="date" name="joining_date" class="form-control"
                        value="<?php echo e(old('joining_date', $evaluation->joining_date ?? '')); ?>">
                </div>
            </div>
            <div class="row teacher-info">
                <div class="col-md-4">
                    <label>Class/Sec:</label>
                    <input type="text" name="class_sec" class="form-control"
                        value="<?php echo e(old('class_sec', $evaluation->class_sec ?? '')); ?>">
                </div>
                <div class="col-md-4">
                    <label>Subject:</label>
                    <input type="text" name="subject" class="form-control"
                        value="<?php echo e(old('subject', $evaluation->subject ?? '')); ?>">
                </div>
                <div class="col-md-4">
                    <label>Topic:</label>
                    <input type="text" name="topic" class="form-control"
                        value="<?php echo e(old('topic', $evaluation->topic ?? '')); ?>">
                </div>
            </div>
            <div class="row teacher-info">
                <div class="col-md-4">
                    <label>Campus:</label>
                    <input type="text" name="campus" class="form-control"
                        value="<?php echo e(old('campus', $evaluation->campus ?? '')); ?>">
                </div>
                <div class="col-md-4">
                    <label>Total Students:</label>
                    <input type="number" name="total_students" class="form-control"
                        value="<?php echo e(old('total_students', $evaluation->total_students ?? 0)); ?>">
                </div>
                <div class="col-md-4">
                    <label>Date:</label>
                    <input type="date" name="observation_date" class="form-control"
                        value="<?php echo e(old('observation_date', $evaluation->observation_date ?? '')); ?>">
                </div>
            </div>

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
                        <td><input type="number" name="checklist[1][obtained_marks]" class="form-control"
                                value="<?php echo e(old('checklist.1.obtained_marks', $evaluation->checklist[1]['obtained_marks'] ?? 0)); ?>"></td>
                        <td><input type="text" name="checklist[1][remarks]" class="form-control"
                                value="<?php echo e(old('checklist.1.remarks', $evaluation->checklist[1]['remarks'] ?? '')); ?>"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lesson plan + standard of lesson plan</td>
                        <td>5</td>
                        <td><input type="number" name="checklist[2][obtained_marks]" class="form-control"
                                value="<?php echo e(old('checklist.2.obtained_marks', $evaluation->checklist[2]['obtained_marks'] ?? 0)); ?>"></td>
                        <td><input type="text" name="checklist[2][remarks]" class="form-control"
                                value="<?php echo e(old('checklist.2.remarks', $evaluation->checklist[2]['remarks'] ?? '')); ?>"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Assessment (seen + unseen ) Oral / Written</td>
                        <td>4</td>
                        <td><input type="number" name="checklist[3][obtained_marks]" class="form-control"
                                value="<?php echo e(old('checklist.3.obtained_marks', $evaluation->checklist[3]['obtained_marks'] ?? 0)); ?>"></td>
                        <td><input type="text" name="checklist[3][remarks]" class="form-control"
                                value="<?php echo e(old('checklist.3.remarks', $evaluation->checklist[3]['remarks'] ?? '')); ?>"></td>
                    </tr>
                 
                </tbody>
            </table>

            <div class="row signature-section">
                <div class="col-md-6">
                    <label for="observerName" class="form-label">Observer Name:</label>
                    <input type="text" class="form-control" id="observerName" name="observer_name"
                        value="<?php echo e(old('observer_name', $evaluation->observer_name ?? '')); ?>">
                </div>
                <div class="col-md-6">
                    <label for="signature" class="form-label">Signature:</label>
                    <input type="text" class="form-control" id="signature" name="signature"
                        value="<?php echo e(old('signature', $evaluation->signature ?? '')); ?>">
                </div>
            </div>

            <div class="form-group guidance-section final-sections">
                <label for="guidance" class="form-label">Guidance by Observer:</label>
                <textarea class="form-control" id="guidance" name="guidance" rows="3"><?php echo e(old('guidance', $evaluation->guidance ?? '')); ?></textarea>
            </div>

            <div class="form-group teacher-views-section final-sections">
                <label for="teacherViews" class="form-label">Teacher’s Views:</label>
                <textarea class="form-control" id="teacherViews" name="teacher_views" rows="3"><?php echo e(old('teacher_views', $evaluation->teacher_views ?? '')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Class Observation Checklist</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 4px 8px; border: 1px solid #000; font-size: 12px; }
    th { background-color: #f2f2f2; }
        h2 { text-align: center;  }
        h3 { text-align: center; margin-bottom: 20px; }
        p { margin: 5px 0;width: 32%; font-size: 14px;
             }
             .header { display: flex; justify-content: space-between; align-items: center; }
             .header img { width: 100px; height: auto; }
    </style>
</head>
<body>
<div class="header">
<img src="/Dar-e-Arqam/public/build/images/logo.png" alt="School Logo">
<h2>Dare Arqam Schools</h2>

    </div>       
     <h3 >CLASS OBSERVATION CHECKLIST (GRADE 1-7)</h3>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
    <p style=" display: inline-block;"><strong>Teacher's Name:</strong> Farhan</p>
    <p style=" display: inline-block;"><strong>Qualification:</strong> MA</p>
    <p style="display: inline-block;"><strong>Joining Date:</strong> 29-05-2023</p>
</div>

<div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
    <p style=" display: inline-block;"><strong>Class/Sec:</strong> 5th C</p>
    <p style=" display: inline-block;"><strong>Subject:</strong> Math</p>
    <p style="display: inline-block;"><strong>Topic:</strong> Algebra</p>
</div>

<div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
    <p style=" display: inline-block;"><strong>Campus:</strong> Gujrat</p>
    <p style=" display: inline-block;"><strong>Total Students:</strong> 80</p>
    <p style="display: inline-block;"><strong>Date:</strong> 10-08-1024</p>
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
                <td>3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Lesson plan + Standard of lesson plan</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Assessment (seen + unseen) Oral / Written</td>
                <td>4</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Introduction/P.K testing</td>
                <td>3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Islamization (integration with lecture)</td>
                <td>3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Gesture/Tone/Intonation/Body language</td>
                <td>4</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Communication skill/Accent</td>
                <td>4</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Strategies/Activities/Group work/Questioning</td>
                <td>4</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>9</td>
                <td>Discipline/Class control/Physical arrangement</td>
                <td>2</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Tools: A.V aids, Illustrative material, Writing board, Effective usage</td>
                <td>8</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>11</td>
                <td>Real life integration</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>12</td>
                <td>Competency/Command on subject</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>13</td>
                <td>Time management</td>
                <td>3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>14</td>
                <td>Evaluation/Conclusion</td>
                <td>3</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>15</td>
                <td>Diary/Homework checking</td>
                <td>3</td>
                <td></td>
                <td></td>
            </tr>

            <!-- Student Centered (40%) -->
            <tr>
                <td>16</td>
                <td>Involvement/Effective participation of class/Engagement, Collaboration</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>17</td>
                <td>Call on board</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>18</td>
                <td>Knowledge gain/Understanding</td>
                <td>10</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>19</td>
                <td>Skill gain (Spoken + Written)</td>
                <td>10</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>20</td>
                <td>Personality trait/Confidence</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>21</td>
                <td>Response of previous knowledge</td>
                <td>5</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 20px;"><strong>Observer Name:</strong> ___________________</p>
    <p style="margin-top: 10px;"><strong>Signature:</strong> ___________________</p>

    <p style="margin-top: 10px;"><strong>Guidance by Observer:</strong></p>
    <p>__________________________________________________________________________</p>
    <p>__________________________________________________________________________</p>

    <p style="margin-top: 10px;"><strong>Teacher Views:</strong></p>
    <p>__________________________________________________________________________</p>
    <p>__________________________________________________________________________</p>

    <p style="margin-top: 20px;"><strong>Signature:</strong> ___________________</p>

</body>
</html>

<?php /**PATH D:\DareArqam\Dar-e-Arqam\resources\views/evaluation/evaluation_pdf.blade.php ENDPATH**/ ?>