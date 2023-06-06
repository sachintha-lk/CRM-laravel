<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class ManageServices extends Component

{
    
    use withPagination;
    use withFileUploads;

    public $confirmingServiceDeletion = false; 
    public $confirmingServiceAdd = false;
    public $confirmingServiceEdit = false;

    
    public $newService, $name, $description, $price, $is_hidden, $image = false;



    // protected $rules = [
    //     'newService.name' => 'required|string|min:1|max:255',
    //     'newService.description' => 'required|string|min:1|max:255',
    //     'newService.price' => 'required|numeric|min:0',
    //     'newService.is_hidden' => 'boolean',
    // ];

    // img validation is done at saveService() method

    protected function rules()
{
    $rules = [
        'newService.name' => 'required|string|min:1|max:255',
        'newService.description' => 'required|string|min:1|max:255',
        'newService.price' => 'required|numeric|min:0',
        'newService.is_hidden' => 'boolean',
    ];

    if (isset($this->newService['image'])) {
    // Conditionally add the image validation rule
    if (is_string($this->newService['image'])) {

        $rules['newService.image'] = 'required|string|min:1|max:255';
    } else {
        // dd($this->newService['image']);

        // TODO: Fix image upload when updating
        $rules['newService.image'] = 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'; // max 2MB
    }
    } else {
        $rules['newService.image'] = 'required|string|min:1|max:255';
    }

    return $rules;
}
  

    public function render()
    {
        $services = Service::paginate(10);

        return view('livewire.manage-services', [
            'services' => $services,
        ]);
    }

    public function confirmServiceDeletion($id)
    {
        $this->confirmingServiceDeletion = $id;


    }

    public function deleteService(Service $service)
    {
        $service->delete();

        session()->flash('message', 'Service successfully deleted.');
        $this->confirmingServiceDeletion = false;
        
    }


    public function confirmServiceAdd() {

        $this->reset(['newService']);
        $this->confirmingServiceAdd = true;

  
    }

    public function confirmServiceEdit( Service $newService ) {
        $this->newService = $newService;

    //    dd($newService->image);

        // dd($this->newService);
        $this->newService['image'] = $newService->image;
        // dd($newService['image']);



        $this->confirmingServiceAdd = true;
    }
    


    public function saveService() {
        
        // dd($this->newService['image']);
        // dd($this->newService['image'] instanceof \Illuminate\Http\UploadedFile);
        // dd($newService['image']);

        // if (is_string($this->newService['image'])) {
        //     $rules['newService.image'] = 'required|string|min:1|max:255';
        // } else {
        //     $rules['newService.image'] = 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048';
        // }
        // dd($this->newService);
        $this->validate();
      

        // if id is set, it means we are editing existing service
        if (isset($this->newService['id'])) {
                
            // if image is string, it means it is not changed
            if (is_string($this->newService['image'])) {
                $this->newService['image'] = $this->newService['image'];
                
            } else {
                dd($originalImage = $this->newService['image']->getClientOriginalName());
                
                $this->newService['image']->store('images', 'public');
                $this->newService['image'] = $this->newService['image']->hashName();

                // remove old image
                
                

                
            }
            
            $this->newService->save();
        } else {

            $this->newService['image']->store('images', 'public');
            
            Service::create([
                'name' => $this->newService['name'],
                'description' => $this->newService['description'],
                'image' => $this->newService['image']->hashName(),
                'price' => $this->newService['price'],
                'is_hidden' => isset($this->newService['is_hidden']) ? $this->newService['is_hidden'] : false,
            ]);
           
        }
       

        session()->flash('message', 'Service successfully saved.');

        $this->confirmingServiceAdd = false;

      
    }

    private function handleImageUpload() {

    }



    
}
