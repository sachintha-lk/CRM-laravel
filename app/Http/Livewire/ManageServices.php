<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManageServices extends Component

{

    use withPagination;
    use withFileUploads;

    public $confirmingServiceDeletion = false;
    public $confirmingServiceAdd = false;
    public $confirmingServiceEdit = false;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $newService, $name, $description, $price, $is_hidden, $image = false;

    protected function rules()
{
    $rules = [
        'newService.name' => 'required|string|min:1|max:255',
        'newService.description' => 'required|string|min:1|max:255',
        'newService.price' => 'required|numeric|min:0',
        'newService.is_hidden' => 'boolean',
    ];
    // check if image is an instance of UploadedFile
    if ($this->image instanceof \Illuminate\Http\UploadedFile) {

        $rules['image'] = 'required|image|mimes:jpg,jpeg,png,svg,gif|max:204800';
    } else {
        $rules['image'] = 'required|string|min:1|max:255';
    }
    return $rules;
}


    public function render()
    {

        $services = Service::when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderByPrice('PriceLowToHigh')
            ->paginate(10);

        return view('livewire.manage-services', compact('services'));
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
        $this->reset(['image']);
        $this->confirmingServiceAdd = true;


    }

    public function confirmServiceEdit( Service $newService ) {
        $this->newService = $newService;

        $this->image = $newService->image;

        $this->confirmingServiceAdd = true;
    }



    public function saveService() {

    // validate all the rules except the image field
    $this->validateOnly('newService.name');
    $this->validateOnly('newService.description');
    $this->validateOnly('newService.price');
    $this->validateOnly('newService.is_hidden');

        if ($this->newService['id']) {

            // If a new image is uploaded then delete the old one
            if ($this->image instanceof \Illuminate\Http\UploadedFile) {

                $this->validateOnly('image');
                // get original image of the old one and delete it from the disk
                $originalImage = Service::find($this->newService['id'])->image;
                $originalImage = str_replace('storage', 'public', $originalImage);
                Storage::delete($originalImage);

                // save the image and get the path

                $this->image = $this->image->store('images', 'public');

            }

            // save the service

            $this->newService['image'] = $this->image;

            $this->newService->save();


        } else {
            $service = Service::create($this->newService);
        }




        session()->flash('message', 'Service successfully saved.');

        $this->confirmingServiceAdd = false;


    }

//    private function handleImageUpload() {
//
//    }
//



}
