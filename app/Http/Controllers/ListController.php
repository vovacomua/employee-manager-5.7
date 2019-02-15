<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Http\Requests\SearchRequest;

class ListController extends Controller
{
     
     /**
     * Display a page with a list of all employees
     *
     * @return View
     */

    public function index()
    {
        $employees = Employee::orderBy('id', 'asc')->get();

        return view('list.index', compact('employees'));
    }

     /**
     * Display a page with a list of all employees ordered by some field
     *
     * @param Request
     * @return View
     */

    public function order(Request $request)

    {
        $input = $request->all();

        $this->validate(request(), [
            'field' => 'required|in:id,parent_id,full_name,position,start_date,salary',
            'order' => 'in:asc,desc'
        ]);

        $field = $request->input('field');
        $order = $request->input('order');
        
        $employees = Employee::orderBy($field, $order)->get(); 

        return view('list.index', compact('employees'));
    }

    /**
     * Display a page with search results
     *
     * @param App\Http\Requests\SearchRequest
     * @return View
     */

    public function search(SearchRequest $request)

    {
        $input = $request->all(); 
        
        $search_field = $request->input('search_field');
        $search_value = $request->input('search_value');
        $employees = Employee::where($search_field, '=', $search_value)->get(); 

        return view('list.index', compact('employees'));
    }
}
