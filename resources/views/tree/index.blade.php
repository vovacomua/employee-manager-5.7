@extends('layouts.master')

@section('scripts')

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

  @include('tree.scripts')

@endsection

@section('content')

<div class="container">

	<div class="card mt-2">
	  <div class="card-header">
	    Employees tree
	  </div>
	  <div class="card-body">

	  	  <div id="container"></div> 

	  </div>
	</div>

</div>

@endsection
