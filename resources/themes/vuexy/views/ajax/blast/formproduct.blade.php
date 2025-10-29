<div class="tab-pane fade show" id="productmessage" role="tabpanel">
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
	<input type="hidden" name="type" value="product" />
</div>