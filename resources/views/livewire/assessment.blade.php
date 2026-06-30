<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Assessment To Delivery</h2>
                </div>
            </div>
        </div>

        @if ($assessmentId)
            <div class="row column1">
                <div class="col-md-12">
                    <div class="white_shd page_title mt-3">
                        <div class="heading1 margin_0">
                            <h2>Documents Details</h2>
                            <hr class="m-0">
                        </div>
                        <form wire:submit.prevent="updateAssessment({{ $assessmentId }})">
                            <div class="row">
                                @if ($step == 1)
                                    <div class="col-md-3 mb-3">
                                        <label>Quantity</label>
                                        <input type="text" wire:model="total_quantity" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>Assessment Date</label>
                                        <input type="date" wire:model="assessment_date" class="form-control">

                                        @error('assessment_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>R No</label>
                                        <input type="text" wire:model="r_no" name="r_no" class="form-control">
                                        @error('r_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>Document</label>
                                        <input type="file" wire:model="document" class="form-control">
                                        {{-- Current File --}}
                                        @if ($document && is_string($document))
                                            <p class="text-primary d-block mt-2">
                                                File: {{ basename($document) }}
                                            </p>
                                        @endif
                                    </div>
                                    @if (empty($containers[0]['container_location']))
                                        <div class="col-md-12 text-right mt-3">
                                            <button type="button" wire:click="nextStep" class="main_bt">
                                                Next →
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-md-12 text-right mt-3">
                                            <button type="submit" class="main_bt" data-bs-dismiss="modal">
                                                Update
                                            </button>
                                        </div>
                                    @endif
                                @endif
                                @if ($step == 2)
                                    @foreach ($containers as $i => $container)
                                        <div class="col-md-4 mb-2">
                                            <input type="text"
                                                wire:model="containers.{{ $i }}.container_no"
                                                class="form-control text-uppercase" readonly>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <input type="text"
                                                wire:model="containers.{{ $i }}.container_size"
                                                class="form-control text-uppercase" readonly>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <select wire:model="containers.{{ $i }}.container_location"
                                                class="form-control">
                                                <option value="">-- Select Yard --</option>
                                                <option value="NCT">NCT</option>
                                                <option value="CCT">CCT</option>
                                                <option value="NCY">NCY</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="08B">08B</option>
                                                <option value="10">10</option>

                                            </select>
                                        </div>
                                    @endforeach

                                    <div class="col-md-12 mt-3">

                                        <button type="button" wire:click="prevStep" class="btn btn-secondary">
                                            ← Back
                                        </button>

                                        <button class="main_bt float-right" data-bs-dismiss="modal">
                                            Update
                                        </button>
                                    </div>
                                @endif
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
                        @error('r_no')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <h2 class="">All Assessment Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0 table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead>
                                            <tr class="assessment">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Lc No</th>
                                                <th>Goods Name</th>
                                                <th>Item Qty</th>
                                                <th>N. W</th>
                                                <th>G. W</th>
                                                <th>Total Qty</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>Cont. No</th>
                                                <th>Yard</th>
                                                <th>R No</th>
                                                <th>Ass. Date</th>
                                                <th>Doc</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-uppercase">
                                            @foreach ($assessments as $assessment)
                                                @php
                                                    $items = $assessment->items ?? [];
                                                    $containers = $assessment->containers ?? [];

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
                                                                {{ $assessment->importer_name }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $assessment->lc_number }}
                                                            </td>
                                                        @endif

                                                        {{-- GOODS / ITEM / NW --}}
                                                        @if ($item)
                                                            <td>
                                                                {{ $item['goods_name'] ?? '' }}
                                                            </td>

                                                            <td>
                                                                {{ $item['item_quantity'] ?? 0 }}
                                                                {{ $assessment->pkgs_code }}
                                                            </td>

                                                            <td>
                                                                {{ $item['net_weight'] ?? 0 }}
                                                                KGS
                                                            </td>
                                                            <td>
                                                                {{ $item['item_gross_weight'] ?? 0 }}
                                                                KGS
                                                            </td>
                                                        @else
                                                            {{-- EMPTY CELLS --}}
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                        {{-- COMMON DATA --}}
                                                        @if ($i == 0)
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $assessment->total_quantity }}
                                                                {{ $assessment->pkgs_code }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                C- <br> <a
                                                                    class="font-weight-bold text-success">{{ $assessment->be_no }}</a>
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $assessment->be_date }}
                                                            </td>
                                                        @endif

                                                        {{-- CONTAINER --}}
                                                        <td>
                                                            @if ($container)
                                                                <a class="text-primary font-weight-bold">
                                                                    {{ $container['container_no'] ?? '' }}
                                                                </a>
                                                                <br> X {{ $container['container_size'] ?? '' }}
                                                            @endif
                                                        </td>

                                                        {{-- YARD --}}
                                                        <td class="text-danger font-weight-bold">
                                                            @if ($container)
                                                                Y- <br>
                                                                {{ $container['container_location'] ?? '' }}
                                                            @endif
                                                        </td>

                                                        {{-- COMMON --}}
                                                        @if ($i == 0)
                                                            <td rowspan="{{ $rowspan }}">
                                                                R- <br> <a
                                                                    class="font-weight-bold text-warning">{{ $assessment->r_no }}</a>
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $assessment->assessment_date }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                @if ($assessment->document)
                                                                    <a href="{{ Storage::url($assessment->document) }}"
                                                                        target="_blank" class="btn btn-sm btn-info">
                                                                        pdf
                                                                    </a>
                                                                @endif
                                                            </td>

                                                            {{-- ACTION --}}
                                                            <td rowspan="{{ $rowspan }}">
                                                                <div class="d-flex justify-content-between">
                                                                    <a url="#" class="btn btn-sm btn-warning"
                                                                        wire:click.prevent="editToAssessment({{ $assessment->id }})">
                                                                        <i class="fa fa-edit"></i></a>
                                                                    @if ($assessment->assessment_date && $assessment->r_no && $container['container_location'])
                                                                        <a class="btn btn-sm btn-success ml-1"
                                                                            wire:click.prevent="confirmMoveToDelivery({{ $assessment->id }})">
                                                                            <i class="fa fa-arrow-circle-right"></i>
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
    <!-- Delivery Modal -->
    @if ($showDeliveryModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-3">
                    <h5>Move to Delivery</h5>
                    <div class="form-group">
                        <label for="delivery_date">Delivery Date</label>
                        <input type="date" id="delivery_date" wire:model="delivery_date" class="form-control">
                        @error('delivery_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-success"
                            wire:click="moveToDelivery({{ $assessment->id }})">Confirm</button>
                        <button class="btn btn-secondary ml-2"
                            wire:click="$set('showDeliveryModal', false)">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

</div>
