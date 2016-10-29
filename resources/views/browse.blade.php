@extends('app')

@section('title', 'Sanction Search')


@section('content')
<div class="row">
<div class="large-12 columns">
<h1>Sanction Search - Browse Entities</h1>
<hr/>
</div>
</div>
 
 
<div class="row">
 
<div class="large-9 columns" role="content">
<article>

	<ul>
 	@foreach ($results as $result)
        <li><p><a href="{{ route('search.detail', ['url'=>$result->url])}}">{{ $result->lastName }}, {{ $result->firstName }} <br>SDN: {{ $result->uid }}</a></p></li>
    @endforeach
	</ul>
	{{ $results->links() }}

</article>
</div>
@endsection

@section('sidebar')
    @parent

    <aside class="large-3 columns">
	Ad placeholder
	</aside>
@endsection
