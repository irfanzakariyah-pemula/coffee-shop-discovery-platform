<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\View\View;

class MapPageController extends Controller
{
    /**
     * Display the map page.
     */
    public function index(): View
    {
        $categories = Category::all();
        $facilities = Facility::all();

        return view('map.index', compact('categories', 'facilities'));
    }
}
