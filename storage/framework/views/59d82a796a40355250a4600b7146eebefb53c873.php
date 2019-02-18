<div class="user-panel">
  <a class="pull-left image" href="<?php echo e(route('backpack.account.info')); ?>">
    <img src="<?php echo e(backpack_avatar_url(backpack_auth()->user())); ?>" class="img-circle" alt="User Image">
  </a>
  <div class="pull-left info">
    <p><a href="<?php echo e(route('backpack.account.info')); ?>"><?php echo e(backpack_auth()->user()->name); ?></a></p>
    <small><small><a href="<?php echo e(route('backpack.account.info')); ?>"><span><i class="fa fa-user-circle-o"></i> <?php echo e(trans('backpack::base.my_account')); ?></span></a> &nbsp;  &nbsp; <a href="<?php echo e(backpack_url('logout')); ?>"><i class="fa fa-sign-out"></i> <span><?php echo e(trans('backpack::base.logout')); ?></span></a></small></small>
  </div>
</div>