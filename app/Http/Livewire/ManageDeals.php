<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Deal;
use Livewire\WithPagination;
// use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class ManageDeals extends Component

{

    use withPagination;


    public $confirmingDealDeletion = false;
    public $confirmingDealAdd = false;
    public $confirmingDealEdit = false;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $newDeal, $name, $description, $discount, $start_date, $end_date, $is_hidden;



    protected function rules()
    {
        $rules = [
            'newDeal.name' => 'required|string|min:1|max:255',
            'newDeal.description' => 'required|string|min:1|max:255',
            'newDeal.discount' => 'required|numeric|min:0|max:100',
            'newDeal.start_date' => 'required|date',
            'newDeal.end_date' => 'required|date|after_or_equal:newDeal.start_date',
            'newDeal.is_hidden' => 'boolean',
        ];

        return $rules;
    }


    public function render()
    {
        $deals = Deal::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('livewire.manage-deals', [
            'deals' => $deals,
        ]);
    }

    public function confirmDealDeletion($id)
    {
        $this->confirmingDealDeletion = $id;
    }

    public function deleteDeal(Deal $deal)
    {
        $deal->delete();

        session()->flash('message', 'Deal successfully deleted.');
        $this->confirmingDealDeletion = false;
    }


    public function confirmDealAdd()
    {

        $this->reset(['newDeal']);
        $this->confirmingDealAdd = true;
    }

    public function confirmDealEdit(Deal $newDeal)
    {
        $this->newDeal = $newDeal;

        // using the same form for adding and editing
        $this->confirmingDealAdd = true;
    }

    public function saveDeal()
    {

        $this->validate();

        if (isset($this->newDeal->id)) {
            $this->newDeal->save();
        } else {

            Deal::create([
                'name' => $this->newDeal['name'],
                'description' => $this->newDeal['description'],
                'discount' => $this->newDeal['discount'],  // divide by 100 for the percentage
                'start_date' => $this->newDeal['start_date'],
                'end_date' => $this->newDeal['end_date'],
                'is_hidden' => isset($this->newService['is_hidden']) ? $this->newService['is_hidden'] : false,
            ]);
        }


        session()->flash('message', 'Deal successfully saved.');

        $this->confirmingDealAdd = false;
    }
}
