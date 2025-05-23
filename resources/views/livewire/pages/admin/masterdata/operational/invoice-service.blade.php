<div class="flex">
    <x-slot:title>Invoice</x-slot:title>
    <div class="card">
        <!-- begin::Body-->
        <div class="card-body py-20">
            <!-- begin::Wrapper-->
            <div class="mw-lg-950px mx-auto w-100">
                <div class="d-flex justify-content-between w-100">
                    <button wire:click="removeInvoice" class="btn btn-light-success my-4" onclick="back()">Back</button>
                    <button type="button" class="btn btn-light-primary my-4" onclick="printMainContent();">Print Invoice</button>
                </div>
              

                <div class="main">
                    <!-- begin::Header-->
                    <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                        <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                        
                        <!--end::Logo-->
                        <div class="text-sm-end">
                            <!--begin::Logo-->
                            <a href="#" class="d-block mw-150px ms-sm-auto">
                                <img alt="Invoice-QR" src="{{ $dataUri }}" class="w-100" />
                            </a> 
                            <!--end::Logo-->
                            <!--begin::Text-->
                            <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                <div>Cecilia Chapman, 711-2880 Nulla St, Mankato</div>
                                <div>Mississippi 96522</div>
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="pb-12">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column gap-7 gap-md-10">
                            <!--begin::Message-->
                            <div class="fw-bold fs-2">{{ $data->customer->name }}
                                <span class="fs-6">({{ $data->customer->email }})</span>,
                                <br />
                                <span class="text-muted fs-5">Here are your order details. We thank you for your purchase.</span></div>
                            <!--begin::Message-->
                            <!--begin::Separator-->
                            <div class="separator"></div>
                            <!--begin::Separator-->
                            <!--begin::Order details-->
                            <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Invoice ID</span>
                                    <span class="fs-5">{{ $data->code }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Date</span>
                                    <span class="fs-5">{{  \Carbon\Carbon::parse($data->updated_at)->translatedFormat('l, d F Y') }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Vehicle Type</span>
                                    <span class="fs-5">{{ $data->vehicle_type }}</span>
                                </div>
                                <div class="flex-root d-flex flex-column">
                                    <span class="text-muted">Due Date</span>
                                    <span class="fs-5">{{  \Carbon\Carbon::parse($data->target_date)->translatedFormat('l, d F Y') }}</span>
                                </div>
                                {{-- <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Invoice ID</span>
                                <span class="fs-5">#INV-000414</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Shipment ID</span>
                                <span class="fs-5">#SHP-0025410</span>
                            </div> --}}
                            </div>
                            <!--end::Order details-->
                            <!--begin::Billing & shipping-->
                            {{-- <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Billing Address</span>
                                <span class="fs-6">Unit 1/23 Hastings Road,
                                <br />Melbourne 3000,
                                <br />Victoria,
                                <br />Australia.</span>
                            </div>
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Shipping Address</span>
                                <span class="fs-6">Unit 1/23 Hastings Road,
                                <br />Melbourne 3000,
                                <br />Victoria,
                                <br />Australia.</span>
                            </div>
                        </div> --}}
                            <!--end::Billing & shipping-->
                            <!--begin:Order summary-->
                            <div class="d-flex justify-content-between flex-column">
                                <!--begin::Table-->
                                <div class="table-responsive border-bottom mb-9">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                                <th class="min-w-175px pb-2">Services</th>
                                                <th class="min-w-70px text-end pb-2"></th>
                                                <th class="min-w-80px text-end pb-2"></th>
                                                <th class="min-w-100px text-end pb-2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($data->services as $service )

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        {{-- <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.png);"></span>
                                                    </a> --}}
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <div class="fw-bold">{{ $service->name }}</div>
                                                            {{-- <div class="fs-7 text-muted">Delivery Date: 19/07/2023</div> --}}
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td class="text-end"></td>
                                                <td class="text-end"></td>
                                                <td class="text-end">RP {{ number_format($service->price, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive border-bottom mb-9">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                                <th class="min-w-175px pb-2">Sparepart</th>
                                                <th class="min-w-70px text-end pb-2">Price</th>
                                                <th class="min-w-80px text-end pb-2">QTY</th>
                                                <th class="min-w-100px text-end pb-2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($data->spareparts as $sparepart )
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        {{-- <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                            <span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.png);"></span>
                                                        </a> --}}
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <div class="fw-bold">{{ $sparepart->name }}</div>
                                                            {{-- <div class="fs-7 text-muted">Delivery Date: 19/07/2023</div> --}}
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td class="text-end">RP {{ number_format($sparepart->price, 0, ',', '.') }}</td>
                                                <td class="text-end">{{ $sparepart->pivot->quantity }}</td>
                                                <td class="text-end">RP {{ number_format($sparepart->pivot->price, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="3" class="text-end">Subtotal</td>
                                                <td class="text-end">RP {{ number_format($data->spareparts->sum(fn($sparepart) => $sparepart->pivot->price) + $data->services->sum('price'), 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">TAX</td>
                                                <td class="text-end">RP {{ number_format($tax, 0, ',', '.') }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td colspan="3" class="text-end">Shipping Rate</td>
                                                <td class="text-end">$5.00</td>
                                            </tr> --}}
                                            <tr>
                                                <td colspan="3" class="fs-3 text-dark fw-bold text-end">Grand Total</td>
                                                <td class="text-dark fs-3 fw-bolder text-end">RP {{ number_format($data->spareparts->sum(fn($sparepart) => $sparepart->pivot->price) + $data->services->sum('price') + $tax, 0, ',', '.') }}</td>
                                               
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="fs-3 text-dark fw-bold text-end">Payment Method</td>
                                                <td class="text-dark fs-3 fw-bolder text-end">{{ $data->payment_method == 0 ? 'Cash' : ($data->payment_method == 1 ? 'Card' : 'QRIS') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end:Order summary-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Body-->
                </div>
                <!-- begin::Footer-->
                <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                    <!-- begin::Actions-->
                    <div class="my-1 me-5">
                        <!-- begin::Pint-->
                        {{-- <button type="button" class="btn btn-success my-1 me-12" onclick="printMainContent();">Print Invoice</button> --}}

                        <!-- end::Pint-->
                        <!-- begin::Download-->
                        <!-- end::Download-->
                    </div>
                    <!-- end::Actions-->
                    <!-- begin::Action-->
                    {{-- <a href="../../demo1/dist/apps/invoices/create.html" class="btn btn-primary my-1">Create Invoice</a> --}}
                    <!-- end::Action-->
                </div>
                <!-- end::Footer-->
            </div>
            <!-- end::Wrapper-->
        </div>
        <!-- end::Body-->
    </div>

</div>
