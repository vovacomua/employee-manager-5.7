<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class ListController extends Controller
{
     
     /**
     * Display a page with a list of all employees
     *
     * @return View
     */

    public function index(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'field' => 'nullable|in:id,parent_id,full_name,position,start_date,salary',
            'order' => 'nullable|in:asc,desc'
        ]);

        //set default values
        $field = $request->input('field', 'id');
        $order = $request->input('order', 'asc');

        $employees = Employee::orderBy($field, $order)->get();

        return view('list.index', compact('employees'));
    }

}
