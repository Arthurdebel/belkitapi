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
		<div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
			<h5 class="card-title mb-0">
				{{ __('Lists auto respond') }}
				@if (Session::has('selectedDevice'))
					<span class="text-muted small">({{ Session::get('selectedDevice')['device_body'] }})</span>
				@endif
			</h5>

			<div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
				<button type="button"
						class="btn btn-sm btn-primary d-flex align-items-center gap-1"
						data-bs-toggle="modal"
						data-bs-target="#addAutoRespond">
					<i class="ti tabler-plus me-1"></i>  {{ __('New Auto Reply') }}
				</button>

				<form method="GET" class="position-relative">
					<button type="submit" class="btn position-absolute top-50 start-0 translate-middle-y ps-3 pe-2 border-0 bg-transparent">
						<i class="ti tabler-search"></i>
					</button>
					<input type="text"
						   name="keyword"
						   class="form-control ps-5 pe-3"
						   placeholder="{{ __('search') }}"
						   value="{{ request()->get('keyword', '') }}">
				</form>
			</div>
		</div>
		<div class="card-body" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
    <div>
        <table class="table table-hover align-middle text-center w-100" style="font-size: 0.78rem; table-layout: auto;">
            <thead class="border-top">
                <tr class="align-middle">
                    <th>{{ __('Keyword') }}</th>
                    <th>{{ __('Details') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Read') }}</th>
                    <th>{{ __('Typing') }}</th>
                    <th>{{ __('Quoted') }}</th>
                    <th>{{ __('Delay') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (Session::has('selectedDevice'))
                    @if ($autoreplies->total() == 0)
                        <x-no-data colspan="9" text="{{ __('No Autoreplies added yet') }}" />
                    @endif

                    @foreach ($autoreplies as $autoreply)
                        <tr>
                            <td>
                                <input type="text" name="id" class="form-control form-control-sm keyword-update tags-input"
                                       data-id="{{ $autoreply->id }}"
                                       data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                       value="{{ $autoreply->keyword }}">
                            </td>
                            <td>
                                <div class="d-grid gap-1">
                                    <span class="badge bg-success text-wrap">{{ __($autoreply['type_keyword']) }}</span>
                                    <span class="badge bg-warning text-wrap">{{ __($autoreply['reply_when']) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-status"
                                           data-id="{{ $autoreply->id }}"
                                           data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                           {{ $autoreply->status == 'active' ? 'checked' : '' }}>
                                </div>
                                <small class="d-block mt-1 text-muted">{{ __($autoreply->status) }}</small>
                            </td>
                            <td>
                                <div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-read"
                                           data-id="{{ $autoreply->id }}"
                                           data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                           {{ $autoreply->is_read ? 'checked' : '' }}>
                                </div>
                                <small class="d-block mt-1 text-muted">{{ $autoreply->is_read ? __('Yes') : __('No') }}</small>
                            </td>
                            <td>
                                <div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-typing"
                                           data-id="{{ $autoreply->id }}"
                                           data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                           {{ $autoreply->is_typing ? 'checked' : '' }}>
                                </div>
                                <small class="d-block mt-1 text-muted">{{ $autoreply->is_typing ? __('Yes') : __('No') }}</small>
                            </td>
                            <td>
                                <div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
                                    <input type="checkbox" class="form-check-input toggle-quoted"
                                           data-id="{{ $autoreply->id }}"
                                           data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                           {{ $autoreply->is_quoted ? 'checked' : '' }}>
                                </div>
                                <small class="d-block mt-1 text-muted">{{ $autoreply->is_quoted ? __('Yes') : __('No') }}</small>
                            </td>
                            <td style="width: 80px;">
                                <input type="text" name="delay" class="form-control form-control-sm delay-update"
                                       data-id="{{ $autoreply->id }}"
                                       data-url="{{ route('autoreply.update', $autoreply->id) }}"
                                       value="{{ $autoreply->delay }}">
                            </td>
                            <td>{{ __($autoreply['type']) }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="javascript:;" onclick="viewReply({{ $autoreply->id }})"
                                       class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="{{ __('Views') }}">
                                        <i class="ti tabler-eye"></i>
                                    </a>
                                    <a href="{{ route('autoreply.edit', ['id' => $autoreply->id]) }}"
                                       class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="{{ __('Edit') }}">
                                        <i class="ti tabler-edit"></i>
                                    </a>
                                    <form action="{{ route('autoreply.delete') }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $autoreply->id }}">
                                        <button type="submit" name="delete" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Delete') }}">
                                            <i class="ti tabler-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center text-muted">{{ __('Please select device') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="row mx-3 justify-content-between">
		{{ $autoreplies->links('pagination::bootstrap-5') }}
	</div>
</div>

	</div>
	<!-- Modal -->
	<div class="modal fade" id="addAutoRespond" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{__('Add Auto Reply')}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <div class="modal-body px-4">
                <form action="" method="POST" enctype="multipart/form-data" id="formautoreply">
                    @csrf

                    @if (Session::has('selectedDevice'))
                        <input type="hidden" name="device" value="{{ Session::get('selectedDevice.device_id') }}">
                        <input type="hidden" name="device_body" id="device" class="form-control" value="{{ Session::get('selectedDevice.device_body') }}" readonly>
                    @else
                        <input type="text" name="devicee" id="device" class="form-control mb-3" value="{{ __('Please select device') }}" readonly>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Type Keyword') }}</label>
                            <div class="d-flex flex-wrap gap-3 mt-1">
                                <div class="form-check">
                                    <input type="radio" value="Equal" name="type_keyword" checked class="form-check-input" id="keywordTypeEqual">
                                    <label class="form-check-label" for="keywordTypeEqual">{{ __('Equal') }}</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" value="Contain" name="type_keyword" class="form-check-input" id="keywordTypeContain">
                                    <label class="form-check-label" for="keywordTypeContain">{{ __('Contains') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Only reply when sender is') }}</label>
                            <div class="d-flex flex-wrap gap-3 mt-1">
                                <div class="form-check">
                                    <input type="radio" value="Group" name="reply_when" class="form-check-input" id="replyWhenGroup">
                                    <label class="form-check-label" for="replyWhenGroup">{{ __('Group') }}</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" value="Personal" name="reply_when" class="form-check-input" id="replyWhenPersonal">
                                    <label class="form-check-label" for="replyWhenPersonal">{{ __('Personal') }}</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" value="All" checked name="reply_when" class="form-check-input" id="replyWhenAll">
                                    <label class="form-check-label" for="replyWhenAll">{{ __('All') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="keyword" class="form-label">{{ __('Keyword') }}</label>
                            <input type="text" name="keyword" class="form-control tags-input-add" id="keyword" required placeholder="{{ __('e.g. hello, info, price') }}">
                        </div>

                        <div class="col-md-12">
                            <label for="type" class="form-label">{{ __('Type Reply') }}</label>
                            <select name="type" id="type" class="form-select" required>
                                <option selected disabled>{{ __('Select One') }}</option>
                                <option value="text">{{ __('Text Message') }}</option>
                                <option value="media">{{ __('Media Message') }}</option>
                                <option value="product">{{ __('Product Message') }}</option>
                                <option value="location">{{ __('Location Message') }}</option>
                                <option value="sticker">{{ __('Sticker Message') }}</option>
                                <option value="vcard">{{ __('VCard Message') }}</option>
                                <option value="list">{{ __('List Message') }}</option>
                                <option value="button">{{ __('Button Message (Must with image)') }}</option>
                            </select>
                        </div>

                        <div class="col-md-12 ajaxplace"></div>
                        <div class="col-md-12" id="loadjs"></div>
                    </div>

                    <div class="modal-footer mt-4 px-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="ti tabler-x"></i> {{ __('Close') }}
                        </button>
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="ti tabler-send"></i> {{ __('Add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

	<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{__('Auto Reply Preview')}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body showReply">
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
	<script src="https://woody180.github.io/vanilla-javascript-emoji-picker/vanillaEmojiPicker.js"></script>
	<script src="{{asset('js/autoreply2.js')}}"></script>
	<script>
		function loadScript(url) {
			  var script = document.createElement('script');
			  script.src = url;
			  document.getElementById("loadjs").appendChild(script); 
		}
		window.addEventListener('load', function() {
			$(document).ready(function() {
			$('#type').on('change', () => {
				const type = $('#type').val();
				$.ajax({
					url: "{{ route('formMessage', ['type' => '___TYPE___']) }}".replace('___TYPE___', type),
					
					type: "GET",
					dataType: "html",
					success: (result) => {
						document.getElementById('loadjs').innerHTML = '';
						$(".ajaxplace").html(result);
						loadScript('{{asset("js/text.js")}}');
						loadScript('{{asset("vendor/laravel-filemanager/js/stand-alone-button2.js")}}');
					},
					error: (error) => {
						console.log(error);
					},
				});
			});
			});
		});
		function viewReply(id) {
			$.ajax({
				url: "{{ route('previewMessage') }}",
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				type: "POST",
				data: {
					id: id,
					table: "autoreplies",
					column: "reply",
				},
				dataType: "html",
				success: (result) => {
					$(".showReply").html(result);
					$("#modalView").modal("show");
				},
				error: (error) => {
					console.log(error);
				},
			});
			// 
		}
	</script>
@endif
</x-layout-dashboard>