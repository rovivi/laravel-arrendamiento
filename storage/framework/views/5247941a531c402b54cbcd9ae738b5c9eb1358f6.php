<?php
$required = (isset($field['attributes']['required']) || (isset($action) && $crud->isRequired($field['name'], $action))) ? ' required' : '';
?>

<?php if(isset($field['wrapperAttributes'])): ?>
    <?php if(!isset($field['wrapperAttributes']['class'])): ?>
        class="form-group col-xs-12 <?php echo e($required); ?>"
    <?php else: ?>
        class="<?php echo e($field['wrapperAttributes']['class']); ?> <?php echo e($required); ?>"
    <?php endif; ?>

    <?php 
        unset($field['wrapperAttributes']['class']);
    ?>

    <?php $__currentLoopData = $field['wrapperAttributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_string($attribute)): ?>
            <?php echo e($attribute); ?>="<?php echo e($value); ?>"
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    class="form-group col-xs-12<?php echo e($required); ?>"
<?php endif; ?>
