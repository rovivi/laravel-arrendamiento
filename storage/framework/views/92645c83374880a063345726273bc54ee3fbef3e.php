<!-- bootstrap daterange picker input -->

<?php
    // if the column has been cast to Carbon or Date (using attribute casting)
    // get the value as a date string
    if (!function_exists('formatDate')) {
        function formatDate($entry, $dateFieldName)
        {
            $formattedDate = null;
            if (isset($entry) && !empty($entry->{$dateFieldName})) {
                $dateField = $entry->{$dateFieldName};
                if ($dateField instanceof \Carbon\Carbon || $dateField instanceof \Jenssegers\Date\Date) {
                    $formattedDate = $dateField->format('Y-m-d H:i:s');
                } else {
                    $formattedDate = date('Y-m-d H:i:s', strtotime($entry->{$dateFieldName}));
                }
            }
            return $formattedDate;
        }
    }

    if (isset($entry)) {
        $start_name = formatDate($entry, $field['start_name']);
        $end_name = formatDate($entry, $field['end_name']);
    }
?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <input class="datepicker-range-start" type="hidden" name="<?php echo e($field['start_name']); ?>" value="<?php echo e(old(square_brackets_to_dots($field['start_name'])) ?? $start_name ?? $field['start_default'] ?? ''); ?>">
    <input class="datepicker-range-end" type="hidden" name="<?php echo e($field['end_name']); ?>" value="<?php echo e(old(square_brackets_to_dots($field['end_name'])) ?? $end_name ?? $field['end_default'] ?? ''); ?>">
    <label><?php echo $field['label']; ?></label>
    <div class="input-group date">
        <input
            data-bs-daterangepicker="<?php echo e(isset($field['date_range_options']) ? json_encode($field['date_range_options']) : '{}'); ?>"
            type="text"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            >
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </div>
    </div>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>




<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/vendor/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <script src="<?php echo e(asset('/vendor/adminlte/bower_components/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendor/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script>
        jQuery(document).ready(function($){
            $('[data-bs-daterangepicker]').each(function(){

                var $fake = $(this),
                $start = $fake.parents('.form-group').find('.datepicker-range-start'),
                $end = $fake.parents('.form-group').find('.datepicker-range-end'),
                $customConfig = $.extend({
                    format: 'dd/mm/yyyy',
                    autoApply: true,
                    startDate: moment($start.val()),
                    endDate: moment($end.val())
                }, $fake.data('bs-daterangepicker'));

                $fake.daterangepicker($customConfig);
                $picker = $fake.data('daterangepicker');

                $fake.on('keydown', function(e){
                    e.preventDefault();
                    return false;
                });

                $fake.on('apply.daterangepicker hide.daterangepicker', function(e, picker){
                    $start.val( picker.startDate.format('YYYY-MM-DD HH:mm:ss') );
                    $end.val( picker.endDate.format('YYYY-MM-DD H:mm:ss') );
                });

            });
        });
    </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


