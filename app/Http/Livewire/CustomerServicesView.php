<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CustomerServicesView extends Component
{
    use WithPagination;

    public $search;
    public $categories;
    public $categoryFilter = [];
    public $sortByPrice = 'PriceLowToHigh';

    private $services;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => []],
    ];

    public function mount()
    {
        $this->categories = \App\Models\Category::all();

        // Initialize categoryFilter with all category IDs
        $this->categoryFilter = $this->categories->pluck('id')->toArray();
    }

    public function render()
    {
        $query = Service::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if (!in_array(0, $this->categoryFilter)) {
            // Exclude 0 (which represents "All" category) from the filter
            $query->whereIn('category_id', $this->categoryFilter);
        }

        $this->services = $query->orderBy($this->sortByPrice)->paginate(10);

        return view('livewire.customer-services-view', [
            'services' => $this->services,
            'categories' => $this->categories,
        ]);
    }

    public function updatedCategoryFilter()
    {
        $this->render(); // Re-render the component
    }

}
