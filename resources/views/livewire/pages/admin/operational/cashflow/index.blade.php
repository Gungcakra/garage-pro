<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Cashflow Management</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">User Management</h1>
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
                    <li class="breadcrumb-item text-muted">User</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div class="d-flex items-center gap-3">
                <div class="form-group position-relative">
                    <input type="text" class="form-control form-control-solid" placeholder="Search Cashflow" id="search" autocomplete="off" wire:model.live.dobonce.300ms="search" />
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                </div>
                <div class="form-group position-relative mb-0">
                    <input type="text" class="form-control form-control-solid pe-10" placeholder="Pick date range" id="range" name="range" wire:model="range" />
                    <i class="bi bi-calendar3 position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                </div>
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Add CashFlow</button>
                <button class="btn btn-sm fw-bold btn-success" wire:click="create()">Report</button>
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
                            <th>Bank</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) < 1) <tr>
                            <td colspan="6" class="text-center">No Data Found</td>
                            </tr>
                            @else

                            @foreach ( $data as $index => $cashflow)

                            <tr wire:key="cashflow-{{ $cashflow->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a wire:click="edit({{ $cashflow->id }})" class="menu-link px-3 w-100">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        @if (!\Illuminate\Support\Str::contains($cashflow->description, 'Service Operational #'))
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="delete({{ $cashflow->id }})">Delete</a>
                                        </div>
                                        @endif
                                        <!--end::Menu item-->
                                </td>
                                <td>{{ $cashflow->bank->name }}</td>
                                <td>Rp {{ number_format($cashflow->amount, 0, ',', '.') }}</td>
                                <td>{{ $cashflow->description }}</td>
                                <td> 
                                    <div class="badge badge-light-{{ $cashflow->type == 1 ? 'success' : 'danger' }}">
                                        {{ $cashflow->type == 1 ? 'Credit' : 'Debet' }}
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($cashflow->created_at)->timezone('Asia/Singapore')->format('d M Y H:i') }}</td>

                            </tr>
                            @endforeach
                            @endif
                    </tbody>


                </table>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $data->onEachSide(1)->links() }}
                </div>
            </div>

            @include('livewire.pages.admin.operational.cashflow.modal')

        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function() {
        $("#range").daterangepicker();
        $("#range").on("apply.daterangepicker", function(event, picker) {
            $(this).val(
                picker.startDate.format("YYYY-MM-DD") +
                " - " +
                picker.endDate.format("YYYY-MM-DD")
            );
            Livewire.dispatch('loadData', {
                startDate: picker.startDate.format("YYYY-MM-DD")
                , endDate: picker.endDate.format("YYYY-MM-DD")
            });
        });

        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('cashFlowModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
            console.log('modal');
            
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('cashFlowModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
                modal.dispose();
            }
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open'); 
            document.body.style.overflow = ''; 
            document.body.style.paddingRight = ''; 
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
                    Livewire.dispatch('deleteCashflowConfirmed');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });

        
    });

</script>
@endpush
