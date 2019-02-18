
<?php
$checkValue = data_get($entry, $column['name']);

$checkedIcon = data_get($column, 'icons.checked', 'fa-check-square-o');
$uncheckedIcon = data_get($column, 'icons.unchecked', 'fa-square-o');

$exportCheckedText = data_get($column, 'labels.checked', 'Yes');
$exportUncheckedText = data_get($column, 'labels.unchecked', 'No');

$icon = $checkValue == false ? $uncheckedIcon : $checkedIcon;
$text = $checkValue == false ? $exportUncheckedText : $exportCheckedText;
?>

<span>
    <i class="fa <?php echo e($icon); ?>"></i>
</span>

<span class="hidden"><?php echo e($text); ?></span>
