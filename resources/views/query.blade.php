<div class="row">
<div class="large-12 columns">
{!! Form::open(array('route' => 'search.index', 'method' => 'get')) !!}
	<fieldset class="fieldset">
		<legend>Search the database</legend>
    {!! Form::text('search'); !!}
	<p>{!! Form::submit('Search'); !!} Tip: You can now search for part of the name.</p>
	</fieldset>
{!! Form::close() !!}
</div>
</div>
