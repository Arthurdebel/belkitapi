<x-layout-dashboard title="{{__('Phone book')}}">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);">{{__('Phonebook')}}</a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active">{{__('Contact')}}</li>
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
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            {{ __('Phonebook') }}
        </h5>
        <div class="d-flex flex-wrap gap-2">
            <form action="{{ route('fetch.groups') }}" method="post" class="m-0">
                @csrf
                <input type="hidden" name="device"
                    value="{{ Session::get('selectedDevice.device_id') }}">
                <button type="submit" class="btn btn-info btn-sm text-white">
                    <i class="ti tabler-device-mobile-message"></i> {{ __('Fetch From Selected Device') }}
                </button>
            </form>
            <button onclick="clearPhonebook()" class="btn btn-outline-danger btn-sm">
                <i class="ti tabler-trash"></i> {{ __('Clear Phonebook') }}
            </button>
        </div>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-primary"><i class="ti tabler-folder"></i> {{ __('Tags') }}</h6>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addTag">
                            <i class="ti tabler-plus"></i>
                        </button>
                    </div>
                    <div class="card-body px-3 py-2">
                        <input type="text" class="form-control mb-3 search-phonebook" placeholder="{{ __('Search phonebook') }}">
                        <div class="list-group list-group-flush phone-book-list" style="max-height: 400px; overflow-y: auto;">
                            <div class="text-center load-phonebook text-danger py-3">
                                <i class="ti tabler-loader"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-outline-secondary btn-sm load-more" data-page="1">
                            <i class="ti tabler-refresh"></i> {{ __('Load More') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <button onclick="deleteAllContact()" class="btn btn-sm btn-danger">
                                <i class="ti tabler-trash-x"></i> {{ __('Delete All') }}
                            </button>
                            <div class="input-group w-50">
                                <span class="input-group-text bg-white"><i class="ti tabler-search"></i></span>
                                <input type="text" class="form-control search-contact" placeholder="{{ __('Search contacts') }}">
                            </div>
                            <div class="d-flex gap-2">
                                <button class="badge btn-sm bg-primary-subtle text-primary" onclick="addContact()">
                                    <i class="ti tabler-user-plus"></i> {{ __('Add') }}
                                </button>
                                <button class="badge btn-sm bg-success-subtle text-success" onclick="importContact()">
                                    <i class="ti tabler-upload"></i> {{ __('Import') }}
                                </button>
                                <button class="badge btn-sm bg-warning-subtle text-warning" onclick="exportContact()">
                                    <i class="ti tabler-download"></i> {{ __('Export') }}
                                </button>
                            </div>
                        </div>

                        <div class="contacts-list"></div>

                        <div class="text-center text-muted mt-4 process-get-contact">
                            <i class="ti tabler-info-circle me-1"></i> {{ __('Please select phonebook to show contact') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


    {{-- modal add phonebook --}}
    <div class="modal fade" id="addTag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Add Tag')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tag.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">{{__('Add')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal add contact -->
    <div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Add Contact')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="add-contact-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control contact-name" id="name"
                            required>
                        <label for="number" class="form-label">{{__('Number')}}</label>
                        <input type="number" name="number" class="form-control contact-number" id="number"
                            required>
                        <input type="hidden" class="input_phonebookid" name="tag_id" value=" ">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary add-contact">{{__('Add')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal add contact -->
    <!-- modal import contact -->
    <div class="modal fade" id="importContacts" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Import Contacts')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="import-contact-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="fileContacts" class="form-label">{{__('File (xlsx )')}}</label>
                        <input accept=".xlsx" type="file" name="fileContacts"
                            class="form-control file-import" id="fileContacts" required>

                        <input type="hidden" name="tag_id" value="" class="import_phonebookid">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">{{__('Import')}}</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal import contact --}}


    </div>
    <!-- end modal import contact -->

    </div>
    <script src="{{ asset('js/phonebook.js') }}"></script>
</x-layout-dashboard>
