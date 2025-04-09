<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Invoice Service</x-slot:title>
  

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
                <button  class="btn btn-sm fw-bold btn-light-primary"" wire:click="removeInvoice">Back</button>
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
@push('scripts')
    <script>
    </script>
@endpush