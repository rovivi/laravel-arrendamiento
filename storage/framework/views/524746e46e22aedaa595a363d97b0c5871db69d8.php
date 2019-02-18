<!-- select2 multiple -->
<?php
    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <select
        name="<?php echo e($field['name']); ?>[]"
        style="width: 100%"
        <?php echo $__env->make('crud::inc.field_attributes', ['default_class' =>  'form-control select2_multiple'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        multiple>

        <?php if(isset($field['allows_null']) && $field['allows_null']==true): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(isset($field['model'])): ?>
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( (old(square_brackets_to_dots($field["name"])) && in_array($option->getKey(), old($field["name"]))) || (is_null(old(square_brackets_to_dots($field["name"]))) && isset($field['value']) && in_array($option->getKey(), $field['value']->pluck($option->getKeyName(), $option->getKeyName())->toArray()))): ?>
                    <option value="<?php echo e($option->getKey()); ?>" selected><?php echo e($option->{$field['attribute']}); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($option->getKey()); ?>"><?php echo e($option->{$field['attribute']}); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>

    <?php if(isset($field['select_all']) && $field['select_all']): ?>
        <a class="btn btn-xs btn-default select_all" style="margin-top: 5px;"><i class="fa fa-check-square-o"></i> <?php echo e(trans('backpack::crud.select_all')); ?></a>
        <a class="btn btn-xs btn-default clear" style="margin-top: 5px;"><i class="fa fa-times"></i> <?php echo e(trans('backpack::crud.clear')); ?></a>
    <?php endif; ?>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>





<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- include select2 css-->
        <link href="<?php echo e(asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- include select2 js-->
        <script src="<?php echo e(asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js')); ?>"></script>
        <script>
            jQuery(document).ready(function($) {
                // trigger select2 for each untriggered select2_multiple box
                $('.select2_multiple').each(function (i, obj) {
                    if (!$(obj).hasClass("select2-hidden-accessible"))
                    {
                        var $obj = $(obj).select2({
                            theme: "bootstrap"
                        });

                        var options = [];
                        <?php if(count($options)): ?>
                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                options.push(<?php echo e($option->getKey()); ?>);
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(isset($field['select_all']) && $field['select_all']): ?>
                            $(obj).parent().find('.clear').on("click", function () {
                                $obj.val([]).trigger("change");
                            });
                            $(obj).parent().find('.select_all').on("click", function () {
                                $obj.val(options).trigger("change");
                            });
                        <?php endif; ?>
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


