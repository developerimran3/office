<?php

namespace App\Livewire;

use App\Models\Assessment as AssessmentDocument;
use App\Models\Delivery;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;


class Assessment extends Component
{
    use WithFileUploads, FileUpload;

    public $assessments = '';
    public $container_location;
    public $assessment_date;
    public $r_no;
    public $document;
    public $quantity;
    public $pkgs_code;
    public $assessmentId;


    public $delivery_date;
    public $showDeliveryModal = false;



    /**
     * Edit Data (create ar jonno)
     */
    public function editToAssessment($id)
    {
        $assessment = AssessmentDocument::findOrFail($id);

        $this->assessment_date    = $assessment->assessment_date;
        $this->r_no               = $assessment->r_no;
        $this->document           = $assessment->document;
        $this->quantity           = $assessment->quantity . ' ' . $assessment->pkgs_code;
        $this->container_location = $assessment->container_location;
        $this->assessmentId       = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */

    public function updateAssessment($id)
    {
        $assessment = AssessmentDocument::findOrFail($id);

        $rules = [
            'r_no'            => 'nullable|unique:assessments,r_no,' . $id,
            'assessment_date' => 'required|date',
        ];

        // শুধু নতুন file এলে validate
        if ($this->document instanceof TemporaryUploadedFile) {
            $rules['document'] = 'file|mimes:pdf|max:5120';
        }

        $this->validate($rules);

        // 🔥 BEST PRACTICE FILE HANDLING
        $path = $this->fileUpload(
            $this->document,
            $assessment->document,
            'documents',
            $assessment->be_no // filename base
        );

        $assessment->update([
            'assessment_date'    => $this->assessment_date,
            'r_no'               => $this->r_no,
            'container_location' => $this->container_location,
            'document'           => $path,
        ]);

        $this->reset('document');
        $this->mount();

        session()->flash('success', 'Document updated successfully!');
    }

    /**
     * Conformation sms(delivery)...
     */
    public function confirmMoveToDelivery($id)
    {
        $this->assessmentId = $id;
        $this->delivery_date = now()->format('Y-m-d'); // default date
        $this->showDeliveryModal = true;
    }


    /**
     * Move All Enty Data Recgister Page...
     */
    public function moveToDelivery($id)
    {
        DB::transaction(function () use ($id) {
            $assessment = AssessmentDocument::with(['items', 'containers'])->findOrFail($id);

            // // All Table ar Bl Valadation
            // $this->r_no = $assessment->r_no;
            // $this->validate([
            //     'r_no' => 'nullable',
            // ]);
            // $exists =
            //     DB::table('deliveries')->where('r_no', $this->r_no)->exists();
            // if ($exists) {
            //     $this->addError('r_no', 'R No already exists in another record.');
            //     return;
            // }

            Delivery::create([
                'importer_name'  => $assessment->importer_name,
                'total_quantity' => $assessment->total_quantity,
                'pkgs_code'      => $assessment->pkgs_code,
                'vessel'         => $assessment->vessel,
                'bl_no'          => $assessment->bl_no,
                'lc_number'      => $assessment->lc_number,
                'lc_date'        => $assessment->lc_date,
                'gross_weight'   => $assessment->gross_weight,
                'arrival_date'   => $assessment->arrival_date,
                'document_receiver'   => $assessment->document_receiver,

                'invoice_value'  => $assessment->invoice_value,
                'invoice_no'     => $assessment->invoice_no,
                'invoice_date'   => $assessment->invoice_date,
                'rot_no'         => $assessment->rot_no,

                'items' => collect($assessment->items)->map(function ($item) {
                    return [
                        'goods_name'        => $item['goods_name'] ?? '',
                        'item_quantity'     => $item['item_quantity'] ?? '',
                        'item_value'        => $item['item_value'] ?? '',
                        'net_weight'        => $item['net_weight'] ?? '',
                        'item_gross_weight' => $item['item_gross_weight'] ?? '',
                    ];
                })->toArray(),

                'containers' => collect($assessment->containers)->map(function ($container) {
                    return [
                        'container_no'       => $container['container_no'] ?? '',
                        'container_size'     => $container['container_size'] ?? '',
                        'container_location' => $container['container_location'] ?? '',
                    ];
                })->toArray(),

                //register
                'be_no'              => $assessment->be_no,
                'be_date'            => $assessment->be_date,
                'be_lane'            => $assessment->be_lane,
                //assessment
                'assessment_date'    => $assessment->assessment_date,
                'document'           => $assessment->document,
                'r_no'               => $assessment->r_no,
                //delivery
                'delivery_date'      => $this->delivery_date,

            ]);

            //Delete from Recived Data
            $assessment->delete();
            $this->showDeliveryModal = false;
            $this->mount();
            session()->flash('success', 'Delivery successfully!');
            return $this->redirect('/delivery', navigate: true);
        });
    }

    public function mount()
    {
        $this->assessments = AssessmentDocument::get();
    }


    public function render()
    {
        return view('livewire.assessment');
    }
}
