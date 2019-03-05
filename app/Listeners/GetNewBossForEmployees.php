<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Employee;
use App\Events\BossDeleting as BossDeletingEvent;

class GetNewBossForEmployees
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BossDeletingEvent $event)
    {
        $children = $event->employee->children()->get();

        if ($children){
            $employee_parent = Employee::find($event->employee->parent_id);

                foreach ($children->chunk(50) as $chunk) {
                    foreach ($chunk as $child) {

                        if ($employee_parent){
                            $child->makeChildOf($employee_parent);
                        } else {
                            $child->makeRoot();
                        }
                        
                    }
                }
            }
    }
}
