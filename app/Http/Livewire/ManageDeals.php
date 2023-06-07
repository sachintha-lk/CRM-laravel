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

    
    public $newDeal, $name, $description, $discount, $date_start, $date_end, $is_hidden;



    protected function rules() {
    $rules = [
        'newDeal.name' => 'required|string|min:1|max:255',
        'newDeal.description' => 'required|string|min:1|max:255',
        'newDeal.discount' => 'required|numeric|min:0|max:100',
        'newDeal.date_start' => 'required|date',
        'newDeal.date_end' => 'required|date|after_or_equal:newDeal.date_start',
        'newDeal.is_hidden' => 'boolean',
    ];

    return $rules;
}
  

    public function render()
    {
        $deals = Deal::paginate(10);

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


    public function confirmDealAdd() {

        $this->reset(['newDeal']);
        $this->confirmingDealAdd = true;

  
    }

    public function confirmDealEdit( Deal $newDeal ) {
        $this->newDeal = $newDeal;

        // using the same form for adding and editing
        $this->confirmingDealAdd = true;
    }

    public function saveDeal() {
             
        $this->validate();
      
        if (isset($this->newDeal->id)) {
            $this->newDeal->save();
        } else {
            
        Deal::create([
            'name' => $this->newDeal['name'],
            'description' => $this->newDeal['description'],
            'discount' => $this->newDeal['discount'],  // divide by 100 for the percentage
            'date_start' => $this->newDeal['date_start'],
            'date_end' => $this->newDeal['date_end'],
            'is_hidden' => isset($this->newService['is_hidden']) ? $this->newService['is_hidden'] : false,
        ]);
        
        }
       

        session()->flash('message', 'Deal successfully saved.');

        $this->confirmingDealAdd = false;

      
    }



    
}
