<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Home')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Home')).'']); ?>
			<?php if(session()->has('alert')): ?>
				<?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
					<?php $__env->slot('type', session('alert')['type']); ?>
					<?php $__env->slot('msg', session('alert')['msg']); ?>
				 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
			<?php endif; ?>
			<?php if($errors->any()): ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<h4 class="alert-heading d-flex align-items-center">
						<span class="alert-icon rounded">
							<i class="icon-base ti tabler-face-id-error icon-md"></i>
						</span>
						<?php echo e(__('Oh Error :(')); ?>

					</h4>
					<hr>
					<p class="mb-0">
						<p><?php echo e(__('The given data was invalid.')); ?></p>
						<ul>
							<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($error); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</p>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>
				<?php if($newVersion): ?>
                    <div class="alert alert-danger">
                        <?php echo e(__('A new version is available:')); ?> <span class="text-danger">v<?php echo e($newVersion); ?></span> <a href="<?php echo e(route('update')); ?>"><?php echo e(__('Click Here')); ?></a></ul>
                    </div>
                <?php endif; ?>
              <div class="row g-6">
                <!-- Website Analytics -->
                <div class="col-xl-6 col">
                  <div
                    class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg h-100"
                    id="swiper-with-pagination-cards">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="row">
                          <div class="col-12">
                            <h5 class="text-white mb-0"><?php echo e(__('Blast/Bulk')); ?></h5>
							<?php
							  $totalMessages = $user->blasts_success + $user->blasts_failed + $user->blasts_pending;
							  $successRate = $totalMessages > 0 ? round(($user->blasts_success / $totalMessages) * 100, 2) : 0;
							?>
                            <small><?php echo e(__('Total :successRate% successful message rate', ['successRate' => $successRate])); ?></small>
                          </div>
                          <div class="row">
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                              <h6 class="text-white mt-0 mt-md-3 mb-4"><?php echo e(__('Messages')); ?></h6>
                              <div class="row">
                                <div class="col-6">
                                  <ul class="list-unstyled mb-0">
                                    <li class="d-flex mb-4 align-items-center">
                                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"><?php echo e(number_format($user->blasts_pending)); ?></p>
                                      <p class="mb-0"><?php echo e(__('Wait')); ?></p>
                                    </li>
                                    <li class="d-flex align-items-center">
                                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"><?php echo e(number_format($user->blasts_success)); ?></p>
                                      <p class="mb-0"><?php echo e(__('Sent')); ?></p>
                                    </li>
                                  </ul>
                                </div>
                                <div class="col-6">
                                  <ul class="list-unstyled mb-0">
                                    <li class="d-flex mb-4 align-items-center">
                                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"><?php echo e(number_format($user->blasts_failed)); ?></p>
                                      <p class="mb-0"><?php echo e(__('Fail')); ?></p>
                                    </li>
                                    <li class="d-flex align-items-center">
                                      <p class="mb-0 fw-medium me-2 website-analytics-text-bg"><?php echo e(number_format($user->campaigns_count)); ?></p>
                                      <p class="mb-0"><?php echo e(__('Campaigns')); ?></p>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
							  <i class="icon-base ti tabler-brand-whatsapp card-website-analytics-img" style="width:150px; height:150px;"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-pagination"></div>
                  </div>
                </div>
                <!--/ Website Analytics -->

                <!-- Average Daily Sales -->
                <?php
				  $isAdmin        = $user->level === 'admin';
				  $planName       = $isAdmin ? __('Administrator') : ($user->plan_name ?? __('No Plan'));
				  $planExpire     = $isAdmin ? null : ($user->subscription_expired ?? null);
				  $totalMessages  = number_format($user->message_histories_count);
				  $remainMessages = $isAdmin ? '∞' : number_format($user->plan_data['messages_limit'] ?? 0);
				?>
				<div class="col-xl-3 col-sm-6">
				  <div class="card h-100">
					<div class="card-header pb-0 border-0">
					  <h5 class="mb-0"><?php echo e(__('All Messages Sent')); ?></h5>
					  <small class="text-muted"><?php echo e(__('Overview of your usage')); ?></small>
					</div>
					<div class="card-body pt-3">
					  
					  <div class="d-flex align-items-center justify-content-between mb-3">
						<div class="d-flex align-items-center gap-2">
						  <span class="avatar avatar-sm rounded bg-label-primary d-flex align-items-center justify-content-center">
							<i class="ti tabler-send fs-5"></i>
						  </span>
						  <span class="fw-medium"><?php echo e(__('Sent')); ?></span>
						</div>
						<span class="fw-bold"><?php echo e($totalMessages); ?></span>
					  </div>

					  <div class="d-flex align-items-center justify-content-between mb-3">
						<div class="d-flex align-items-center gap-2">
						  <span class="avatar avatar-sm rounded bg-label-success d-flex align-items-center justify-content-center">
							<i class="ti tabler-message-circle fs-5"></i>
						  </span>
						  <span class="fw-medium"><?php echo e(__('Remaining')); ?></span>
						</div>
						<span class="fw-bold"><?php echo e($remainMessages); ?></span>
					  </div>

					  <hr class="my-3">

					  <div class="d-flex align-items-center justify-content-between mb-2">
						<div class="d-flex align-items-center gap-2">
						  <span class="avatar avatar-sm rounded bg-label-info d-flex align-items-center justify-content-center">
							<i class="ti tabler-package fs-5"></i>
						  </span>
						  <span class="fw-medium"><?php echo e(__('Plan')); ?></span>
						</div>
						<span class="fw-bold text-end"><?php echo e($planName); ?></span>
					  </div>

					  <div class="d-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center gap-2">
						  <span class="avatar avatar-sm rounded bg-label-warning d-flex align-items-center justify-content-center">
							<i class="ti tabler-calendar fs-5"></i>
						  </span>
						  <span class="fw-medium"><?php echo e(__('Expiry')); ?></span>
						</div>
						<span class="fw-bold">
						  <?php echo e($isAdmin ? __('Unlimited') : ($planExpire ? \Carbon\Carbon::parse($planExpire)->format('Y-m-d') : __('N/A'))); ?>

						</span>
					  </div>

					</div>
				  </div>
				</div>
                <!--/ Average Daily Sales -->

                <!-- Sales Overview -->
				<?php
				  $totalLimit = (int) ($user->limit_device ?? 0);
				  $used       = (int) ($user->devices_count ?? 0);
				  $available  = max($totalLimit - $used, 0);
				?>

				<div class="col-xl-3 col-sm-6">
				  <div class="card h-100">
					<div class="card-header pb-0 border-0">
					  <h5 class="mb-0"><?php echo e(__('Devices Overview')); ?></h5>
					  <small class="text-muted"><?php echo e(__('Your plan device statistics')); ?></small>
					</div>
					<div class="card-body pt-2">
					  <div class="d-flex flex-column gap-3">

						<div class="d-flex align-items-center justify-content-between">
						  <div class="d-flex align-items-center gap-2">
							<span class="avatar avatar-sm rounded bg-label-primary d-flex align-items-center justify-content-center">
							  <i class="ti tabler-devices fs-5"></i>
							</span>
							<span class="fw-medium"><?php echo e(__('Used')); ?></span>
						  </div>
						  <span class="fw-bold"><?php echo e(number_format($used)); ?></span>
						</div>

						<div class="d-flex align-items-center justify-content-between">
						  <div class="d-flex align-items-center gap-2">
							<span class="avatar avatar-sm rounded bg-label-success d-flex align-items-center justify-content-center">
							  <i class="ti tabler-circle-check fs-5"></i>
							</span>
							<span class="fw-medium"><?php echo e(__('Available')); ?></span>
						  </div>
						  <span class="fw-bold"><?php echo e(number_format($available)); ?></span>
						</div>

						<div class="d-flex align-items-center justify-content-between">
						  <div class="d-flex align-items-center gap-2">
							<span class="avatar avatar-sm rounded bg-label-info d-flex align-items-center justify-content-center">
							  <i class="ti tabler-box fs-5"></i>
							</span>
							<span class="fw-medium"><?php echo e(__('Total')); ?></span>
						  </div>
						  <span class="fw-bold"><?php echo e(number_format($totalLimit)); ?></span>
						</div>

					  </div>
					</div>
				  </div>
				</div>
                <!--/ Sales Overview -->
<?php if($user->level == 'admin'): ?>
<?php
  $diskTotal     = disk_total_space('/');
  $diskFree      = disk_free_space('/');
  $diskUsed      = $diskTotal - $diskFree;
  $diskTotalGB   = number_format($diskTotal/1024/1024/1024,1);
  $diskUsedGB    = number_format($diskUsed/1024/1024/1024,1);
  $diskPercent   = round($diskUsed / $diskTotal * 100);
  $phpVersion    = phpversion();
  $mysqlVersion  = DB::selectOne('SELECT VERSION() AS version')->version;
  $laravelVersion = Illuminate\Foundation\Application::VERSION;
?>

  <!-- System Resources -->
  <div class="col-md-6">
    <div class="row gx-4 gy-4">
      <!-- System Resources -->
      <div class="col-12">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h5 class="mb-1"><?php echo e(__('System Resources')); ?></h5>
            <small class="text-muted"><?php echo e(__('Live Memory & Disk')); ?></small>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <!-- RAM -->
              <div class="col-12 col-sm-6">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-label-primary rounded p-2 me-3">
                    <i class="icon-base ti tabler-device-sd-card fs-3"></i>
                  </div>
                  <div class="w-100">
                    <h5 class="mb-1">
                      <span id="ramUsed">--</span> / <span id="ramTotal">--</span> <?php echo e(__('MB')); ?>

                    </h5>
                    <div class="d-flex justify-content-between small text-muted mb-1">
                      <span><?php echo e(__('RAM Usage')); ?></span>
                      <span><span id="ramPercent">--</span>%</span>
                    </div>
                    <div class="progress" style="height:6px">
                      <div id="ramProgressBar" class="progress-bar bg-primary" style="width:0%"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mt-2">
                      <span><?php echo e(__('Free RAM')); ?></span>
                      <span><span id="ramFree">--</span> <?php echo e(__('MB')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Disk -->
              <div class="col-12 col-sm-6">
                <div class="d-flex align-items-center">
                  <div class="bg-label-info rounded p-2 me-3">
                    <i class="icon-base ti tabler-stack-2 fs-3"></i>
                  </div>
                  <div class="w-100">
                    <h5 class="mb-1"><?php echo e($diskUsedGB); ?> / <?php echo e($diskTotalGB); ?> <?php echo e(__('GB')); ?></h5>
                    <div class="d-flex justify-content-between small text-muted mb-1">
                      <span><?php echo e(__('Disk Usage')); ?></span>
                      <span><?php echo e($diskPercent); ?>%</span>
                    </div>
                    <div class="progress" style="height:6px">
                      <div class="progress-bar bg-info" style="width:<?php echo e($diskPercent); ?>%"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mt-2">
                      <span><?php echo e(__('Free Disk')); ?></span>
                      <span><?php echo e(number_format($diskFree/1024/1024/1024,1)); ?> <?php echo e(__('GB')); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Server Info -->
      <div class="col-12">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h5 class="mb-1"><?php echo e(__('Server Info')); ?></h5>
            <small class="text-muted"><?php echo e(__('Environment Versions')); ?></small>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="bg-label-warning rounded p-2 me-3">
                  <i class="icon-base ti tabler-brand-php fs-3"></i>
                </div>
                <div>
                  <h6 class="mb-1"><?php echo e(__('PHP')); ?></h6>
                  <small class="text-muted"><?php echo e($phpVersion); ?></small>
                </div>
              </div>
              <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="bg-label-success rounded p-2 me-3">
                  <i class="icon-base ti tabler-server fs-3"></i>
                </div>
                <div>
                  <h6 class="mb-1"><?php echo e(__('Laravel')); ?></h6>
                  <small class="text-muted"><?php echo e($laravelVersion); ?></small>
                </div>
              </div>
              <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="bg-label-danger rounded p-2 me-3">
                  <i class="icon-base ti tabler-database fs-3"></i>
                </div>
                <div>
                  <h6 class="mb-1"><?php echo e(__('MySQL')); ?></h6>
                  <small class="text-muted"><?php echo e($mysqlVersion); ?></small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>        
  </div>

  <!-- CPU Usage (unchanged) -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-header pb-0">
        <h5 class="mb-1"><?php echo e(__('CPU Usage')); ?></h5>
        <small class="text-muted"><?php echo e(__('Real-time Processor Load')); ?></small>
      </div>
      <div class="card-body d-flex flex-column align-items-center">
		  <div id="cpuusage"></div>
		  <div class="mt-3 text-center">
			<small id="cpuInfo" class="text-muted">--</small>
		  </div>
	  </div>
    </div>
  </div>


<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" crossorigin="anonymous"></script>
<script>
  if ('<?php echo e(env('TYPE_SERVER')); ?>' === 'hosting') {
	socket = io();
  } else {
	socket = io('<?php echo e(env("WA_URL_SERVER")); ?>', {
        transports: ['websocket', 'polling', 'flashsocket']
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
	socket.emit('specs', {});
    const cpuEl = document.getElementById('cpuusage');
    const cpuChart = new ApexCharts(cpuEl, {
      series: [0],
	  labels: ['CPU'],
      chart: { type: 'radialBar', height: 300 },
      plotOptions: {
        radialBar: {
          hollow: { size: '65%' },
          startAngle: -140,
          endAngle: 140,
          track: { background: '#f0f0f0', strokeWidth: '100%' },
          dataLabels: {
            name: {
              offsetY: -20,
              color: config.colors.textMuted,
              fontSize: '13px',
              fontWeight: '400'
            },
            value: {
              offsetY: 10,
              color: config.colors.headingColor,
              fontSize: '38px',
              fontWeight: '400'
            }
          }
        }
      },
      colors: [config.colors.primary]
    });
    cpuChart.render();

    socket.on('serverStats', data => {
      const used = parseInt(data.ram_used);
       const total = parseInt(data.ram_total);
			const free  = data.ram_free;
            const pct   = Math.round(used / total * 100);
			const model = data.cpu_model;
		  const cores = data.cpu_name;
		  document.getElementById('ramUsed').innerText  = used.toLocaleString();
		  document.getElementById('ramTotal').innerText = total.toLocaleString();
		  document.getElementById('ramFree').innerText   = free.toLocaleString();
		  document.getElementById('ramPercent').innerText = pct;
		  document.getElementById('ramProgressBar').style.width = pct + '%';
		  document.getElementById('cpuInfo').innerText = `${model} ${cores} Core`;

      cpuChart.updateSeries([parseFloat(data.cpu)]);
    });
  });
</script>
<?php endif; ?>

<?php
  $cu = $chatUi ?? [];
  $mt = number_format($cu['messages_today'] ?? 0);
  $as = number_format($cu['active_sessions_today'] ?? 0);
  $md = number_format($cu['media_today'] ?? 0);
  $incoming = (int) ($cu['incoming_today'] ?? 0);
  $outgoing = (int) ($cu['outgoing_today'] ?? 0);
  $typesLabels = $cu['types_labels'] ?? [];
  $typesData   = $cu['types_data'] ?? [];
  $topContacts = $cu['top_contacts'] ?? collect();
?>

  <div class="col-12 col-xl-12">
  <div class="card h-100 overflow-hidden">
    <div class="card-body p-4">
      <div class="row g-0">

        <div class="col-lg-8 pe-lg-4 border-end">
          <h5 class="mb-2"><?php echo e(__('Chat Overview')); ?></h5>
          <p class="mb-4 text-body"><?php echo e(__('Today at a glance')); ?></p>

          <div class="d-flex flex-wrap gap-4">
            <div class="d-flex align-items-center gap-3 me-lg-4">
              <span class="avatar avatar-lg rounded bg-label-primary d-flex align-items-center justify-content-center">
                <i class="ti tabler-message-2 fs-2 text-primary"></i>
              </span>
              <div>
                <span class="d-block text-body"><?php echo e(__('Messages Today')); ?></span>
                <h4 class="mb-0 text-primary"><?php echo e(number_format($chatUi['messages_today'] ?? 0)); ?></h4>
              </div>
            </div>

            <div class="d-flex align-items-center gap-3 me-lg-4">
              <span class="avatar avatar-lg rounded bg-label-info d-flex align-items-center justify-content-center">
                <i class="ti tabler-users fs-2 text-info"></i>
              </span>
              <div>
                <span class="d-block text-body"><?php echo e(__('Active Sessions')); ?></span>
                <h4 class="mb-0 text-info"><?php echo e(number_format($chatUi['active_sessions_today'] ?? 0)); ?></h4>
              </div>
            </div>

            <div class="d-flex align-items-center gap-3">
              <span class="avatar avatar-lg rounded bg-label-success d-flex align-items-center justify-content-center">
                <i class="ti tabler-photo fs-2 text-success"></i>
              </span>
              <div>
                <span class="d-block text-body"><?php echo e(__('Media Today')); ?></span>
                <h4 class="mb-0 text-success"><?php echo e(number_format($chatUi['media_today'] ?? 0)); ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 ps-lg-4">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <h6 class="mb-1"><?php echo e(__('Direction Split')); ?></h6>
              <small class="text-body"><?php echo e(__('Today')); ?></small>
            </div>
            <h4 class="mb-0"><?php echo e((int)(($chatUi['incoming_today'] ?? 0) + ($chatUi['outgoing_today'] ?? 0))); ?></h4>
          </div>
          <div class="d-flex justify-content-center">
            <div id="chatDirectionDonut" class="rounded chart-donut-wrap"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


  <div class="col-12 col-xl-8">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2"><?php echo e(__('Message Types Today')); ?></h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="icon-base ti tabler-dots-vertical icon-22px text-body-secondary"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item waves-effect" href="javascript:void(0);"><?php echo e(__('Refresh')); ?></a>
          </div>
        </div>
      </div>
      <div class="card-body row g-3">
        <div class="col-md-8">
          <div id="chatTypesBar" style="min-height: 315px;"></div>
        </div>
        <div class="col-md-4 d-flex justify-content-around align-items-center">
          <div class="d-flex flex-column gap-4">
            <?php $__currentLoopData = array_slice($typesLabels,0,3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="d-flex align-items-baseline">
                <span class="me-2">
                  <i class="icon-base ti tabler-circle-filled icon-12px text-primary"></i>
                </span>
                <div>
                  <p class="mb-0"><?php echo e(ucfirst($lbl)); ?></p>
                  <h5><?php echo e(number_format($typesData[$i] ?? 0)); ?></h5>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div class="d-flex flex-column gap-4">
            <?php $__currentLoopData = array_slice($typesLabels,3,3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $idx = $j + 3; ?>
              <div class="d-flex align-items-baseline">
                <span class="me-2">
                  <i class="icon-base ti tabler-circle-filled icon-12px text-info"></i>
                </span>
                <div>
                  <p class="mb-0"><?php echo e(ucfirst($lbl)); ?></p>
                  <h5><?php echo e(number_format($typesData[$idx] ?? 0)); ?></h5>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-xl-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2"><?php echo e(__('Top Contacts Today')); ?></h5>
        </div>
        <div class="dropdown">
          <button class="btn text-body-secondary p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="icon-base ti tabler-dots-vertical icon-22px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item waves-effect" href="javascript:void(0);"><?php echo e(__('Select All')); ?></a>
            <a class="dropdown-item waves-effect" href="javascript:void(0);"><?php echo e(__('Refresh')); ?></a>
          </div>
        </div>
      </div>
      <div class="px-5 py-4 border border-start-0 border-end-0">
        <div class="d-flex justify-content-between align-items-center">
          <p class="mb-0 text-uppercase"><?php echo e(__('Contact')); ?></p>
          <p class="mb-0 text-uppercase"><?php echo e(__('Messages')); ?></p>
        </div>
      </div>
      <div class="card-body">
        <?php $__currentLoopData = $topContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex justify-content-between align-items-center mb-6">
            <div class="d-flex align-items-center">
              <div class="avatar avatar me-4">
                <span class="avatar-initial rounded-circle bg-label-primary"><?php echo e(strtoupper(mb_substr($c->push_name ?: $c->phone_number,0,1))); ?></span>
              </div>
              <div>
                <div>
                  <h6 class="mb-0 text-truncate"><?php echo e($c->push_name ?: $c->phone_number); ?></h6>
                  <small class="text-truncate text-body"><?php echo e($c->phone_number); ?></small>
                </div>
              </div>
            </div>
            <div class="text-end">
              <h6 class="mb-0"><?php echo e(number_format($c->cnt)); ?></h6>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  var dirOptions = {
    chart: { type: 'donut', height: 157, sparkline: { enabled: true } },
    labels: ['Incoming','Outgoing'],
    series: [<?php echo e($incoming); ?>, <?php echo e($outgoing); ?>],
    colors: ['var(--bs-success)','var(--bs-primary)'],
    dataLabels: { enabled: false },
    legend: { show: false },
    stroke: { width: 0 },
    plotOptions: { pie: { donut: { size: '70%' } } }
  };
  var dirChart = new ApexCharts(document.querySelector('#chatDirectionDonut'), dirOptions);
  dirChart.render();

  var typesLabels = <?php echo json_encode($typesLabels, 15, 512) ?>;
  var typesData = <?php echo json_encode($typesData, 15, 512) ?>;
  var barOptions = {
    chart: { type: 'bar', height: 300, toolbar: { show: false } },
    series: [{ data: typesData }],
    xaxis: { categories: typesLabels, labels: { style: { colors: 'var(--bs-secondary-color)' } } },
    plotOptions: { bar: { horizontal: true, borderRadius: 6, barHeight: '28px' } },
    colors: ['var(--bs-primary)'],
    grid: { borderColor: 'var(--bs-border-color)', strokeDashArray: 10 },
    dataLabels: { enabled: false },
    yaxis: { labels: { style: { colors: 'var(--bs-secondary-color)' } } },
    tooltip: { theme: 'light' }
  };
  var typesChart = new ApexCharts(document.querySelector('#chatTypesBar'), barOptions);
  typesChart.render();
});
</script>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $attributes = $__attributesOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__attributesOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $component = $__componentOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__componentOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/home.blade.php ENDPATH**/ ?>