<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Devices')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Devices')).'']); ?>
<style>
.offcanvas-end { width: 420px; }
@media (max-width: 576px){ .offcanvas-end { width: 100%; } }
</style>
<!--breadcrumb-->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);"><?php echo e(__('Devices')); ?></a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active"><?php echo e(__('Whatsapp Account')); ?></li>
		</ol>
	</nav>
	<!--end breadcrumb-->
	
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
              <div class="row g-6">
				  <div class="col-xxl-12">
					<div class="card">
					  <div class="card-header">
						<div class="d-flex align-items-center">
						  <h5 class="mb-0"><?php echo e(__('Whatsapp Account')); ?></h5>
						  <form class="ms-auto position-relative">
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDevice"><i class="icon-base ti tabler-plus"></i> <?php echo e(__('Add Device')); ?></button>
						  </form>
						</div>
					  </div>

					  <div class="table-responsive mb-4">
						<table class="table datatable-project table-sm">
						  <thead class="border-top">
							<th><?php echo e(__('Number')); ?></th>
							<th class="text-nowrap"><?php echo e(__('Webhook URL')); ?></th>
							<th><?php echo e(__('Sent')); ?></th>
							<th><?php echo e(__('status')); ?></th>
							<th class="text-nowrap"><?php echo e(__('Options')); ?></th>
							<th><?php echo e(__('Action')); ?></th>
						  </thead>
						  <tbody>
							<?php if($numbers->total() == 0): ?>
							  <?php if (isset($component)) { $__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.no-data','data' => ['colspan' => '6','text' => 'No Device added yet']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('no-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '6','text' => 'No Device added yet']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc)): ?>
<?php $attributes = $__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc; ?>
<?php unset($__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc)): ?>
<?php $component = $__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc; ?>
<?php unset($__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc); ?>
<?php endif; ?>
							<?php endif; ?>

							<?php $__currentLoopData = $numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <tr>
								<td><small><?php echo e($number['body']); ?></small></td>

								<td>
								  <form action="" method="post">
									<?php echo csrf_field(); ?>
									<input type="text" class="form-control form-control-solid-bordered webhook-url-form" data-id="<?php echo e($number['body']); ?>" name="" value="<?php echo e($number['webhook']); ?>" id="">
								  </form>
								</td>

								<td><?php echo e($number['message_sent']); ?></td>

								<td>
								  <span class="badge bg-<?php echo e($number['status'] == 'Connected' ? 'success' : 'danger'); ?>"> </span>
								</td>

								<td class="text-nowrap">
								  <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#opts-<?php echo e($number['body']); ?>">
									<i class="ti tabler-adjustments me-1"></i> <?php echo e(__('Options')); ?>

								  </button>

								  <div class="offcanvas offcanvas-end" tabindex="-1" id="opts-<?php echo e($number['body']); ?>" aria-labelledby="optsLabel-<?php echo e($number['body']); ?>" data-bs-scroll="true">
									<div class="offcanvas-header">
									  <h5 id="optsLabel-<?php echo e($number['body']); ?>"><?php echo e(__('Options')); ?></h5>
									  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
									</div>
									<div class="offcanvas-body">
									  <div class="d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-primary rounded-2 p-2"><i class="ti tabler-square-rounded-check"></i></span>
										  <div class="fw-medium"><?php echo e(__('Full Response')); ?></div>
										</div>
										<div class="form-check form-switch">
										  <input data-url="<?php echo e(route('setHookFull')); ?>" class="form-check-input toggle-full" type="checkbox" data-id="<?php echo e($number['body']); ?>" <?php echo e(($number['webhook_full']) ? 'checked' : ''); ?>>
										  <span class="ms-2 small toggle-label"><?php echo e(($number['webhook_full']) ? __('Yes') : __('No')); ?></span>
										</div>
									  </div>

									  <div class="d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-info rounded-2 p-2"><i class="ti tabler-eye-check"></i></span>
										  <div class="fw-medium"><?php echo e(__('Read')); ?></div>
										</div>
										<div class="form-check form-switch">
										  <input data-url="<?php echo e(route('setHookRead')); ?>" class="form-check-input toggle-read" type="checkbox" data-id="<?php echo e($number['body']); ?>" <?php echo e($number['webhook_read'] ? 'checked' : ''); ?>>
										  <span class="ms-2 small toggle-label"><?php echo e($number['webhook_read'] ? __('Yes') : __('No')); ?></span>
										</div>
									  </div>

									  <div class="d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-danger rounded-2 p-2"><i class="ti tabler-phone-x"></i></span>
										  <div class="fw-medium"><?php echo e(__('Reject Call')); ?></div>
										</div>
										<div class="form-check form-switch">
										  <input data-url="<?php echo e(route('setHookReject')); ?>" class="form-check-input toggle-reject" type="checkbox" data-id="<?php echo e($number['body']); ?>" <?php echo e($number['webhook_reject_call'] ? 'checked' : ''); ?>>
										  <span class="ms-2 small toggle-label"><?php echo e($number['webhook_reject_call'] ? __('Yes') : __('No')); ?></span>
										</div>
									  </div>

									  <div class="d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-success rounded-2 p-2"><i class="ti tabler-user-check"></i></span>
										  <div class="fw-medium"><?php echo e(__('Available')); ?></div>
										</div>
										<div class="form-check form-switch">
										  <input data-url="<?php echo e(route('setAvailable')); ?>" class="form-check-input toggle-available" type="checkbox" data-id="<?php echo e($number['body']); ?>" <?php echo e($number['set_available'] ? 'checked' : ''); ?>>
										  <span class="ms-2 small toggle-label"><?php echo e($number['set_available'] ? __('Yes') : __('No')); ?></span>
										</div>
									  </div>

									  <div class="d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-warning rounded-2 p-2"><i class="ti tabler-keyboard"></i></span>
										  <div class="fw-medium"><?php echo e(__('Typing')); ?></div>
										</div>
										<div class="form-check form-switch">
										  <input data-url="<?php echo e(route('setHookTyping')); ?>" class="form-check-input toggle-typing" type="checkbox" data-id="<?php echo e($number['body']); ?>" <?php echo e($number['webhook_typing'] ? 'checked' : ''); ?>>
										  <span class="ms-2 small toggle-label"><?php echo e($number['webhook_typing'] ? __('Yes') : __('No')); ?></span>
										</div>
									  </div>

									  <div class="d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center gap-2">
										  <span class="badge bg-label-secondary rounded-2 p-2"><i class="ti tabler-clock"></i></span>
										  <div class="fw-medium"><?php echo e(__('Delay')); ?></div>
										</div>
										<div style="width:140px">
										  <form action="" method="post">
											<?php echo csrf_field(); ?>
											<input type="text" class="form-control form-control-solid-bordered delay-url-form" data-id="<?php echo e($number['body']); ?>" name="" value="<?php echo e($number['delay']); ?>" id="">
										  </form>
										</div>
									  </div>
									</div>
								  </div>
								</td>

								<td>
								  <div class="dropdown position-static">
									<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-base ti tabler-dots-vertical icon-22px"></i></a>
									<ul class="dropdown-menu dropdown-menu-end">
									  <li>
										<a href="<?php echo e(route('scan', $number->body)); ?>" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo e(__('connect Via QR')); ?>">
										  <i class="ti tabler-qrcode me-2"></i> <?php echo e(__('connect Via QR')); ?>

										</a>
									  </li>
									  <li><hr class="dropdown-divider"></li>
									  <li>
										<form action="<?php echo e(route('deleteDevice')); ?>" method="POST">
										  <?php echo method_field('delete'); ?>
										  <?php echo csrf_field(); ?>
										  <input name="deviceId" type="hidden" value="<?php echo e($number['id']); ?>">
										  <button type="submit" name="delete" class="dropdown-item text-danger">
											<i class="ti tabler-trash me-2"></i> <?php echo e(__('Delete')); ?>

										  </button>
										</form>
									  </li>
									</ul>
								  </div>
								</td>
							  </tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </tbody>
						  <tfoot></tfoot>
						</table>
					  </div>

					  <div class="row mx-3 justify-content-between">
						<?php echo e($numbers->links('pagination::bootstrap-5')); ?>

					  </div>
					</div>
				  </div>
				</div>

			  <div class="modal fade" id="addDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Add Device')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('addDevice')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <label for="sender" class="form-label"><?php echo e(__('Number')); ?></label>
                        <input type="number" name="sender" class="form-control" id="nomor" required>
                        <p class="text-small text-danger">*<?php echo e(__('Use Country Code ( without + )')); ?></p>
                        <label for="urlwebhook" class="form-label"><?php echo e(__('Link webhook')); ?></label>
                        <input type="text" name="urlwebhook" class="form-control" id="urlwebhook">
                        <p class="text-small text-danger">*<?php echo e(__('Optional')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="submit" name="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function(){
  let typingTimer;
  const doneTypingInterval = 1000;

  $(document).on('change', '.form-check-input.toggle-full, form-check-input.toggle-read, .form-check-input.toggle-reject, .form-check-input.toggle-available, .form-check-input.toggle-typing', function(){
    const $el = $(this);
    const id = $el.data('id');
    const url = $el.data('url');
    const isChecked = $el.is(':checked');
    let payload = { id: id };
	if($el.hasClass('toggle-full')) payload.webhook_full = isChecked ? '1' : '0';
    else if($el.hasClass('toggle-read')) payload.webhook_read = isChecked ? '1' : '0';
    else if($el.hasClass('toggle-reject')) payload.webhook_reject_call = isChecked ? '1' : '0';
    else if($el.hasClass('toggle-available')) payload.set_available = isChecked ? '1' : '0';
    else if($el.hasClass('toggle-typing')) payload.webhook_typing = isChecked ? '1' : '0';

    $.ajax({
      url: url,
      type: 'POST',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      data: payload,
      success: function(result){
        const $label = $el.siblings('.toggle-label');
        if($label.length) $label.text(isChecked ? "<?php echo e(__('Yes')); ?>" : "<?php echo e(__('No')); ?>");
        if(result && !result.error && result.msg) notyf.success(result.msg);
      }
    });
  });

  $(document).on('keyup', '.webhook-url-form', function(){
    clearTimeout(typingTimer);
    const $el = $(this);
    typingTimer = setTimeout(function(){
      $.ajax({
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '<?php echo e(route('setHook')); ?>',
        data: { number: $el.data('id'), webhook: $el.val() },
        dataType: 'json',
        success: function(){ notyf.success('<?php echo e(__("Webhook URL has been updated")); ?>'); },
        error: function(err){ console.log(err.responseJSON?.msg || err); }
      });
    }, doneTypingInterval);
  });

  $(document).on('keyup', '.delay-url-form', function(){
    clearTimeout(typingTimer);
    const $el = $(this);
    typingTimer = setTimeout(function(){
      $.ajax({
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '<?php echo e(route('setDelay')); ?>',
        data: { number: $el.data('id'), delay: $el.val() },
        dataType: 'json',
        success: function(){ notyf.success('<?php echo e(__("Delay has been updated")); ?>'); },
        error: function(err){ console.log(err); }
      });
    }, doneTypingInterval);
  });
});
</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $attributes = $__attributesOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__attributesOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $component = $__componentOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__componentOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/devices.blade.php ENDPATH**/ ?>