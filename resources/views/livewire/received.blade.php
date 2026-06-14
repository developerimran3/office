 <!-- end topbar -->
 <div class="midde_cont">
     <div class="container-fluid">
         <div class="row column_title">
             <div class="col-md-12">
                 <div class="page_title">
                     <h2>Orginial Documents Received</h2>
                 </div>
             </div>
         </div>

         @if ($receivedId)
             <div class="row column1">
                 <div class="col-md-12">
                     <div class="white_shd page_title mt-3">
                         <div class="heading1 margin_0">
                             <h2>Documents Details</h2>
                             <hr class="m-0">
                         </div>

                         <form wire:submit.prevent="updateReceived">
                             <div class="row mb-2">
                                 @if ($step == 1)
                                     <div class="col-md-3 mb-3">
                                         <label>BL No</label>
                                         <input type="text" wire:model="bl_no" class="form-control" readonly>
                                     </div>
                                     @if (!$vessel)
                                         <div class="col-md-2">
                                             <label>Vessel</label>
                                             <input type="text" wire:model="vessel" name="vessel"
                                                 class="form-control">
                                         </div>
                                     @endif
                                     <div class="col-md-2">
                                         <label>Rotation No</label>
                                         <input type="text" wire:model="rot_no" name="rot_no" class="form-control">
                                     </div>
                                     <div class="col-md-2">
                                         <label>Invoice Value</label>
                                         <input type="number" step="0.01" wire:model="invoice_value"
                                             name="invoice_value" class="form-control">
                                     </div>
                                     <div class="col-md-2">
                                         <label>Invoice No</label>
                                         <input type="text" wire:model="invoice_no" name="invoice_no"
                                             class="form-control">
                                     </div>
                                     <div class="col-md-2">
                                         <label>Invoice Date</label>
                                         <input type="date" wire:model="invoice_date" class="form-control">
                                     </div>
                                     <div class="col-md-12 my-3 text-right">
                                         <button type="button" wire:click="nextStep" class="main_bt">
                                             Next →
                                         </button>
                                     </div>
                                 @endif


                                 @if ($step == 2)
                                     {{-- Alart Message --}}
                                     <div wire:poll.2s class="col-md-12 mb-3">
                                         @if ($warningMessage)
                                             <div class="alert alert-danger">
                                                 {{ $warningMessage }}
                                             </div>
                                         @endif
                                     </div>

                                     {{-- Goods Details --}}
                                     <div class="col-md-4 mb-3">
                                         <h3>Goods Details</h3>
                                     </div>

                                     <div class="col-md-2 mb-2">
                                         <label for="total_quantity">Total Quantity</label>
                                         <input type="text" class="form-control"
                                             value="{{ $total_quantity }} {{ $pkgs_code }}" readonly>
                                     </div>

                                     <div class="col-md-2 mb-2">
                                         <label for="total_quantity">Total N.W</label>
                                         <input type="text" class="form-control" value="{{ $total_nw }} KGS"
                                             readonly>
                                     </div>

                                     <div class="col-md-2 mb-2">
                                         <label for="total_quantity">Total G.w</label>
                                         <input type="text" class="form-control" value="{{ $gross_weight }} KGS"
                                             readonly>
                                     </div>

                                     <div class="col-md-2 mb-2">
                                         <label for="total_quantity">Total Value</label>
                                         <input type="text" class="form-control" value="USD {{ $remainingValue }}"
                                             readonly>
                                     </div>
                                     @foreach ($items as $index => $item)
                                         <div class="col-md-4 my-2">
                                             <input type="text" wire:model="items.{{ $index }}.goods_name"
                                                 class="form-control text-uppercase text-white bg-info" readonly>
                                         </div>

                                         <div class="col-md-2 my-2">
                                             <input type="number" step="0.01"
                                                 wire:model="items.{{ $index }}.item_quantity" name="quantity"
                                                 class="form-control" placeholder="Item Quantity">
                                         </div>

                                         <div class="col-md-2 my-2">
                                             <input type="number" step="0.001"
                                                 wire:model="items.{{ $index }}.net_weight" name="net_weight"
                                                 class="form-control" placeholder="Net Weight">
                                         </div>

                                         <div class="col-md-2 my-2">
                                             <input type="number"
                                                 wire:model="items.{{ $index }}.item_gross_weight"
                                                 name="gross_weight" class="form-control" step="0.001"
                                                 placeholder="Item Gross Weight">
                                         </div>

                                         <div class="col-md-2 my-2">
                                             <input type="number" wire:model="items.{{ $index }}.item_value"
                                                 name="item_value" class="form-control" step="0.001"
                                                 placeholder="Item Value">
                                         </div>
                                     @endforeach
                                     {{-- Container Details --}}
                                     <div class="col-md-12 my-3">
                                         <h3>Container Details</h3>
                                     </div>
                                     @foreach ($containers as $i => $container)
                                         <div class="col-md-4 my-2">
                                             <input type="text"
                                                 wire:model="containers.{{ $i }}.container_no"
                                                 class="form-control text-uppercase" readonly>
                                         </div>
                                         <div class="col-md-4 my-2">
                                             <input type="text"
                                                 wire:model="containers.{{ $i }}.container_size"
                                                 class="form-control text-uppercase" readonly>
                                         </div>

                                         <div class="col-md-2 my-2">
                                             <select wire:model="containers.{{ $i }}.container_location"
                                                 class="form-control">
                                                 <option value="">--Select--</option>
                                                 <option value="Yard">Yard</option>
                                                 <option value="NCT">NCT </option>
                                                 <option value="CCT">CCT </option>
                                                 <option value="NCY">NCY </option>
                                                 <option value="01">01 </option>
                                                 <option value="02">02 </option>
                                                 <option value="03">03 </option>
                                                 <option value="04">04 </option>
                                                 <option value="05">05 </option>
                                                 <option value="06">06 </option>
                                                 <option value="07">07 </option>
                                                 <option value="08">08 </option>
                                                 <option value="08B">08B </option>
                                                 <option value="10">10 </option>
                                             </select>
                                         </div>
                                     @endforeach
                                     <div class="col-md-12 my-3">
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
                     <div>
                         @if (Session::has('success'))
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ Session::get('success') }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @endif
                         @error('invoice_no')
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ $message }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @enderror
                     </div>
                     <div class="heading1 m-0 p-0">
                         <h2 class="">All Received Documents</h2>
                     </div>
                     <div class="row column1">
                         <div class="col-md-12">
                             <div class=" full">
                                 <div class="heading1 margin_0">
                                     <table class="table table-bordered align-middle">
                                         <thead>
                                             <tr class="document_received">
                                                 <th>#</th>
                                                 <th>Importer Name</th>
                                                 <th>Goods Name</th>
                                                 <th>Item Qty</th>
                                                 <th>N.W</th>
                                                 <th>G.W</th>
                                                 <th>Item Value</th>
                                                 <th>Value</th>
                                                 <th>Total Qty</th>
                                                 <th>Vessel</th>
                                                 <th>BL. No</th>
                                                 <th>Rot. No</th>
                                                 <th>Cont. No</th>
                                                 <th>Yard</th>
                                                 <th>Invoice No</th>
                                                 <th>IV. Date</th>
                                                 <th>Rec. Doc</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>

                                         <tbody class="text-uppercase">
                                             @foreach ($receiveds as $receive)
                                                 @php
                                                     $items = $receive->items ?? [];
                                                     $containers = $receive->containers ?? [];

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
                                                                 {{ $receive->importer_name }}
                                                             </td>
                                                         @endif

                                                         {{-- GOODS / ITEM / NW --}}
                                                         @if ($item)
                                                             <td>
                                                                 {{ $item['goods_name'] ?? '' }}
                                                             </td>

                                                             <td>
                                                                 {{ $item['item_quantity'] ?? ($item['qty'] ?? 0) }}
                                                                 {{ $receive->pkgs_code }}
                                                             </td>

                                                             <td>
                                                                 {{ $item['net_weight'] ?? 0 }}
                                                                 KGS
                                                             </td>

                                                             <td>
                                                                 {{ $item['item_gross_weight'] ?? 0 }}
                                                                 KGS
                                                             </td>

                                                             <td>
                                                                 $ {{ number_format($item['item_value'] ?? 0, 2) }}
                                                             </td>
                                                         @else
                                                             {{-- EMPTY CELLS --}}
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                             <td></td>
                                                         @endif


                                                         {{-- COMMON DATA --}}
                                                         @if ($i == 0)
                                                             <td rowspan="{{ $rowspan }}">
                                                                 $ {{ number_format($receive->invoice_value ?? 0, 2) }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->total_quantity }}
                                                                 {{ $receive->pkgs_code }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 <a href="https://www.google.com/search?q={{ urlencode($receive->vessel) }}"
                                                                     target="_blank"
                                                                     class="text-primary font-weight-bold">
                                                                     {{ $receive->vessel }}
                                                                 </a>
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->bl_no }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->rot_no }}
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
                                                         <td class="text-success">
                                                             @if ($container)
                                                                 Y- {{ $container['container_location'] ?? '' }}
                                                             @endif
                                                         </td>

                                                         {{-- COMMON --}}
                                                         @if ($i == 0)
                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->invoice_no }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->invoice_date }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $receive->document_receiver }}
                                                             </td>

                                                             {{-- ACTION --}}
                                                             <td rowspan="{{ $rowspan }}">
                                                                 <div class="d-flex justify-content-between">
                                                                     <a class="btn btn-sm btn-warning"
                                                                         wire:click="editToReceived({{ $receive->id }})">
                                                                         <i class="fa fa-edit"></i>
                                                                     </a>
                                                                     @if ($receive->invoice_no)
                                                                         <a class="btn btn-sm btn-success ml-1"
                                                                             wire:click="moveToRegister({{ $receive->id }})"
                                                                             wire:confirm="Are you Move To Register Document?">
                                                                             <i class="fa fa-arrow-circle-right"></i>
                                                                         </a>
                                                                     @endif
                                                                     <a class="btn btn-danger btn-sm ml-1"
                                                                         wire:click="deleteReceived({{ $receive->id }})"
                                                                         wire:confirm="Are you sure? Document Delete?">
                                                                         <i class="fa fa-trash"></i>
                                                                     </a>
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
 </div>
