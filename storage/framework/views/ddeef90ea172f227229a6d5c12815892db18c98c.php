<!-- configurable color picker -->
<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="input-group colorpicker-component">

        <input
        	type="text"
        	name="<?php echo e($field['name']); ?>"
            value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	>
        <div class="input-group-addon">
            <i class="color-preview-<?php echo e($field['name']); ?>"></i>
        </div>
    </div>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>




<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.5/css/bootstrap-colorpicker.min.css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.5/js/bootstrap-colorpicker.min.js"></script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>

<?php $__env->startPush('crud_fields_scripts'); ?>
<script type="text/javascript">
    jQuery('document').ready(function($){
        //https://itsjaviaguilar.com/bootstrap-colorpicker/
        var config = jQuery.extend({}, <?php echo isset($field['color_picker_options']) ? json_encode($field['color_picker_options']) : '{}'; ?>);
        var picker = $('[name="<?php echo e($field['name']); ?>"]').parents('.colorpicker-component').colorpicker(config);
        $('[name="<?php echo e($field['name']); ?>"]').on('focus', function(){
            picker.colorpicker('show');
        });
    })
</script>
<?php $__env->stopPush(); ?>



