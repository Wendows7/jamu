<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductService
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {
        return $this->product::latest()->with('stockProduct', 'category');
    }

    public function getProducts()
    {
        return $this->product->latest()->get();
    }

    public function shortBy($shortBy)
    {
        return $this->product::orderBy($shortBy, 'asc')->paginate(8);
    }

    public function getTotalProduct()
    {
        return $this->product->count();
    }

    public function findById($productId)
    {
        return $this->product::where('id', $productId)->with('stockProduct')->first();
    }

    public function storeProduct($request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $this->product->create($validateData);

    }

    public function searchProduct($slug)
    {
        return $this->product::where('name', 'like', '%' . $slug . '%')
            ->orWhere('description', 'like', '%' . $slug . '%')
            ->orWhereHas('category', function ($query) use ($slug) {
                $query->where('name', 'like', '%' . $slug . '%');
            })->paginate(8);
    }

    public function getTotalProductByCategory()
    {
        $category = ProductCategory::all();
        $data = [];
        foreach ($category as $item) {
            $query = $this->product->where("category_id", $item->id)->get();
            $data[] = ['name' => $item->name, 'total' => $query->count()];
        }
        return $data;
    }

    public function updateStockById($id, $stock)
    {
        $this->product->where('id', $id)->update(['stock' => $stock]);
    }

    public function deleteById($id)
    {
        $product = $this->product->with('stockProduct')->find($id);
        if ($product) {
            // Delete related stock products first
            $product->stockProduct()->delete();
            // Then delete the product
            $product->delete();
        }

    }

    public function editProduct($request)
    {
        $product = $this->findById($request->id);

        if (!$product) {
            return false;
        }

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|file|max:2024',
            'image_2' => 'image|file|max:2024',
            'image_3' => 'image|file|max:2024',
            'category_id' => 'required|int'
            // Add other fields as needed, e.g. price, etc.
        ]);


        if($request->file('image_1')){
            $validateData['image'] = $this->resizeAndStoreImage($request->file('image_1'), $request->oldImage_1);
        }
        if($request->file('image_2')){
            $validateData['image_2'] = $this->resizeAndStoreImage($request->file('image_2'), $request->oldImage_2);
        }
        if($request->file('image_3')){
            $validateData['image_3'] = $this->resizeAndStoreImage($request->file('image_3'), $request->oldImage_3);
        }

        // Update product main data
        $product->update($validateData);

        // Update sizes & stocks
        if ($request->has('stock_ids')) {
            $stockIds = $request->input('stock_ids');
            $sizes = $request->input('sizes');
            $stocks = $request->input('stocks');
            $price = $request->input('price');

            foreach ($stockIds as $i => $stockId) {
                $stockProduct = $product->stockProduct()->find($stockId);
                if ($stockProduct) {
                    $stockProduct->update([
                        'size' => $sizes[$i],
                        'stock' => $stocks[$i],
                        'price' => $price[$i] // Assuming price is also part of the stock
                    ]);
                }
            }
        }


        return true;
    }

    public function createProduct($request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|array',
            'image_1' => 'image|file|max:2024',
            'image_2' => 'image|file|max:2024',
            'image_3' => 'image|file|max:2024',
            'category_id' => 'required|int',
            'sizes' => 'required|array',
            'stocks' => 'required|array',
        ]);

        // Handle images
        if ($request->file('image_1')) {
            $validateData['image'] = $this->resizeAndStoreImage($request->file('image_1'));
        }
        if ($request->file('image_2')) {
            $validateData['image_2'] = $this->resizeAndStoreImage($request->file('image_2'));
        } else {
            $validateData['image_2'] = 'assets/img/blank-image.jpg';
        }
        if ($request->file('image_3')) {
            $validateData['image_3'] = $this->resizeAndStoreImage($request->file('image_3'));
        } else {
            $validateData['image_3'] = 'assets/img/blank-image.jpg';
        }

        // Create product
        $product = $this->product->create($validateData);

        // Create sizes & stocks
        $sizes = $request->input('sizes');
        $stocks = $request->input('stocks');
        $price = $request->input('price');
        foreach ($sizes as $i => $size) {
            $product->stockProduct()->create([
                'size' => $size,
                'stock' => $stocks[$i] ?? 0,
                'price' => $price[$i] ?? 0,
            ]);
        }

        return $product;
    }

    protected function resizeAndStoreImage($file, $oldPath = null)
    {
        // Delete old image if exists
        if ($oldPath) {
            Storage::delete($oldPath);
        }

        $filename = time() . '_' . $file->getClientOriginalName();

        // Create image instance and resize
        $img = Image::read($file->getRealPath());
//        check if the size is 335x335, if not resize it
        if ($img->width() != 800 || $img->height() != 700) {
            $img->cover(800, 700);
        }

        // Save the resized image
        $path = 'product-images/' . $filename;
        Storage::disk('public')->put($path, $img->toPng());

        return $path;
    }

}
