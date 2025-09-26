<?php
    $numbers = request()->user()->devices()->latest()->paginate(15);
?>
	<!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu">
          <div class="app-brand demo">
            <a href="<?php echo e(url('/')); ?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
                </span>
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
              <i class="icon-base ti tabler-x d-block d-xl-none"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
			<?php if(env("ENABLE_INDEX") == 'yes'): ?>
			<li class="menu-item">
              <a href="<?php echo e(route('index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Home"><?php echo e(__('Home')); ?></div>
              </a>
            </li>
			<?php endif; ?>
			<li class="menu-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('home')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-dashboard"></i>
                <div data-i18n="Dashboard"><?php echo e(__('Dashboard')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('devices') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('devices')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-device-mobile"></i>
                <div data-i18n="Devices"><?php echo e(__('Devices')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('file-manager') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('file-manager')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-cloud-up"></i>
                <div data-i18n="File Manager"><?php echo e(__('File Manager')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('phonebook') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('phonebook')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-notebook"></i>
                <div data-i18n="Phone Book"><?php echo e(__('Phone Book')); ?></div>
              </a>
            </li>
			<li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-report"></i>
                <div data-i18n="Reports"><?php echo e(__('Reports')); ?></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item <?php echo e(request()->routeIs('campaigns') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('campaigns')); ?>" class="menu-link">
                    <div data-i18n="Campaign / Blast"><?php echo e(__('Campaign / Blast')); ?></div>
                  </a>
                </li>
                <li class="menu-item <?php echo e(request()->routeIs('messages.history') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('messages.history')); ?>" class="menu-link">
                    <div data-i18n="Messages History"><?php echo e(__('Messages History')); ?></div>
                  </a>
                </li>
              </ul>
            </li>
			<?php if(Auth::user()->level != 'admin'): ?>
			<li class="menu-item <?php echo e(request()->routeIs('user.tickets.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('user.tickets.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-ticket"></i>
                <div data-i18n="Phone Book"><?php echo e(__('Tickets')); ?></div>
				<div class="badge text-bg-danger rounded-pill ms-auto"><?php echo e(auth()->user()->tickets()->where('status', 'open')->count()); ?></div>
              </a>
            </li>
			<?php endif; ?>
			
			<li class="menu-header small">
              <span class="menu-header-text" data-i18n="Device tools"><?php echo e(__('Device tools')); ?></span>
            </li>
			
			<?php if (isset($component)) { $__componentOriginal8e251167e904b7c042726ccf9f0438f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8e251167e904b7c042726ccf9f0438f4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.select-device','data' => ['numbers' => $numbers]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-device'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['numbers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($numbers)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8e251167e904b7c042726ccf9f0438f4)): ?>
<?php $attributes = $__attributesOriginal8e251167e904b7c042726ccf9f0438f4; ?>
<?php unset($__attributesOriginal8e251167e904b7c042726ccf9f0438f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e251167e904b7c042726ccf9f0438f4)): ?>
<?php $component = $__componentOriginal8e251167e904b7c042726ccf9f0438f4; ?>
<?php unset($__componentOriginal8e251167e904b7c042726ccf9f0438f4); ?>
<?php endif; ?>
			
			<?php if(Session::has('selectedDevice')): ?>
			<li class="menu-item <?php echo e(request()->routeIs('chat.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('chat.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-brand-whatsapp"></i>
                <div data-i18n="Auto Reply"><?php echo e(__('Live Chat')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('autoreply') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('autoreply')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-message-2"></i>
                <div data-i18n="Auto Reply"><?php echo e(__('Auto Reply')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('aibot') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('aibot')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-robot"></i>
                <div data-i18n="AI Bot"><?php echo e(__('AI Bot')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('campaign.create') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('campaign.create')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-brand-campaignmonitor"></i>
                <div data-i18n="Create Campaign"><?php echo e(__('Create Campaign')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('messagetest') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('messagetest')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-mail"></i>
                <div data-i18n="Test Message"><?php echo e(__('Test Message')); ?></div>
              </a>
            </li>
			<?php endif; ?>
			
			<li class="menu-header small">
              <span class="menu-header-text" data-i18n="Developers"><?php echo e(__('Developers')); ?></span>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('rest-api') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('rest-api')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-api-app"></i>
                <div data-i18n="API Docs"><?php echo e(__('API Docs')); ?></div>
              </a>
            </li>
			
			<?php if(Auth::user()->level == 'admin'): ?>
			<li class="menu-header small">
              <span class="menu-header-text" data-i18n="Admin Panel"><?php echo e(__('Admin Panel')); ?></span>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.settings') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.settings')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div data-i18n="Setting Server"><?php echo e(__('Setting Server')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.manage-users') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.manage-users')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users"></i>
                <div data-i18n="Manage User"><?php echo e(__('Manage User')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.manage-themes') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.manage-themes')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-brush"></i>
                <div data-i18n="Manage Themes"><?php echo e(__('Manage Themes')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('languages.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('languages.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-language"></i>
                <div data-i18n="Manage Languages"><?php echo e(__('Manage Languages')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.index.edit') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.index.edit')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-home-edit"></i>
                <div data-i18n="Manage Homepage"><?php echo e(__('Manage Homepage')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.plans.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.plans.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-transaction-euro"></i>
                <div data-i18n="Manage Plans"><?php echo e(__('Manage Plans')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.payments.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.payments.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-credit-card-pay"></i>
                <div data-i18n="Manage Payments"><?php echo e(__('Manage Payments')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.tickets.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.tickets.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-ticket"></i>
                <div data-i18n="Manage Tickets"><?php echo e(__('Manage Tickets')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.notifications.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.notifications.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-bell-plus"></i>
                <div data-i18n="Send Notification"><?php echo e(__('Send Notification')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.orders.index') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.orders.index')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-folders"></i>
                <div data-i18n="Orders"><?php echo e(__('Orders')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('admin.troubleshoot') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('admin.troubleshoot')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-device-desktop-search"></i>
                <div data-i18n="Troubleshoot"><?php echo e(__('Troubleshoot')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('cronjob') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('cronjob')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-metronome"></i>
                <div data-i18n="Cronjob"><?php echo e(__('Cronjob')); ?></div>
              </a>
            </li>
			<li class="menu-item <?php echo e(request()->routeIs('update') ? 'active' : ''); ?>">
              <a href="<?php echo e(route('update')); ?>" class="menu-link">
                <i class="menu-icon icon-base ti tabler-progress-down"></i>
                <div data-i18n="Update"><?php echo e(__('Update')); ?></div>
              </a>
            </li>
			<?php endif; ?>
          </ul>
        </aside>

        <div class="menu-mobile-toggler d-xl-none rounded-1">
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
            <i class="ti tabler-menu icon-base"></i>
            <i class="ti tabler-chevron-right icon-base"></i>
          </a>
        </div>
        <!-- / Menu --><?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/components/aside.blade.php ENDPATH**/ ?>