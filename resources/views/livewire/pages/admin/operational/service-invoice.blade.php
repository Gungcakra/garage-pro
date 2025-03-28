<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <base href="" />
    <title>Invoice {{ $data->code }}</title>
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
            {{-- @include('layouts.partials.admin.navbar') --}}
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="container-fluid d-flex justify-content-center m-4" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                {{-- @include('layouts.partials.admin.sidebar') --}}
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="container d-flex flex-column align-items-center" id="kt_app_main">
                   <div class="flex container d-flex justify-content-start">
                    {{-- <a id="back" href="{{ route('serviceoperational') }}" class="btn btn-secondary mb-3" wire.navigate>Back</a> --}}
                   </div>
                    <!--begin::Content wrapper-->
                    <div class="container">
                        <div class="card-body">
                          <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                              <div class="col-xl-9">
                                <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{ $data->code }}</strong></p>
                              </div>
                              <div class="col-xl-3 float-end">
                                {{-- <a data-mdb-ripple-init class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                    class="fas fa-print text-primary"></i> Print</a>
                                <a data-mdb-ripple-init class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                    class="far fa-file-pdf text-danger"></i> Export</a> --}}
                              </div>
                              <hr>
                            </div>
                      
                            <div class="container">
                              {{-- <div class="col-md-12">
                                <div class="text-center">
                                  <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                                  <p class="pt-0">MDBootstrap.com</p>
                                </div>
                      
                              </div> --}}
                      
                      
                              <div class="row">
                                <div class="col-xl-8">
                                  <ul class="list-unstyled">
                                    <li class="text-muted"><span style="color:#5d9fc5 ;">{{ $data->customer->name }}</span></li>
                                    <li class="text-muted">{{ $data->customer->address }}</li>
                                    <li class="text-muted">{{ $data->customer->email }}</li>
                                    <li class="text-muted"><i class="fas fa-phone"></i> {{$data->customer->phone}}</li>
                                  </ul>
                                </div>
                                <div class="col-xl-4">
                                  <p class="text-muted">Invoice</p>
                                  <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">{{ $data->code }}</li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">{{ $data->created_at->format('Y-m-d H:i:s') }}</li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold"></span><span class="badge bg-warning text-black fw-bold">
                                        {{ $data->status === 0 ? 'Pending' : 'Process' }}</span></li>
                                  </ul>
                                </div>
                              </div>
                      
                              <div class="row my-2 mx-1 justify-content-center">
                                <table class="table table-striped table-borderless">
                                  <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Plate Number</th>
                                      <th scope="col">Check</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">1</th>
                                      <td>{{ $data->plate_number }}</td>
                                      <td>{{ $data->check }}</td>
                                    </tr>
                                  </tbody>
                      
                                </table>
                              </div>
                              <div class="row">
                                <div class="col-xl-8">
                                    <ul>
                                        <li>STNK {{ $data->stnk === 1 ? 'V' : 'X' }}</li>
                                        <li>KUNCI {{ $data->kunci === 1 ? 'V' : 'X' }}</li>
                                        <li>BPKB {{ $data->bpkb === 1 ? 'V' : 'X' }}</li>
                                    </ul>
                                  {{-- <p class="ms-3">Add additional notes and payment information</p> --}}
                      
                                </div>
                                {{-- <div class="col-xl-3">
                                  <ul class="list-unstyled">
                                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                                  </ul>
                                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                                      style="font-size: 25px;">$1221</span></p>
                                </div> --}}
                              </div>
                              <hr>
                              {{-- <div class="row">
                                <div class="col-xl-10">
                                  <p>Thank you for your purchase</p>
                                </div>
                                <div class="col-xl-2">
                                  <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary text-capitalize"
                                    style="background-color:#60bdf3 ;">Pay Now</button>
                                </div>
                              </div> --}}
                      
                            </div>
                          </div>
                        </div>
                      </div>


                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    {{-- @include('layouts.partials.admin.footer') --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script>
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
            KTMenu.createInstances();
        });

    </script> --}}
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
        document.addEventListener('DOMContentLoaded', function () {
            // Hide the back button before printing
            const backButton = document.getElementById('back');
            if (backButton) {
                backButton.style.display = 'none';
            }

            window.print();
            
            // Show the back button again after printing
            // window.location.href = "{{ route('serviceoperational') }}";
            if (backButton) {
                backButton.style.display = '';
            }
        });

        const style = document.createElement('style');
        style.type = 'text/css';
        style.media = 'print';
        style.innerHTML = `
            @page {
                size: A5 landscape;
                margin: 10mm;
            }
            body {
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>
    <script>
        var hostUrl = "{{ asset('assets/')}}";

    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script data-navigate-once src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script data-navigate-once src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
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
