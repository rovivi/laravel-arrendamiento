<?php
    $horizontalTabs = $crud->getTabsType()=='horizontal' ? true : false;
?>

<?php $__env->startPush('crud_fields_styles'); ?>
    <style>
        .nav-tabs-custom {
            box-shadow: none;
        }
        .nav-tabs-custom > .nav-tabs.nav-stacked > li {
            margin-right: 0;
        }

        .tab-pane .form-group h1:first-child,
        .tab-pane .form-group h2:first-child,
        .tab-pane .form-group h3:first-child {
            margin-top: 0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php if($crud->getFieldsWithoutATab()->filter(function ($value, $key) { return $value['type'] != 'hidden'; })->count()): ?>
<div class="box p-t-20">
    <div class="box-body">
    <?php echo $__env->make('crud::inc.show_fields', ['fields' => $crud->getFieldsWithoutATab()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>
<?php else: ?>
    <?php echo $__env->make('crud::inc.show_fields', ['fields' => $crud->getFieldsWithoutATab()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<div class="tab-container <?php echo e($horizontalTabs ? 'col-xs-12' : 'col-xs-3 m-t-10'); ?>">

    <div class="nav-tabs-custom" id="form_tabs">
        <ul class="nav <?php echo e($horizontalTabs ? 'nav-tabs' : 'nav-stacked nav-pills'); ?>" role="tablist">
            <?php $__currentLoopData = $crud->getTabs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li role="presentation" class="<?php echo e($k == 0 ? 'active' : ''); ?>">
                    <a href="#tab_<?php echo e(str_slug($tab, "")); ?>" aria-controls="tab_<?php echo e(str_slug($tab, "")); ?>" role="tab" tab_name="<?php echo e(str_slug($tab, "")); ?>" data-toggle="tab" class="tab_toggler"><?php echo e($tab); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

</div>

<div class="tab-content box <?php echo e($horizontalTabs ? 'col-md-12' : 'col-md-9 m-t-10'); ?>">

    <?php $__currentLoopData = $crud->getTabs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div role="tabpanel" class="tab-pane<?php echo e($k == 0 ? ' active' : ''); ?>" id="tab_<?php echo e(str_slug($tab, "")); ?>">

        <?php echo $__env->make('crud::inc.show_fields', ['fields' => $crud->getTabFields($tab)], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
