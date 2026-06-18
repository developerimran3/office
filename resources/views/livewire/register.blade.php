 <!-- end topbar -->
 <div class="midde_cont">
     <div class="container-fluid">
         <div class="row column_title">
             <div class="col-md-12">
                 <div class="page_title">
                     <h2>Registered <small>(C- Number)</small> </h2>
                 </div>
             </div>
         </div>

         @if ($registerId)
             <div class="row column1">
                 <div class="col-md-12">
                     <div class="white_shd page_title mt-3">
                         <div class="heading1 margin_0">
                             <h2>Documents Details</h2>
                             <hr class="m-0">
                         </div>

                         <form wire:submit.prevent="updateRegister({{ $registerId }})">
                             <div class="row">
                                 @if ($step == 1)
                                     <div class="col-md-3">
                                         <label for="quantity">Quantity</label>
                                         <input type="text" wire:model="total_quantity" class="form-control"
                                             readonly>
                                     </div>

                                     <div class="col-md-3">
                                         <label for="be_no">B/E Number</label>
                                         <input type="number" wire:model="be_no" name="be_no" class="form-control"
                                             placeholder="B/E Number">
                                         @error('be_no')
                                             <p class="text-danger"> {{ $message }}</p>
                                         @enderror
                                     </div>

                                     <div class="col-md-3">
                                         <label for="be_date">B/E Date</label>
                                         <input type="date" wire:model="be_date" name="be_date" class="form-control"
                                             placeholder="B/E Date">
                                         @error('be_date')
                                             <p class="text-danger"> {{ $message }}</p>
                                         @enderror
                                     </div>

                                     <div class="col-md-3">
                                         <label for="be_lane">B/E Lane</label>
                                         <select wire:model="be_lane" class="form-control">
                                             <option hidden>B/E LANE</option>
                                             <option value="YELLOW">YELLOW LANE</option>
                                             <option value="RED">RED LANE</option>
                                         </select>
                                     </div>


                                     @if (empty($containers[0]['container_location']))
                                         <div class="col-md-12 my-3 text-right">
                                             <button type="button" wire:click="nextStep" class="main_bt">
                                                 Next →
                                             </button>
                                         </div>
                                     @else
                                         <div class="col-md-12 my-3 text-right">
                                             <button type="submit" class="main_bt ">Update</button>
                                         </div>
                                     @endif
                                 @endif
                                 @if ($step == 2)
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
                                                 <option>Yard</option>
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

                                         <button type="submit" class="main_bt float-right">
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
                         <div>
                             @if (Session::has('success'))
                                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                                     {{ Session::get('success') }}
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                             @endif
                             @error('be_no')
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     {{ $message }}
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                             @enderror
                         </div>
                         <h2 class="">All Registered Documents</h2>
                     </div>
                     <div class="row column1">
                         <div class="col-md-12">
                             <div class=" full">
                                 <div class="heading1 margin_0 responsive_table">
                                     <table class="table table-bordered mb-none dataTable no-footer " id="dataTable">
                                         <thead>
                                             <tr class="register_enty">
                                                 <th>#</th>
                                                 <th>Importer Name</th>
                                                 <th>Goods Name</th>
                                                 <th>Item Qty</th>
                                                 <th>N.W</th>
                                                 <th>G.W</th>
                                                 <th>Item Value</th>
                                                 <th>Total Value</th>
                                                 <th>Total Qty</th>
                                                 <th>Vessel</th>
                                                 <th>BL. No</th>
                                                 <th>Rot. No</th>
                                                 <th>Cont. No</th>
                                                 <th>Yard</th>
                                                 <th>B/E No</th>
                                                 <th>B/E Date</th>
                                                 <th>B/E Lane</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>

                                         <tbody class="text-uppercase">
                                             @foreach ($registers as $register)
                                                 @php
                                                     $items = $register->items ?? [];
                                                     $containers = $register->containers ?? [];

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
                                                                 {{ $register->importer_name }}
                                                             </td>
                                                         @endif

                                                         {{-- GOODS / ITEM / NW --}}
                                                         @if ($item)
                                                             <td>
                                                                 {{ $item['goods_name'] ?? '' }}
                                                             </td>

                                                             <td>
                                                                 {{ $item['item_quantity'] ?? ($item['qty'] ?? 0) }}
                                                                 {{ $register->pkgs_code }}
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
                                                                 $
                                                                 {{ number_format((float) ($item['item_value'] ?? 0), 2) }}
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
                                                                 $
                                                                 {{ number_format($register->invoice_value ?? 0, 2) }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $register->total_quantity }}
                                                                 {{ $register->pkgs_code }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 <a href="https://www.google.com/search?q={{ urlencode($register->vessel) }}"
                                                                     target="_blank"
                                                                     class="text-primary font-weight-bold">
                                                                     {{ $register->vessel }}
                                                                 </a>
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $register->bl_no }}
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $register->rot_no }}
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
                                                                 Y- <br> {{ $container['container_location'] ?? '' }}
                                                             @endif
                                                         </td>

                                                         {{-- COMMON --}}
                                                         @if ($i == 0)
                                                             <td rowspan="{{ $rowspan }}">
                                                                 C- <br> <a
                                                                     class="font-weight-bold text-success">{{ $register->be_no }}</a>
                                                             </td>

                                                             <td rowspan="{{ $rowspan }}">
                                                                 {{ $register->be_date }}
                                                             </td>



                                                             <td rowspan="{{ $rowspan }}"
                                                                 class="font-weight-bold {{ $register->be_lane === 'RED' ? 'text-danger' : '' }}
                                                            {{ $register->be_lane === 'YELLOW' ? 'text-warning' : '' }}">
                                                                 {{ $register->be_lane }}
                                                             </td>

                                                             {{-- ACTION --}}
                                                             <td rowspan="{{ $rowspan }}">
                                                                 <div class="d-flex justify-content-between ">
                                                                     <a class="btn btn-sm btn-warning"
                                                                         wire:click="editToregister({{ $register->id }})">
                                                                         <i class="fa fa-edit"></i></a>
                                                                     @if ($register->be_no && $register->be_date && $register->be_lane)
                                                                         <a class="btn btn-sm btn-success ml-1"
                                                                             wire:click="moveToAssessment({{ $register->id }})"
                                                                             wire:confirm="Are you Move To Assessment Document?">
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
     <!-- table end -->
 </div>
