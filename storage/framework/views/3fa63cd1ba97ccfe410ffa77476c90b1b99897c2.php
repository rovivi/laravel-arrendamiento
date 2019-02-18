<!-- checkbox field -->

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="checkbox">
    	<label>
    	  <input type="hidden" name="<?php echo e($field['name']); ?>" value="0">
    	  <input type="checkbox" value="1"

          name="<?php echo e($field['name']); ?>"

          <?php if(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false): ?>
                 checked="checked"
          <?php endif; ?>

          <?php if(isset($field['attributes'])): ?>
              <?php $__currentLoopData = $field['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			<?php echo e($attribute); ?>="<?php echo e($value); ?>"
        	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          > <?php echo $field['label']; ?>

    	</label>

        
        <?php if(isset($field['hint'])): ?>
            <p class="help-block"><?php echo $field['hint']; ?></p>
        <?php endif; ?>
    </div>
</div>
