<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Service;


class CreateService extends Component
{
    use WithFileUploads;
    


    public $name, $description, $image, $price, $is_hidden = false;


    protected $rules = [
        'name' => 'required|string|min:1|max:255',
        'description' => 'required|string|min:1|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        'price' => 'required|numeric|min:0',
        'is_hidden' => 'boolean',
    ];

    public function submit() {

        $this->validate();
    
        // store image in a safe way
        // $this->image->store('public/images');
        $this->image->store('images', 'public');
       
        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image->hashName(),
            'price' => $this->price,
            'is_hidden' => $this->is_hidden,
        ]);

        session()->flash('message', 'Service successfully created.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.create-service');
    }


}
