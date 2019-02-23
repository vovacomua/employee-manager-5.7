@php
	//Array of columns with corresponding field names

	$cols = [
		['name' => 'id', 		'type' => 'text', 'placeholder' => '1', 		'pattern' => '^\d{1,10}$'],
		['name' => 'parent_id', 'type' => 'text', 'placeholder' => '1', 		'pattern' => '^\d{1,10}$'],
		['name' => 'full_name', 'type' => 'text', 'placeholder' => 'John Doe',	'pattern' => '^.{1,255}$'],
		['name' => 'position', 	'type' => 'text', 'placeholder' => 'Programmer','pattern' => '^.{1,255}$'],
		['name' => 'start_date','type' => 'date', 'placeholder' => '', 			'pattern' => ''],
		['name' => 'salary', 	'type' => 'text', 'placeholder' => '99999.00',	'pattern' => '^\d{1,5}(\.\d{2})?$'],
		['name' => 'EMPTY'],
		['name' => 'EMPTY'],
	];
@endphp

<thead>
    <tr>

    @foreach($cols as $col)

	    <th scope="col">

	    	@if( $col['name'] != 'EMPTY')
		    	<div class="text-nowrap">

		      		{{ strtoupper(str_replace('_', ' ', $col['name'])) }}

		      		<a href="#" class="order" data-values="field={{ $col['name'] }}&order=asc">
		      			<i class="fas fa-arrow-circle-up"></i>
		      		</a>

		      		<a href="#" class="order" data-values="field={{ $col['name'] }}&order=desc">
		      			<i class="fas fa-arrow-circle-down"></i>
		      		</a>

		      	</div>

		      	<form class="search">
		      		<input type="hidden" name="search_field" value="{{ $col['name'] }}">
					<div class="input-group mt-2">

					  <input type="{{ $col['type'] }}" 
							  id="search_value" name="search_value" class="form-control" 
							  placeholder="{{ $col['placeholder'] }}" 
							  pattern="{{ $col['pattern'] }}" required>

					  <div class="input-group-append">
					    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
					  </div>
					</div>
		      	</form>
	    	@endif

	  </th>

    @endforeach

	</tr>
</thead>