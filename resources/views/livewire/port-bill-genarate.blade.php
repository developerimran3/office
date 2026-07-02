<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>New Enty By Copy BL</h2>
                </div>
            </div>
        </div>

        <a href="{{ url('/port-rate') }}" wire:navigate class="btn btn-sm btn-warning">RATE UPDATE</a>

        <div class="row column1">
            <div class="col-md-5">
                <div class="full margin_bottom_30 bg-white p-3">
                    <form wire:submit.prevent="createEnty">

                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">Bill Type</div>
                            <div class="col-3">
                                <select class="form-control form-control-sm" wire:model="ff">
                                    <option value="FCL">FCL CONT</option>
                                    <option value="LCL">LCL CONT</option>
                                </select>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-2 label-cell">Cont Size</div>
                            <div class="col-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lift_type" value="8.5"
                                        wire:model="lift_type" required>
                                    <label class="form-check-label">8.5</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lift_type" value="9.5"
                                        wire:model="lift_type" required>
                                    <label class="form-check-label">9.5</label>
                                </div>
                            </div>
                        </div>
                        <!-- C/L DT + CONTAINER -->

                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">C/L DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" wire:model.lazy="cl_date"
                                    required>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">Cont Type</div>
                            <div class="col-3">
                                <select class="form-control form-control-sm" wire:model="cont_select" required>
                                    <option value="">--select--</option>
                                    <option value="20fcl">20' FCL</option>
                                    <option value="40fcl">40' FCL</option>
                                    <option value="45fcl">45' FCL</option>


                                    <option value="lockfast">LOCKFAST</option>
                                    <option value="warehouse">WAREHOUSE</option>
                                </select>
                            </div>
                        </div>

                        <!-- UNSTF + QNTY -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">UNSTF DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" wire:model.lazy="unstf_date">
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">QNTY</div>
                            <div class="col-3">
                                <input type="number" value="1" class="form-control form-control-sm"
                                    wire:model="qty" placeholder="1" required>
                            </div>
                        </div>

                        <!-- W/R DT + RATE -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">W/R DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" wire:model="wr_date"
                                    readonly>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">EXCH RATE</div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-sm" value="122.7"
                                    wire:model="usd_rate" required placeholder="122.7">
                            </div>
                        </div>

                        <!-- UP TO + DAYS -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">UP TO DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" wire:model.lazy="upto_date"
                                    required>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">DAY(s)</div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-sm" wire:model="days" readonly>
                            </div>
                        </div>

                        <!-- ADO + DG -->
                        <div class="form-row align-items-center mb-3">
                            <div class="col-2 label-cell">ADO DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" wire:model="ado_dt" readonly>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 text-warning font-weight-bold">DG</div>
                            <div class="col-3">
                                <select class="form-control form-control-sm" wire:model="dg_status">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <!-- EXTRA MOVEMENT -->
                        <div class="form-row align-items-center mb-3">
                            <div class="col-2 label-cell">EXT. MOV</div>
                            <div class="col-2">
                                <input type="number" class="form-control form-control-sm" wire:model="extra_mov"
                                    placeholder="0">
                            </div>

                            <div class="col-2 label-cell">RPC</div>
                            <div class="col-2">
                                <input type="number" wire:model="rpc" min="{{ $qty }}"
                                    class="form-control form-control-sm">
                            </div>

                            <div class="col-2 label-cell">HC</div>
                            <div class="col-2">
                                <input type="number" class="form-control form-control-sm" wire:model="hc"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm">
                                Save Entry
                            </button>
                        </div>

                    </form>
                </div>
            </div>



            <div class="col-md-7">
                <div class="full counter_section margin_bottom_30">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="port_bill">
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>RATE (T/$)</th>
                                    <th>QNTY</th>
                                    <th>DAYS</th>
                                    <th>PORT (TK)</th>
                                    <th>VAT (TK)</th>
                                    <th>MLWF (TK)</th>
                                </tr>
                            </thead>
                            @if (!empty($calculated))
                                <tbody>
                                    <tr>
                                        <td>RIVER DUES CNT (2N)</td>
                                        <td class="text-right">
                                            {{ $calculated['river_dues'] / ($qty ?: 1) }}
                                        </td>
                                        <td class="text-center"> {{ $qty ?? 0 }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">
                                            {{ $calculated['river_dues'] * $usd_rate }}
                                        </td>
                                        <td class="text-right">
                                            {{ $calculated['river_dues'] * $usd_rate * 0.15 }}
                                        </td>
                                        <td class="text-right">
                                            {{ $calculated['river_dues'] * $usd_rate * 0.04 }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>LIFT ON (2N)</td>

                                        <td class="text-right">
                                            {{ $calculated['lift_on'] / ($qty ?: 1) }}
                                        </td>
                                        <td class="text-center"> {{ $qty ?? 0 }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">
                                            {{ $calculated['lift_on'] * $usd_rate }}
                                        </td>
                                        <td class="text-right">
                                            {{ $calculated['lift_on'] * $usd_rate * 0.15 }}
                                        </td>
                                        </td>
                                        <td class="text-right">-</td>
                                    </tr>

                                    <tr>
                                        <td>REPAIRING CHARGE (2N)</td>
                                        <td class="text-right">
                                            {{ $calculated['rpc_rate'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ (float) ($rpc ?? 0) }}
                                        </td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">
                                            {{ $calculated['rpc_rate'] * (float) $rpc }}
                                        </td>
                                        <td class="text-right">
                                            {{ $calculated['rpc_rate'] * (float) $rpc * 0.15 }}
                                        </td>
                                        <td class="text-right">-</td>
                                    </tr>

                                    @if ($calculated['store_rent_1_days'] > 0)
                                        <tr>
                                            <td>
                                                STORE RENT (1N) NR
                                            </td>

                                            <td class="text-right">
                                                {{ $calculated['store_rent_1'] }}
                                            </td>

                                            <td class="text-center">
                                                {{ $qty }}
                                            </td>

                                            <td class="text-center">
                                                {{ $calculated['store_rent_1_days'] }}
                                            </td>

                                            <td class="text-right">
                                                {{ $calculated['store_rent_1_amount'] * $usd_rate }}
                                            </td>

                                            <td class="text-right">
                                                {{ $calculated['store_rent_1_amount'] * $usd_rate * 0.15 }}
                                            </td>
                                            <td class="text-right">-</td>
                                        </tr>
                                    @endif

                                    @if ($calculated['store_rent_2_days'] > 0)
                                        <tr>
                                            <td>
                                                STORE RENT (2N) NR
                                            </td>

                                            <td class="text-right">
                                                {{ $calculated['store_rent_2'] }}
                                            </td>

                                            <td class="text-center">
                                                {{ $qty ?? 0 }}
                                            </td>

                                            <td class="text-center">
                                                {{ $calculated['store_rent_2_days'] }}
                                            </td>

                                            <td class="text-right">
                                                {{ $calculated['store_rent_2_amount'] * $usd_rate }}
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['store_rent_2_amount'] * $usd_rate * 0.15 }}
                                            </td>
                                            <td class="text-right"> - </td>
                                        </tr>
                                    @endif

                                    @if ($calculated['store_rent_3_days'] > 0)
                                        <tr>
                                            <td>
                                                STORE RENT (3N) NR
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['store_rent_3'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ $qty ?? 0 }}
                                            </td>
                                            <td class="text-center">
                                                {{ $calculated['store_rent_3_days'] }}
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['store_rent_3_amount'] * $usd_rate }}
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['store_rent_3_amount'] * $usd_rate * 0.15 }}
                                            </td>
                                            <td class="text-right">-</td>
                                        </tr>
                                    @endif

                                    @if ($extra_mov)
                                        <tr>
                                            <td>EXTRA MOVEMENT (2N)</td>
                                            <td class="text-right">
                                                {{ $calculated['extra_mov_rate'] }}
                                            </td>
                                            <td class="text-center"> {{ (float) ($extra_mov ?? 0) }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">
                                                {{ $calculated['extra_mov_rate'] * (float) $extra_mov * $usd_rate }}
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['extra_mov_rate'] * (float) $extra_mov * $usd_rate * 0.15 }}
                                            </td>
                                            <td class="text-right">-</td>
                                        </tr>
                                    @endif

                                    @if ($hc)
                                        <tr>
                                            <td>HOSTING CHARGES (2N)</td>
                                            <td class="text-right"> {{ $calculated['hc_rate'] }}
                                            </td>
                                            <td class="text-center">{{ (float) ($hc ?? 0) }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">
                                                {{ $calculated['hc_rate'] * (float) $hc * $usd_rate }}
                                            </td>
                                            <td class="text-right">
                                                {{ $calculated['hc_rate'] * (float) $hc * $usd_rate * 0.15 }}
                                            </td>
                                            <td class="text-right">-</td>
                                        </tr>
                                    @endif

                                    <tr class="total-row font-weight-bold">
                                        <td colspan="3" class="text-right">TOTAL</td>
                                        <td class="text-center">{{ $calculated['display_days'] }}</td>
                                        <td class="text-right">
                                            {{ $calculated['total_port'] }}
                                        </td>
                                        <td class="text-right"> {{ $calculated['vat'] }}</td>
                                        <td class="text-right">{{ $calculated['mlwf'] }}</td>
                                    </tr>

                                    <tr class="gross-row bg-info text-white font-weight-bold">
                                        <td colspan="6" class="text-right">GROSS</td>
                                        <td class="text-right">{{ $calculated['gross'] }}</td>

                                    </tr>
                                </tbody>
                            @endif
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
