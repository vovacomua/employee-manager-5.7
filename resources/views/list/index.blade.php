@extends('layouts.master')

@section('scripts')

  @include('list.scripts')

@endsection

@section('content')

 @include ('layouts.errors')

<div class="container">

	@if (\Session::has('success'))
      <div class="alert alert-success mt-3">
          <p>{{ \Session::get('success') }}</p>
      </div>
      <br />
 	@endif

 	<a href="{{action('EmployeeController@create')}}" class="btn btn-primary mt-3 mb-3"> 
 	+ Create New Employee 
 	</a>


	<table class="table table-striped">

		@include('list.thead')

  	<tbody>

  	@if (count($employees) > 0)

  	    @foreach($employees as $employee)

			    <tr>

			    <td> 
			    	<img src="{{ $employee->has_photo == '1' ? asset('storage/photos/'.$employee->id.'.jpg') : asset('storage/photos/no-photo.jpg') }}" 
			    		style="max-height:40px; max-width:40px">
			    </td>

		    	<td> {{ $employee->id }} </td>
		        <td> {{ $employee->parent_id }} </td>
		        <td> {{ $employee->full_name }} </td>
		        <td> {{ $employee->position }} </td>
		        <td> {{ $employee->start_date }} </td>
		        <td> {{ $employee->salary }} </td>

		    <td>
	        	<a href="{{ action('EmployeeController@edit', $employee->id) }}" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
	        </td>

	        <td>
		        <form action="{{ action('EmployeeController@destroy', $employee->id) }}" method="post">
		          {{ csrf_field() }}
		          {{ method_field('DELETE') }}
		          <button class="btn btn-danger" type="submit"> <i class="fas fa-trash-alt"></i> </button>
		        </form>
	        </td>

		    </tr>

    	@endforeach
    
	@else

	   <tr>
            <td align="center" colspan="9">No Data Found</td>
       </tr>
	    
	@endif

	</tbody>
	</table>

</div>

@endsection
