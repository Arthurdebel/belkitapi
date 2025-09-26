<div class="tab-pane fade show" id="buttonmessage" role="tabpanel">
                    <form class="row g-3" action="{{ route('messagetest') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">{{__('Sender')}}</label>
                            <input name="sender" value="{{ session()->get('selectedDevice')['device_body'] }}" type="text" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{__('Receiver Number')}} *</label>
                            <textarea placeholder="628xxx|628xxx|628xxx" class="form-control" name="number" id="" cols="20" rows="2" required></textarea>
                        </div>
<label for="message" class="form-label">{{__('Message')}}</label>
<textarea type="text" name="message" class="form-control" id="message" required> </textarea>
<label for="footer" class="form-label">{{__('Footer message *optional')}}</label>
<input type="text" name="footer" class="form-control" id="footer" >
 <label class="form-label">{{__('Image')}} *</label>
                   <div class="input-group">
                     <span class="input-group-btn">
                       <a id="image-button" data-input="thumbnail-button" data-preview="holder" class="btn btn-primary text-white">
                         <i class="fa fa-picture-o"></i> {{__('Choose')}}
                       </a>
                     </span>
                     <input id="thumbnail-button" class="form-control"  type="text" name="image" required />
                   </div>
				   <input type="hidden" name="type" value="button" />
<button type="button" id="addbutton" class="btn btn-primary btn-sm mr-2 mt-4">{{__('Add Button')}}</button>
<div class="button-area">

</div>


                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info btn-sm text-white px-5">{{__('Send Message')}}</button>
                        </div>
                    </form>
                </div>
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
window.addEventListener('load', function() {
    // add button when click add button maximal 3 button
    $(document).ready(function() {
        $('#image').filemanager('file');
        var max_fields = 3; // Maximum number of buttons allowed
        var wrapper = $(".button-area"); // Wrapper for button forms
        var add_button = $("#addbutton"); // Add button ID
        var x = 0; // Initial button count

        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++; // Increment button count

                var buttonForm = `
                <div class="form-group buttoninput mt-3" id="buttonGroup${x}">
                    <label for="buttonType${x}" class="form-label">${"{{ __('Button :x Type', ['x' => ':x']) }}".replace(':x', x)}</label>
                    <select name="button[${x}][type]" class="form-control buttonType" id="buttonType${x}" data-index="${x}" required>
                        <option value="reply">{{ __('Reply') }}</option>
                        <option value="call">{{ __('Call') }}</option>
                        <option value="url">{{ __('URL') }}</option>
                        <option value="copy">{{ __('Copy') }}</option>
                    </select>
                    
                    <label for="buttonDisplayText${x}" class="form-label mt-2">{{ __('Display Text') }}</label>
                    <input type="text" name="button[${x}][displayText]" class="form-control" id="buttonDisplayText${x}" required>

                    <div class="additionalFields mt-2" id="additionalFields${x}"></div>
                    
                    <button type="button" class="btn btn-danger btn-sm mt-2 removeButton" data-index="${x}">{{ __('Remove') }}</button>
                </div>
            `;
                $(wrapper).append(buttonForm);
            } else {
                toastr['warning']('{{__("Maximal 3 button")}}');
            }
        });

        // Handle button type change to display relevant additional fields
        $(document).on('change', '.buttonType', function() {
            var index = $(this).data('index');
            var selectedType = $(this).val();
            var additionalFields = $(`#additionalFields${index}`);

            additionalFields.empty(); // Clear existing fields

            if (selectedType === 'call') {
                additionalFields.append(`
                <label for="phoneNumber${index}" class="form-label">{{ __('Phone Number') }}</label>
                <input type="text" name="button[${index}][phoneNumber]" class="form-control" id="phoneNumber${index}" required>
            `);
            } else if (selectedType === 'url') {
                additionalFields.append(`
                <label for="url${index}" class="form-label">{{ __('URL') }}</label>
                <input type="text" name="button[${index}][url]" class="form-control" id="url${index}" required>
            `);
            } else if (selectedType === 'copy') {
                additionalFields.append(`
                <label for="copyText${index}" class="form-label">{{ __('Copy Text') }}</label>
                <input type="text" name="button[${index}][copyCode]" class="form-control" id="copyText${index}" required>
            `);
            }
        });

        // Remove button form
        $(document).on('click', '.removeButton', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            $(`#buttonGroup${index}`).remove();
            x--; // Decrement button count
        });
    });
});
</script>
