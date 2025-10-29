<x-layout-dashboard title="{{__('Auto Replies')}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" defer></script>
	<style>
        .bootstrap-tagsinput {
            width: 100%;
            padding: 0.5rem;
            display: flex;
            flex-wrap: wrap;
        }

        .bootstrap-tagsinput input {
            flex: 1;
            min-width: 50px;
            border: none;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 5px;
            margin-bottom: 5px;
            color: white;
            background-color: #007bff;
            padding: 0.2rem 0.5rem;
            border-radius: 0.2rem;
        }
    </style>
	<!--breadcrumb-->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);">{{__('Whatsapp')}}</a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active">{{__('Auto Reply')}}</li>
		</ol>
	</nav>
	<!--end breadcrumb-->
	{{-- alert --}}
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
    {{--  --}}
	@if (!session()->has('selectedDevice'))
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center">{{ __('Please select a device first') }}</div>
			</div>
		</div>
	@else
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Edit Auto Reply')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('autoreply.edit.update') }}" method="POST" enctype="multipart/form-data" id="formautoreplyedit{{ $autoreply->id }}">
                        @csrf
						@if (Session::has('selectedDevice'))
						<input type="hidden" name="device" value="{{ Session::get('selectedDevice.device_id') }}">
						<input type="hidden" name="device_body" id="device" class="form-control" value="{{ Session::get('selectedDevice.device_body') }}" readonly>
						@else
						<input type="text" name="devicee" id="device" class="form-control mb-3" value="{{ __('Please select device') }}" readonly>
						@endif
						<input type="hidden" name="edit_id" value="{{ $autoreply->id }}">
						<div class="row g-3">
							<div class="col-md-6">
								<label class="form-label">{{ __('Type Keyword') }}</label>
								<div class="d-flex flex-wrap gap-3 mt-1">
									<div class="form-check">
										<input type="radio" value="Equal" name="type_keyword" class="form-check-input" id="keywordTypeEqual" @if ($autoreply->type_keyword == 'Equal') checked @endif>
										<label class="form-check-label" for="keywordTypeEqual">{{ __('Equal') }}</label>
									</div>
									<div class="form-check">
										<input type="radio" value="Contain" name="type_keyword" class="form-check-input" id="keywordTypeContain" @if ($autoreply->type_keyword == 'Contain') checked @endif>
										<label class="form-check-label" for="keywordTypeContain">{{ __('Contains') }}</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">{{ __('Only reply when sender is') }}</label>
								<div class="d-flex flex-wrap gap-3 mt-1">
									<div class="form-check">
										<input type="radio" value="Group" name="reply_when" class="form-check-input" id="replyWhenGroup" @if ($autoreply->reply_when == 'Group') checked @endif>
										<label class="form-check-label" for="replyWhenGroup">{{ __('Group') }}</label>
									</div>
									<div class="form-check">
										<input type="radio" value="Personal" name="reply_when" class="form-check-input" id="replyWhenPersonal" @if ($autoreply->reply_when == 'Personal') checked @endif>
										<label class="form-check-label" for="replyWhenPersonal">{{ __('Personal') }}</label>
									</div>
									<div class="form-check">
										<input type="radio" value="All" name="reply_when" class="form-check-input" id="replyWhenAll" @if ($autoreply->reply_when == 'All') checked @endif>
										<label class="form-check-label" for="replyWhenAll">{{ __('All') }}</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label for="keyword" class="form-label">{{ __('Keyword') }}</label>
								<input type="text" name="keyword" class="form-control tags-input-add" id="keyword" required placeholder="{{ __('e.g. hello, info, price') }}" value="{{ $autoreply->keyword }}" >
							</div>
							<div class="col-md-12">
								<label for="type" class="form-label">{{ __('Type Reply') }}</label>
								<select name="type" id="typeEdit{{ $autoreply->id }}" class="js-statesEdit form-control" data-id="{{ $autoreply->id }}" tabindex="-1" required>
									<option selected disabled>{{__('Select One')}}</option>
									<option value="text" @if ($autoreply->type == 'text') selected @endif>{{__('Text Message')}}</option>
									<option value="media" @if ($autoreply->type == 'media') selected @endif>{{__('Media Message')}}</option>
									<option value="product" @if ($autoreply->type == 'product') selected @endif>{{__('Product Message')}}</option>
									<option value="location" @if ($autoreply->type == 'location') selected @endif>{{__('Location Message')}}</option>
									<option value="sticker" @if ($autoreply->type == 'sticker') selected @endif>{{__('Sticker Message')}}</option>
									<option value="vcard" @if ($autoreply->type == 'vcard') selected @endif>{{__('VCard Message')}}</option>
									<option value="list" @if ($autoreply->type == 'list') selected @endif>{{__('List Message')}}</option>
									<option value="button" @if ($autoreply->type == 'button') selected @endif>{{__('Button Message (Must with image)')}}</option>
								</select>
							</div>
							<div class="col-md-12 ajaxplaceEdit{{ $autoreply->id }}"></div>
							<div class="col-md-12" id="loadjs{{ $autoreply->id }}"></div>
						</div>
						<div class="modal-footer mt-4 px-0">
							<button type="submit" name="submit" class="btn btn-primary">
							<i class="ti tabler-send"></i> {{__('Edit')}}
							</button>
						</div>
                    </form>
                </div>
            </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
	<script src="https://woody180.github.io/vanilla-javascript-emoji-picker/vanillaEmojiPicker.js"></script>
	<script>
	window.addEventListener('load', function() {
		$(document).ready(function () {
			$('#keyword').tagsinput({
				confirmKeys: [13, 32]
			});

			$('#keyword').on('keypress', function (e) {
				if (e.which === 32) {
					e.preventDefault();
					$(this).tagsinput('add', $(this).val().trim());
					$(this).val('');
				}
			});
		});
		$(document).on('change', 'select[id^=typeEdit]', function() {
			const type = $(this).val();
			const id = $(this).data('id');
			loadAjaxContent(type, id);
		});
		const type = $('#typeEdit{{ $autoreply->id }}').val();
		loadAjaxContent(type, {{ $autoreply->id }});
	});
	function loadScript(url) {
			  var script = document.createElement('script');
			  script.src = url;
			  document.getElementById("loadjs{{ $autoreply->id }}").appendChild(script); 
	}
	function loadAjaxContent(types, id) {
			$.ajax({
				url: "{{ route('formMessageEdit', ['type' => '___TYPE___']) }}".replace('___TYPE___', types),
				type: "GET",
				data: { id: id, type: types, table: 'autoreplies', column: 'reply' },
				dataType: "html",
				success: (result) => {
					$(`.ajaxplaceEdit{{ $autoreply->id }}`).html(result);
					loadScript('{{asset("js/text.js")}}');
					loadScript('{{asset("vendor/laravel-filemanager/js/stand-alone-button2.js")}}');
				},
				error: (error) => {
					console.log(error);
				},
			});
	}
	</script>
@endif
</x-layout-dashboard>