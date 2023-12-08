<?php
namespace Suresh\SimpleCrudBuilder\Controllers;

use Suresh\SimpleCrudBuilder\SimpleCrud;

class SimpleCrudController
{
    public function __invoke(SimpleCrud $simpleCrud)
    {
        $quote = $simpleCrud->justDoIt();

        return view('simple-crud-builder::index', compact('quote'));
    }
}
