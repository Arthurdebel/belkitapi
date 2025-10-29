<div class="tab-pane fade show" id="productmessage" role="tabpanel">
    <form class="row g-3" action="{{ route('messagetest') }}" method="POST">
        @csrf

        <div class="col-12">
			<label class="form-label">{{__('Sender')}}</label>
			<input name="sender" value="{{ session()->get('selectedDevice')['device_body'] }}" type="text" class="form-control" readonly>
		</div>
		<div class="col-12">
			<label class="form-label">{{__('Receiver Number')}} *</label>
			<textarea placeholder="628xxx|628xxx|628xxx" class="form-control" name="number" id="" cols="20" rows="2" required></textarea>
			<input type="hidden" name="type" value="product" />
		</div>
		
		<div class="col-md-12 position-relative">
			<label class="form-label">{{ __('WhatsApp Product URL') }}</label>
			<input type="text" class="form-control" id="productUrl" placeholder="https://wa.me/p/1234567890123456/628xxxxxx" required>
			<div id="loadingIcon" class="spinner-border text-primary position-absolute" style="right:15px;top:34px;display:none;width:1.2rem;height:1.2rem;" role="status"></div>
		</div>

		<div id="productPreview" class="col-12" style="display: none;">
			<div class="card border shadow-sm">
				<div class="card-body d-flex flex-column flex-md-row align-items-center">
					<div class="me-md-3 mb-3 mb-md-0">
						<img id="productImage" src="" class="rounded border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
					</div>
					<div class="text-center text-md-start">
						<h6 id="productTitleView" class="mb-1"></h6>
						<small id="productCompany" class="text-muted d-block mb-1"></small>
						<small id="productPrice" class="text-muted d-block mb-1"></small>
						<small id="productDesc" class="text-muted"></small>
					</div>
				</div>
			</div>

			<input type="hidden" name="product_id" id="productId">
			<input type="hidden" name="phone" id="phoneNumber">
			<input type="hidden" name="product_title" id="productTitle">
			<input type="hidden" name="company_name" id="companyName">
			<input type="hidden" name="description" id="description">
			<input type="hidden" name="price" id="price">
			<input type="hidden" name="old_price" id="oldPrice">
			<input type="hidden" name="currency" id="currency">
			<input type="hidden" name="image" id="imageUrl">
		</div>
		
		<div class="col-12">
            <label class="form-label">{{ __('Message *optional') }}</label>
            <textarea name="message" class="form-control" id="message"></textarea>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-sm text-white px-5">{{ __('Send Message') }}</button>
        </div>
    </form>
<script>
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
</script>


</div>