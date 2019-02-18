<?php $__env->startSection('content'); ?>
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center m-b-20"><?php echo e(trans('backpack::base.login')); ?></h3>
            <div class="box">
                <div class="box-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="<?php echo e(route('backpack.auth.login')); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group<?php echo e($errors->has($username) ? ' has-error' : ''); ?>">
                            <label class="control-label"><?php echo e(config('backpack.base.authentication_column_name')); ?></label>

                            <div>
                                <input type="text" class="form-control" name="<?php echo e($username); ?>" value="<?php echo e(old($username)); ?>">

                                <?php if($errors->has($username)): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first($username)); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label class="control-label"><?php echo e(trans('backpack::base.password')); ?></label>

                            <div>
                                <input type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> <?php echo e(trans('backpack::base.remember_me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    <?php echo e(trans('backpack::base.login')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if(backpack_users_have_email()): ?>
                <div class="text-center m-t-10"><a href="<?php echo e(route('backpack.auth.password.reset')); ?>"><?php echo e(trans('backpack::base.forgot_your_password')); ?></a></div>
            <?php endif; ?>
            <?php if(config('backpack.base.registration_open')): ?>
                <div class="text-center m-t-10"><a href="<?php echo e(route('backpack.auth.register')); ?>"><?php echo e(trans('backpack::base.register')); ?></a></div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>