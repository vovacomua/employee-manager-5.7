@extends('layouts.master')

@section('content')

<div class="container">

	<table class="table table-striped">

		@include('list.thead')

  	<tbody>

  	@if (count($employees) > 0)

  	    @foreach($employees as $employee)

		    <tr>
		    	<td> {{ $employee->id }} </td>
		        <td> {{ $employee->parent_id }} </td>
		        <td> {{ $employee->full_name }} </td>
		        <td> {{ $employee->position }} </td>
		        <td> {{ $employee->start_date }} </td>
		        <td> {{ $employee->salary }} </td>

		    </tr>

    	@endforeach
    
	@else

	   <tr>
            <td align="center" colspan="6">No Data Found</td>
       </tr>
	    
	@endif

	</tbody>
	</table>

</div>

@endsection
