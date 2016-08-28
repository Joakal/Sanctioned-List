@extends('app')

@section('title', 'Sanction Search')


@section('content')
<div class="row">
<div class="large-12 columns">
<h1>Sanction Search</h1>
<hr/>
</div>
</div>
 
 
<div class="row">
 
<div class="large-9 columns" role="content">
<article>
@include('query')

<div class="row">
<div class="large-12 columns">
<h4>Search OFAC database with ease.</h4>
<p>The website makes searching easy for anyone. Complex algorithims are performed based on a single query against the OFAC database that give you results most closely matching your query.</p>
<hr>
<h4>Office of Foreign Assets Control (OFAC)</h4>
<p>The Office of Foreign Assets Control (OFAC) of the US Department of the Treasury administers and enforces economic and trade sanctions based on US foreign policy and national security goals against targeted foreign countries and regimes, terrorists, international narcotics traffickers, those engaged in activities related to the proliferation of weapons of mass destruction, and other threats to the national security, foreign policy or economy of the United States. OFAC maintains a listing of these restricted counter parties in a document called the "Specially Designated Nationals List" (SDN) that is retrieved and loaded onto this website at least daily.</p>
</div>
</div>

</article>
</div>
@endsection

@section('sidebar')
    @parent

    <aside class="large-3 columns">
	Ad placeholder
	</aside>
@endsection
