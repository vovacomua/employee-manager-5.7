@php
	$cols = ['id', 'parent_id', 'full_name', 'position', 'start_date', 'salary'];
@endphp

<thead>
    <tr>

    @foreach($cols as $col)

	    <th scope="col">
	      	<div class="text-nowrap">

	      		{{ strtoupper(str_replace('_', ' ', $col)) }}

	      		<a href="{{url()->current() . '?field=' . $col. '&order=asc'}}" class="order">
	      			<i class="fas fa-arrow-circle-up"></i>
	      		</a>

	      		<a href="{{url()->current() . '?field=' . $col. '&order=desc'}}" class="order">
	      			<i class="fas fa-arrow-circle-down"></i>
	      		</a>

	      	</div>
	  </th>

    @endforeach

	</tr>
</thead>