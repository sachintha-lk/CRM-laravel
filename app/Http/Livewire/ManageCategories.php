<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class ManageCategories extends Component
{

    private $categories;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $category;

    public $confirmingCategoryAdd;

    public $confirmCategoryDeletion  = false;
    public $confirmingCategoryDeletion = false;

    protected $rules = [
        "category.name" => "required|string|max:255",
    ];
    public function render()
    {
        $this->categories = Category::when($this->search, function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })->paginate(10);

        return view('livewire.manage-categories', [
            'categories' => $this->categories,
        ]);
    }

    public function confirmCategoryEdit(Category $category) {
        $this->category = $category;
        $this->confirmingCategoryAdd= true;
    }
    public function confirmCategoryDeletion() {
        $this->confirmingCategoryDeletion = true;
    }

    public function saveCategory() {
        $this->validate();

        if (isset($this->category->id)) {
            $this->category->save();
            } else {
            Category::create(
                [
                    'name' => $this->category['name'],
                ]
            );
        }

        $this->confirmingCategoryAdd = false;
        $this->category = null;
    }

    public function deleteCategory(Category $categoryId) {
        $this->category = $categoryId;
        $this->category->delete();
        $this->confirmingCategoryDeletion = false;
    }

    public function confirmCategoryAdd() {
        $this->confirmingCategoryAdd = true;
    }

}
