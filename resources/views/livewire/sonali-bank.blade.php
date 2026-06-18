<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Sonali Bank</h2>
                </div>
            </div>
        </div>
        <div class="row column1  mt-3 ">
            <div class="col-md-5">
                <div class="white_shd full p-4">
                    <div class="heading1 margin_0">
                        <h2>Sonali Bank Details</h2>
                        <hr class="m-0">
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <!-- Type Selector -->
                            <div class="col-md-4">
                                <label>Cash or B/E</label>
                                <select class="form-control" wire:model.lazy="type">
                                    <option value="">--Select--</option>
                                    <option value="BE">B/E</option>
                                    <option value="CASH">CASH</option>
                                </select>
                            </div>

                            <!-- CASH Section -->
                            @if ($type == 'CASH')
                                <div class="col-md-4">
                                    <label>Credit (Cash)</label>
                                    <input type="number" wire:model="credit" step="0.001" class="form-control">
                                    @error('credit')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Credit Date</label>
                                    <input type="date" wire:model="credit_date" class="form-control">
                                </div>
                            @endif

                            <!-- B/E Section -->
                            @if ($type == 'BE')
                                <div class="col-md-4">
                                    <label>B/E Number</label>
                                    <select wire:model.lazy="be_no" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($delivery as $d)
                                            <option value="{{ $d->be_no }}">{{ $d->be_no }}</option>
                                        @endforeach
                                        @error('be_no')
                                            <p class="text-danger"> {{ $message }}</p>
                                        @enderror
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <label>Date</label>
                                    <input type="date" wire:model="be_date" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Goods Name</label>
                                    <input type="text" class="form-control" readonly
                                        value="{{ collect($items)->pluck('goods_name')->implode(', ') }}">
                                    @error('goods_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Debit</label>
                                    <input type="number" wire:model="debit" class="form-control" step="0.001">

                                    @error('debit')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                            @endif

                            <div class="col-md-12 mt-3">
                                <button type="submit" class="main_bt">Sonali Save</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <!-- table srart -->
            <div class="col-md-7">
                <div class="white_shd full p-4 ">
                    <div class="heading1 m-0 p-0">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h2>All Availability</h2>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="sonali">
                                <th>#</th>
                                <th>B/E No</th>
                                <th>Date</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($sonalis as $sonali)
                                <tr class="sonali">
                                    <td>{{ $loop->iteration }} </td>
                                    <td>
                                        @if ($sonali->type == 'BE')
                                            {{ $sonali->be_no ? 'C- ' . $sonali->be_no : '' }}
                                        @elseif($sonali->type == 'CASH')
                                            CASH
                                        @endif
                                    </td>

                                    <td>
                                        @if ($sonali->type == 'BE')
                                            {{ $sonali->be_date }}
                                        @elseif($sonali->type == 'CASH')
                                            {{ $sonali->credit_date }}
                                        @endif
                                    </td>

                                    <td>{{ $sonali->debit ?? 0 }}</td>
                                    <td>{{ $sonali->credit ?? 0 }}</td>

                                    <!-- Balance -->
                                    <td class="font-weight-bold"> {{ number_format($sonali->balance ?? 0, 2) }}</td>
                                    <td>
                                        @if ($sonali->type == 'BE')
                                            @php
                                                $items = is_string($sonali->items)
                                                    ? json_decode($sonali->items, true)
                                                    : $sonali->items;
                                            @endphp

                                            {{ collect($items ?? [])->pluck('goods_name')->implode(',    ') }}
                                        @elseif($sonali->type == 'CASH')
                                            CASH
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table end -->
        </div>
    </div>
</div>
