<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductManagement extends Component
{
    use WithFileUploads;

    public $products, $product_id, $name, $sku, $price, $description, $image, $brand;
    protected $listeners = ['refreshComponent'];

    public $showModal = false;

    public function GetProducta()
    {
        $this->products = Product::all();
    }
    public function closeModal()
    {
        $this->showModal = false;
    }


    public function addProduct()
    {
        //    $this->product_id = $this->name = $this->sku = $this->price = $this->description = $this->brand = '';
        $this->reset(['product_id', 'name', 'sku', 'price', 'description', 'brand', 'image']);
        $this->showModal = true;
    }
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->brand = $product->brand;

        $this->showModal = true;
    }

    public function updateProduct()
    {

        $validate = $this->validate([
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand' => 'required',
            'image' => 'nullable|max:1024', // Validate image if present
        ]);

        $product = Product::find($this->product_id);
        $fileName = $this->image;
        if ($this->product_id) {
            if ($this->image) {
                if ($this->image && file_exists(public_path('storage/' . $product->image))) {
                    Storage::disk('public')->delete($product->image);
                }
                $imageName = $this->image->store('Products', 'public');
            } else {
                $imageName = $product->image;
            }
        } else {
            if ($this->image) {
                $imageName = $this->image->store('Products', 'public');
            } else {
                $imageName = "Products/default.jpg";
            }
        }
        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand,
            'image' => $imageName,
        ]);
        if ($this->product_id) {
            session()->flash('message', 'Product updated successfully.');
        } else {
            session()->flash('message', 'Product added successfully.');
        }

        $this->products = Product::all();

        $this->showModal = false;
    }

    public function RemoveProduct($id){
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
    }

    public function render()
    {
        $this->GetProducta();
        return view('livewire.product-management');
    }
}
