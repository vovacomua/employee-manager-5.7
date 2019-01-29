@extends('layouts.master')

@section('scripts')

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

  @include('tree.scripts')

@endsection

@section('content')

  <div id="container"></div>        

@endsection
