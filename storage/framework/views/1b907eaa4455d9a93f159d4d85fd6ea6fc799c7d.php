<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('backpack::inc.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="hold-transition <?php echo e(config('backpack.base.skin')); ?> sidebar-mini">
	<script type="text/javascript">
		/* Recover sidebar state */
		(function () {
			if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
				var body = document.getElementsByTagName('body')[0];
				body.className = body.className + ' sidebar-collapse';
			}
		})();
	</script>
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php echo $__env->make('backpack::inc.main_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- =============================================== -->

      <?php echo $__env->make('backpack::inc.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <?php echo $__env->yieldContent('header'); ?>

        <!-- Main content -->
        <section class="content">

          <?php echo $__env->yieldContent('content'); ?>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer text-sm clearfix">
        <?php echo $__env->make('backpack::inc.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </footer>
    </div>
    <!-- ./wrapper -->


    <?php echo $__env->yieldContent('before_scripts'); ?>
    <?php echo $__env->yieldPushContent('before_scripts'); ?>

    <?php echo $__env->make('backpack::inc.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('backpack::inc.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('after_scripts'); ?>
    <?php echo $__env->yieldPushContent('after_scripts'); ?>

    <script>
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
          event.preventDefault();
          if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '');
          } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
          }
        });

        // Set active state on menu element
        var current_url = "<?php echo e(Request::fullUrl()); ?>";
        var full_url = current_url+location.search;
        var $navLinks = $("ul.sidebar-menu li a");
        // First look for an exact match including the search string
        var $curentPageLink = $navLinks.filter(
            function() { return $(this).attr('href') === full_url; }
        );
        // If not found, look for the link that starts with the url
        if(!$curentPageLink.length > 0){
            $curentPageLink = $navLinks.filter(
                function() { return $(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')); }
            );
        }

        $curentPageLink.parents('li').addClass('active');
    </script>

    <!-- JavaScripts -->
    
</body>
</html>
