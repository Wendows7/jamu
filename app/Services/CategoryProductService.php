<?php

namespace App\Services;

use App\Models\ProductCategory;

class CategoryProductService
{
    protected $category;

    public function __construct(ProductCategory $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function addCategory($request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);

        $this->category->create($validatedData);

    }

    public function editCategory($request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);

        $this->category->where('id', request('id'))->update($validatedData);
    }

    public function deleteCategoryById($id)
    {
        $this->category->where('id', $id)->delete();
    }
}
