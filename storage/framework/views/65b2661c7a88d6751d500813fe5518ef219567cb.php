<?php if($crud->hasAccess('delete') && $crud->bulk_actions): ?>
	<a href="javascript:void(0)" onclick="bulkDeleteEntries(this)" class="btn btn-default btn-sm bulk-button"><i class="fa fa-trash"></i> <?php echo e(trans('backpack::crud.delete')); ?></a>
<?php endif; ?>

<?php $__env->startPush('after_scripts'); ?>
<script>
	if (typeof bulkDeleteEntries != 'function') {
	  function bulkDeleteEntries(button) {

	      if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
	      {
	      	new PNotify({
	              title: "<?php echo e(trans('backpack::crud.bulk_no_entries_selected_title')); ?>",
	              text: "<?php echo e(trans('backpack::crud.bulk_no_entries_selected_message')); ?>",
	              type: "warning"
	          });

	      	return;
	      }

	      var message = ("<?php echo e(trans('backpack::crud.bulk_delete_are_you_sure')); ?>").replace(":number", crud.checkedItems.length);
	      var button = $(this);

	      // show confirm message
	      if (confirm(message) == true) {
	      	  var ajax_calls = [];
      		  var delete_route = "<?php echo e(url($crud->route)); ?>/bulk-delete";

	      	  // submit an AJAX delete call
      		  $.ajax({
	              url: delete_route,
	              type: 'DELETE',
				  data: { entries: crud.checkedItems },
	              success: function(result) {
	                  // Show an alert with the result
	                  new PNotify({
	                      title: ("<?php echo e(trans('backpack::crud.bulk_delete_sucess_title')); ?>"),
	                      text: crud.checkedItems.length+"<?php echo e(trans('backpack::crud.bulk_delete_sucess_message')); ?>",
	                      type: "success"
	                  });

	                  crud.checkedItems = [];
			      	  crud.table.ajax.reload();
	              },
	              error: function(result) {
	                  // Show an alert with the result
	                  new PNotify({
	                      title: "<?php echo e(trans('backpack::crud.bulk_delete_error_title')); ?>",
	                      text: "<?php echo e(trans('backpack::crud.bulk_delete_error_message')); ?>",
	                      type: "warning"
	                  });
	              }
	          });
	      }
      }
	}
</script>
<?php $__env->stopPush(); ?>