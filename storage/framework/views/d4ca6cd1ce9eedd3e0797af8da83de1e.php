<!-- light-dark mode -->

<a href="javascript: void(0);" id="light-dark-mode" class="mode-btn text-white rounded-end">
	<i class="mdi mdi-sun-compass bx-spin mode-light"></i>
	<i class="mdi mdi-moon-waning-crescent mode-dark"></i>
</a>

<!--Navbar Start-->

<nav class="layout-navbar shadow-none py-0">
	<div class="container">
		<div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
			<!-- Menu logo wrapper: Start -->
			<div class="navbar-brand app-brand demo d-flex py-0 me-4 me-xl-8 ms-0">
				<!-- Mobile menu toggle: Start-->
				<button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<i class="icon-base ti tabler-menu-2 icon-lg align-middle text-heading fw-medium"></i>
				</button>
				<!-- Mobile menu toggle: End-->
				<a href="<?php echo e(url('')); ?>" class="app-brand-link">
					<span class="app-brand-text demo menu-text fw-bold ms-2 ps-1"><?php if (isset($component)) { $__componentOriginal071044510095d4acf83d2e74ee967609 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal071044510095d4acf83d2e74ee967609 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'index::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('index-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal071044510095d4acf83d2e74ee967609)): ?>
<?php $attributes = $__attributesOriginal071044510095d4acf83d2e74ee967609; ?>
<?php unset($__attributesOriginal071044510095d4acf83d2e74ee967609); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal071044510095d4acf83d2e74ee967609)): ?>
<?php $component = $__componentOriginal071044510095d4acf83d2e74ee967609; ?>
<?php unset($__componentOriginal071044510095d4acf83d2e74ee967609); ?>
<?php endif; ?></span>
				</a>
			</div>
			<!-- Menu logo wrapper: End -->
			<!-- Menu wrapper: Start -->
			<div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
				<button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl p-2"
					type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="icon-base ti tabler-x icon-lg"></i>
				</button>
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link fw-medium" aria-current="page" href="#home"><?php echo e(__index('HOME')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link fw-medium" href="#features"><?php echo e(__index('FEATURES')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link fw-medium" href="#pricing"><?php echo e(__index('PRICING')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link fw-medium" href="#contact"><?php echo e(__index('CONTACT_US')); ?></a>
					</li>
				</ul>
				<ul class="navbar-nav dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-globe"></i>
						<?php echo e(__('Language')); ?>

					</a>
					<ul class="dropdown-menu" aria-labelledby="languageDropdown">
						<?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li>
							<a class="dropdown-item" rel="alternate" hreflang="<?php echo e($localeCode); ?>"
								href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
								<span class="flag-icon flag-icon-<?php echo e(strtolower($localeCode)); ?>"></span>
								<?php echo e($properties['native']); ?>

							</a>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</ul>
			</div>
			<div class="landing-menu-overlay d-lg-none"></div>
			<!-- Menu wrapper: End -->
			<!-- Toolbar: Start -->
			<ul class="navbar-nav flex-row align-items-center ms-auto">

				<!-- Style Switcher -->
				<li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
					<a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);"
						data-bs-toggle="dropdown">
						<i class="icon-base ti tabler-sun icon-lg theme-icon-active"></i>
						<span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
					</a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
						<li>
							<button type="button" class="dropdown-item align-items-center active"
								data-bs-theme-value="light" aria-pressed="false">
								<span><i class="icon-base ti tabler-sun icon-md me-3" data-icon="sun"></i>Light</span>
							</button>
						</li>
						<li>
							<button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark"
								aria-pressed="true">
								<span><i class="icon-base ti tabler-moon-stars icon-md me-3"
										data-icon="moon-stars"></i>Dark</span>
							</button>
						</li>
						<li>
							<button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system"
								aria-pressed="false">
								<span><i class="icon-base ti tabler-device-desktop-analytics icon-md me-3"
										data-icon="device-desktop-analytics"></i>System</span>
							</button>
						</li>
					</ul>
				</li>
				<!-- / Style Switcher-->

				<!-- navbar button: Start -->
				<li>
					<?php if(auth()->check()): ?>
					<a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
						<span class="tf-icons icon-base ti tabler-home scaleX-n1-rtl me-md-1"></span><span
							class="d-none d-md-block">
							<?php echo e(__('Dashboard')); ?>

						</span>
					</a>
					<?php else: ?>
					<a href="<?php echo e(route('login')); ?>" class="btn btn-primary">
						<span class="tf-icons icon-base ti tabler-login scaleX-n1-rtl me-md-1"></span><span
							class="d-none d-md-block">
							<?php echo e(__index('SIGN_IN')); ?>

						</span>
					</a>
					<?php endif; ?>
				</li>
				<!-- navbar button: End -->
			</ul>
			<!-- Toolbar: End -->
		</div>
	</div>
</nav>
<!-- Navbar End --><?php /**PATH C:\xampp\htdocs\resources\index/vuexy/views/components/header.blade.php ENDPATH**/ ?>