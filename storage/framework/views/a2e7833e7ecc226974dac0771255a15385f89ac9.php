

<li filter-name="<?php echo e($filter->name); ?>"
	filter-type="<?php echo e($filter->type); ?>"
	class="dropdown <?php echo e(Request::get($filter->name)?'active':''); ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($filter->label); ?> <span class="caret"></span></a>
    <div class="dropdown-menu">
      <div class="form-group backpack-filter m-b-0">
			<select id="filter_<?php echo e($filter->name); ?>" name="filter_<?php echo e($filter->name); ?>" class="form-control input-sm select2" placeholder="<?php echo e($filter->placeholder); ?>" multiple>
				<option></option>

				<?php if(is_array($filter->values) && count($filter->values)): ?>
					<?php $__currentLoopData = $filter->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key); ?>"
							<?php if($filter->isActive() && json_decode($filter->currentValue) && array_search($key, json_decode($filter->currentValue)) !== false): ?>
								selected
							<?php endif; ?>
							>
							<?php echo e($value); ?>

						</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</select>
		</div>
    </div>
  </li>







<?php $__env->startPush('crud_list_styles'); ?>
    <!-- include select2 css-->
    <link href="<?php echo e(asset('vendor/backpack/select2/select2.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('vendor/backpack/select2/select2-bootstrap-dick.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
	  .form-inline .select2-container {
	    display: inline-block;
	  }
	  .select2-drop-active {
	  	border:none;
	  }
	  .select2-container .select2-choices .select2-search-field input, .select2-container .select2-choice, .select2-container .select2-choices {
	  	border: none;
	  }
	  .select2-container-active .select2-choice {
	  	border: none;
	  	box-shadow: none;
	  }
    </style>
<?php $__env->stopPush(); ?>





<?php $__env->startPush('crud_list_scripts'); ?>
	<!-- include select2 js-->
    <script src="<?php echo e(asset('vendor/backpack/select2/select2.js')); ?>"></script>
    <script>
        jQuery(document).ready(function($) {
            // trigger select2 for each untriggered select2 box
            $('.select2').each(function (i, obj) {
                if (!$(obj).data("select2"))
                {
                    $(obj).select2({
                    	allowClear: true,
    					closeOnSelect: false
                    });
                }
            });
        });
    </script>

    <script>
		jQuery(document).ready(function($) {
			$("select[name=filter_<?php echo e($filter->name); ?>]").change(function() {
                var value = '';
                if ($(this).val() !== null) {
                    // clean array from undefined, null, "".
                    var values = $(this).val().filter(function(e){ return e === 0 || e });
                    // stringify only if values is not empty. otherwise it will be '[]'.
                    value = values.length !== 0 ? JSON.stringify(values) : '';
                }

				var parameter = '<?php echo e($filter->name); ?>';

		    	// behaviour for ajax table
				var ajax_table = $("#crudTable").DataTable();
				var current_url = ajax_table.ajax.url();
				var new_url = addOrUpdateUriParameter(current_url, parameter, value);

				// replace the datatables ajax url with new_url and reload it
				new_url = normalizeAmpersand(new_url.toString());
				ajax_table.ajax.url(new_url).load();

				// add filter to URL
				crud.updateUrl(new_url);

				// mark this filter as active in the navbar-filters
				if (URI(new_url).hasQuery('<?php echo e($filter->name); ?>', true)) {
					$("li[filter-name=<?php echo e($filter->name); ?>]").removeClass('active').addClass('active');
				}
				else
				{
					$("li[filter-name=<?php echo e($filter->name); ?>]").trigger("filter:clear");
				}
			});

			// when the dropdown is opened, autofocus on the select2
			$("li[filter-name=<?php echo e($filter->name); ?>]").on('shown.bs.dropdown', function () {
				$('#filter_<?php echo e($filter->name); ?>').select2('open');
			});

			// clear filter event (used here and by the Remove all filters button)
			$("li[filter-name=<?php echo e($filter->name); ?>]").on('filter:clear', function(e) {
				// console.log('select2 filter cleared');
				$("li[filter-name=<?php echo e($filter->name); ?>]").removeClass('active');
				$("li[filter-name=<?php echo e($filter->name); ?>] .select2").select2("val", "");
			});
		});
	</script>
<?php $__env->stopPush(); ?>

