<!-- summernote editor -->
<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <textarea
        name="<?php echo e($field['name']); ?>"
        <?php echo $__env->make('crud::inc.field_attributes', ['default_class' =>  'form-control summernote'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        ><?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?></textarea>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>





<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- include summernote css-->
        <link href="<?php echo e(asset('vendor/backpack/summernote/summernote.css')); ?>" rel="stylesheet" type="text/css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- include summernote js-->
        <script src="<?php echo e(asset('vendor/backpack/summernote/summernote.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>

<?php $__env->startPush('crud_fields_scripts'); ?>
    <!-- include summernote js with related options for this field -->
    <script>
        jQuery(document).ready(function($) {
            $(".summernote[name='<?php echo e($field['name']); ?>']").summernote(<?php echo json_encode($field['options'] ?? [], 15, 512) ?>);
        });
    </script>
<?php $__env->stopPush(); ?>


