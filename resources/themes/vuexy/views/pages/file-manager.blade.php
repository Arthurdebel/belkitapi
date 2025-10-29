<x-layout-dashboard title="{{__('File manager')}}">
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
		<div class="card-header">
			<h5 class="card-title mb-0">{{__('File manager')}}</h5>
		</div>
		<div class="card-body px-4 pb-4">
			<iframe src="{{ url('/laravel-filemanager') }}" style="width: 100%; height: 100vh; border: none;"></iframe>
		</div>
	</div>

    <script>
	window.addEventListener('load', function() {
			$(document).ready(function() {
				$('#server').on('change',function(){
				   let type = $('#server :selected').val();
					console.log(type);
					if(type === 'other'){
							$('.formUrlNode').removeClass('d-none')
						} else {
						$('.formUrlNode').addClass('d-none')

					}
				})
			});
		});
    </script>
</x-layout-dashboard>