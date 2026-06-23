<div class="container mt-4 mb-5"> {{-- SINGLE ROOT --}}
    <div class="card shadow-sm">
        <div class="card-header text-white">
            <h5 class="mb-0">Port Bill Rate</h5>
        </div>

        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save">

                {{-- River Dues --}}
                <h5 class="mt-3">River Dues</h5>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>20 ft</th>
                            <th>40 ft</th>
                            <th>45 ft</th>
                            <th>LCL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-danger font-weight-bold">River Dues</td>
                            <td><input type="number" step="0.01" wire:model="river_duse_20"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="river_duse_40"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="river_duse_45"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.001" wire:model="river_duse_lcl"
                                    class="form-control form-control-sm"></td>
                        </tr>
                    </tbody>
                </table>

                {{-- Lift On --}}
                <h5 class="mt-3">Lift On</h5>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>20x8.5 ft</th>
                            <th>40x8.5 ft</th>
                            <th>45x8.5 ft</th>
                            <th>20x9.5 ft</th>
                            <th>40x9.5 ft</th>
                            <th>45x9.5 ft</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-danger font-weight-bold">Lift On</td>
                            <td><input type="number" step="0.01" wire:model="lift_on_20"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="lift_on_40"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="lift_on_45"
                                    class="form-control form-control-sm"></td>

                            <td><input type="number" step="0.01" wire:model="lift_on_20_HQ"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="lift_on_40_HQ"
                                    class="form-control form-control-sm"></td>
                            <td><input type="number" step="0.01" wire:model="lift_on_45_HQ"
                                    class="form-control form-control-sm"></td>

                        </tr>
                    </tbody>
                </table>




                {{-- Extra Movement --}}
                <h5 class="mt-3">Extra Movement</h5>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="text-danger font-weight-bold">Extra Movement 20 ft</td>
                            <td><input type="number" step="0.01" wire:model="extra_movement_20"
                                    class="form-control form-control-sm"></td>
                            <td class="text-danger font-weight-bold">Extra Movement 40 ft</td>
                            <td><input type="number" step="0.01" wire:model="extra_movement_40"
                                    class="form-control form-control-sm"></td>
                            <td class="text-danger font-weight-bold">Extra Movement 45 ft</td>
                            <td><input type="number" step="0.01" wire:model="extra_movement_45"
                                    class="form-control form-control-sm"></td>
                        </tr>
                    </tbody>
                </table>

                {{-- Storage Charges --}}
                <h5 class="mt-3">Storage Charges</h5>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>20</th>
                            <th>40</th>
                            <th>45</th>
                            <th>20 DG</th>
                            <th>40 DG</th>
                            <th>45 DG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['1st', '2nd', '3rd'] as $i => $label)
                            <tr>
                                <td class="text-danger font-weight-bold">{{ $label }}</td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_20"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_40"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_45"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_20_dg"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_40_dg"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" wire:model="storage_{{ $label }}_45_dg"
                                        class="form-control form-control-sm"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- LCL Storage --}}
                <h5 class="mt-3">LCL Storage</h5>
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>Lock</th>
                            <th>Ware</th>
                            <th>Lock DG</th>
                            <th>Ware DG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['1st', '2nd', '3rd'] as $label)
                            <tr>
                                <td class="text-danger font-weight-bold">{{ $label }}</td>
                                <td><input type="number" step="0.001"
                                        wire:model="storage_{{ $label }}_lcl_lock"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.001"
                                        wire:model="storage_{{ $label }}_lcl_ware"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.001"
                                        wire:model="storage_{{ $label }}_lcl_lock_dg"
                                        class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.001"
                                        wire:model="storage_{{ $label }}_lcl_ware_dg"
                                        class="form-control form-control-sm"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Other Charges --}}
                <h5 class="mt-3">Other Charges</h5>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="text-danger font-weight-bold">RPC</td>
                            <td><input type="number" step="0.01" wire:model="rpc"
                                    class="form-control form-control-sm"></td>
                            <td class="text-danger font-weight-bold">HC</td>
                            <td><input type="number" step="0.01" wire:model="hc"
                                    class="form-control form-control-sm"></td>
                            <td class="text-danger font-weight-bold">Unstuffing</td>
                            <td><input type="number" step="0.01" wire:model="unstuffing"
                                    class="form-control form-control-sm"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <a href="{{ url('/port-bill') }}" wire:navigate class="btn btn-success">
                            Back
                        </a>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">
                            Save Port Bill Rate
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
