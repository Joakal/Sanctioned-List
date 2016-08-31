@extends('app')

@section('title', 'Sanction Search Results')


@section('content')
<div class="row">
<div class="large-12 columns">
<h1>Sanction Search - Database Query</h1>
<hr/>
</div>
</div>
 
 
<div class="row">
 
<div class="large-9 columns" role="content">
<article>
@include('query')
<?php die(var_dump($results)); ?>
	Searched for {{$query}}
	@forelse ($results as $result)
		<li>{{ $result }}</li>
	@empty
		<p>No results</p>
	@endforelse

</article>
</div>
@endsection

@section('sidebar')
    @parent

    <aside class="large-3 columns">
	Ad placeholder
	</aside>
@endsection
