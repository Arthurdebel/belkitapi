<!DOCTYPE html>

<html
  lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="<?php echo e(in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr'); ?>"
  data-skin="default"
  data-assets-path="<?php echo e(asset('/')); ?>"
  data-template="vuexy-magd"
  data-bs-theme="light">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo e($title); ?> | <?php echo e(config('config.site_name')); ?></title>
    <link rel="icon" href="<?php echo e(asset('img/favicon/favicon.ico')); ?>" type="image/png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo e(asset('vendor/fonts/iconify-icons.css')); ?>?v2" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/node-waves/node-waves.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/pickr/pickr-themes.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/default.css')); ?>" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />

    <!-- endbuild -->
	
	<link rel="stylesheet" href="<?php echo e(asset('vendor/libs/apex-charts/apex-charts.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/libs/swiper/swiper.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('vendor/libs/notyf/notyf.css')); ?>" />

    <!-- Page CSS -->
	<link rel="stylesheet" href="<?php echo e(asset('vendor/css/pages/cards-advance.css')); ?>" />

    <!-- Helpers -->
    <script src="<?php echo e(asset('vendor/js/helpers.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/js/template-customizer.js')); ?>"></script>

    <script src="<?php echo e(asset('js/config.js')); ?>"></script>
	
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
		<?php if (isset($component)) { $__componentOriginal91c821ac63991f310c0b8692f4f16f0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91c821ac63991f310c0b8692f4f16f0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.aside','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91c821ac63991f310c0b8692f4f16f0a)): ?>
<?php $attributes = $__attributesOriginal91c821ac63991f310c0b8692f4f16f0a; ?>
<?php unset($__attributesOriginal91c821ac63991f310c0b8692f4f16f0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91c821ac63991f310c0b8692f4f16f0a)): ?>
<?php $component = $__componentOriginal91c821ac63991f310c0b8692f4f16f0a; ?>
<?php unset($__componentOriginal91c821ac63991f310c0b8692f4f16f0a); ?>
<?php endif; ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Header -->
		  <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
		  <!-- / Header -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
		  
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <?php echo e($slot); ?>

            </div>
            <!-- / Content -->
			
			<?php if (isset($component)) { $__componentOriginal28174ed9fa6cdc4e8c05e1ad52ee0759 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal28174ed9fa6cdc4e8c05e1ad52ee0759 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.notify','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal28174ed9fa6cdc4e8c05e1ad52ee0759)): ?>
<?php $attributes = $__attributesOriginal28174ed9fa6cdc4e8c05e1ad52ee0759; ?>
<?php unset($__attributesOriginal28174ed9fa6cdc4e8c05e1ad52ee0759); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal28174ed9fa6cdc4e8c05e1ad52ee0759)): ?>
<?php $component = $__componentOriginal28174ed9fa6cdc4e8c05e1ad52ee0759; ?>
<?php unset($__componentOriginal28174ed9fa6cdc4e8c05e1ad52ee0759); ?>
<?php endif; ?>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , <?php echo e(config('config.footer_name')); ?>

                  </div>
                  <div class="d-none d-lg-inline-block">
                    <?php echo config('config.footer_copyright'); ?>

                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="<?php echo e(asset('vendor/libs/jquery/jquery.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/libs/node-waves/node-waves.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/@algolia/autocomplete-js.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/pickr/pickr.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/libs/hammer/hammer.js')); ?>"></script>
	
    <script src="<?php echo e(asset('vendor/js/menu.js')); ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
	
	<script src="<?php echo e(asset('vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
	<script src="<?php echo e(asset('vendor/libs/notyf/notyf.js')); ?>"></script>
	<script>var notyf = new Notyf({duration: 3000,position: {x: 'right',y: 'top',}});</script>

    <!-- Main JS -->
	<script>
		let Translate = {};
		Translate.placeholder = '<?php echo e(__("Search [CTRL + K]")); ?>';
		Translate.no_result = '<?php echo e(__("No results found")); ?>';
	</script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>

    <!-- Page JS -->
	<script src="<?php echo e(asset('js/dashboards-analytics.js')); ?>"></script>
	
		<script>
	if (typeof TemplateCustomizer !== 'undefined') {
		TemplateCustomizer.LANGUAGES.<?php echo e(str_replace('_', '-', app()->getLocale())); ?> = {
			panel_header: '<?php echo e(__("Template Customizer")); ?>',
			panel_sub_header: '<?php echo e(__("Customize and preview in real time")); ?>',
			theming_header: '<?php echo e(__("Theming")); ?>',
			color_label: '<?php echo e(__("Primary Color")); ?>',
			theme_label: '<?php echo e(__("Theme")); ?>',
			skin_label: '<?php echo e(__("Skins")); ?>',
			semiDark_label: '<?php echo e(__("Semi Dark")); ?>',
			layout_header: '<?php echo e(__("Layout")); ?>',
			layout_label: '<?php echo e(__("Menu (Navigation)")); ?>',
			layout_header_label: '<?php echo e(__("Header Types")); ?>',
			content_label: '<?php echo e(__("Content")); ?>',
			layout_navbar_label: '<?php echo e(__("Navbar Type")); ?>',
			direction_label: '<?php echo e(__("Direction")); ?>'
		};
	  window.templateCustomizer = new TemplateCustomizer({
		displayCustomizer: true,
		lang: '<?php echo e(str_replace('_', '-', app()->getLocale())); ?>',
		controls: [
		  'color',
		  'theme',
		  'semiDark',
		  'layoutCollapsed',
		  'layoutNavbarOptions',
		  'headerType',
		]
	  });
	}
	</script>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/components/layout-dashboard.blade.php ENDPATH**/ ?>