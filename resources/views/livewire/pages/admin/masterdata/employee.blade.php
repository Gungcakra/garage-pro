<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Employee Management</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Employee Management</h1>
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
                    <li class="breadcrumb-item text-muted">Employee</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex items-center">
                <input type="text" class="form-control form-control-solid" placeholder="Search Employee Name" id="search" autocomplete="off" wire:model="search" onkeydown="handleSearch()" />
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Add Employee</button>
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
        <div class="flex flex-column container">

            <div class="table-responsive">
                <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>No</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) < 1)
                        <tr>
                            <td colspan="6" class="text-center">No Data Found</td>
                        </tr>
                        @else

                        @foreach ( $data as $index => $employee)

                        <tr wire:key="employee-{{ $employee->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a wire:click="edit({{ $employee->id }})" class="menu-link px-3 w-100">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="delete({{ $employee->id }})">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->address }}</td>

                        </tr>
                        @endforeach
                        @endif
                    </tbody>


                </table>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $data->onEachSide(1)->links() }}
                </div>
            </div>

            <div class="modal fade" tabindex="-1" id="employeeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">{{$employeeId ? 'Edit' : 'Add'}} Employee</h3>

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
                                        <span class="required">Position</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    @error('position')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>

                                    @enderror
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Position" autocomplete="off" id="position" wire:model="position" />
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
                            <button class="btn btn-primary" wire:click="{{ isset($employeeId) ? 'update' : 'store' }}">{{ $employeeId ? 'Update' : 'Store' }}</button>

                        </div>
                    </div>
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
        });
        Livewire.on('confirm-delete', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Yes"
                , cancelButtonText: "No"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteEmployee');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });

        function handleSearch() {
            Livewire.dispatch('loadData');
        }

    </script>
</div>
