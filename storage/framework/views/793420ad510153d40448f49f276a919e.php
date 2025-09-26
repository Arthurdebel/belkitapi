<!DOCTYPE html>

<html
  lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="<?php echo e(in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr'); ?>"
  data-skin="default"
  data-assets-path="<?php echo e(asset_index('/')); ?>/"
  data-template="vuexy-magd"
  data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title><?php echo e(config('config.site_name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset_index('img/favicon/favicon.ico')); ?>">
    <!-- css -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/fonts/iconify-icons.css')); ?>" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/libs/node-waves/node-waves.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/libs/pickr/pickr-themes.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/css/core.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset_index('css/demo.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/css/pages/front-page.css')); ?>" />
    <!-- Vendors CSS -->

    <!-- endbuild -->
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/libs/nouislider/nouislider.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/libs/swiper/swiper.css')); ?>" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?php echo e(asset_index('vendor/css/pages/front-page-landing.css')); ?>" />
    <!-- Helpers -->
    <script src="<?php echo e(asset_index('vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo e(asset_index('vendor/js/template-customizer.js')); ?>"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo e(asset_index('js/front-config.js')); ?>"></script>
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
</head>

<body>
    <?php if (isset($component)) { $__componentOriginalb3e736cbd97dce84339f214192337fea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb3e736cbd97dce84339f214192337fea = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'index::components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('index-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb3e736cbd97dce84339f214192337fea)): ?>
<?php $attributes = $__attributesOriginalb3e736cbd97dce84339f214192337fea; ?>
<?php unset($__attributesOriginalb3e736cbd97dce84339f214192337fea); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb3e736cbd97dce84339f214192337fea)): ?>
<?php $component = $__componentOriginalb3e736cbd97dce84339f214192337fea; ?>
<?php unset($__componentOriginalb3e736cbd97dce84339f214192337fea); ?>
<?php endif; ?>


    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example">
        <?php echo e($slot); ?>

    </div>
    <!-- / Sections:End -->

    <?php if (isset($component)) { $__componentOriginal170118df4e1fb8a1766198f7d923b904 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal170118df4e1fb8a1766198f7d923b904 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'index::components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('index-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal170118df4e1fb8a1766198f7d923b904)): ?>
<?php $attributes = $__attributesOriginal170118df4e1fb8a1766198f7d923b904; ?>
<?php unset($__attributesOriginal170118df4e1fb8a1766198f7d923b904); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal170118df4e1fb8a1766198f7d923b904)): ?>
<?php $component = $__componentOriginal170118df4e1fb8a1766198f7d923b904; ?>
<?php unset($__componentOriginal170118df4e1fb8a1766198f7d923b904); ?>
<?php endif; ?>
    <!-- javascript -->
    <script src="<?php echo e(asset_index('vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset_index('vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset_index('vendor/libs/node-waves/node-waves.js')); ?>">
    </script>
    <script src="<?php echo e(asset_index('vendor/libs/@algolia/autocomplete-js.js')); ?>">
    </script>
    <script src="<?php echo e(asset_index('vendor/libs/pickr/pickr.js')); ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset_index('vendor/libs/nouislider/nouislider.js')); ?>">
    </script>
    <script src="<?php echo e(asset_index('vendor/libs/swiper/swiper.js')); ?>"></script>
    <!-- Main JS -->
    <script src="<?php echo e(asset_index('js/front-main.js')); ?>"></script>
    <!-- Page JS -->
    <script src="<?php echo e(asset_index('js/front-page-landing.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\resources\index/vuexy/views/components/layout.blade.php ENDPATH**/ ?>