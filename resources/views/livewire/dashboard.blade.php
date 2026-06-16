<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1 ">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 mt-3">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-user yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $enty->count() }}</p>
                            <p class="head_couter">New Enty</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 mt-3">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-clock-o blue1_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $receiveds->count() }}</p>
                            <p class="head_couter">Received</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 mt-3">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-cloud-download green_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $registers->count() }}</p>
                            <p class="head_couter">Registers</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 mt-3">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-comments-o red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $assessments->count() }}</p>
                            <p class="head_couter">Assessments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-comments-o red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $delivery->count() }}</p>
                            <p class="head_couter">Delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- new enty table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <h2 class="">All New Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="new_enty_tr">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Vassel</th>
                                                <th>BL No</th>
                                                <th>Cont. No</th>
                                                <th>LC No</th>
                                                <th>LC Date</th>
                                                <th>G.W</th>
                                                <th>ETA. Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enty as $enty)
                                                <tr class="new_enty_tr">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $enty->importer_name }}</td>
                                                    <td class="font-weight-bold">{{ $enty->goods_name }}</td>
                                                    <td>{{ $enty->quantity }} {{ $enty->pkgs_code }}</td>
                                                    <td>{{ $enty->vessel }}</td>
                                                    <td>{{ $enty->bl_no }}</td>
                                                    <td>{{ $enty->container_no }}x{{ $enty->container_size }}</td>
                                                    <td>{{ $enty->lc_number }}</td>
                                                    <td>{{ $enty->lc_date }}</td>
                                                    <td>{{ number_format($enty->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $enty->arivel_date }}</td>
                                                </tr>
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
        <!-- table end -->

        <!-- Received document table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <h2 class="">All Received Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="document_received">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Vessel</th>
                                                <th>BL. No</th>
                                                <th>Rot. No</th>
                                                <th>Yard</th>
                                                <th>Value</th>
                                                <th>Invoice No</th>
                                                <th>IV. Date</th>
                                                <th>N.W</th>
                                                <th>Rec. Doc</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($receiveds as $receive)
                                                <tr class="document_received">
                                                    <td> {{ $loop->iteration }} </td>
                                                    <td>{{ $receive->importer_name }}</td>
                                                    <td class="font-weight-bold">{{ $receive->goods_name }}</td>
                                                    <td>{{ $receive->quantity }} {{ $receive->pkgs_code }}</td>
                                                    <td>{{ $receive->vessel }}</td>
                                                    <td>{{ $receive->bl_no }}</td>
                                                    <td>{{ $receive->rot_no ? date('Y') . '/' . $receive->rot_no : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $receive->container_location ? 'Y- ' . $receive->container_location : '' }}
                                                    </td>
                                                    <td>$ {{ number_format($receive->invoice_value ?? 0, 2) }}</td>
                                                    <td>{{ $receive->invoice_no }}</td>
                                                    <td>{{ $receive->invoice_date }}</td>
                                                    <td>{{ number_format($receive->net_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $receive->document_receiver }}</td>
                                                </tr>
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
        <!-- table end -->


        <!-- Registered Enty table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <div>
                        </div>
                        <h2 class="">All Registered Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="register_enty">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Vessel</th>
                                                <th>BL No</th>
                                                <th>Rot No</th>
                                                <th>Cont No</th>
                                                <th>Yard</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>G.W</th>
                                                <th>N.W</th>
                                                <th>B/E Lane</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registers as $register)
                                                <tr class="register_enty">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $register->importer_name }}</td>
                                                    <td class="font-weight-bold">{{ $register->goods_name }}</td>
                                                    <td>{{ $register->quantity }} {{ $register->pkgs_code }}</td>
                                                    <td>{{ $register->vessel }}</td>
                                                    <td>{{ $register->bl_no }}</td>
                                                    <td>{{ $register->rot_no }}</td>
                                                    <td>{{ $register->container_no }} x
                                                        {{ $register->container_size }}
                                                    </td>
                                                    <td>
                                                        {{ $register->container_location ? 'Y- ' . $register->container_location : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $register->be_no ? 'C- ' . $register->be_no : '' }}
                                                    </td>
                                                    <td>{{ $register->be_date }}</td>
                                                    <td>{{ number_format($register->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ number_format($register->net_weight ?? 0, 2) }} KGS</td>
                                                    <td
                                                        class="font-weight-bold {{ $register->be_lane === 'RED' ? 'text-danger' : '' }}
                                                            {{ $register->be_lane === 'YELLOW' ? 'text-warning' : '' }}">
                                                        {{ $register->be_lane }}
                                                    </td>
                                                </tr>
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

        <!-- Assessment Enty table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <h2 class="">All Assessment Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="assessment">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Lc No</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>Ass. Date</th>
                                                <th>R No</th>
                                                <th>G. W</th>
                                                <th>Cont. No</th>
                                                <th>Yard</th>
                                                <th>Doc</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assessments as $assessment)
                                                <tr class="assessment">
                                                    <td> {{ $loop->iteration }} </td>
                                                    <td>{{ $assessment->importer_name }}</td>
                                                    <td>{{ $assessment->lc_number }}</td>
                                                    <td class="font-weight-bold">{{ $assessment->goods_name }}</td>
                                                    <td>{{ $assessment->quantity }} {{ $assessment->pkgs_code }}</td>
                                                    <td>
                                                        {{ $assessment->be_no ? 'C- ' . $assessment->be_no : '' }}
                                                    </td>
                                                    <td>{{ $assessment->be_date }}</td>
                                                    <td>{{ $assessment->assessment_date }}</td>
                                                    <td>
                                                        {{ $assessment->r_no ? 'R- ' . $assessment->r_no : '' }}
                                                    </td>
                                                    <td>{{ number_format($assessment->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $assessment->container_no }} x
                                                        {{ $assessment->container_size }}
                                                    </td>
                                                    <td>
                                                        {{ $assessment->container_location ? 'Y- ' . $assessment->container_location : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($assessment->document)
                                                            <a href="{{ Storage::url($assessment->document) }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                View
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
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
</div>
<!-- table end -->
