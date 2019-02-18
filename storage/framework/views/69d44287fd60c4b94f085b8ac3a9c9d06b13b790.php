<?php $__env->startSection('header'); ?>
	<section class="content-header">
	  <h1>
      <span class="text-capitalize"><?php echo $crud->getHeading() ?? $crud->entity_name_plural; ?></span>
      <small id="datatable_info_stack"><?php echo $crud->getSubheading() ?? trans('backpack::crud.all').'<span>'.$crud->entity_name_plural.'</span> '.trans('backpack::crud.in_the_database'); ?>.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="<?php echo e(url(config('backpack.base.route_prefix'), 'dashboard')); ?>"><?php echo e(trans('backpack::crud.admin')); ?></a></li>
	    <li><a href="<?php echo e(url($crud->route)); ?>" class="text-capitalize"><?php echo e($crud->entity_name_plural); ?></a></li>
	    <li class="active"><?php echo e(trans('backpack::crud.list')); ?></li>
	  </ol>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="<?php echo e($crud->getListContentClass()); ?>">
      <div class="">

        <div class="row m-b-10">
          <div class="col-xs-6">
            <?php if( $crud->buttons->where('stack', 'top')->count() ||  $crud->exportButtons()): ?>
            <div class="hidden-print <?php echo e($crud->hasAccess('create')?'with-border':''); ?>">

              <?php echo $__env->make('crud::inc.button_stack', ['stack' => 'top'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
            <?php endif; ?>
          </div>
          <div class="col-xs-6">
              <div id="datatable_search_stack" class="pull-right"></div>
          </div>
        </div>

        
        <?php if($crud->filtersEnabled()): ?>
          <?php echo $__env->make('crud::inc.filters_navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="overflow-hidden">

        <table id="crudTable" class="box table table-striped table-hover display responsive nowrap m-t-0" cellspacing="0">
            <thead>
              <tr>
                
                <?php $__currentLoopData = $crud->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <th
                    data-orderable="<?php echo e(var_export($column['orderable'], true)); ?>"
                    data-priority="<?php echo e($column['priority']); ?>"
                    data-visible-in-modal="<?php echo e((isset($column['visibleInModal']) && $column['visibleInModal'] == false) ? 'false' : 'true'); ?>"
                    data-visible="<?php echo e(!isset($column['visibleInTable']) ? 'true' : (($column['visibleInTable'] == false) ? 'false' : 'true')); ?>"
                    data-visible-in-export="<?php echo e((isset($column['visibleInExport']) && $column['visibleInExport'] == false) ? 'false' : 'true'); ?>"
                    >
                    <?php echo $column['label']; ?>

                  </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if( $crud->buttons->where('stack', 'line')->count() ): ?>
                  <th data-orderable="false" data-priority="<?php echo e($crud->getActionsColumnPriority()); ?>" data-visible-in-export="false"><?php echo e(trans('backpack::crud.actions')); ?></th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                
                <?php $__currentLoopData = $crud->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <th><?php echo $column['label']; ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if( $crud->buttons->where('stack', 'line')->count() ): ?>
                  <th><?php echo e(trans('backpack::crud.actions')); ?></th>
                <?php endif; ?>
              </tr>
            </tfoot>
          </table>

          <?php if( $crud->buttons->where('stack', 'bottom')->count() ): ?>
          <div id="bottom_buttons" class="hidden-print">
            <?php echo $__env->make('crud::inc.button_stack', ['stack' => 'bottom'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
          </div>
          <?php endif; ?>

        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </div>

  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_styles'); ?>
  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/crud.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/form.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/list.css')); ?>">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  <?php echo $__env->yieldPushContent('crud_list_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<?php echo $__env->make('crud::inc.datatables_logic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script src="<?php echo e(asset('vendor/backpack/crud/js/crud.js')); ?>"></script>
  <script src="<?php echo e(asset('vendor/backpack/crud/js/form.js')); ?>"></script>
  <script src="<?php echo e(asset('vendor/backpack/crud/js/list.js')); ?>"></script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  <?php echo $__env->yieldPushContent('crud_list_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>