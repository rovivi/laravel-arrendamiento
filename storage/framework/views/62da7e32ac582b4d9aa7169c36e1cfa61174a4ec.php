<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <?php if(backpack_auth()->check()): ?>
            <!-- Topbar. Contains the left part -->
            <?php echo $__env->make('backpack::inc.topbar_left_content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

    <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu pull-right">
    <ul class="nav navbar-nav">
        <!-- ========================================================= -->
        <!-- ========= Top menu right items (ordered right) ========== -->
        <!-- ========================================================= -->

        <?php if(config('backpack.base.setup_auth_routes')): ?>
            <?php if(backpack_auth()->guest()): ?>
                <li>
                    <a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/login')); ?>"><?php echo e(trans('backpack::base.login')); ?></a>
                </li>
                <?php if(config('backpack.base.registration_open')): ?>
                    <li><a href="<?php echo e(route('backpack.auth.register')); ?>"><?php echo e(trans('backpack::base.register')); ?></a></li>
                <?php endif; ?>
            <?php else: ?>
                <!-- Topbar. Contains the right part -->
                <?php echo $__env->make('backpack::inc.topbar_right_content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <li><a href="<?php echo e(route('backpack.auth.logout')); ?>"><i class="fa fa-btn fa-sign-out"></i> <?php echo e(trans('backpack::base.logout')); ?></a></li>
            <?php endif; ?>
        <?php endif; ?>
        <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
