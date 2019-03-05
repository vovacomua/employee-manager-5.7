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
     * Return either hierarchy tree of employees with 2 levels depth
     * or the rest of levels starting from 3-rd one for the given branch/boss
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|JSON
     */
    public function tree(Request $request)
    {
        if ($request->id > 0){
            return $this->lazyLoadSecondLevel($request->id);
        } else {
            return $this->lazyLoadFirstLevel();
        }
    }


    /**
     * Return hierarchy tree of employees with 2 levels depth
     *
     * @return string|JSON
     */
    private function lazyLoadFirstLevel()
    {
        $tree = Employee::limitDepth(2)->get()->toHierarchy();
        $tree = $tree->values();

        foreach ($tree->chunk(50) as $chunk) {
            foreach ($chunk as $id => $value) {

                foreach ($value->children->chunk(50) as $chunk2) {
                    foreach ($chunk2 as $id2 => $value2) { 

                        if (count($value2->children) > 0){  
                                unset($value2->children);
                                $value2->children = true;
                            } else {
                                unset($value2->children);
                            }      
                    }
                }

            }
        }

        return $tree;
    }

    /**
     * For the given branch/boss return the rest of levels starting from 3-rd one 
     *
     * @param  int  $id
     * @return string|JSON
     */
    private function lazyLoadSecondLevel($id)
    {
        $boss = Employee::find($id);
        $tree = $boss->getDescendants()->toHierarchy();
        $tree = $tree->values();

        return $tree;
    }

}
