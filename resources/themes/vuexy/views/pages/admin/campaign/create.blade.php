<x-layout-dashboard title="{{__('Create Campaign')}}">
	<style>
		#message-forms > .tab-pane {
		display: none;
		}
	</style>
	<link rel="stylesheet" href="{{ asset('vendor/libs/bs-stepper/bs-stepper.css')}}" />
	<link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
	<link rel="stylesheet" href="{{ asset('vendor/libs/@form-validation/form-validation.css')}}" />
	<link rel="stylesheet" href="{{ asset('vendor/libs/nouislider/nouislider.css')}}" />
	<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);">{{__('Campaign')}}</a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active">{{__('Create')}}</li>
		</ol>
	</nav>
	<!--end breadcrumb-->
	@if (session()->has('alert'))
	<x-alert>
		@slot('type', session('alert')['type'])
		@slot('msg', session('alert')['msg'])
	</x-alert>
	@endif
	@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		<h4 class="alert-heading d-flex align-items-center">
			<span class="alert-icon rounded">
			<i class="icon-base ti tabler-face-id-error icon-md"></i>
			</span>
			{{__('Oh Error :(')}}
		</h4>
		<hr>
		<p class="mb-0">
		<p>{{__('The given data was invalid.')}}</p>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		</p>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif
	{{-- wizard --}}
	@if (!session()->has('selectedDevice'))
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center">{{ __('Please select a device first') }}</div>
			</div>
		</div>
	@else
	<div class="card bs-stepper wizard-numbered">
		<div class="card-body">
			<div class="bs-stepper vertical wizard-modern wizard-modern-vertical mt-2">
				<div class="bs-stepper-header">
					<div class="step" data-target="#step-1">
						<button type="button" class="step-trigger">
						<span class="bs-stepper-circle"><i class="icon-base ti tabler-signature icon-md"></i></span>
						<span class="bs-stepper-label">
						<span class="bs-stepper-title">{{__('Step 1')}}</span>
						<span class="bs-stepper-subtitle">{{__('Create name')}}</span>
						</span>
						</button>
					</div>
					<div class="line"></div>
					<div class="step" data-target="#step-2">
						<button type="button" class="step-trigger">
						<span class="bs-stepper-circle"><i class="icon-base ti tabler-message icon-md"></i></span>
						<span class="bs-stepper-label">
						<span class="bs-stepper-title">{{__('Step 2')}}</span>
						<span class="bs-stepper-subtitle">{{__('Set message and destination')}}</span>
						</span>
						</button>
					</div>
					<div class="line"></div>
					<div class="step" data-target="#step-3">
						<button type="button" class="step-trigger">
						<span class="bs-stepper-circle"><i class="icon-base ti tabler-bell icon-md"></i></span>
						<span class="bs-stepper-label">
						<span class="bs-stepper-title">{{__('Step 3')}}</span>
						<span class="bs-stepper-subtitle">{{__('Delay and Campaign type')}}</span>
						</span>
						</button>
					</div>
				</div>
				<div class="bs-stepper-content pt-3">
					<form>
						<div id="step-1" class="content">
							<div class="form-group">
								<label class="form-label" for="campaignName">{{__('Sender Number / Device')}}</label>
								<input type="text" class="form-control" id="campaignName" name="sender" placeholder="{{__('Enter campaign name')}}" value="{{ session('selectedDevice')['device_body'] }}" disabled>
								<input type="hidden" name="device_id" id="device_id" value="{{ session('selectedDevice')['device_id'] }}">
							</div>
							<div class="form-group mt-4">
								<label class="form-label" for="campaign_name">{{__('Campaign Name')}}</label>
								<input type="text" class="form-control" id="campaign_name" name="campaign_name" placeholder="{{__('Enter campaign name')}}" required>
							</div>
							<div class="d-flex justify-content-between mt-4">
								<button class="btn btn-sm btn-label-secondary btn-prev" disabled>
								<i class="ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
								<span class="d-sm-inline-block d-none">{{__('Previous')}}</span>
								</button>
								<button class="btn btn-sm btn-primary btn-next">
								<span class="d-sm-inline-block d-none me-sm-2">{{__('Next')}}</span>
								<i class="ti tabler-arrow-right icon-xs"></i>
								</button>
							</div>
						</div>
						<div id="step-2" class="content">
							<div class="mb-3 form-group">
								<label class="form-label mb-2">{{ __('Select PhoneBook') }}</label>
								<select id="phonebook_id" name="phonebook_id" class="form-select phonebook-option">
									@foreach ($phonebooks as $phonebook)
									<option value="{{ $phonebook->id }}">
										{{ $phonebook->name }} ({{ $phonebook->contacts_count }} {{ __('Numbers') }})
									</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="type" class="form-label">{{__('Type Message')}}</label>
								<select name="type" id="type" class="form-control" required>
									<option value="" selected disabled>{{__('Select One')}}</option>
									<option value="text">{{__('Text Message')}}</option>
									<option value="product">{{__('Product Message')}}</option>
									<option value="media">{{__('Media Message')}}</option>
									<option value="sticker">{{__('Sticker Message')}}</option>
									<option value="location">{{__('Location Message')}}</option>
									<option value="vcard">{{__('VCard Message')}}</option>
									<option value="list">{{__('List Message')}}</option>
									<option value="button">{{__('Button Message (Must with image)')}}</option>
								</select>
							</div>
							<div class="form-group" id="message-forms">
								@include('theme::ajax.blast.formtext')
								@include('theme::ajax.blast.formproduct')
								@include('theme::ajax.blast.formmedia')
								@include('theme::ajax.blast.formsticker')
								@include('theme::ajax.blast.formlocation')
								@include('theme::ajax.blast.formvcard')
								@include('theme::ajax.blast.formlist')
								@include('theme::ajax.blast.formbutton')
							</div>
							<div id="loadjs"></div>
							<div class="d-flex justify-content-between mt-4">
								<button class="btn btn-sm btn-label-secondary btn-prev">
								<i class="ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
								<span class="d-sm-inline-block d-none">{{__('Previous')}}</span>
								</button>
								<button class="btn btn-sm btn-primary btn-next">
								<span class="d-sm-inline-block d-none me-sm-2">{{__('Next')}}</span>
								<i class="ti tabler-arrow-right icon-xs"></i>
								</button>
							</div>
						</div>
						<div id="step-3" class="content">
							<div class="form-group mt-2">
								<label class="form-label">{{__('Delay Per Message (Second)')}}</label>
								<div id="slider-tap" class="mt-9 mb-5"></div>

								<input type="hidden" name="delay" id="delay" value="10">
								<input type="hidden" name="delay_max" id="delay_max" value="50">
							</div>
							<div class="form-group">
								<label for="tipe" class="form-label">{{__('Type')}}</label>
								<select name="tipe" id="tipe" class="form-control">
									<option value="immediately">{{__('Immediately')}}</option>
									<option value="schedule">{{__('Schedule')}}</option>
								</select>
							</div>
							<div class="form-group d-none" id="datetime">
								<label for="datetime2" class="form-label">{{ __('Date Time') }}</label>
								<input type="datetime-local" id="datetime2" name="datetime" class="form-control" value="{{ old('datetime', \Carbon\Carbon::now()->setTimezone(auth()->user()->timezone ?? config('app.timezone'))->format('Y-m-d\\TH:i')) }}">
							</div>
							<div class="d-flex justify-content-between mt-4">
								<button class="btn btn-sm btn-label-secondary btn-prev">
								<i class="ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
								<span class="d-sm-inline-block d-none">{{__('Previous')}}</span>
								</button>
								<button class="btn btn-sm btn-success btn-submit">{{__('Create Campaign')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{{-- end wizard --}}
	<script src="{{ asset('vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
	<script src="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}" defer></script>
	<script src="{{ asset('vendor/libs/@form-validation/popular.js') }}"></script>
	<script src="{{ asset('vendor/libs/@form-validation/bootstrap5.js') }}"></script>
	<script src="{{ asset('vendor/libs/@form-validation/auto-focus.js') }}"></script>
	<script src="{{ asset('vendor/libs/nouislider/nouislider.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			let currentType = null;
			const stepperEl = document.querySelector('.bs-stepper');
			const stepper = new Stepper(stepperEl, {
				animation: true
			});
			const form = stepperEl.querySelector('form');
			const loadJsContainer = document.getElementById('loadjs');
			
			const sliderTap = document.getElementById('slider-tap');

			noUiSlider.create(sliderTap, {
				start: [10, 50],
				behaviour: 'tap',
				direction: "{{ in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr' }}",
				connect: true,
				range: { min: 1, max: 180 },
				tooltips: [true, true],
				format: {
				  to: v => Math.round(v),
				  from: v => Number(v)
				}
			});
			
			const minInput   = document.getElementById('delay');
			const maxInput   = document.getElementById('delay_max');
			
			sliderTap.noUiSlider.on('update', (values) => {
				const [min, max] = values.map(v => Math.round(v));
				minInput.value = min;
				maxInput.value = max;
			});
			
			function getActivePane() {
				if (!currentType) return null;
				return document.getElementById(`${currentType}message`);
			}
		
			function loadScript(url) {
				const script = document.createElement('script');
				script.src = url;
				script.defer = true;
				loadJsContainer.innerHTML = '';
				loadJsContainer.appendChild(script);
			}
		
			function requiredInput(name) {
				const pane = getActivePane();
				if (!pane) return false;
				const el = pane.querySelector(`[name="${name}"]`);
				return el && el.value.trim().length > 0;
			}
		
			function checkMultipleForm(type) {
				const pane = getActivePane();
				if (!pane) return false;

				if (type === 'button') {
					const buttonTypes = pane.querySelectorAll(`[name^="button["][name$="[type]"]`);
					if (buttonTypes.length === 0) {
						notyf.error(`{{ __("Please add at least one button") }}`);
						return false;
					}
					for (const select of buttonTypes) {
						const id = select.name.match(/\[(\d+)\]/)[1];
						const display = pane.querySelector(`[name="button[${id}][displayText]"]`);
						if (!select.value || !display || !display.value.trim()) {
							notyf.error(`{{ __("All button fields must be filled") }}`);
							return false;
						}
						if (select.value === 'call') {
							const phone = pane.querySelector(`[name="button[${id}][phoneNumber]"]`);
							if (!phone || !phone.value.trim()) {
								notyf.error(`{{ __("Phone number is required for Call button") }}`);
								return false;
							}
						} else if (select.value === 'url') {
							const url = pane.querySelector(`[name="button[${id}][url]"]`);
							if (!url || !url.value.trim()) {
								notyf.error(`{{ __("URL is required for URL button") }}`);
								return false;
							}
						} else if (select.value === 'copy') {
							const code = pane.querySelector(`[name="button[${id}][copyCode]"]`);
							if (!code || !code.value.trim()) {
								notyf.error(`{{ __("Copy text is required for Copy button") }}`);
								return false;
							}
						}
					}
					return true;
				}

				if (type === 'sections') {
					const sections = pane.querySelectorAll('.section');
					if (sections.length === 0) {
						notyf.error(`{{ __("Please add at least one section") }}`);
						return false;
					}

					for (const section of sections) {
						const titleInput = section.querySelector('input[name$="[title]"]');
						if (!titleInput || !titleInput.value.trim()) {
							notyf.error(`{{ __("Section title cannot be empty") }}`);
							return false;
						}
						const rows = section.querySelectorAll('.row-input');
						if (rows.length === 0) {
							notyf.error(`{{ __("Please add at least one row to each section") }}`);
							return false;
						}
						for (const row of rows) {
							const rowTitle = row.querySelector('input[name*="[rows]"][name$="[title]"]');
							if (!rowTitle || !rowTitle.value.trim()) {
								notyf.error(`{{ __("Each row must have a title") }}`);
								return false;
							}
						}
					}
					return true;
				}

				return true;
			}
			
			document.getElementById('productUrl').addEventListener('input', function () {
				const url = this.value.trim();
				if (!url.includes('wa.me/p/')) {
					notyf.error('{{ __("Make sure you are using the correct link (wa.me/p/)") }}');
					return;
				}

				const input = this;
				const loader = document.getElementById('loadingIcon');
				input.disabled = true;
				loader.style.display = 'inline-block';

				fetch(`{{ route('fetch.whatsapp.product') }}?url=${encodeURIComponent(url)}`)
					.then(res => res.json())
					.then(data => {
						document.getElementById('productId').value = data.productId || '';
						document.getElementById('phoneNumber').value = data.phoneNumber || '';
						document.getElementById('productTitle').value = data.productTitle || '';
						document.getElementById('companyName').value = data.companyName || '';
						document.getElementById('description').value = data.description || '';
						document.getElementById('price').value = data.price || '';
						document.getElementById('oldPrice').value = data.oldPrice || '';
						document.getElementById('currency').value = data.currency || '';
						document.getElementById('imageUrl').value = data.image || '';

						document.getElementById('productTitleView').textContent = data.productTitle || '-';
						document.getElementById('productCompany').textContent = data.companyName || '-';
						document.getElementById('productPrice').textContent = data.price 
							? `{{ __('Price:') }} ${data.price} ${data.currency || ''}` : '';
						document.getElementById('productDesc').textContent = data.description || '';
						document.getElementById('productImage').src = data.image || '';
						
						const oldPrice = data.oldPrice ? '<del class="text-muted me-2">'+data.oldPrice+'</del>' : '';
						const currentPrice = data.price ? (data.price + ' ' + (data.currency || '')) : '';
						document.getElementById('productPrice').innerHTML = '{{ __("Price:") }} '+oldPrice+'<strong>'+currentPrice+'</strong>';

						document.getElementById('productPreview').style.display = 'block';
					})
					.catch(() => notyf.error('{{ __("Failed to fetch product data") }}'))
					.finally(() => {
						input.disabled = false;
						loader.style.display = 'none';
					});
			});
		
			document.getElementById('tipe').addEventListener('change', function () {
				document.getElementById('datetime').classList.toggle('d-none', this.value !== 'schedule');
			});
		
			document.getElementById('type').addEventListener('change', function () {
				currentType = this.value;

				const allForms = document.querySelectorAll('#message-forms .tab-pane');
				allForms.forEach(div => {
					div.style.display = 'none';
					div.querySelectorAll('input, select, textarea').forEach(input => input.disabled = true);
				});

				const target = document.getElementById(`${currentType}message`);
				if (target) {
					target.style.display = 'block';
					target.querySelectorAll('input, select, textarea').forEach(input => input.disabled = false);
				}
			});
		
		
			const fv1 = FormValidation.formValidation(document.querySelector('#step-1'), {
				fields: {
					campaign_name: {
						validators: {
							notEmpty: {
								message: '{{ __("Campaign Name is required") }}'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.form-group'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus()
				}
			});
		
			const fv2 = FormValidation.formValidation(document.querySelector('#step-2'), {
				fields: {
					phonebook_id: {
						validators: {
							notEmpty: {
								message: '{{ __("Please select PhoneBook") }}'
							}
						}
					},
					type: {
						validators: {
							notEmpty: {
								message: '{{ __("Please select Message Type") }}'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.form-group'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus()
				}
			});
		
			const fv3 = FormValidation.formValidation(document.querySelector('#step-3'), {
				fields: {
					delay: {
						validators: {
							notEmpty: {
								message: '{{ __("Delay is required") }}'
							},
							between: {
								min: 1,
								max: 180,
								message: '{{ __("Delay must be between 1 and 60") }}'
							}
						}
					},
					tipe: {
						validators: {
							notEmpty: {
								message: '{{ __("Please select Campaign Type") }}'
							}
						}
					},
					datetime: {
						validators: {
							callback: {
								message: '{{ __("Please select valid datetime") }}',
								callback: function (input) {
									return document.getElementById('tipe').value !== 'schedule' || input.value !== '';
								}
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.form-group'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus()
				}
			});
		
			document.querySelectorAll('.btn-next').forEach(btn => {
				btn.addEventListener('click', e => {
					e.preventDefault();
					const i = stepper._currentIndex;
					if (i === 0) {
						fv1.validate().then(r => r === 'Valid' && stepper.next());
					} else if (i === 1) {
						fv2.validate().then(r => {
							if (r !== 'Valid') return;
							const t = document.getElementById('type').value;
							let ok = true;
							if (t === 'text') ok = requiredInput('message');
							else if (t === 'location') ok = requiredInput('latitude');
							else if (t === 'vcard') ok = requiredInput('phone');
							else if (t === 'sticker') ok = document.getElementById('thumbnail-sticker').value.length > 5;
							else if (t === 'media') ok = document.getElementById('thumbnail').value.length > 5;
							else if (t === 'button') ok = requiredInput('message') && checkMultipleForm('button');
							else if (t === 'list') {  ok = requiredInput('message') && 
								   requiredInput('buttontext') && 
								   requiredInput('name') && 
								   checkMultipleForm('sections');
							}
							if (ok) stepper.next();
							else notyf.error('{{ __("Please fill all required fields.") }}');
						});
					}
				});
			});
		
			document.querySelectorAll('.btn-prev').forEach(button => {
				button.addEventListener('click', function (e) {
					e.preventDefault();
					stepper.previous();
				});
			});
		
			document.querySelector('.btn-submit').addEventListener('click', function () {
				fv3.validate().then(function (result) {
					if (result !== 'Valid') return;
					const formData = new FormData();

					const visibleForm = document.querySelector('#message-forms .tab-pane[style*="display: block"]');
					const staticFields = document.querySelectorAll(
						'#step-1 input, #step-1 select, #step-1 textarea, ' +
						'#step-2 > .form-group > select, #step-3 input, #step-3 select, #step-3 textarea'
					);

					staticFields.forEach(el => {
						if (el.name) formData.append(el.name, el.value);
					});

					if (visibleForm) {
						visibleForm
						  .querySelectorAll('input, select, textarea')
						  .forEach(el => {
							if (!el.name) return;

							if (el.type === 'radio' && !el.checked) return;
							if (el.type === 'checkbox' && !el.checked) return;

							formData.append(el.name, el.value);
						  });
					}

					$.ajax({
						url: '{{route("campaign.store")}}',
						method: 'POST',
						data: formData,
						processData: false,
						contentType: false,
						headers: {
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						success(res) {
							if (res.error) {
								notyf.error(res.message);
							} else {
								notyf.success(res.message);
								form.reset();
								stepper.to(1);
							}
						},
						error(err) {
							console.error(err);
							notyf.error('{{ __("An error occurred while submitting the form.") }}');
						}
					});
				});
			});
		});
	</script>
@endif
</x-layout-dashboard>