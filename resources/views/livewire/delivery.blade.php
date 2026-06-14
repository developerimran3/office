<!-- All Documents-->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Delivery End All Documents</h2>
                </div>
            </div>
        </div>

        @if ($deliveryId)
            <div class="row column1">
                <div class="col-md-12">
                    <div class="white_shd page_title mt-3">
                        <div class="heading1 margin_0">
                            <h2>Documents Details</h2>
                            <hr class="m-0">
                        </div>
                        <form wire:submit.prevent="updateDelivery({{ $deliveryId }})">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="importer_name">Importer Name</label>
                                    <input type="text" wire:model="importer_name" class="form-control text-uppercase"
                                        readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="bl_no">BL No</label>
                                    <input type="text" wire:model="bl_no" class="form-control" readonly>
                                </div>

                                <div class="col-md-2">
                                    <label for="be_no">BE No</label>
                                    <input type="text" wire:model="be_no" class="form-control" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="document">Document</label>
                                    <input type="file" wire:model="document" class="form-control">
                                    @error('document')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 my-3">
                                    <button type="submit" class="main_bt float-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd page_title mt-0">
                    <div class="heading1 m-0 p-0">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h2 class="">All Delivery Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="delivery_tr">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>LC No</th>
                                                <th>LC Date</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Cont. No</th>
                                                <th>Dly. Date</th>
                                                <th>Remark</th>
                                                <th>Ass. Date</th>
                                                <th>Doc</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-uppercase">
                                            @foreach ($delivery as $deliv)
                                                @php
                                                    $items = $deliv->items ?? [];
                                                    $containers = $deliv->containers ?? [];

                                                    $itemCount = count($items);
                                                    $containerCount = count($containers);

                                                    $rowspan = max($itemCount, $containerCount, 1);
                                                @endphp

                                                @for ($i = 0; $i < $rowspan; $i++)
                                                    @php
                                                        $item = $items[$i] ?? null;
                                                        $container = $containers[$i] ?? null;
                                                    @endphp
                                                    <tr>

                                                        {{-- INDEX --}}
                                                        @if ($i == 0)
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $loop->iteration }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->importer_name }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->lc_number }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->lc_date }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->be_no }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->be_date }}
                                                            </td>
                                                        @endif

                                                        {{-- GOODS / ITEM / NW --}}
                                                        @if ($item)
                                                            <td>
                                                                {{ $item['goods_name'] ?? '' }}
                                                            </td>

                                                            <td>
                                                                {{ $item['item_quantity'] ?? ($item['qty'] ?? 0) }}
                                                                {{ $deliv->pkgs_code }}
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                        {{-- CONTAINER --}}
                                                        <td>
                                                            @if ($container)
                                                                <a class="text-primary font-weight-bold">
                                                                    {{ $container['container_no'] ?? '' }}
                                                                </a>
                                                                <br> X {{ $container['container_size'] }}
                                                            @endif
                                                        </td>

                                                        {{-- COMMON --}}
                                                        @if ($i == 0)
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->delivery_date }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}"
                                                                class="font-weight-bold {{ $deliv->be_lane === 'RED' ? 'text-danger' : '' }}
                                                            {{ $deliv->be_lane === 'YELLOW' ? 'text-warning' : '' }}">
                                                                {{ $deliv->be_lane }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $deliv->assessment_date }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                @if ($deliv->document)
                                                                    <a href="{{ Storage::url($deliv->document) }}"
                                                                        target="_blank" class="btn btn-sm btn-info">
                                                                        pdf
                                                                    </a>
                                                                @endif
                                                            </td>

                                                            {{-- ACTION --}}
                                                            <td rowspan="{{ $rowspan }}">
                                                                <div class="d-flex justify-content-between">
                                                                    @if (!$deliv->document)
                                                                        <a class="btn btn-sm btn-warning"
                                                                            wire:click="editToDelivery({{ $deliv->id }})">
                                                                            <i class="fa fa-edit"></i></a>
                                                                    @endif

                                                                    <a class="btn btn-sm btn-info ml-1"
                                                                        wire:click="viewDocument({{ $deliv->id }})"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#viewDocumentModal">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>

                                                                    @if (!$deliv->document)
                                                                        <a class="btn btn-danger btn-sm ml-1"
                                                                            wire:click="deleteDelivery({{ $deliv->id }})"
                                                                            wire:confirm="Are you sure? Document Delete?">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endfor
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table end -->

    <!-- View Document Modal -->
    <div wire:ignore.self class="modal fade" id="viewDocumentModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="max-width: 920px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white">
                        📄 Document Full Details
                    </h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    @if ($this->viewData)
                        <div class="row g-3">
                            <!-- BASIC INFO -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-primary text-white">
                                        Basic Information
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Importer:</strong> {{ $this->viewData->importer_name }} </p>
                                        <p><strong>Total Quantity:</strong> {{ $this->viewData->total_quantity }}
                                            {{ $this->viewData->pkgs_code }}</p>
                                        <p><strong>Vessel:</strong> {{ $this->viewData->vessel }}</p>
                                        <p><strong>BL No:</strong> {{ $this->viewData->bl_no }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- CONTAINER & LC -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-secondary text-white">
                                        Container & LC
                                    </div>
                                    <div class="card-body">
                                        <p><strong>ROT No:</strong> {{ $this->viewData->rot_no }} </p>
                                        <p><strong>LC No:</strong> {{ $this->viewData->lc_number }}</p>
                                        <p><strong>LC Date:</strong> {{ $this->viewData->lc_date }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-danger text-white">
                                        Items & Container Details
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 23%">Goods Name</th>
                                                    <th style="width: 11%">Item Qty</th>
                                                    <th>Item Value</th>
                                                    <th>Item N. W</th>
                                                    <th>Item G. W</th>
                                                    <th>Cont. No</th>
                                                    <th>Yard</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-uppercase">
                                                @php
                                                    $items = collect($this->viewData->items ?? [])
                                                        ->filter(fn($item) => !empty($item['goods_name']))
                                                        ->values();
                                                    $containers = collect($this->viewData->containers ?? [])
                                                        ->filter(fn($c) => !empty($c['container_no']))
                                                        ->values();
                                                    $rowCount = max($items->count(), $containers->count(), 1);
                                                    $total_net_weight = collect($this->viewData->items ?? [])->sum(
                                                        'net_weight',
                                                    );
                                                @endphp

                                                @for ($i = 0; $i < $rowCount; $i++)
                                                    @php
                                                        $item = $items[$i] ?? null;
                                                        $container = $containers[$i] ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{ $item['goods_name'] ?? '' }}
                                                        </td>
                                                        <td>
                                                            @if ($item)
                                                                {{ $item['item_quantity'] }}
                                                                {{ $this->viewData->pkgs_code }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item)
                                                                $ {{ $item['item_value'] ?? '' }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item)
                                                                {{ $item['net_weight'] ?? '' }} KGS
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item)
                                                                {{ $item['item_gross_weight'] ?? '' }} KGS
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($container)
                                                                <a class="text-primary font-weight-bold">
                                                                    {{ $container['container_no'] }}
                                                                </a>
                                                                X {{ $container['container_size'] }}
                                                            @endif
                                                        </td>
                                                        <td class="text-danger font-weight-bold">
                                                            @if ($container)
                                                                Y- {{ $container['container_location'] }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="float-right">Total=</th>
                                                    <th>{{ $this->viewData->total_quantity }}
                                                        {{ $this->viewData->pkgs_code }}</th>
                                                    <th>$ {{ number_format($this->viewData->invoice_value ?? 0, 2) }}
                                                    </th>
                                                    <th>{{ number_format($total_net_weight, 2) }} KGS</th>
                                                    <th> {{ number_format($this->viewData->gross_weight ?? 0, 2) }} KGS
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- RECEIVED -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-warning">
                                        Received Info
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Total Gross Weight:</strong>
                                            {{ number_format($this->viewData->gross_weight ?? 0, 2) }} KGS
                                        </p>
                                        <p><strong>Invoice No:</strong> {{ $this->viewData->invoice_no }} </p>
                                        <p><strong>Invoice Date:</strong>
                                            {{ $this->viewData->invoice_date }}
                                        </p>
                                        <p><strong>Invoice Value:</strong> $
                                            {{ number_format($this->viewData->invoice_value ?? 0, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- REGISTER -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-success text-white">
                                        Register Info
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Total Net Weight:</strong>
                                            {{ number_format($total_net_weight, 2) }} KGS
                                        </p>
                                        <p><strong>BE No:</strong>
                                            {{ $this->viewData->be_no ? 'C- ' . $this->viewData->be_no : '' }}
                                        </p>
                                        <p><strong>BE Date:</strong> {{ $this->viewData->be_date }}</p>
                                        <p><strong>Lane:</strong>
                                            <span
                                                class="text-white badge bg-{{ $this->viewData->be_lane === 'RED' ? 'danger' : 'warning' }}">
                                                {{ $this->viewData->be_lane }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- ASSESSMENT -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-info text-white">
                                        Assessment
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Assessment Date:</strong>
                                            {{ $this->viewData->assessment_date }}</p>
                                        <p><strong>R No:</strong>
                                            {{ $this->viewData->r_no ? 'R- ' . $this->viewData->r_no : '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- DELIVERY -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-dark text-white">
                                        Delivery
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Delivery Date:</strong>
                                            {{ $this->viewData->delivery_date }}
                                        </p>
                                        <p><strong>Receiver:</strong>
                                            {{ $this->viewData->document_receiver }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header fw-bold bg-info text-white">
                                        Document
                                    </div>
                                    <div class="card-body">
                                        @if ($this->viewData->document)
                                            <div class="border rounded mt-2" style="height: 500px;">
                                                <iframe src="{{ asset('storage/' . $this->viewData->document) }}"
                                                    class="w-100 h-100" title="Assessment PDF">
                                                </iframe>
                                            </div>
                                            <a href="{{ asset('storage/' . $this->viewData->document) }}"
                                                target="_blank" class="btn btn-sm btn-outline-secondary mt-2">
                                                🔗 Open in New Tab
                                            </a>
                                        @else
                                            <span class="text-muted">No PDF attached</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
