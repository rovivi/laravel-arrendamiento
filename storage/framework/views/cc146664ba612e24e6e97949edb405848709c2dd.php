<?php $__env->startSection('header'); ?>
    <section class="content-header">
      <h1>
        <?php echo e(trans('backpack::logmanager.log_manager')); ?><small><?php echo e(trans('backpack::logmanager.log_manager_description')); ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="<?php echo e(url(config('backpack.base.route_prefix'),'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
      <li><a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log')); ?>"><?php echo e(trans('backpack::logmanager.log_manager')); ?></a></li>
      <li class="active"><?php echo e(trans('backpack::logmanager.preview')); ?></li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <a href="<?php echo e(url(config('backpack.base.route_prefix', 'admin').'/log')); ?>"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('backpack::logmanager.back_to_all_logs')); ?></a><br><br>
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <h3><?php echo e($file_name); ?>:</h3>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="panel panel-<?php echo e($log['level_class']); ?>">
              <div class="panel-heading" role="tab" id="heading<?php echo e($key); ?>">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo e($key); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($key); ?>">
                    <i class="fa fa-<?php echo e($log['level_img']); ?>"></i>
                    <span>[<?php echo e($log['date']); ?>]</span>
                    <?php echo e(str_limit($log['text'], 150)); ?>

                  </a>
                </h4>
              </div>
              <div id="collapse<?php echo e($key); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo e($key); ?>">
                <div class="panel-body">
                  <p><?php echo e($log['text']); ?></p>
                  <pre>
                    <?php echo e(trim($log['stack'])); ?>

                  </pre>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h3 class="text-center">No Logs to display.</h3>
          <?php endif; ?>
        </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>