<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Class Observation Checklist</title>
    <style>
        @font-face {
            font-family: 'Jameel Noori Nastaleeq';
            src: url('<?php echo e(public_path('fonts/JameelNooriNastaleeq.ttf')); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body, td, th {
            font-family: 'Jameel Noori Nastaleeq', 'Noto Nastaliq Urdu', DejaVu Sans, Arial, sans-serif;
            direction: rtl;
            text-align: right;
            letter-spacing: 0.5px; /* Adjust for Urdu */
            word-spacing: 1px; /* Adjust for Urdu */
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

        p {
            margin: 5px 0;
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
        <h2>دائرہ ارقم اسکولز</h2>
    </div>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap; margin-top: 20px;">
        <p><strong>نام استاد:</strong> <?php echo e($evaluation->teacher->first_name ?? 'N/A'); ?> <?php echo e($evaluation->teacher->last_name ?? ''); ?></p>
        <p><strong>تعلیمی قابلیت:</strong> <?php echo e($evaluation->teacher->qualification ?? 'N/A'); ?></p>
    </div>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p><strong>کلاس / سیکشن:</strong> 5th C</p>
        <p><strong>مضمون:</strong> Math</p>
        <p><strong>عنوان:</strong> Algebra</p>
    </div>

    <div style="display: flex; justify-content: space-between; flex-wrap: nowrap;">
        <p><strong>کیمپس:</strong> <?php echo e($evaluation->campus->name ?? 'N/A'); ?></p>
        <p><strong>کل طلبہ:</strong> 50</p>
        <p><strong>تاریخ:</strong> <?php echo e(\Carbon\Carbon::now()->format('d-m-Y')); ?></p>
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
        <tbody>
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
            <!-- Add more rows similarly -->
        </tbody>
    </table>

    <p style="margin-top: 20px;"><strong>ناظر کا نام:</strong> <?php echo e($evaluation->observer_name ?? '___________________'); ?></p>
    <p><strong>دستخط:</strong> <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span></p>

    <p style="margin-top: 10px;"><strong>ناظر کی رہنمائی:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        <?php echo e($evaluation->observer_guidance ?? '__________________________________________________________________________'); ?>

    </p>

    <p style="margin-top: 10px;"><strong>اساتذہ کے خیالات:</strong></p>
    <p style="border-bottom: 1px solid black; width: 100%; padding-bottom: 10px;">
        <?php echo e($evaluation->teacher_views ?? '__________________________________________________________________________'); ?>

    </p>

    <p style="margin-top: 20px;">
        <strong>دستخط:</strong> <span style="display: inline-block; width: 200px; border-bottom: 1px solid black;"></span>
    </p>
</body>

</html>
<?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/report/evaluation_pdf.blade.php ENDPATH**/ ?>