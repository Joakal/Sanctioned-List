<div class="row">
<div class="large-12 columns">
{!! Form::open(array('route' => 'search.index', 'method' => 'get')) !!}
	<fieldset class="fieldset">
		<legend></legend>
	{!! Form::label('search', 'Search the database'); !!}
    {!! Form::text('search'); !!}
	Fuzzy {!! Form::checkbox('sensitive', '0.1'); !!}
	{!! Form::checkbox('sensitive', '0.2'); !!}
	{!! Form::checkbox('sensitive', '0.3'); !!}
	{!! Form::checkbox('sensitive', '0.4'); !!} Exact
	<p>{!! Form::submit('Search'); !!} Tip: You can now search for part of the name.</p>
	</fieldset>
{!! Form::close() !!}
</div>
</div>
