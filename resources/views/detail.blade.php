@extends('app')

@section('title', 'Sanction Search - '.$result->firstName.' '.$result->lastName)


@section('content')
<div class="row">
<div class="large-12 columns">
<h1>Sanction Search - Details</h1>
<hr/>
</div>
</div>
 
<div class="row">
 
<div class="large-9 columns" role="content">
<article>


	<table id="entity">
		<tbody>
			<tr>
				<th width="15%">Type: </th>
				<td width="55%">{{ $result->sdnType }}</td>
				<th width="15%">List: </th>
				<td width="35%">SDN</td>
			</tr>
			<tr>
				<th>Last Name: </th>
				<td>{{ $result->lastName }}</td>
				<th>Program: </th>
				<td>{{ $result->programList }}</td>
			</tr>
			<tr>
				<th>First Name: </th>
				<td>{{ $result->firstName }}</td>
				<th>Nationality: </th>
				<td>{{ $result->nationalityList }}</td>
			</tr>
			<tr>
				<th>Title: </th>
				<td>{{ $result->title }}</td>
				<th>Date of Birth:</th>
				<td>{{ $result->dateOfBirthList }}</td>
			</tr>
			<tr>
				<th>Citizenship: </th>
				<td>{{ $result->citizenshipList }}</td>
				<th>Place of Birth:</th>
				<td>{{ $result->placeOfBirthList }}</td>
			</tr>
			<tr>
				<th>Remarks: </th>
				<td>{{ $result->remarks }}</td>
			</tr>
			@if ($result->akaList)
			<tr>
				<th>Aliases:</th>
				<td colspan="3">{{ $result->akaList }}</td>
			</tr>
			@endif 
			@if ($result->addressList)
			<tr>
				<th>Known addresses:</th>
				<td colspan="3">{{ $result->addressList }}</td>
			</tr>
			@endif 
			@if ($result->vesselInfo)
			<tr>
				<th>Vessel Information:</th>
				<td colspan="3">{{ $result->vesselInfo }}</td>
			</tr>
			@endif 


		</tbody>
	</table>
	

</article>
</div>
@endsection

@section('sidebar')
    @parent

    <aside class="large-3 columns">
	Ad placeholder
	</aside>
@endsection
