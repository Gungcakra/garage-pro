<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Operational Service Data</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Service Management</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Service Operational</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex items-center">
                {{-- <input type="text" class="form-control form-control-solid" placeholder="Search Service Code" id="search" autocomplete="off" wire:model="search" onkeydown="handleSearch()" /> --}}
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
              

                {{-- <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Add Service</button> --}}
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
        <div id="kt_app_content_container" class="app-container container-xxl" >
        <div class="card p-5">  
            <div class="d-flex w-full justify-content-between">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input
                        type="text"
                        data-kt-customer-table-filter="search"
                        class="form-control form-control-solid w-250px ps-12"
                        placeholder="Search Service Code"
                        wire:model="search" onkeydown="handleSearch()" 
                    />
                </div>
                <button class="btn btn-sm btn-light-success fw-bold" onclick="scanQr()" data-bs-toggle="modal" data-bs-target="#scanQr">Scan QrCode</button>
            </div>
            <div class="table-responsive">
                <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>No</th>
                            <th>Action</th>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Check</th>
                            <th>Vehicle Type</th>
                            <th>Plate Number</th>
                            <th>Completeness</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($data) < 1) <tr>
                            <td colspan="10" class="text-center">No Data Found</td>
                            </tr>
                            @else
                            @foreach ( $data as $index => $Service)

                            <tr wire:key="Service-{{ $Service->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            @if($Service->status === 0)
                                            <a wire:click="finalize({{ $Service->id }})" class="menu-link px-3 w-100">Finalize</a>
                                            @else
                                            <a wire:click="invoiceService({{ $Service->id }})" class="menu-link px-3 w-100">Invoice</a>

                                            @endif
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        {{-- <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="delete({{ $Service->id }})">Delete</a>
                                    </div> --}}
                                    <!--end::Menu item-->
                                </td>
                                <td class="fw-bold">{{ $Service->code }}</td>
                                <td>{{ $Service->customer->name }}</td>
                                <td>{{ $Service->check }}</td>
                                <td>{{ $Service->vehicle_type }}</td>
                                <td>{{ $Service->plate_number }}</td>
                                <td>
                                    @php
                                    $completeness = [];
                                    if ($Service->kunci) $completeness[] = 'Kunci';
                                    if ($Service->stnk) $completeness[] = 'STNK';
                                    @endphp
                                    {{ implode(' - ', $completeness) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($Service->created_at)->translatedFormat('l, d F Y') }}
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $Service->status === 0 ? 'warning' : 'success' }}">{{ $Service->status === 0 ? 'Pending' : 'Complete' }}</div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                    </tbody>


                </table>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $data->onEachSide(1)->links() }}
                </div>
            </div>

            {{-- MODAL --}}
            <div class="modal fade" tabindex="-1" id="scanQr">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Scan QrCode</h3>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" onclick="closeCamera()">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>

                        <div class="modal-body">
                            <div class="d-flex w-100 justify-content-center">
                                <video id="qr-video" style="width: 100%; max-width: 400px;"></video>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="closeCamera()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


</div>

@include('livewire.pages.admin.masterdata.operational.script')