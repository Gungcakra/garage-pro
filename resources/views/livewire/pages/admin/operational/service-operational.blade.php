<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Operational Service</x-slot:title>

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add Order</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Sales</li>
                    <!--end::Item-->
                </ul>
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
                <a href="#" class="btn btn-sm fw-bold btn-primary" wire:click="createCustomer">Add Customer</a>
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
            <!--begin::Form-->
            <div id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" ">
                <!--begin::Aside column-->
                <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Service Details</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-10">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Auto-generated ID-->
                                   
                                    <div class="fw-bold fs-3">
                                        {{ $code }}
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Customer</label>
                                    <!--end::Label-->
                                    <!--begin:: 2-->
                                    <div wire:ignore>   
                                        <select class="form-select" data-control="select2" data-placeholder="Select an option" wire:model="customer_id" onchange="@this.set('customer_id', this.value)" name="customer_id">
                                            <option>Select Customer</option>
                                            @forelse($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty
                                            <option value="">No Data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <input type="hidden" wire:model="status" value="pending" wire:ignore>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Select Customer.</div>
                                    <!--end::Description-->
                                </div>
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Plate Number</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <input type="text" class="form-control" name="billing_order_address_1" placeholder="Plate Number" wire:model="plate_number" />
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model="stnk" />
                                    <label for="flexCheckDefault">
                                        STNK
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" wire:model="bpkb" />
                                    <label  for="flexCheckChecked">
                                        BPKB
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" wire:model="kunci"/>
                                    <label for="flexCheckChecked">
                                        Kunci
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Order details-->
                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
               
                    <!--begin::Order details-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Vehicle Check</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Billing address-->
                            <div class="d-flex flex-column gap-5 gap-md-7">
                                <!--begin::Input group-->
                                <div class="d-flex flex-column flex-md-row gap-5">
                                    <div class="fv-row flex-row-fluid">
                                        <!--begin::Label-->
                                        <label class="required form-label">Check</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control" name="billing_order_address_1" placeholder="Vehicle Check" wire:model="check" style="height: 250px;"></textarea>
                                        <!--end::Input-->
                                    </div>
                                </div>
                             
                                <!--end::Shipping address-->
                            </div>
                            <!--end::Billing address-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                       
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button wire:click="store" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <div class="modal fade" tabindex="-1" id="employeeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Customer</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($employeeId) ? 'update' : 'store' }}"
                    > --}}

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">

                        <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Name</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>

                            @enderror
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="name" />
                        </div>
                        <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Email</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Eamil for future usage and reference">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>

                            @enderror
                            <input type="text" class="form-control form-control-solid" placeholder="Enter email" autocomplete="off" id="email" wire:model="email" />
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">

                        <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Phone</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            @error('phone')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>

                            @enderror
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Phone" id="phone" autocomplete="off" wire:model="phone" />
                        </div>
                        <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Address</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            @error('address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>

                            @enderror
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Address" id="address" autocomplete="off" wire:model="address" />

                        </div>
                    </div>
                    <!--end::Input group-->


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                    <button class="btn btn-primary" wire:click="storeCustomer">Store</button>

                </div>
            </div>
        </div>
    </div>

    <script>
         Livewire.on('show-modal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('employeeModal'), {});
            myModal.show();
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('employeeModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            modal.hide();
        });
        Livewire.on('success', () => {
          var customerSelect = document.querySelector('select[name="customer_id"]');
            customerSelect.value = '';
            
        });
    </script>
</div>
