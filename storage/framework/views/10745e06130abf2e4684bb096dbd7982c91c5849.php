<!-- PAGE OR LINK field -->
<!-- Used in Backpack\MenuCRUD -->

<?php
    $field['options'] = ['page_link' => trans('backpack::crud.page_link'), 'internal_link' => trans('backpack::crud.internal_link'), 'external_link' => trans('backpack::crud.external_link')];
    $field['allows_null'] = false;
    $page_model = $field['page_model'];
    $active_pages = $page_model::all();
?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="clearfix"></div>

    <div class="col-sm-3">
        <select
            id="page_or_link_select"
            name="<?php echo e($field['name'] ?? 'type'); ?>"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            >

            <?php if(isset($field['allows_null']) && $field['allows_null']==true): ?>
                <option value="">-</option>
            <?php endif; ?>

                <?php if(count($field['options'])): ?>
                    <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"
                            <?php if(isset($field['value']) && $key==$field['value']): ?>
                                 selected
                            <?php endif; ?>
                        ><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
        </select>
    </div>
    <div class="col-sm-9">
        <!-- external link input -->
          <div class="page_or_link_value <?php if (!isset($entry) || $entry->type != 'external_link') {
                echo 'hidden';
} ?>" id="page_or_link_external_link">
            <input
                type="url"
                class="form-control"
                name="link"
                placeholder="<?php echo e(trans('backpack::crud.page_link_placeholder')); ?>"

                <?php if(!isset($entry) || $entry->type!='external_link'): ?>
                    disabled="disabled"
                  <?php endif; ?>

                <?php if(isset($entry) && $entry->type=='external_link' && isset($entry->link) && $entry->link!=''): ?>
                    value="<?php echo e($entry->link); ?>"
                <?php endif; ?>
                >
          </div>
          <!-- internal link input -->
          <div class="page_or_link_value <?php if (!isset($entry) || $entry->type != 'internal_link') {
                echo 'hidden';
} ?>" id="page_or_link_internal_link">
            <input
                type="text"
                class="form-control"
                name="link"
                placeholder="<?php echo e(trans('backpack::crud.internal_link_placeholder', ['url', url(config('backpack.base.route_prefix').'/page')])); ?>"

                <?php if(!isset($entry) || $entry->type!='internal_link'): ?>
                    disabled="disabled"
                  <?php endif; ?>

                <?php if(isset($entry) && $entry->type=='internal_link' && isset($entry->link) && $entry->link!=''): ?>
                    value="<?php echo e($entry->link); ?>"
                <?php endif; ?>
                >
          </div>
          <!-- page slug input -->
          <div class="page_or_link_value <?php if (isset($entry) && $entry->type != 'page_link') {
                echo 'hidden';
} ?>" id="page_or_link_page">
            <select
                class="form-control"
                name="page_id"
                >
                <?php if(!count($active_pages)): ?>
                    <option value="">-</option>
                <?php else: ?>
                    <?php $__currentLoopData = $active_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($page->id); ?>"
                            <?php if(isset($entry) && isset($entry->page_id) && $page->id==$entry->page_id): ?>
                                 selected
                            <?php endif; ?>
                        ><?php echo e($page->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </select>
          </div>
    </div>
    <div class="clearfix"></div>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>

</div>





<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <script>
            jQuery(document).ready(function($) {

                $("#page_or_link_select").change(function(e) {
                    $(".page_or_link_value input").attr('disabled', 'disabled');
                    $(".page_or_link_value select").attr('disabled', 'disabled');
                    $(".page_or_link_value").removeClass("hidden").addClass("hidden");


                    switch($(this).val()) {
                        case 'external_link':
                            $("#page_or_link_external_link input").removeAttr('disabled');
                            $("#page_or_link_external_link").removeClass('hidden');
                            break;

                        case 'internal_link':
                            $("#page_or_link_internal_link input").removeAttr('disabled');
                            $("#page_or_link_internal_link").removeClass('hidden');
                            break;

                        default: // page_link
                            $("#page_or_link_page select").removeAttr('disabled');
                            $("#page_or_link_page").removeClass('hidden');
                    }
                });

            });
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


