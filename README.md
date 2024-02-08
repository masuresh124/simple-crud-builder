
# Simple CRUD Builder
This form builders offer an intuitive, user-friendly interface where users can easily add form elements (such as text fields, checkboxes, radio buttons, dropdown etc.) to create custom forms without the need much coding skills.




### Here is example to use form builder

In Controller
```javascript
namespace App\Http\Controllers;

use App\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Http\Request;
use Masuresh124\SimpleCrudBuilder\FormBuilder\FormBuilder;

class ProductController extends Controller
{
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new Product();
       return FormBuilder::createFormSimpleBuilder($entity, ProductForm::class, 'product');
    }
....
     

}

```
In Product form
```javascript
use Masuresh124\SimpleCrudBuilder\FormBuilder\Form;

class ProductForm extends Form
{

    public function createForm($entity)
    {
        $this->add(self::TEXT, 'name', ['required' => true, 'placeHolder' => 'Enter your product name', 'label' => 'Product Name']);
        $this->add(self::TEXTAREA, 'description', ['required' => true, 'placeHolder' => 'Enter your product description', 'label' => 'Product Description']);
..... 
        return $this;
    }
}
```

In product.blade.php
```javascript
  <x-simple-crud-builder::form  method="{{ $entity->method }}" action="{{ $entity->action }}">
                <div class="mb-3">
                    {{ $form->text('name') }}
                </div>
                <div class="mb-3">
                    {{ $form->textArea('description') }}
                </div>

```

 

## Installation

Install simple crud builder with composer

```bash
  composer require masuresh124/simple-crud-builder
```

Add the following code in config\app.php

```bash
        /**
         * Package Service Providers...
         */
        Masuresh124\SimpleCrudBuilder\Providers\SimpleCrudProvider::class,
```


## Step 1 - Create Form

Create a form in app\Forms\ProductForm.php

```javascript
namespace App\Forms;
use Masuresh124\SimpleCrudBuilder\FormBuilder\Form;

class ProductForm extends Form
{
    public function createForm($entity)
    {
        $this->add(self::TEXT, 'name', ['required' => true, 'placeHolder' => 'Enter your product name', 'label' => 'Product Name']);
        $this->add(self::TEXTAREA, 'description', ['required' => true, 'placeHolder' => 'Enter your product description', 'label' => 'Product Description']);
        $this->add(self::RADIO, 'is_active', ['required' => true, 'choices' => ['Active' => 1, 'In Active' => 0]]);
        $this->add(self::CHECKBOX, 'is_new_arrival', ['required' => true, 'label' => 'Is New Arrival']);
        $this->add(self::CHECKBOX, 'is_best_seller', ['required' => true, 'label' => 'Is Best Seller']);
        $this->add(self::CHECKBOX, 'is_taxable', ['required' => true, 'label' => 'Is Taxable']);
        $this->add(self::DROPDOWN, 'brand', ['required' => true, 'label' => 'Select Your Brand', 'placeHolder' => 'Select Brand', 'choices' => ['Brand A' => 1, 'Brand B' => 2, 'Brand C' => 3]]);
        $this->add(self::FILE, 'file_path', ['path' => 'myFolder', 'required' => true, 'label' => 'Upload your File']);
        return $this;
    }
}


```
- In the above code, The 'name', 'description', 'is_active' should same name as data base table column names

 
- Product Table


| name  | description  |is_active  |is_new_arrival|
| ----- | -------- |-------- |-------- |

 
## Step 2 - Create Controller

Create a controller in app\Http\Controllers\ProductController.php

```javascript
<?php

namespace App\Http\Controllers;

use App\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Http\Request;
use Masuresh124\SimpleCrudBuilder\FormBuilder\FormBuilder;

class ProductController extends Controller
{

    public function index()
    {
        $data = Product::all();
        return view('product-list', compact('data'));
    }

    public function create()
    {
        $entity = new Product();
        return $this->process($entity);
    }

    public function store(Request $request)
    {
        $entity = new Product();
        return $this->process($entity);
    }

    public function edit(Product $product)
    {
        return $this->process($product);
    }
    public function update(Request $request, Product $product)
    {
        return $this->process($product);
    }

     /**
     *  This common function handles all the actions 
     *
     * @param  Product Model $entity
     * @return \Illuminate\Http\Response
     */
    public function process(Product $entity)
    {     /**
         * @param  Product Model $entity
         * @param  ProductForm::class 
         * @param  Form blade name  'product'
         */
        return FormBuilder::createFormSimpleBuilder($entity, ProductForm::class, 'product');
    }
}

```
## Step 3 - Create Form Blade

Create a blade in \resources\views\product.blade.php

```javascript
 <x-simple-crud-builder::form name="reseller-form" method="{{ $entity->method }}" action="{{ $entity->action }}" file="true">
                <div class="mb-3">
                    {{ $form->text('name') }}
                </div>
                <div class="mb-3">
                    {{ $form->textArea('description') }}
                </div>
                <div class="mb-3">
                    {{ $form->radio('is_active') }}
                </div>
                <div class="mb-3">
                    {{ $form->checkBox('is_new_arrival') }}
                </div>
                <div class="mb-3">
                    {{ $form->checkBox('is_best_seller') }}
                </div>
                <div class="mb-3">
                    {{ $form->checkBox('is_taxable') }}
                </div>
                <div class="mb-3">
                    {{ $form->dropDown('brand') }}
                </div>
                <div class="mb-3">
                    {{ $form->file('file_path') }}
                </div>
                <div class="m
                <div class="bottom-btn text-right mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </x-simple-crud-builder::form>
```
## Step 4 - Create list Blade

Create a blade to list products in \resources\views\product-list.blade.php

```javascript
      <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $row)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $row->name }}</td>
                            <td><a href="{{ route('products.edit', ['product' => $row->id]) }}">Edit</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="bottom-btn text-right mt-4">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>
            </div>
```
## Step 5 - Create Route

Create a route in routes\web.php

```javascript
Route::resource('products', ProductController::class);
```

Run the following command to access the uploaded file from the local

```bash
        php artisan storage:link
```

## Badges
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)


## Authors

- [@Suresh M A](https://github.com/masuresh124)



## Features

- Relation form saving
- Sub Form saving
- Validations
- Event handlers
 

