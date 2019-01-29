<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class TreeController extends Controller
{
     
     /**
     * Display a page with jstree component
     *
     * @return View
     */

    public function index()
    {
        return view('tree.index');
    }

     /**
     * Return hierarchy tree of employees
     *
     * @return string
     */
    public function tree()
    {
        $tree = Employee::get()->toHierarchy()->values();
        return $tree;
    }
}
