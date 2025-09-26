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

<script>
(function ($) {
    let buttonIndex = 0;
    const maxButtons = 4;

    $('#add-button').click(function () {
        if (buttonIndex >= maxButtons) {
            notyf.error("{{ __('Maximal 4 button') }}");
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

        $('#buttons-area').append(buttonHtml);
        buttonIndex++;
    });

    $(document).on('click', '.remove-button', function () {
        const id = $(this).data('id');
        $(`#button${id}`).remove();
    });

    $(document).on('change', '.button-type', function () {
        const type = $(this).val();
        const id = $(this).data('id');
        const target = $(`#extra${id}`);
        target.empty();

        if (type === 'url') {
            target.append(`
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('URL') }}</label>
                    <input type="url" name="button[${id}][url]" class="form-control" required>
                </div>
            `);
        } else if (type === 'call') {
            target.append(`
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('Phone Number') }}</label>
                    <input type="tel" name="button[${id}][phoneNumber]" class="form-control" required>
                </div>
            `);
        } else if (type === 'copy') {
            target.append(`
                <div class="form-group mt-2">
                    <label class="form-label">{{ __('Copy Text') }}</label>
                    <input type="text" name="button[${id}][copyCode]" class="form-control" required>
                </div>
            `);
        }
    });
})(jQuery);
</script>
