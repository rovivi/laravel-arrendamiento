
<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- load the view from type and view_namespace attribute if set -->
    <?php
        $fieldsViewNamespace = $field['view_namespace'] ?? 'crud::fields';
    ?>

    <?php echo $__env->make($fieldsViewNamespace.'.'.$field['type'], ['field' => $field], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>