<!-- text input -->

<?php

// the field should work whether or not Laravel attribute casting is used
if (isset($field['value']) && (is_array($field['value']) || is_object($field['value']))) {
    $field['value'] = json_encode($field['value']);
}

?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="hidden" value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>" name="<?php echo e($field['name']); ?>">

    <?php if(isset($field['prefix']) || isset($field['suffix'])): ?> <div class="input-group"> <?php endif; ?>
        <?php if(isset($field['prefix'])): ?> <div class="input-group-addon"><?php echo $field['prefix']; ?></div> <?php endif; ?>
        <?php if(isset($field['store_as_json']) && $field['store_as_json']): ?>
        <input
            type="text"
            data-address="{&quot;field&quot;: &quot;<?php echo e($field['name']); ?>&quot;, &quot;full&quot;: <?php echo e(isset($field['store_as_json']) && $field['store_as_json'] ? 'true' : 'false'); ?> }"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        >
        <?php else: ?>
        <input
            type="text"
            data-address="{&quot;field&quot;: &quot;<?php echo e($field['name']); ?>&quot;, &quot;full&quot;: <?php echo e(isset($field['store_as_json']) && $field['store_as_json'] ? 'true' : 'false'); ?> }"
            name="<?php echo e($field['name']); ?>"
            value="<?php echo e(old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ))); ?>"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        >
        <?php endif; ?>
        <?php if(isset($field['suffix'])): ?> <div class="input-group-addon"><?php echo $field['suffix']; ?></div> <?php endif; ?>
    <?php if(isset($field['prefix']) || isset($field['suffix'])): ?> </div> <?php endif; ?>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>






<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <style>
            .ap-input-icon.ap-icon-pin {
                right: 5px !important; }
            .ap-input-icon.ap-icon-clear {
                right: 10px !important; }
        </style>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.11.0"></script>
    <script>
        jQuery(document).ready(function($){
            window.AlgoliaPlaces = window.AlgoliaPlaces || {};

            $('[data-address]').each(function(){

                var $this      = $(this),
                $addressConfig = $this.data('address'),
                $field = $('[name="'+$addressConfig.field+'"]'),
                $place = places({
                    container: $this[0]
                });

                function clearInput() {
                    if( !$this.val().length ){
                        $field.val('');
                    }
                }

                if( $addressConfig.full ){

                    $place.on('change', function(e){
                        var result = JSON.parse(JSON.stringify(e.suggestion));
                        delete(result.highlight); delete(result.hit); delete(result.hitIndex);
                        delete(result.rawAnswer); delete(result.query);
                        $field.val( JSON.stringify(result) );
                    });

                    $this.on('change blur', clearInput);
                    $place.on('clear', clearInput);

                    if( $field.val().length ){
                        var existingData = JSON.parse($field.val());
                        $this.val(existingData.value);
                    }
                }

                window.AlgoliaPlaces[ $addressConfig.field ] = $place;
            });
        });
    </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


