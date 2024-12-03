<!DOCTYPE html>
<html lang="ur">

<head>
    <meta charset="UTF-8">
    <title>رپورٹ کارڈ برائے مشاہدہ کلاس</title>
    <style>
        @font-face {
            font-family: 'Jameel Noori Nastaleeq';
            src: url('<?php echo e(resource_path('fonts/JameelNooriNastaleeq.ttf')); ?>') format('truetype');
        }

        body {
            font-family: 'Jameel Noori Nastaleeq', sans-serif;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 0;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: center;
            padding: 5px;
            font-size: 14px;
        }

        .details {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .signature-section {
            margin-top: 20px;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            text-align: center;
            width: 45%;
        }
    </style>
</head>

<body>

    <h2>رپورٹ کارڈ برائے مشاہدہ کلاس</h2>


    <div class="details">
        <p><strong>استاد کا نام:</strong> <?php echo e($evaluation->teacher->first_name); ?> <?php echo e($evaluation->teacher->last_name); ?>

        </p>
        <p><strong>کوالفیکیشن:</strong> <?php echo e($evaluation->teacher->qualification); ?></p>
        <p><strong>کمپیس:</strong> <?php echo e($evaluation->campus->name); ?></p>
        <p><strong>تاریخ:</strong> <?php echo e(\Carbon\Carbon::parse($evaluation->created_at)->format('d-m-Y')); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>نمبر شمار</th>
                <th>خصوصیات</th>
                <th>کل نمبر</th>
                <th>حاصل کردہ نمبر</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>آمد و استقبال</td>
                <td>2</td>
                <td><?php echo e($evaluation->entrance_welcome); ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>شخصی سلیقہ و لباس</td>
                <td>3</td>
                <td><?php echo e($evaluation->appearance_dress); ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>درسی انداز</td>
                <td>5</td>
                <td><?php echo e($evaluation->teaching_style); ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>حفاظتی تدابیر و صفائی</td>
                <td>3</td>
                <td><?php echo e($evaluation->safety_cleanliness); ?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>نظم و ضبط</td>
                <td>5</td>
                <td><?php echo e($evaluation->discipline); ?></td>
            </tr>
            <tr>
                <td>6</td>
                <td>کلاس بورڈ</td>
                <td>2</td>
                <td><?php echo e($evaluation->class_board); ?></td>
            </tr>
            <tr>
                <td>7</td>
                <td>تدریسی پلان اور ٹائم ٹیبل</td>
                <td>5</td>
                <td><?php echo e($evaluation->teaching_plan); ?></td>
            </tr>
            <tr>
                <td>8</td>
                <td>طلبہ کی تیاری</td>
                <td>10</td>
                <td><?php echo e($evaluation->student_preparation); ?></td>
            </tr>
            <tr>
                <td>9</td>
                <td>گفتگو کا معیار</td>
                <td>10</td>
                <td><?php echo e($evaluation->conversation_standard); ?></td>
            </tr>
            <tr>
                <td>10</td>
                <td>حفظ قرآن</td>
                <td>10</td>
                <td><?php echo e($evaluation->hifz_during_teaching); ?></td>
            </tr>
            <tr>
                <td>11</td>
                <td>روانی</td>
                <td>10</td>
                <td><?php echo e($evaluation->hifz_fluency); ?></td>
            </tr>
            <tr>
                <td>12</td>
                <td>اخلاقی تربیت</td>
                <td>10</td>
                <td><?php echo e($evaluation->moral_training); ?></td>
            </tr>
            <tr>
                <td>13</td>
                <td>فکری و اخلاقی تربیت</td>
                <td>5</td>
                <td><?php echo e($evaluation->intellectual_moral_training); ?></td>
            </tr>
            <tr>
                <td>14</td>
                <td>جسمانی طاقت و صحت</td>
                <td>3</td>
                <td><?php echo e($evaluation->physical_strength_health); ?></td>
            </tr>
            <tr>
                <td>15</td>
                <td>استعمال وقت</td>
                <td>2</td>
                <td><?php echo e($evaluation->time_management); ?></td>
            </tr>
            <tr>
                <td>16</td>
                <td>طلبہ کی کارکردگی</td>
                <td>5</td>
                <td><?php echo e($evaluation->student_performance); ?></td>
            </tr>
            <tr>
                <td>17</td>
                <td>ڈائری</td>
                <td>3</td>
                <td><?php echo e($evaluation->diary); ?></td>
            </tr>
            <tr>
                <td colspan="2"><strong>کل نمبر</strong></td>
                <td><strong>100</strong></td>
                <td><strong><?php echo e($evaluation->total_marks); ?></strong></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <p><strong>مشاہدہ کرنے والے کا نام:</strong> ________________________</p>
        <p><strong>دستخط:</strong> ________________________</p>
        <p><strong>استاد کے خیالات:</strong> ________________________</p>
    </div>
</body>

</html>
<?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/report/evaluation_pdf.blade.php ENDPATH**/ ?>