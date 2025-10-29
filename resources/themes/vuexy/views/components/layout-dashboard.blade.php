<!DOCTYPE html>

<html
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="{{ in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']) ? 'rtl' : 'ltr' }}"
  data-skin="default"
  data-assets-path="{{asset('/')}}"
  data-template="vuexy-magd"
  data-bs-theme="light">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }} | {{ config('config.site_name') }}</title>
    <link rel="icon" href="{{ asset('img/favicon/favicon.ico') }}" type="image/png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('vendor/fonts/iconify-icons.css') }}?v2" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/libs/pickr/pickr-themes.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/default.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->
	
	<link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/swiper/swiper.css') }}" />
	<link rel="stylesheet" href="{{ asset('vendor/libs/notyf/notyf.css') }}" />

    <!-- Page CSS -->
	<link rel="stylesheet" href="{{ asset('vendor/css/pages/cards-advance.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>

    <script src="{{ asset('js/config.js') }}"></script>
	
	<meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
		<x-aside></x-aside>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Header -->
		  <x-header></x-header>
		  <!-- / Header -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
		  
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              {{ $slot }}
            </div>
            <!-- / Content -->
			
			<x-notify></x-notify>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , {{config('config.footer_name')}}
                  </div>
                  <div class="d-none d-lg-inline-block">
                    {!! config('config.footer_copyright') !!}
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <script src="{{ asset('vendor/libs/pickr/pickr.js') }}"></script>

    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
	
    <script src="{{ asset('vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
	
	<script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>
	<script src="{{ asset('vendor/libs/notyf/notyf.js') }}"></script>
	<script>var notyf = new Notyf({duration: 3000,position: {x: 'right',y: 'top',}});</script>

    <!-- Main JS -->
	<script>
		let Translate = {};
		Translate.placeholder = '{{__("Search [CTRL + K]")}}';
		Translate.no_result = '{{__("No results found")}}';
	</script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
	<script src="{{ asset('js/dashboards-analytics.js') }}"></script>
	
		<script>
	if (typeof TemplateCustomizer !== 'undefined') {
		TemplateCustomizer.LANGUAGES.{{ str_replace('_', '-', app()->getLocale()) }} = {
			panel_header: '{{__("Template Customizer")}}',
			panel_sub_header: '{{__("Customize and preview in real time")}}',
			theming_header: '{{__("Theming")}}',
			color_label: '{{__("Primary Color")}}',
			theme_label: '{{__("Theme")}}',
			skin_label: '{{__("Skins")}}',
			semiDark_label: '{{__("Semi Dark")}}',
			layout_header: '{{__("Layout")}}',
			layout_label: '{{__("Menu (Navigation)")}}',
			layout_header_label: '{{__("Header Types")}}',
			content_label: '{{__("Content")}}',
			layout_navbar_label: '{{__("Navbar Type")}}',
			direction_label: '{{__("Direction")}}'
		};
	  window.templateCustomizer = new TemplateCustomizer({
		displayCustomizer: true,
		lang: '{{ str_replace('_', '-', app()->getLocale()) }}',
		controls: [
		  'color',
		  'theme',
		  'semiDark',
		  'layoutCollapsed',
		  'layoutNavbarOptions',
		  'headerType',
		]
	  });
	}
	</script>
  </body>
</html>
