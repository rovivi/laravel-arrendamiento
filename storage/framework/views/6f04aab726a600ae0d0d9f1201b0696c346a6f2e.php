<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
        <span class="text-capitalize"><?php echo $crud->getHeading() ?? $crud->entity_name_plural; ?></span>
        <small><?php echo $crud->getSubheading() ?? trans('backpack::crud.add').' '.$crud->entity_name; ?>.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix'), 'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
	    <li><a href="<?php echo e(url($crud->route)); ?>" class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></a></li>
	    <li class="active"><?php echo e(trans('backpack::crud.add')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if($crud->hasAccess('list')): ?>
	<a href="<?php echo e(starts_with(URL::previous(), url($crud->route)) ? URL::previous() : url($crud->route)); ?>" class="hidden-print"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('backpack::crud.back_to_all')); ?> <span><?php echo e($crud->entity_name_plural); ?></span></a>
<?php endif; ?>

<div class="row m-t-20">
	<div class="<?php echo e($crud->getCreateContentClass()); ?>">
		<!-- Default box -->

		<?php echo $__env->make('crud::inc.grouped_errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		  <form method="post"
		  		action="<?php echo e(url($crud->route)); ?>"
				<?php if($crud->hasUploadFields('create')): ?>
				enctype="multipart/form-data"
				<?php endif; ?>
		  		>
		  <?php echo csrf_field(); ?>

		  <div class="col-md-12">

		    <div class="row display-flex-wrap">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      <?php if(view()->exists('vendor.backpack.crud.form_content')): ?>
		      	<?php echo $__env->make('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		      <?php else: ?>
		      	<?php echo $__env->make('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		      <?php endif; ?>
		    </div><!-- /.box-body -->
		    <div class="">

                <?php echo $__env->make('crud::inc.form_save_buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		    </div><!-- /.box-footer-->

		  </div><!-- /.box -->
		  </form>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>