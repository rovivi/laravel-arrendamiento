<input type="hidden" name="http_referrer" value=<?php echo e(old('http_referrer') ?? \URL::previous() ?? url($crud->route)); ?>>

<?php if($crud->model->translationEnabled()): ?>
<input type="hidden" name="locale" value=<?php echo e($crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()); ?>>
<?php endif; ?>


<?php if($crud->tabsEnabled() && count($crud->getTabs())): ?>
    <?php echo $__env->make('crud::inc.show_tabbed_fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="hidden" name="current_tab" value="<?php echo e(str_slug($crud->getTabs()[0], "")); ?>" />
<?php else: ?>
    <div class="box col-md-12 padding-10 p-t-20">
    <?php echo $__env->make('crud::inc.show_fields', ['fields' => $fields], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php endif; ?>



<?php $__env->startSection('after_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/crud.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/form.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/backpack/crud/css/'.$action.'.css')); ?>">

    <!-- CRUD FORM CONTENT - crud_fields_styles stack -->
    <?php echo $__env->yieldPushContent('crud_fields_styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
    <script src="<?php echo e(asset('vendor/backpack/crud/js/crud.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/backpack/crud/js/form.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/backpack/crud/js/'.$action.'.js')); ?>"></script>

    <!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
    <?php echo $__env->yieldPushContent('crud_fields_scripts'); ?>

    <script>
    jQuery('document').ready(function($){

      // Save button has multiple actions: save and exit, save and edit, save and new
      var saveActions = $('#saveActions'),
      crudForm        = saveActions.parents('form'),
      saveActionField = $('[name="save_action"]');

      saveActions.on('click', '.dropdown-menu a', function(){
          var saveAction = $(this).data('value');
          saveActionField.val( saveAction );
          crudForm.submit();
      });

      // Ctrl+S and Cmd+S trigger Save button click
      $(document).keydown(function(e) {
          if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
          {
              e.preventDefault();
              // alert("Ctrl-s pressed");
              $("button[type=submit]").trigger('click');
              return false;
          }
          return true;
      });

      // prevent duplicate entries on double-clicking the submit form
      crudForm.submit(function (event) {
        $("button[type=submit]").prop('disabled', true);
      });

      // Place the focus on the first element in the form
      <?php if( $crud->autoFocusOnFirstField ): ?>
        <?php
          $focusField = array_first($fields, function($field) {
              return isset($field['auto_focus']) && $field['auto_focus'] == true;
          });
        ?>

        <?php if($focusField): ?>
        <?php
        $focusFieldName = !is_iterable($focusField['value']) ? $focusField['name'] : ($focusField['name'] . '[]');
        ?>
          window.focusField = $('[name="<?php echo e($focusFieldName); ?>"]').eq(0),
        <?php else: ?>
          var focusField = $('form').find('input, textarea, select').not('[type="hidden"]').eq(0),
        <?php endif; ?>

        fieldOffset = focusField.offset().top,
        scrollTolerance = $(window).height() / 2;

        focusField.trigger('focus');

        if( fieldOffset > scrollTolerance ){
            $('html, body').animate({scrollTop: (fieldOffset - 30)});
        }
      <?php endif; ?>

      // Add inline errors to the DOM
      <?php if($crud->inlineErrorsEnabled() && $errors->any()): ?>

        window.errors = <?php echo json_encode($errors->messages()); ?>;
        // console.error(window.errors);

        $.each(errors, function(property, messages){

            var normalizedProperty = property.split('.').map(function(item, index){
                    return index === 0 ? item : '['+item+']';
                }).join('');

            var field = $('[name="' + normalizedProperty + '[]"]').length ?
                        $('[name="' + normalizedProperty + '[]"]') :
                        $('[name="' + normalizedProperty + '"]'),
                        container = field.parents('.form-group');

            container.addClass('has-error');

            $.each(messages, function(key, msg){
                // highlight the input that errored
                var row = $('<div class="help-block">' + msg + '</div>');
                row.appendTo(container);

                // highlight its parent tab
                <?php if($crud->tabsEnabled()): ?>
                var tab_id = $(container).parent().attr('id');
                $("#form_tabs [aria-controls="+tab_id+"]").addClass('text-red');
                <?php endif; ?>
            });
        });

      <?php endif; ?>

      $("a[data-toggle='tab']").click(function(){
          currentTabName = $(this).attr('tab_name');
          $("input[name='current_tab']").val(currentTabName);
      });

      });
    </script>
<?php $__env->stopSection(); ?>
