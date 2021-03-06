<!-- number input -->
<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label for="<?php echo e($field['name']); ?>"><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if(isset($field['prefix']) || isset($field['suffix'])): ?> <div class="input-group"> <?php endif; ?>
        <?php if(isset($field['prefix'])): ?> <div class="input-group-addon"><?php echo $field['prefix']; ?></div> <?php endif; ?>
        <input
        	type="number"
        	name="<?php echo e($field['name']); ?>"
            id="<?php echo e($field['name']); ?>"
            value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	>
        <?php if(isset($field['suffix'])): ?> <div class="input-group-addon"><?php echo $field['suffix']; ?></div> <?php endif; ?>

    <?php if(isset($field['prefix']) || isset($field['suffix'])): ?> </div> <?php endif; ?>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>
