<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <base href="" />
    <title>{{ $title }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }

    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('layouts.partials.admin.navbar')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('layouts.partials.admin.sidebar')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    {{ $slot }}


                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('layouts.partials.admin.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Javascript-->
    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/qr-scanner@1.4.2/qr-scanner.legacy.min.js"></script>

    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', (message, isClose = true, type = 'success') => {
                toastr[type](message);

                if (isClose) {
                    $('.modal').modal('hide');
                }
            });

            Livewire.on('delete-success', (message) => {
                Swal.fire("Deleted!", message, "success");
            });
        });

        Livewire.hook('morphed', () => {
            if (typeof KTMenu !== 'undefined' && typeof KTMenu.createInstances === 'function') {
                KTMenu.createInstances();
            } else {
                console.error("KTMenu or KTMenu.createInstances is not defined.");
            }
        });

        function handleSearchService() {
            Livewire.dispatch('loadDataService');
        }

        function handleSearchSparepart() {
            Livewire.dispatch('loadDataSparepart');
        }

        function printInvoice() {
            console.log('Print Invoice clicked!');

            const printContents = document.querySelector('.main').innerHTML;
            const originalContents = document.body.innerHTML;

            const printStyle = document.createElement('style');
            printStyle.innerHTML = `
                @page {
                    size: A4 portrait;
                    margin: 20mm;
                }
            `;
            document.head.appendChild(printStyle);

            document.body.innerHTML = printContents;
            document.title = "Invoice";
            window.print();
            document.body.innerHTML = originalContents;
            document.head.removeChild(printStyle);
        }

        function backOperational() {
            window.Livewire.navigate('serviceoperational');
        }

        function scanQr() {
            console.log("scanQr started");
            const videoElem = document.getElementById('qr-video');

            if (!videoElem) {
                console.error("QR video element not found");
                return;
            }

            const qrScanner = new QrScanner(
                videoElem,
                result => {
                    console.log('Scanned QR:', result);
                    qrScanner.stop();

                    const id = result?.data?.split('#')[1]?.trim();
                    if (id) {
                        Livewire.dispatch('getInvoiceFromQr', {
                            code: `#${id}`
                        });
                        const modalEl = document.getElementById('scanQr');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) {
                            modal.hide();
                            modal.dispose();
                        }
                        modalEl.style.display = 'none';
                        modalEl.setAttribute('aria-hidden', 'true');
                        modalEl.removeAttribute('aria-modal');
                        modalEl.removeAttribute('role');
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow = '';
                        document.body.style.paddingRight = '';
                    } else {
                        console.error('Invalid QR data format');
                        alert('Invalid QR code format. Please try again.');
                    }
                },
                {
                    returnDetailedScanResult: true
                }
            );

            qrScanner.start().catch(e => {
                alert("Camera access denied or not found.");
                console.error("Error starting QR scanner:", e);
            });
        }

        function closeCamera() {
            const videoElem = document.getElementById('qr-video');
            const qrScanner = new QrScanner(videoElem, () => {});
            qrScanner.stop();
        }
    </script>

    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@2.0.2/dist/echo.iife.min.js"></script>
    <script>
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher'
            , key: "{{ env('PUSHER_APP_KEY') }}"
    , cluster: "{{ env('PUSHER_APP_CLUSTER', 'mt1') }}"
    , wsHost: "{{ env('PUSHER_HOST', 'ws-mt1.pusher.com') }}"
    , wsPort: 443
    , wssPort: 443
    , forceTLS: true
    , disableStats: true
    , encrypted: true
    });

    </script> --}}
    <script>
        var hostUrl = "{{ asset('assets/')}}";

    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script data-navigate-once src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script data-navigate-once src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
    {{-- <script data-navigate-once src="{{ asset('assets/js/custom/pages/general/pos.js') }}"></script> --}}

    {{-- <script data-navigate-once src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}


    {{-- <script data-navigate-once src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    {{-- <script data-navigate-once src="{{ asset('assets/js/custom/widgets.js') }}"></script> --}}

    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    {{-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> --}}
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js')}}"></script> --}}

    @livewireScripts
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
