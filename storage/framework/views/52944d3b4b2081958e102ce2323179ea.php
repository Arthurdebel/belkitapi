<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Settings Server')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Settings Server')).'']); ?>
    <!--breadcrumb-->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);"><?php echo e(__('Admin')); ?></a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active"><?php echo e(__('Setting Server')); ?></li>
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
<div class="card mb-4">
    <div class="card-body">
        <h5 class="mb-3"><i class="ti tabler-server me-1"></i> <?php echo e(__('Server Type')); ?> & <?php echo e(__('Port Node JS')); ?></h5>
        <form action="<?php echo e(route('setServer')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="typeServer" class="form-label"><?php echo e(__('Server Type')); ?></label>
                    <select name="typeServer" id="server" class="form-select" required>
                        <option value="localhost" <?php echo e(env('TYPE_SERVER') === 'localhost' ? 'selected' : ''); ?>><?php echo e(__('Localhost')); ?></option>
                        <option value="hosting" <?php echo e(env('TYPE_SERVER') === 'hosting' ? 'selected' : ''); ?>><?php echo e(__('Hosting Shared')); ?></option>
                        <option value="other" <?php echo e(env('TYPE_SERVER') === 'other' ? 'selected' : ''); ?>><?php echo e(__('Other')); ?></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="Port" class="form-label"><?php echo e(__('Port Node JS')); ?></label>
                    <input type="number" name="portnode" id="Port" class="form-control" value="<?php echo e(env('PORT_NODE')); ?>" required>
                </div>
            </div>

            <div class="row g-3 mt-2 <?php echo e(env('TYPE_SERVER') === 'other' ? '' : 'd-none'); ?> formUrlNode">
                <div class="col-md-12">
                    <label class="form-label"><?php echo e(__('URL Node')); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><?php echo e(__('URL')); ?></span>
                        <input type="text" name="urlnode" value="<?php echo e(env('WA_URL_SERVER')); ?>" class="form-control">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="ti tabler-check me-1"></i> <?php echo e(__('Update')); ?>

                </button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body text-center">
        <h5 class="mb-3"><i class="ti tabler-shield-lock me-1"></i> <?php echo e(__('Generate SSL For Your NodeJS')); ?></h5>
        <form action="<?php echo e(route('generateSsl')); ?>" method="POST" class="row g-3 justify-content-center">
            <?php echo csrf_field(); ?>
            <div class="col-md-5">
                <label class="form-label"><?php echo e(__('Domain')); ?></label>
                <input type="text" name="domain" value="<?php echo e($host); ?>" class="form-control" readonly <?php echo e($host === 'localhost' ? 'disabled' : ''); ?>>
            </div>
            <div class="col-md-5">
                <label class="form-label"><?php echo e(__('Email')); ?></label>
                <input type="email" name="email" class="form-control" <?php echo e($host === 'localhost' ? 'disabled readonly' : 'required'); ?>>
            </div>
            <div class="col-12">
                <button class="btn <?php echo e($host === 'localhost' ? 'btn-danger' : 'btn-success'); ?> btn-sm" type="submit" <?php echo e($host === 'localhost' ? 'disabled' : ''); ?>>
                    <i class="ti tabler-lock me-1"></i>
                    <?php echo e($host === 'localhost' ? __("You Can't Generate SSL For Localhost") : __('Generate SSL Certificate')); ?>

                </button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="text-center mb-4"><i class="ti tabler-settings me-1"></i> <?php echo e(__('Env file Settings')); ?></h5>
        <form method="POST" action="<?php echo e(route('setEnvAll')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                <?php $__currentLoopData = $allEnv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($key, [
                        'APP_KEY', 'APP_URL', 'PORT_NODE', 'THEME_NAME', 'WA_URL_SERVER', 'LICENSE_KEY', 
                        'APP_INSTALLED', 'TYPE_SERVER', 'DB_CONNECTION', 'LOG_DEPRECATIONS_CHANNEL', 'REDIS_PASSWORD',
                        'REDIS_HOST', 'REDIS_PORT', 'MIX_PUSHER_APP_KEY', 'MIX_PUSHER_APP_CLUSTER', 'AUTH', 'PORT',
                        'THEME_INDEX', 'ENABLE_INDEX', 'WEBHOOK', 'MEMCACHED_HOST', 'ORIGIN', 'LOG_CHANNEL'
                    ])): ?>
                        <div class="col-md-6 mb-4">
                            <label class="form-label"><?php echo e(ucfirst(strtolower(str_replace("_", " ", $key)))); ?></label>
                            <input type="text" class="form-control" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                            <small class="form-text text-muted mt-1">
                                <?php switch($key):
                                    case ('APP_NAME'): ?>
                                        <?php echo e(__('The name of the application, shown in page titles and notifications.')); ?>

                                        <?php break; ?>
                                    <?php case ('APP_ENV'): ?>
                                        <?php echo e(__('The environment of the application (e.g., local for development, production for live use).')); ?>

                                        <?php break; ?>
                                    <?php case ('APP_DEBUG'): ?>
                                        <?php echo e(__('Enables or disables debugging mode.')); ?>

                                        <?php break; ?>
                                    <?php case ('BUYER_EMAIL'): ?>
                                        <?php echo e(__('The email of the buyer or license holder.')); ?>

                                        <?php break; ?>
                                    <?php case ('DB_HOST'): ?>
                                        <?php echo e(__('The host address of the database.')); ?>

                                        <?php break; ?>
                                    <?php case ('DB_PORT'): ?>
                                        <?php echo e(__('The port used to connect to the database.')); ?>

                                        <?php break; ?>
                                    <?php case ('DB_DATABASE'): ?>
                                        <?php echo e(__('The name of the database.')); ?>

                                        <?php break; ?>
                                    <?php case ('DB_USERNAME'): ?>
                                        <?php echo e(__('The username for the database connection.')); ?>

                                        <?php break; ?>
                                    <?php case ('DB_PASSWORD'): ?>
                                        <?php echo e(__('The password for the database connection.')); ?>

                                        <?php break; ?>
                                    <?php case ('LOG_CHANNEL'): ?>
                                        <?php echo e(__('The channel used for logging.')); ?>

                                        <?php break; ?>
                                    <?php case ('LOG_LEVEL'): ?>
                                        <?php echo e(__('The level of logs to record (e.g., debug, error).')); ?>

                                        <?php break; ?>
                                    <?php case ('BROADCAST_DRIVER'): ?>
                                        <?php echo e(__('The driver used for broadcasting events.')); ?>

                                        <?php break; ?>
                                    <?php case ('CACHE_DRIVER'): ?>
                                        <?php echo e(__('The driver used for caching.')); ?>

                                        <?php break; ?>
                                    <?php case ('FILESYSTEM_DRIVER'): ?>
                                        <?php echo e(__('The driver used for the file system (e.g., local, s3).')); ?>

                                        <?php break; ?>
                                    <?php case ('QUEUE_CONNECTION'): ?>
                                        <?php echo e(__('The connection used for job queues.')); ?>

                                        <?php break; ?>
                                    <?php case ('SESSION_DRIVER'): ?>
                                        <?php echo e(__('The driver used for session management.')); ?>

                                        <?php break; ?>
                                    <?php case ('SESSION_LIFETIME'): ?>
                                        <?php echo e(__('The lifetime of a session, in minutes.')); ?>

                                        <?php break; ?>
                                    <?php case ('CHATGPT_URL'): ?>
                                        <?php echo e(__('The URL for the ChatGPT API.')); ?>

                                        <?php break; ?>
                                    <?php case ('CHATGPT_MODEL'): ?>
                                        <?php echo e(__('The model used in ChatGPT (e.g., gpt-3.5-turbo).')); ?>

                                        <?php break; ?>
                                    <?php case ('GEMINI_URL'): ?>
                                        <?php echo e(__('The URL for the Gemini API.')); ?>

                                        <?php break; ?>
                                    <?php case ('CLAUDE_URL'): ?>
                                        <?php echo e(__('The URL for the Claude API.')); ?>

                                        <?php break; ?>
                                    <?php case ('CLAUDE_MODEL'): ?>
                                        <?php echo e(__('The model used in Claude.')); ?>

                                        <?php break; ?>
                                    <?php case ('DALLE_URL'): ?>
                                        <?php echo e(__('The URL for the DALLE API.')); ?>

                                        <?php break; ?>
                                    <?php case ('DALLE_SIZE'): ?>
                                        <?php echo e(__('The image size for DALLE API.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_MAILER'): ?>
                                        <?php echo e(__('The driver used for sending emails (e.g., smtp).')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_HOST'): ?>
                                        <?php echo e(__('The host address for the email service.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_PORT'): ?>
                                        <?php echo e(__('The port used for the email service.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_USERNAME'): ?>
                                        <?php echo e(__('The username for the email service.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_PASSWORD'): ?>
                                        <?php echo e(__('The password for the email service.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_ENCRYPTION'): ?>
                                        <?php echo e(__('The encryption type used for emails (e.g., tls).')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_FROM_ADDRESS'): ?>
                                        <?php echo e(__('The default sender email address.')); ?>

                                        <?php break; ?>
                                    <?php case ('MAIL_FROM_NAME'): ?>
                                        <?php echo e(__('The default sender name.')); ?>

                                        <?php break; ?>
									<?php case ('TRIAL_DEVICES_LIMIT'): ?>
                                        <?php echo e(__('Number of devices limit in the trial.')); ?>

                                        <?php break; ?>
									<?php case ('TRIAL_MESSAGE_LIMIT'): ?>
                                        <?php echo e(__('Number of messages limit in the trial.')); ?>

                                        <?php break; ?>
									<?php case ('GEMINI_MODEL'): ?>
                                        <?php echo e(__('The model used in Gemini.')); ?>

                                        <?php break; ?>
                                    <?php default: ?>
                                        <?php echo e(__('No description available for this key.')); ?>

                                <?php endswitch; ?>
                            </small>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="ti tabler-edit me-1"></i> <?php echo e(__('Edit')); ?>

                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const serverSelect = document.querySelector('#server');
        const formUrlNode = document.querySelector('.formUrlNode');

        serverSelect.addEventListener('change', function () {
            formUrlNode.classList.toggle('d-none', this.value !== 'other');
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\resources\themes/vuexy/views/pages/admin/settings.blade.php ENDPATH**/ ?>