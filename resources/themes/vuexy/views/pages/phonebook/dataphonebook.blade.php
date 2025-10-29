@foreach ($phonebooks as $phonebook)
    <div class="d-flex justify-content-between align-items-center mb-2 px-1">
        <a href="javascript:;"
           onclick="clickPhoneBook({{ $phonebook->id }}, this)"
           data-phonebook-id="{{ $phonebook->id }}"
           class="list-group-item list-group-item-action d-flex align-items-center single-phonebook gap-2 flex-grow-1 me-2">
            <i class="ti tabler-bookmark text-primary"></i>
            <span class="text-truncate" style="max-width: 160px;">{{ $phonebook->name }}</span>
        </a>

        <div class="d-flex align-items-center gap-1">
            <button class="btn btn-sm text-muted px-1" onclick="navigator.clipboard.writeText('{{ $phonebook->name }}'); notyf.success('Copied!')"
                    title="Copy Group Name">
                <i class="ti tabler-copy"></i>
            </button>

            <form action="{{ route('tag.delete') }}" method="POST"
                  onsubmit="return confirm('{{ __('do you sure want to delete this tag? ( All contacts in this tag also will delete! )') }}')"
                  class="m-0">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $phonebook->id }}">
                <button type="submit" class="btn btn-sm text-danger px-1" title="Delete">
                    <i class="ti tabler-trash"></i>
                </button>
            </form>
        </div>
    </div>
@endforeach
