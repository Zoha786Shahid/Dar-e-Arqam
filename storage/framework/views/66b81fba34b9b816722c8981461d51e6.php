<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Class Observation Checklist</title>
    <style>
        body {
    font-family: 'Jameel Noori Nastaleeq', 'Noto Nastaliq Urdu', DejaVu Sans, Arial, sans-serif;
    direction: rtl;
}

td, th {
    text-align: right;
    direction: rtl;
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

        

        <img src="<?php echo e(public_path('images/school.jpeg')); ?>" alt="School Image">




        <h2>Dare Arqam Schools</h2>

    </div>
 

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Teacher's Name:</strong>
            <?php echo e($evaluation->teacher->first_name ?? 'N/A'); ?>

            <?php echo e($evaluation->teacher->last_name ?? ''); ?> </p>
        <p style=" display: inline-block;"><strong>Qualification:</strong>
            <?php echo e($evaluation->teacher->qualification ?? 'N/A'); ?></p>
        <p style="display: inline-block;"><strong>Joining
                Date:</strong><?php echo e(\Carbon\Carbon::parse($evaluation->teacher->joining_date)->format('d-m-Y') ?? 'N/A'); ?>

        </p>
    </div>


    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Class/Sec:</strong> 5th C</p>
        <p style=" display: inline-block;"><strong>Subject:</strong> Math</p>
        <p style="display: inline-block;"><strong>Topic:</strong> Algebra</p>
    </div>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p style=" display: inline-block;"><strong>Campus:</strong> <?php echo e($evaluation->campus->name ?? 'N/A'); ?></p>
        <p style=" display: inline-block;"><strong>Total Students:</strong> 50</p>
        <p style="display: inline-block;"><strong>Date:</strong> <?php echo e(\Carbon\Carbon::now()->format('d-m-Y')); ?></p>

    </div>

    <table>
        <thead>
            <tr>
                <th>نمبر شمار</th>
                <th>خصوصیات</th>
                <th>کل نمبر</th>
                <th>حاصل کردہ نمبر</th>
                <th>Remarks (if any)</th>
            </tr>
        </thead>
         <tbody dir="rtl">
            <?php $serial = 1; ?>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>آمد و استقبال (Entrance and Welcome)</td>
                <td>2</td>
                <td><?php echo e($evaluation->entrance_welcome ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_entrance_welcome ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>شخصی سلیقہ و لباس (Personal Appearance and Dress)</td>
                <td>3</td>
                <td><?php echo e($evaluation->appearance_dress ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_appearance_dress ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>درسی انداز (Teaching Style)</td>
                <td>5</td>
                <td><?php echo e($evaluation->teaching_style ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_teaching_style ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>حفاظتی تدابیر و صفائی (Safety Measures and Cleanliness)</td>
                <td>3</td>
                <td><?php echo e($evaluation->safety_cleanliness ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_safety_cleanliness ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>نظم و ضبط (Discipline)</td>
                <td>5</td>
                <td><?php echo e($evaluation->discipline ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_discipline ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>کلاس بورڈ (Class Board)</td>
                <td>2</td>
                <td><?php echo e($evaluation->class_board ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_class_board ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>تدریسی پلان اور ٹائم ٹیبل (Teaching Plan and Time Table)</td>
                <td>5</td>
                <td><?php echo e($evaluation->teaching_plan ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_teaching_plan ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>مشق کروائی / طلبہ کی تیاری (Student Preparation)</td>
                <td>10</td>
                <td><?php echo e($evaluation->student_preparation ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_student_preparation ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>گفتگو کا معیار (Standard of Conversation)</td>
                <td>10</td>
                <td><?php echo e($evaluation->conversation_standard ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_conversation_standard ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>حفظ قرآن / دوران تعلیم و تدریس (Hifz-e-Quran / during Teaching)</td>
                <td>10</td>
                <td><?php echo e($evaluation->hifz_during_teaching ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_hifz_during_teaching ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>حفظ قرآن / روانی (Hifz-e-Quran / Fluency)</td>
                <td>10</td>
                <td><?php echo e($evaluation->hifz_fluency ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_hifz_fluency ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>قراءت (Recitation)</td>
                <td>7</td>
                <td><?php echo e($evaluation->recitation ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_recitation ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>اخلاقی تربیت (Moral Training)</td>
                <td>10</td>
                <td><?php echo e($evaluation->moral_training ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_moral_training ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>فکری و اخلاقی تربیت (Intellectual and Moral Training)</td>
                <td>5</td>
                <td><?php echo e($evaluation->intellectual_moral_training ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_intellectual_moral_training ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>جسمانی طاقت و صحت (Physical Strength and Health)</td>
                <td>3</td>
                <td><?php echo e($evaluation->physical_strength_health ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_physical_strength_health ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>استعمال وقت (Time Management)</td>
                <td>2</td>
                <td><?php echo e($evaluation->time_management ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_time_management ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>طلبہ کی کارکردگی (Student Performance)</td>
                <td>5</td>
                <td><?php echo e($evaluation->student_performance ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_student_performance ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td>ڈائری (Diary)</td>
                <td>3</td>
                <td><?php echo e($evaluation->diary ?? ''); ?></td>
                <td><?php echo e($evaluation->remarks_diary ?? ''); ?></td>
            </tr>
    
            <tr>
                <td><?php echo e($serial++); ?></td>
                <td><strong>کل نمبر</strong></td>
                <td>100</td>
                <td><?php echo e($evaluation->total_marks ?? ''); ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    



    <p style="margin-top: 20px;"><strong>Observer Name:</strong>
        <?php echo e($evaluation->observer_name ?? '___________________'); ?></p>
    <p style="margin-top: 10px;">
        <strong>Signature:</strong>
        <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>

    <p style="margin-top: 10px;"><strong>Guidance by Observer:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        <?php echo e($evaluation->observer_guidance ?? '__________________________________________________________________________'); ?>

    </p>

    <p style="margin-top: 10px;"><strong>Teacher Views:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        <?php echo e($evaluation->teacher_views ?? '__________________________________________________________________________'); ?>

    </p>

    <p style="margin-top: 20px;">
        <strong>Signature:</strong>
        <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>



</body>

</html>
<?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/report/evaluation_pdf.blade.php ENDPATH**/ ?>