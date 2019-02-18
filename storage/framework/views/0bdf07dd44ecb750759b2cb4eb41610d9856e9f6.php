<!-- icon picker input -->

<?php
// if no iconset was provided, set the default iconset to Font-Awesome
if (!isset($field['iconset'])) {
    $field['iconset'] = 'fontawesome';
}
?>

<div <?php echo $__env->make('crud::inc.field_wrapper_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> >
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::inc.field_translatable_icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div>
        <button class="btn btn-default " role="iconpicker" data-icon="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>" data-iconset="<?php echo e($field['iconset']); ?>"></button>
        <input
            type="hidden"
            name="<?php echo e($field['name']); ?>"
            value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>"
            <?php echo $__env->make('crud::inc.field_attributes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        >
    </div>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
</div>


<?php if($crud->checkIfFieldIsFirstOfItsType($field)): ?>

    <?php if($field['iconset'] == 'glyphicon'): ?>
        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Glyphicon -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-glyphicon.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'ionicon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Ionicons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/ionicons-1.5.2/css/ionicons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Ionicons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-ionicon-1.5.2.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'weathericon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Weather Icons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/weather-icons-1.2.0/css/weather-icons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Weather Icons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-weathericon-1.2.0.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'mapicon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Map Icons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/map-icons-2.1.0/css/map-icons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Map Icons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-mapicon-2.1.0.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'octicon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Octicons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/octicons-2.1.2/css/octicons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Octicons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-octicon-2.1.2.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'typicon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Typicons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/typicons-2.0.6/css/typicons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Typicons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-typicon-2.0.6.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'elusiveicon'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Elusive Icons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Elusive Icons -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-elusiveicon-2.0.0.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php elseif($field['iconset'] == 'materialdesign'): ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Material Icons -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/material-design-1.1.1/css/material-design-iconic-font.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Material Design -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-materialdesign-1.1.1.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php else: ?>
        <?php $__env->startPush('crud_fields_styles'); ?>
            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/font-awesome-4.2.0/css/font-awesome.min.css')); ?>"/>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('crud_fields_scripts'); ?>
            <!-- Bootstrap-Iconpicker Iconset for Font Awesome -->
            <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- Bootstrap-Iconpicker -->
        <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')); ?>"/>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- Bootstrap-Iconpicker -->
        <script type="text/javascript" src="<?php echo e(asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')); ?>"></script>

        
        <script>
            jQuery(document).ready(function($) {
                $('button[role=iconpicker]').on('change', function(e) {
                    $(this).siblings('input[type=hidden]').val(e.icon);
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>



