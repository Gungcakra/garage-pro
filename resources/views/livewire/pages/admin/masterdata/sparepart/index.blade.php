<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Spare Part Management</x-slot:title>
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Spare Part Management</h1>
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
                    <li class="breadcrumb-item text-muted">Spare Part</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex items-center">
                <input type="text" class="form-control form-control-solid" placeholder="Search Spare Part Name" id="search" autocomplete="off" wire:model="search" onkeydown="handleSearch()" />
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Add Spare Part</button>
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
                            <th>Brand</th>
                            <th>Stock</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($data) < 1)
                        <tr>
                            <td colspan="6" class="text-center">No Data Found</td>
                        </tr>
                        @else
                        @foreach ( $data as $index => $SparePart)

                        <tr wire:key="SparePart-{{ $SparePart->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a wire:click="edit({{ $SparePart->id }})" class="menu-link px-3 w-100">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="delete({{ $SparePart->id }})">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                            </td>
                            <td>{{ $SparePart->name }}</td>
                            <td>{{ $SparePart->brand }}</td>
                            <td>{{ $SparePart->stock }}</td>
                            <td>RP {{ number_format($SparePart->price, 0, ',', '.') }}</td>

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
            @include('livewire.pages.admin.masterdata.sparepart.modal')
        </div>
    </div>
    <script>
        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('SparePartModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (existingModal) {
                existingModal.dispose();
            }
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('SparePartModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
                modal.dispose();
            }
            document.body.classList.remove('modal-open'); 
            document.body.style.overflow = ''; 
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
                    Livewire.dispatch('deleteSparePart');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });

        function handleSearch() {
            Livewire.dispatch('loadData')
        }
    </script>
</div>