<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ManageServices extends Component

{
    
    use withPagination;
    use withFileUploads;

    public $confirmingServiceDeletion = false; 
    public $confirmingServiceAdd = false;
    public $confirmingServiceEdit = false;

    
    public $newService, $name, $description, $image, $price, $is_hidden = false;



    protected $rules = [
        'newService.name' => 'required|string|min:1|max:255',
        'newService.description' => 'required|string|min:1|max:255',
        'newService.image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',

        // 'newService.image' => ['nullable', function ($attribute, $value, $fail) {
        //     $isNewImageUploaded = request()->hasFile($attribute);
        //     $isExistingImageFilename = is_string($value);
    
        //     if (!$isNewImageUploaded && !$isExistingImageFilename) {
        //         $fail('The '.$attribute.' field must be either an image file or an image filename.');
        //     }
    
        //     if ($isNewImageUploaded) {
        //         $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        //         $extension = strtolower($value->getClientOriginalExtension());
    
        //         if (!in_array($extension, $allowedExtensions)) {
        //             $fail('The '.$attribute.' field must be a valid image file (jpg, jpeg, png, gif, svg).');
        //         }
        //     }
        // }],
        'newService.price' => 'required|numeric|min:0',
        'newService.is_hidden' => 'boolean',
    ];
    
  

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

        // dd($this->newService);
        // $this->newService['image'] = $newService->image;



        $this->confirmingServiceAdd = true;
    }
    


    public function saveService() {
        
        $this->validate();
        dd($this->newService);

        // // if image is string, it means it is not changed
        // if (is_string($this->newService['image'])) {
        //     $this->newService['image'] = $this->newService['image'];
            
        // } else {
        //     $this->newService['image']->store('images', 'public');
        //     $this->newService['image'] = $this->newService['image']->hashName();

        //     // delete old image permanently
        //     if (Storage::disk('public')->exists('images/' . $this->newService->getOriginal('image'))) {
        //         Storage::disk('public')->delete('images/' . $this->newService->getOriginal('image'));
        //     }
        // }
        

        // if ($this->newService->id) {
        //     $this->newService->save();
        // } else {
        //     Service::create([
        //         'name' => $this->newService['name'],
        //         'description' => $this->newService['description'],
        //         'image' => $this->newService['image'],
        //         'price' => $this->newService['price'],
        //         'is_hidden' => $this->newService['is_hidden'],
        //     ]);
           
        // }
       

        // session()->flash('message', 'Service successfully saved.');

        // $this->confirmingServiceAdd = false;

      
    }

    private function handleImageUpload() {

    }



    
}
