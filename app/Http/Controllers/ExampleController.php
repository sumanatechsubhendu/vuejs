<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ExampleController extends Controller
{
    public function index()
    {
        return Inertia::render('Example', [
            'greeting' => 'Hello, World! I am calling from example inner page',
        ]);
    }
}
