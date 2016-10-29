<div class="row">
<div class="large-12 columns">

	<fieldset class="fieldset">
		<legend>Browse entities</legend>
		@foreach ($letters as $letter)
			<a href="{{route('search.browse',['letter'=>$letter])}}">{{$letter}}</a>
		@endforeach
	</fieldset>
</div>
</div>
