<div class="tab-pane fade show" id="buttonmessage" role="tabpanel">
<div class="form-group">
    <label for="message" class="form-label">{{ __('Message') }}</label>
    <textarea name="message" class="form-control" id="message" required></textarea>
</div>

<div class="form-group mt-2">
    <label for="footer" class="form-label">{{ __('Footer message *optional') }}</label>
    <input type="text" name="footer" class="form-control" id="footer">
</div>

<div class="form-group mt-2">
    <label class="form-label">{{ __('Image') }}
        <span class="text-sm text-warning">*{{ __('Required') }}</span>
    </label>
    <div class="input-group">
        <span class="input-group-btn">
            <a id="image-button" data-input="thumbnail-button" data-preview="holder" class="btn btn-primary text-white">
                <i class="fa fa-picture-o"></i> {{ __('Choose') }}
            </a>
        </span>
        <input id="thumbnail-button" class="form-control" type="text" name="image" required>
    </div>
</div>

<div id="buttons-area" class="mt-3"></div>

<button type="button" id="add-button" class="btn btn-success btn-sm mt-4">{{ __('Add Button') }}</button>

                </div>
<script>
let buttonIndex = 0;
const maxButtons = 4;

document.getElementById('add-button').addEventListener('click', function () {
    if (buttonIndex >= maxButtons) {
        toastr.warning("{{ __('Maximal 4 button') }}");
        return;
    }

    const label = "{{ __('Button :x') }}".replace(':x', buttonIndex + 1);

    const buttonHtml = `
    <div class="card mb-3 button-block" id="button${buttonIndex}">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>${label}</strong>
            <a class="remove-button" data-id="${buttonIndex}">
                <i class="icon-base ti tabler-trash icon-sm cursor-pointer"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="form-group mb-2">
                <label class="form-label">{{ __('Type') }}</label>
                <select name="button[${buttonIndex}][type]" class="form-control button-type" data-id="${buttonIndex}" required>
                    <option value="reply">{{ __('Reply') }}</option>
                    <option value="call">{{ __('Call') }}</option>
                    <option value="url">{{ __('URL') }}</option>
                    <option value="copy">{{ __('Copy') }}</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label class="form-label">{{ __('Display Text') }}</label>
                <input type="text" name="button[${buttonIndex}][displayText]" class="form-control" required>
            </div>

            <div class="extra-field" id="extra${buttonIndex}"></div>
        </div>
    </div>
    `;

    document.getElementById('buttons-area').insertAdjacentHTML('beforeend', buttonHtml);
    buttonIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.remove-button')) {
        const id = e.target.closest('.remove-button').dataset.id;
        const element = document.getElementById(`button${id}`);
        if (element) element.remove();
    }
});

document.addEventListener('change', function (e) {
    if (e.target.classList.contains('button-type')) {
        const type = e.target.value;
        const id = e.target.dataset.id;
        const target = document.getElementById(`extra${id}`);
        if (!target) return;

        target.innerHTML = '';

        if (type === 'url') {
            target.innerHTML = `
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('URL') }}</label>
                    <input type="url" name="button[${id}][url]" class="form-control" required>
                </div>
            `;
        } else if (type === 'call') {
            target.innerHTML = `
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('Phone Number') }}</label>
                    <input type="tel" name="button[${id}][phoneNumber]" class="form-control" required>
                </div>
            `;
        } else if (type === 'copy') {
            target.innerHTML = `
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('Copy Text') }}</label>
                    <input type="text" name="button[${id}][copyCode]" class="form-control" required>
                </div>
            `;
        }
    }
});
</script>