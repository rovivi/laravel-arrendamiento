
<span data-order="<?php echo e($entry->{$column['name']}); ?>">
    <?php if(!empty($entry->{$column['name']})): ?>
	<?php echo e(Date::parse($entry->{$column['name']})->format(($column['format'] ?? config('backpack.base.default_date_format')))); ?>

    <?php endif; ?>
</span>