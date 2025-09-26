<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Manage User')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Manage User')).'']); ?>

<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);"><?php echo e(__('Admin')); ?></a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active"><?php echo e(__('Users')); ?></li>
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

<!-- User Management Card -->
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 d-flex align-items-center gap-2">
            <?php echo e(__('Users')); ?>

        </h5>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-2" onclick="addUser()">
            <i class="ti tabler-user-plus"></i> <?php echo e(__('Add User')); ?>

        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap align-middle mb-0">
                <thead class="border-top">
                    <tr>
                        <th><?php echo e(__('Username')); ?></th>
                        <th class="text-center"><?php echo e(__('Devices')); ?></th>
                        <th class="text-center"><?php echo e(__('Plan')); ?></th>
                        <th class="text-center"><?php echo e(__('Status')); ?></th>
                        <th class="text-center"><?php echo e(__('Expires')); ?></th>
                        <th class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <strong><?php echo e($user->username); ?></strong>
                                    <small class="text-muted"><?php echo e($user->email); ?></small>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary"><?php echo e($user->total_device); ?>/<?php echo e($user->limit_device); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary"><?php echo e($user->plan_name ?? '--'); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?php echo e($user->is_expired_subscription ? 'danger' : 'success'); ?>-subtle text-<?php echo e($user->is_expired_subscription ? 'danger' : 'success'); ?>">
                                    <?php echo e($user->active_subscription); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <?php if($user->is_expired_subscription || $user->active_subscription !== 'active'): ?>
                                    <span class="text-danger">—</span>
                                <?php else: ?>
                                    <span><?php echo e($user->subscription_expired); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-1">
									<a href="<?php echo e(route('admin.loginAsUser', $user->id)); ?>"
									   class="btn btn-outline-warning btn-sm" title="<?php echo e(__('Login')); ?>"
									   onclick="return confirm('<?php echo e(__('Are you sure you want to login as this user?')); ?>')">
										<i class="ti tabler-login-2"></i>
									</a>

									<button class="btn btn-outline-info btn-sm" title="<?php echo e(__('Edit')); ?>"
											onclick="editUser(<?php echo e($user->id); ?>)">
										<i class="ti tabler-edit"></i>
									</button>

									<form method="POST" action="<?php echo e(route('user.delete', $user->id)); ?>"
										  onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete this user?')); ?>')">
										<?php echo csrf_field(); ?>
										<?php echo method_field('DELETE'); ?>
										<button class="btn btn-outline-danger btn-sm" title="<?php echo e(__('Delete')); ?>">
											<i class="ti tabler-trash-x"></i>
										</button>
									</form>
								</div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted"><?php echo e(__('No users found')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($users->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>

<!-- User Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content position-relative">
			<div id="modalOverlay" style="
			   position: absolute;
			   top: 0; left: 0;
			   width: 100%; height: 100%;
			   background: rgba(255,255,255,0.75);
			   display: none;
			   justify-content: center;
			   align-items: center;
			   z-index: 9999;
			 ">
			<div class="spinner-border text-primary" role="status">
			  <span class="visually-hidden"><?php echo e(__('Loading...')); ?></span>
			</div>
		  </div>
            <form id="formUser" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="iduser">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="ti tabler-user-cog"></i> <?php echo e(__('User Details')); ?>

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo e(__('Close')); ?>"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Username')); ?></label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Email')); ?></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label id="labelpassword" class="form-label"><?php echo e(__('Password')); ?></label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Message Limit')); ?></label>
                            <input type="number" class="form-control" name="messages_limit" id="messages_limit" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Limit Device')); ?></label>
                            <input type="number" class="form-control" name="limit_device" id="limit_device" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Active Subscription')); ?></label>
                            <select class="form-select" name="active_subscription" id="active_subscription">
                                <option value="active"><?php echo e(__('Active')); ?></option>
                                <option value="inactive"><?php echo e(__('Inactive')); ?></option>
                                <option value="lifetime"><?php echo e(__('Lifetime')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Subscription Expired')); ?></label>
                            <input type="datetime-local" class="form-control" name="subscription_expired" id="subscription_expired">
                        </div>
						<div class="col-md-6">
                            <label class="form-label"><?php echo e(__('Level')); ?></label>
                            <select class="form-select" name="level" id="level">
                                <option value="user" class="text-success"><?php echo e(__('User')); ?></option>
                                <option value="admin" class="text-danger"><?php echo e(__('Admin')); ?></option>
                            </select>
                        </div>
						<div class="col-md-12">
							<label class="form-label"><?php echo e(__('Plan')); ?></label>
							<select class="form-select" id="plan_selector">
								<option value=""><?php echo e(__('-- Custom --')); ?></option>
								<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($p->id); ?>"><?php echo e($p->title); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<input type="hidden" name="plan_name" id="plan_name">
                        <div class="col-12">
                            <label class="form-label"><?php echo e(__('Plan Features')); ?></label>
                            <div class="row g-2">
								<?php
								$features = [
										'ai_message' => __('AI Message'),
										'schedule_message' => __('Schedule Message'),
										'bulk_message' => __('Bulk Message'),
										'autoreply' => __('Auto Reply'),
										'send_message' => __('Send Message'),
										'send_media' => __('Send Media'),
										'send_product' => __('Send Product'),
										'send_text_channel' => __('Text To Channel'),
										'send_list' => __('Send List'),
										'send_button' => __('Send Button'),
										'send_location' => __('Send Location'),
										'send_poll' => __('Send Poll'),
										'send_sticker' => __('Send Sticker'),
										'send_vcard' => __('Send VCard'),
										'webhook' => __('Webhook'),
										'api' => __('API')
									];
								?>
                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="plan_data[<?php echo e($key); ?>]" id="<?php echo e($key); ?>">
                                            <label class="form-check-label" for="<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-sm btn-primary"><?php echo e(__('Save Changes')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script -->
<script>
const PLANS = <?php echo json_encode($plansJson, 15, 512) ?>;

function setFeatures(features) {
    $('input[type=checkbox][name^="plan_data["]').each(function(){
        const key = $(this).attr('name').replace('plan_data[','').replace(']','');
        const val = !!(features && features[key] === true);
        $(this).prop('checked', val);
    });
    if (features && typeof features.messages_limit !== 'undefined') $('#messages_limit').val(features.messages_limit);
    if (features && typeof features.device_limit !== 'undefined') $('#limit_device').val(features.device_limit);
}
window.addEventListener('load', function() {
    $(document).ready(function () {
		$('#plan_selector').on('change', function(){
			const id = parseInt($(this).val() || 0);
			const p = PLANS.find(x => x.id === id);
			if (p) {
				setFeatures(p.data || {});
				$('#plan_name').val(p.title);
			} else {
				$('#plan_name').val('');
			}
		});
    });
});
function addUser() {
    $('#modalLabel').html('<?php echo e(__("Add User")); ?>');
    $('#formUser').attr('action', '<?php echo e(route('user.store')); ?>');
    $('#formUser').trigger('reset');
    $('input[type=checkbox]').prop('checked', false);
    $('#plan_selector').val('');
    $('#plan_name').val('');
    $('#modalUser').modal('show');
}

function editUser(id) {
  $('#modalLabel').text('<?php echo e(__("Edit User")); ?>');
  $('#formUser').attr('action', '<?php echo e(route("user.update")); ?>');

  $('#modalOverlay').css('display','flex');
  $('#modalUser').modal('show');

  $.ajax({
    url: "<?php echo e(route('user.edit')); ?>",
    type: "GET",
    data: { id: id },
    dataType: "JSON",
    success: function(data) {
      const features = data.plan_data || {};
      $('#username').val(data.username);
      $('#email').val(data.email);
      $('#password').val('');
      $('#messages_limit').val(features.messages_limit ?? 0);
      $('#limit_device').val(features.device_limit ?? 0);
      $('#active_subscription').val(data.active_subscription);
      $('#level').val(data.level);
      if (data.subscription_expired) {
        $('#subscription_expired').val(data.subscription_expired.substring(0,16));
      }
      $('#iduser').val(data.id);
      $('input[type=checkbox][name^="plan_data["]').each(function(){
        const name = $(this).attr('name').replace('plan_data[','').replace(']','');
        $(this).prop('checked', features[name] === true);
      });
      $('#plan_name').val(data.plan_name || '');
      let matched = '';
      if (data.plan_name) {
        const m = PLANS.find(p => p.title === data.plan_name);
        if (m) matched = String(m.id);
      }
      $('#plan_selector').val(matched);
      $('#modalOverlay').css('display','none');
    },
    error: function(){
      $('#modalOverlay').css('display','none');
      notyf.error('<?php echo e(__("Failed to load user data.")); ?>');
    }
  });
}
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/pages/admin/manageusers.blade.php ENDPATH**/ ?>