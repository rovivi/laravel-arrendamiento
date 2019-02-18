
<li filter-name="<?php echo e($filter->name); ?>"
	filter-type="<?php echo e($filter->type); ?>"
	class="dropdown <?php echo e(Request::get($filter->name)?'active':''); ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($filter->label); ?> <span class="caret"></span></a>
    <div class="dropdown-menu padding-10">

			<div class="form-group backpack-filter m-b-0">
					<?php
						$from = '';
						$to = '';
						if($filter->currentValue) {
							$range = (array)json_decode($filter->currentValue);
							$from = $range['from'];
							$to = $range['to'];
						}
					?>
					<div class="input-group">
				        <input class="form-control pull-right from"
				        		type="number"
									<?php if($from): ?>
										value = "<?php echo e($from); ?>"
									<?php endif; ?>
									<?php if(array_key_exists('label_from', $filter->options)): ?>
										placeholder = "<?php echo e($filter->options['label_from']); ?>"
									<?php else: ?>
										placeholder = "min value"
									<?php endif; ?>
				        		>
								<input class="form-control pull-right to"
				        		type="number"
									<?php if($to): ?>
										value = "<?php echo e($to); ?>"
									<?php endif; ?>
									<?php if(array_key_exists('label_to', $filter->options)): ?>
										placeholder = "<?php echo e($filter->options['label_to']); ?>"
									<?php else: ?>
										placeholder = "max value"
									<?php endif; ?>
				        		>
				        <div class="input-group-addon range-filter-<?php echo e(str_slug($filter->name)); ?>-clear-button">
				          <a class="" href=""><i class="fa fa-times"></i></a>
				        </div>
				    </div>
			</div>
    </div>
  </li>








    








<?php $__env->startPush('crud_list_scripts'); ?>
	<script>
		jQuery(document).ready(function($) {
			$("li[filter-name=<?php echo e($filter->name); ?>] .from, li[filter-name=<?php echo e($filter->name); ?>] .to").change(function(e) {
				e.preventDefault();
				var from = $("li[filter-name=<?php echo e($filter->name); ?>] .from").val();
				var to = $("li[filter-name=<?php echo e($filter->name); ?>] .to").val();
				if (from || to) {
					var range = {
						'from': from,
						'to': to
					};
					var value = JSON.stringify(range);
				} else {
					//this change to empty string,because addOrUpdateUriParameter method just judgment string
					var value = '';
				}
				var parameter = '<?php echo e($filter->name); ?>';

				// behaviour for ajax table
				var ajax_table = $('#crudTable').DataTable();
				var current_url = ajax_table.ajax.url();
				var new_url = addOrUpdateUriParameter(current_url, parameter, value);

				// replace the datatables ajax url with new_url and reload it
				new_url = normalizeAmpersand(new_url.toString());
				ajax_table.ajax.url(new_url).load();

				// add filter to URL
				crud.updateUrl(new_url);

				// mark this filter as active in the navbar-filters
				if (URI(new_url).hasQuery('<?php echo e($filter->name); ?>', true)) {
					$('li[filter-name=<?php echo e($filter->name); ?>]').removeClass('active').addClass('active');
				}
			});

			$('li[filter-name=<?php echo e($filter->name); ?>]').on('filter:clear', function(e) {
				$('li[filter-name=<?php echo e($filter->name); ?>]').removeClass('active');
				$("li[filter-name=<?php echo e($filter->name); ?>] .from").val("");
				$("li[filter-name=<?php echo e($filter->name); ?>] .to").val("");
				$("li[filter-name=<?php echo e($filter->name); ?>] .to").trigger('change');
			});

			// range clear button
			$(".range-filter-<?php echo e(str_slug($filter->name)); ?>-clear-button").click(function(e) {
				e.preventDefault();

				$('li[filter-name=<?php echo e(str_slug($filter->name)); ?>]').trigger('filter:clear');
			})

		});
	</script>
<?php $__env->stopPush(); ?>



