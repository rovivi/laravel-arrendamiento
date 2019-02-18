<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
        <span class="text-capitalize"><?php echo $crud->getHeading() ?? $crud->entity_name_plural; ?></span>
        <small><?php echo $crud->getSubheading() ?? trans('backpack::crud.edit').' '.$crud->entity_name; ?>.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix'),'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
	    <li><a href="<?php echo e(url($crud->route)); ?>" class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></a></li>
	    <li class="active"><?php echo e(trans('backpack::crud.edit')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if($crud->hasAccess('list')): ?>
	<a href="<?php echo e(starts_with(URL::previous(), url($crud->route)) ? URL::previous() : url($crud->route)); ?>" class="hidden-print"><i class="fa fa-angle-double-left"></i> <?php echo e(trans('backpack::crud.back_to_all')); ?> <span><?php echo e($crud->entity_name_plural); ?></span></a>
<?php endif; ?>

<div class="row m-t-20">
	<div class="<?php echo e($crud->getEditContentClass()); ?>">
		<!-- Default box -->

		<?php echo $__env->make('crud::inc.grouped_errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		  <form method="post"
		  		action="<?php echo e(url($crud->route.'/'.$entry->getKey())); ?>"
				<?php if($crud->hasUploadFields('update', $entry->getKey())): ?>
				enctype="multipart/form-data"
				<?php endif; ?>
		  		>
		  <?php echo csrf_field(); ?>

		  <?php echo method_field('PUT'); ?>

		  <div class="col-md-12">
		  	<?php if($crud->model->translationEnabled()): ?>
		    <div class="row m-b-10">
		    	<!-- Single button -->
				<div class="btn-group pull-right">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <?php echo e(trans('backpack::crud.language')); ?>: <?php echo e($crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()]); ?> &nbsp; <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  	<?php $__currentLoopData = $crud->model->getAvailableLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  	<li><a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/edit')); ?>?locale=<?php echo e($key); ?>"><?php echo e($locale); ?></a></li>
				  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  </ul>
				</div>
		    </div>
		    <?php endif; ?>
		    <div class="row display-flex-wrap">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      <?php if(view()->exists('vendor.backpack.crud.form_content')): ?>
		      	<?php echo $__env->make('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		      <?php else: ?>
		      	<?php echo $__env->make('crud::form_content', ['fields' => $fields, 'action' => 'edit'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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