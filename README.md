
# Simple CRUD Builder
This form builders offer an intuitive, user-friendly interface where users can easily add form elements (such as text fields, checkboxes, radio buttons, dropdown etc.) to create custom forms without the need much coding skills.




### Here is example to use form builder

In Controller
```javascript
namespace App\Http\Controllers;

use App\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Http\Request;
use Suresh\SimpleCrudBuilder\FormBuilder\FormBuilder;

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
use Suresh\SimpleCrudBuilder\FormBuilder\Form;

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
  composer require suresh/simple-crud-builder
```
## Requirements

- [PHP >= 7.0](http://www.php.net)
- [Laravel >= 7.0](https://laravel.com)

## Badges
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)


## Authors

- [@Suresh M A](https://github.com/masuresh124)



## Features

- Relation form saving
- Sub Form saving
- Validations
- Event handlers
 

