<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Invoice Service</x-slot:title>
    <style>
        body .select2-container--bootstrap-5 .select2-selection {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border: var(--bs-border-width) solid var(--bs-border-color);
        }

        body .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        body .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: var(--bs-link-hover-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        body .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__clear,
        body .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear {
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23676a6d'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") 50%/0.75rem auto no-repeat;
        }

        body .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__clear:hover,
        body .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear:hover {
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") 50%/0.75rem auto no-repeat;
        }

        body .select2-container--bootstrap-5 .select2-dropdown {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: var(--bs-link-hover-color);
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-search .select2-search__field {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            background-clip: padding-box;
            border: var(--bs-border-width) solid var(--bs-border-color);
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-search .select2-search__field:focus {
            border-color: var(--bs-link-hover-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option.select2-results__message {
            color: #6c757d;
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option.select2-results__option--highlighted {
            color: var(--bs-body-color);
            background-color: var(--bs-light-bg-subtle) !important;
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option.select2-results__option--selected,
        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option[aria-selected="true"]:not(.select2-results__option--highlighted) {
            color: var(--bs-body-color);
            background-color: var(--bs-dark-bg-subtle);
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option.select2-results__option--disabled,
        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option[aria-disabled="true"] {
            color: #6c757d;
        }

        body .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option[role="group"] .select2-results__group {
            color: #6c757d;
        }

        body .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: var(--bs-body-color);
        }

        body .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered .select2-selection__placeholder {
            color: #6c757d;
        }

        body .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            color: var(--bs-body-color);
            border: var(--bs-border-width) solid var(--bs-border-color);
        }

        body .select2-container--bootstrap-5.select2-container--disabled .select2-selection,
        body .select2-container--bootstrap-5.select2-container--disabled.select2-container--focus .select2-selection {
            color: #6c757d;
            background-color: var(--bs-light-bg-subtle);
            border-color: var(--bs-dark-bg-subtle);
        }

        .is-valid+body .select2-container--bootstrap-5 .select2-selection,
        .was-validated select:valid+body .select2-container--bootstrap-5 .select2-selection {
            border-color: #198754;
        }

        .is-valid+body .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .is-valid+body .select2-container--bootstrap-5.select2-container--open .select2-selection,
        .was-validated select:valid+body .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .was-validated select:valid+body .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        .is-invalid+body .select2-container--bootstrap-5 .select2-selection,
        .was-validated select:invalid+body .select2-container--bootstrap-5 .select2-selection {
            border-color: #dc3545;
        }

        .is-invalid+body .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .is-invalid+body .select2-container--bootstrap-5.select2-container--open .select2-selection,
        .was-validated select:invalid+body .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .was-validated select:invalid+body .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

    </style>

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Invoice</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->

                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->

                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button  class="btn btn-sm fw-bold btn-light-primary" onclick="backOperational()" wire:click="removeInvoice">Back</button>
                <button class="btn btn-sm fw-bold btn-light-primary" onclick="printInvoice()">Print Invoice</button>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="container d-flex flex-column align-items-center">
                <div class="flex container d-flex justify-content-start">
                    {{-- <a id="back" href="{{ route('serviceoperational') }}" class="btn btn-secondary mb-3" wire.navigate>Back</a> --}}
                </div>
                <!--begin::Content wrapper-->
                <div class="container main">
                    <div class="card-body">
                        <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-9 d-flex flex-column justify-content-center align-items-start">
                                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{ $data->code }}</strong></p>
                                    <a href="#" class="d-block mw-150px">
                                        <img alt="QrCode" src="{{ $dataUri }}" class="w-100" />
                                    </a>
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
                                  <i class="fab fa-mdb fa-4x ms-0" class="text-primary"></i>
                                  <p class="pt-0">MDBootstrap.com</p>
                                </div>
                      
                              </div> --}}


                                <div class="row">
                                    <div class="col-xl-8">
                                        <ul class="list-unstyled">
                                            <li class="text-muted"><span class="text-primary">{{ $data->customer->name }}</span></li>
                                            <li class="text-muted">{{ $data->customer->address }}</li>
                                            <li class="text-muted">{{ $data->customer->email }}</li>
                                            <li class="text-muted"><i class="fas fa-phone"></i> {{$data->customer->phone}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-4">
                                        <p class="text-muted">Invoice</p>
                                        <ul class="list-unstyled">
                                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">{{ $data->code }}</li>
                                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">{{ $data->created_at->format('Y-m-d H:i:s') }}</li>
                                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="me-1 fw-bold"></span><span class="badge bg-warning text-black fw-bold">
                                                    {{ $data->status === 0 ? 'Pending' : 'Process' }}</span></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row my-2 mx-1 justify-content-center p-3">
                                    <table class="table table-striped table-borderless">
                                        <thead class="text-white bg-primary">
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
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
