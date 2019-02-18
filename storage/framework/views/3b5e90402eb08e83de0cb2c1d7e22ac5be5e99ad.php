<!-- CKeditor -->
<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <textarea
    	id="ckeditor-<?php echo e($field['name']); ?>"
        name="<?php echo e($field['name']); ?>"
        <?php echo $__env->make('crud::inc.field_attributes', ['default_class' => 'form-control'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	><?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?></textarea>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>





<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <script src="<?php echo e(asset('vendor/backpack/ckeditor/ckeditor.js')); ?>"></script>
        <script src="<?php echo e(asset('vendor/backpack/ckeditor/adapters/jquery.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php $__env->startPush('crud_fields_scripts'); ?>
<script>
    jQuery(document).ready(function($) {
        $('#ckeditor-<?php echo e($field['name']); ?>').ckeditor({
            "filebrowserBrowseUrl": "<?php echo e(url(config('backpack.base.route_prefix').'/elfinder/ckeditor')); ?>",
            "extraPlugins" : '<?php echo e(isset($field['extra_plugins']) ? implode(',', $field['extra_plugins']) : 'oembed,widget'); ?>'
            <?php if(isset($field['options']) && count($field['options'])): ?>
                <?php echo ', '.trim(json_encode($field['options']), "{}"); ?>

            <?php endif; ?>
        });
    });
</script>
<?php $__env->stopPush(); ?>



