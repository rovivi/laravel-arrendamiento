<!-- select2 from ajax -->
<?php
    $connected_entity = new $field['model'];
    $connected_entity_key_name = $connected_entity->getKeyName();
    $old_value = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false;
?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php $entity_model = $crud->model; ?>

    <select
        name="<?php echo e($field['name']); ?>"
        style="width: 100%"
        id="select2_ajax_<?php echo e($field['name']); ?>"
        <?php echo $__env->make('crud::inc.field_attributes', ['default_class' =>  'form-control'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        >

        <?php if($old_value): ?>
            <?php
                $item = $connected_entity->find($old_value);
            ?>
            <?php if($item): ?>

            
            <?php if($entity_model::isColumnNullable($field['name'])): ?>
            <option value="" selected>
                <?php echo e($field['placeholder']); ?>

            </option>
            <?php endif; ?>

            <option value="<?php echo e($item->getKey()); ?>" selected>
                <?php echo e($item->{$field['attribute']}); ?>

            </option>
            <?php endif; ?>
        <?php endif; ?>
    </select>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>




<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
    <!-- include select2 css-->
    <link href="<?php echo e(asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <?php if($entity_model::isColumnNullable($field['name'])): ?>
    <style type="text/css">
        .select2-selection__clear::after {
            content: ' <?php echo e(trans('backpack::crud.clear')); ?>';
        }
    </style>
    <?php endif; ?>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
    <!-- include select2 js-->
    <script src="<?php echo e(asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>

<!-- include field specific select2 js-->
<?php $__env->startPush('crud_fields_scripts'); ?>
<script>
    jQuery(document).ready(function($) {
        // trigger select2 for each untriggered select2 box
        $("#select2_ajax_<?php echo e($field['name']); ?>").each(function (i, obj) {
            var form = $(obj).closest('form');

            if (!$(obj).hasClass("select2-hidden-accessible"))
            {
                $(obj).select2({
                    theme: 'bootstrap',
                    multiple: false,
                    placeholder: "<?php echo e($field['placeholder']); ?>",
                    minimumInputLength: "<?php echo e($field['minimum_input_length']); ?>",

                    
                    <?php if($entity_model::isColumnNullable($field['name'])): ?>
                    allowClear: true,
                    <?php endif; ?>
                    ajax: {
                        url: "<?php echo e($field['data_source']); ?>",
                        type: '<?php echo e($field['method'] ?? 'GET'); ?>',
                        dataType: 'json',
                        quietMillis: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page, // pagination
                                form: form.serializeArray()  // all other form inputs
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            var result = {
                                results: $.map(data.data, function (item) {
                                    textField = "<?php echo e($field['attribute']); ?>";
                                    return {
                                        text: item[textField],
                                        id: item["<?php echo e($connected_entity_key_name); ?>"]
                                    }
                                }),
                               pagination: {
                                     more: data.current_page < data.last_page
                               }
                            };

                            return result;
                        },
                        cache: true
                    },
                })
                
                <?php if($entity_model::isColumnNullable($field['name'])): ?>
                .on('select2:unselecting', function(e) {
                    $(this).val('').trigger('change');
                    // console.log('cleared! '+$(this).val());
                    e.preventDefault();
                })
                <?php endif; ?>
                ;

            }
        });

        <?php if(isset($field['dependencies'])): ?>
            <?php $__currentLoopData = array_wrap($field['dependencies']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dependency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                $('input[name=<?php echo e($dependency); ?>], select[name=<?php echo e($dependency); ?>], checkbox[name=<?php echo e($dependency); ?>], radio[name=<?php echo e($dependency); ?>], textarea[name=<?php echo e($dependency); ?>]').change(function () {
                    $("#select2_ajax_<?php echo e($field['name']); ?>").val(null).trigger("change");
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    });
</script>
<?php $__env->stopPush(); ?>


