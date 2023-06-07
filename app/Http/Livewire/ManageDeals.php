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
        'newDeal.discount' => 'required|numeric|min:0',
        'newDeal.date_start' => 'required|date',
        'newDeal.date_end' => 'required|date',

        'newDeal.price' => 'required|numeric|min:0',
        'newDeal.is_hidden' => 'boolean',
    ];

    if (isset($this->newDeal['image'])) {
    // Conditionally add the image validation rule
    if (is_string($this->newDeal['image'])) {

        $rules['newDeal.image'] = 'required|string|min:1|max:255';
    } else {
        // dd($this->newDeal['image']);

        // TODO: Fix image upload when updating
        $rules['newDeal.image'] = 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'; // max 2MB
    }
    } else {
        $rules['newDeal.image'] = 'required|string|min:1|max:255';
    }

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

    //    dd($newDeal->image);

        // dd($this->newDeal);
        $this->newDeal['image'] = $newDeal->image;
        // dd($newDeal['image']);



        $this->confirmingDealAdd = true;
    }
    


    public function saveDeal() {
        
       
        $this->validate();
      

        // if id is set, it means we are editing existing deal
        if (isset($this->newDeal['id'])) {
                
            // if image is string, it means it is not changed
            if (is_string($this->newDeal['image'])) {
                $this->newDeal['image'] = $this->newDeal['image'];
                
            } else {
                dd($originalImage = $this->newDeal['image']->getClientOriginalName());
                
                $this->newDeal['image']->store('images', 'public');
                $this->newDeal['image'] = $this->newDeal['image']->hashName();

                // remove old image
                
                

                
            }
            
            $this->newDeal->save();
        } else {

            $this->newDeal['image']->store('images', 'public');
            
            Deal::create([
                'name' => $this->newDeal['name'],
                'description' => $this->newDeal['description'],
                
                'price' => $this->newDeal['price'],
                'is_hidden' => isset($this->newDeal['is_hidden']) ? $this->newDeal['is_hidden'] : false,
            ]);
           
        }
       

        session()->flash('message', 'Deal successfully saved.');

        $this->confirmingDealAdd = false;

      
    }



    
}
