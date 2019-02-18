<!-- text input -->
<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	
    <?php if(!empty($field['value'])): ?>
    <div class="well well-sm">
        <?php if(isset($field['disk'])): ?>
        <?php if(isset($field['temporary'])): ?>
            <a target="_blank" href="<?php echo e((asset(\Storage::disk($field['disk'])->temporaryUrl(array_get($field, 'prefix', '').$field['value'], Carbon\Carbon::now()->addMinutes($field['temporary']))))); ?>">
        <?php else: ?>
            <a target="_blank" href="<?php echo e((asset(\Storage::disk($field['disk'])->url(array_get($field, 'prefix', '').$field['value'])))); ?>">
        <?php endif; ?>
        <?php else: ?>
            <a target="_blank" href="<?php echo e((asset(array_get($field, 'prefix', '').$field['value']))); ?>">
        <?php endif; ?>
            <?php echo e($field['value']); ?>

        </a>
    	<a id="<?php echo e($field['name']); ?>_file_clear_button" href="#" class="btn btn-default btn-xs pull-right" title="Clear file"><i class="fa fa-remove"></i></a>
    	<div class="clearfix"></div>
    </div>
    <?php endif; ?>

	
	<input
        type="file"
        id="<?php echo e($field['name']); ?>_file_input"
        name="<?php echo e($field['name']); ?>"
        value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>"
        <?php echo $__env->make('crud::inc.field_attributes', ['default_class' =>  isset($field['value']) && $field['value']!=null?'form-control hidden':'form-control'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    >

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>




    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- no scripts -->
        <script>
	        $("#<?php echo e($field['name']); ?>_file_clear_button").click(function(e) {
	        	e.preventDefault();
	        	$(this).parent().addClass('hidden');

	        	var input = $("#<?php echo e($field['name']); ?>_file_input");
	        	input.removeClass('hidden');
	        	input.attr("value", "").replaceWith(input.clone(true));
	        	// add a hidden input with the same name, so that the setXAttribute method is triggered
	        	$("<input type='hidden' name='<?php echo e($field['name']); ?>' value=''>").insertAfter("#<?php echo e($field['name']); ?>_file_input");
	        });

	        $("#<?php echo e($field['name']); ?>_file_input").change(function() {
	        	console.log($(this).val());
	        	// remove the hidden input, so that the setXAttribute method is no longer triggered
	        	$(this).next("input[type=hidden]").remove();
	        });
        </script>
    <?php $__env->stopPush(); ?>
