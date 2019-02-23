<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Http\Requests\SearchRequest;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        $this->middleware('auth');
    }

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
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate(request(), [
            'parent_id' => 'nullable|numeric|digits_between:1,5|exists:employees,id',
            'full_name' => 'required|max:255',
            'position'  => 'required|max:255',
            'start_date'=> 'required|date',
            'salary'    => 'required|regex:/^\d{1,5}(\.\d{2})?$/'
        ]);

        $employee = Employee::create([
                    'full_name' => $request->input('full_name'), 
                    'position' => $request->input('position'), 
                    'start_date' => $request->input('start_date'), 
                    'salary' => $request->input('salary')
                    ]); 
        
        if ($request->filled('parent_id')){
            $boss = Employee::find($request->input('parent_id'));
            $employee->makeChildOf($boss);
        }

        return redirect('/home/employees')->with('success','New Employee has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        
        return view('list.edit', compact('employee','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->validate(request(), [
            'parent_id' => 'nullable|numeric|digits_between:1,5|exists:employees,id',
            'full_name' => 'required|max:255',
            'position'  => 'required|max:255',
            'start_date'=> 'required|date',
            'salary'    => 'required|regex:/^\d{1,5}(\.\d{2})?$/'
        ]);

        $employee = Employee::findOrFail($id);

        $employee->full_name = $request->input('full_name');
        $employee->position = $request->input('position');
        $employee->start_date = $request->input('start_date');
        $employee->salary = $request->input('salary');
        
        $employee->save();

        //change boss

        //current parent_id
        $employee_parent_id = (isset($employee->parent_id) ? $employee->parent_id : null);

        //new parent_id
        $boss_id = ($request->filled('parent_id') ? intval($request->input('parent_id')) : null);

        //check if changing boss is both needed and possible
        if (($boss_id != $employee_parent_id) && ($boss_id != $employee->id)){ 

            if ($boss_id == null){
                $employee->makeRoot();
                
            } else {
                $boss = Employee::find($boss_id);           
                if ($boss->isDescendantOf($employee)){
                    return back()->with('error', 'You tried to set descendant as boss.'); 

                } else {
                    $employee->makeChildOf($boss);
                }
            }
        }

        return redirect('/home/employees')->with('success', 'Employee info has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('/home/employees')->with('success','Employee has been deleted.');
    }

     /**
     * Display a page with a list of all employees ordered by some field
     *
     * @param Request
     * @return string|json
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

        echo $this->renderOutput($employees);
    }

    /**
     * Display a page with search results
     *
     * @param App\Http\Requests\SearchRequest
     * @return string|json
     */

    public function search(SearchRequest $request)

    {
        $input = $request->all(); 
        
        $search_field = $request->input('search_field');
        $search_value = $request->input('search_value');
        $employees = Employee::where($search_field, '=', $search_value)->get(); 

        echo $this->renderOutput($employees);
    }

    /**
     * Render collection to table raws
     *
     * @param Baum\Extensions\Eloquent\Collection
     * @return string|json
     */

    private function renderOutput($collection)

    {

        $output = '';

        if ($collection->isNotEmpty()){

            foreach ($collection->chunk(50) as $chunk) {
                foreach ($chunk as $row) {
                    $url_edit = action('EmployeeController@edit', $row->id);
                    $url_destroy = action('EmployeeController@destroy', $row->id);
                    $token = csrf_field();
                    $method = method_field('DELETE');

                   $output .= '
                    <tr>
                     <td>'.$row->id.'</td>
                     <td>'.$row->parent_id.'</td>
                     <td>'.$row->full_name.'</td>
                     <td>'.$row->position.'</td>
                     <td>'.$row->start_date.'</td>
                     <td>'.$row->salary.'</td>

                     <td>
                        <a href="'.$url_edit.'" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
                     </td>

                     <td>
                        <form action="'.$url_destroy.'" method="post">
                          '.$token.'
                          '.$method.'
                          <button class="btn btn-danger" type="submit"> <i class="far fa-trash-alt"></i> </button>
                        </form>
                     </td>

                    </tr>
                    ';
                   }                  
                }

        } else {
            $output = '
               <tr>
                <td align="center" colspan="6">No Data Found</td>
               </tr>
               ';
        } 
        return json_encode($output);
    }
}
