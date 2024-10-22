<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.seniorevaluation-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Teacher Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">ناظرہ رپورٹ</h4>
                    <a href="<?php echo e(route('report.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('report.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row gy-4">
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">کیمپس</label>
                                    <select class="form-select <?php $__errorArgs = ['campus_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="campus_id"
                                        name="campus_id" required>
                                        <option value="">کیمپس منتخب کریں</option>
                                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($campus->id); ?>"><?php echo e($campus->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['campus_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">استاد کا نام</label>
                                    <select class="form-select <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="teacher_id"
                                        name="teacher_id" required>
                                        <option value="">استاد منتخب کریں</option>
                                    </select>
                                    <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                        </div>
                        <div class="row gy-4">

                            <!-- Field 1: آمد و استقبال (Entrance and Welcome) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome" class="form-label">آمد و استقبال</label>
                                    <input type="number" class="form-control" id="entrance_welcome" name="entrance_welcome"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="2"
                                        required>
                                </div>
                            </div>

                            <!-- Field 2: شخصی سلیقہ و لباس (Personal Appearance and Dress) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress" class="form-label">شخصی سلیقہ و لباس</label>
                                    <input type="number" class="form-control" id="appearance_dress" name="appearance_dress"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="3"
                                        required>
                                </div>
                            </div>

                            <!-- Field 3: درسی انداز (Teaching Style) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_style" class="form-label">درسی انداز</label>
                                    <input type="number" class="form-control" id="teaching_style" name="teaching_style"
                                        oninput="calculateTotal()" oninput="calculateTotal()  placeholder="نمبر درج کریں"
                                        min="0" max="5" required>
                                </div>
                            </div>

                            <!-- Field 4: حفاظتی تدابیر و صفائی (Safety Measures and Cleanliness) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="safety_cleanliness" class="form-label">حفاظتی تدابیر و صفائی</label>
                                    <input type="number" class="form-control" id="safety_cleanliness"
                                        name="safety_cleanliness" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="3" required>
                                </div>
                            </div>

                            <!-- Field 5: نظم و ضبط (Discipline) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline" class="form-label">نظم و ضبط</label>
                                    <input type="number" class="form-control" id="discipline" name="discipline"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="5"
                                        required>
                                </div>
                            </div>

                            <!-- Field 6: کلاس بورڈ (Class Board) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_board" class="form-label">کلاس بورڈ</label>
                                    <input type="number" class="form-control" id="class_board" name="class_board"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="2"
                                        required>
                                </div>
                            </div>

                            <!-- Field 7: تدریسی پلان اور ٹائم ٹیبل (Teaching Plan and Time Table) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_plan" class="form-label">تدریسی پلان اور ٹائم ٹیبل</label>
                                    <input type="number" class="form-control" id="teaching_plan" name="teaching_plan"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="5" required>
                                </div>
                            </div>

                            <!-- Field 8: مشق کروائی / طلبہ کی تیاری (Classroom Exercises / Student Preparation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_preparation" class="form-label">مشق کروائی / طلبہ کی تیاری</label>
                                    <input type="number" class="form-control" id="student_preparation"
                                        name="student_preparation" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 9: گفتگو کا معیار (Standard of Conversation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="conversation_standard" class="form-label">گفتگو کا معیار</label>
                                    <input type="number" class="form-control" id="conversation_standard"
                                        name="conversation_standard" oninput="calculateTotal()"
                                        placeholder="نمبر درج کریں" min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 10: حفظ قرآن / دوران تعلیم و تدریس (Hifz-e-Quran / during Teaching) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_during_teaching" class="form-label">حفظ قرآن / دوران تعلیم و
                                        تدریس</label>
                                    <input type="number" class="form-control" id="hifz_during_teaching"
                                        name="hifz_during_teaching" oninput="calculateTotal()"
                                        placeholder="نمبر درج کریں" min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 11: حفظ قرآن / روانی (Hifz-e-Quran / Fluency) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_fluency" class="form-label">حفظ قرآن / روانی</label>
                                    <input type="number" class="form-control" id="hifz_fluency" name="hifz_fluency"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <!-- Field 12: قراءت (Recitation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="recitation" class="form-label">قراءت</label>
                                    <input type="number" class="form-control" id="recitation" name="recitation"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="7" required>
                                </div>
                            </div>

                            <!-- Field 13: اخلاقی تربیت (Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training" class="form-label">اخلاقی تربیت</label>
                                    <input type="number" class="form-control" id="moral_training" name="moral_training"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <!-- Field 14: فکری و اخلاقی تربیت (Intellectual and Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="intellectual_moral_training" class="form-label">فکری و اخلاقی
                                        تربیت</label>
                                    <input type="number" class="form-control" id="intellectual_moral_training"
                                        name="intellectual_moral_training" oninput="calculateTotal()"
                                        placeholder="نمبر درج
                                        کریں" min="0"
                                        max="5" required>
                                </div>
                            </div>

                            <!-- Field 15: جسمانی طاقت و صحت (Physical Strength and Health) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="physical_strength_health" class="form-label">جسمانی طاقت و صحت</label>
                                    <input type="number" class="form-control" id="physical_strength_health"
                                        name="physical_strength_health" oninput="calculateTotal()"
                                        placeholder="نمبر درج
                                        کریں" min="0"
                                        max="3" required>
                                </div>
                            </div>

                            <!-- Field 16: استعمال وقت (Time Management) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">استعمال وقت</label>
                                    <input type="number" class="form-control" id="time_management"
                                        name="time_management" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="2" required>
                                </div>
                            </div>

                            <!-- Field 17: طلبہ کی کارکردگی (Student Performance) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_performance" class="form-label">طلبہ کی کارکردگی</label>
                                    <input type="number" class="form-control" id="student_performance"
                                        name="student_performance" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="5" required>
                                </div>
                            </div>

                            <!-- Field 18: ڈائری (Diary) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary" class="form-label">ڈائری</label>
                                    <input type="number" class="form-control" id="diary" name="diary"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="3" required>
                                </div>
                            </div>

                            <!-- Total Marks Field -->
                            <div class="col-xxl-12 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">جمع کرائیں</button>
                            <a href="<?php echo e(route('report.index')); ?>" class="btn btn-secondary">منسوخ کریں</a>
                        </div>
                    </form>





                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Load jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Your other script files -->
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#campus_id').on('change', function() {
                var campusId = $(this).val(); // Get the selected campus ID
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId, // Call to the controller
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log("Data received: ",
                                data); // Log the data to ensure it's being received

                            $('#teacher_id').empty(); // Clear the dropdown
                            $('#teacher_id').append(
                                '<option value="">Select Teacher</option>'
                            ); // Add the default option

                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    console.log("Adding teacher: ", value
                                        .name); // Log each teacher being added
                                    $('#teacher_id').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });
                            } else {
                                $('#teacher_id').append(
                                    '<option value="">No Teachers Available</option>');
                            }
                        },

                        error: function() {
                            $('#teacher_id').empty();
                            $('#teacher_id').append(
                                '<option value="">Error loading teachers</option>');
                        }
                    });
                } else {
                    $('#teacher_id').empty();
                    $('#teacher_id').append('<option value="">Select Teacher</option>');
                }
            });
        });
    </script>


    <script>
        function calculateTotal() {
            let total = 0;

            // List of your field IDs
            const fields = [
                'entrance_welcome',
                'appearance_dress',
                'teaching_style',
                'safety_cleanliness',
                'discipline',
                'class_board',
                'teaching_plan',
                'student_preparation',
                'conversation_standard',
                'hifz_during_teaching',
                'hifz_fluency',
                'recitation',
                'moral_training',
                'intellectual_moral_training',
                'physical_strength_health',
                'time_management',
                'student_performance',
                'diary'
            ];

            // Loop through each field and add its value to the total
            fields.forEach(function(field) {
                const value = parseInt(document.getElementById(field).value) || 0; // Use 0 if the field is empty
                total += value;
            });

            // Display the total in the total_marks field
            document.getElementById('total_marks').value = total;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/report/create.blade.php ENDPATH**/ ?>