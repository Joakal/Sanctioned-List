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



<?php if (file_exists('../storage/sdn.xml')) {
    $xml = simplexml_load_file('../storage/sdn.xml');
	/*
	$xml = file_get_contents('../storage/consolidated.xml');
	$p = xml_parser_create();
	xml_parse_into_struct($p, $xml, $vals, $index);
	xml_parser_free($p);

	foreach ($vals as $val) {
		print(" {$val["type"]} : {$val["number"]} : {$val["value"]}<br><br>\n");
	}
	*/

 	/* 
	*	We want to Parse XML
	*	Put them into 2D arrays
	* 	Easily put them into the database
	*/


	//$xml_records->Publish_Date = $xml->publshInformation->Publish_Date;
	$publshInformation = $xml->publshInformation;

	$publish_date = $publshInformation->Publish_Date;
	$record_count = $publshInformation->Record_Count;

	$sdnEntry = Array();
	$programList = Array();
	$idList = Array();
	$akaList = Array();
	$addressList = Array();
	$nationalityList = Array();
	$citizenshipList = Array();
	$dateOfBirthList = Array();
	$placeOfBirthList = Array();
	$vesselInfo = Array();


	foreach ($xml->sdnEntry as $value)
	{

		// We generate an array based on SDN record
		// And for each record, we're attaching a foreign reference to primary SDN record
		if($value->programList)
		{
			foreach ($value->programList as $programRecord)
			{
				$programRecord->sdnuid = $value->uid;
				array_push($programList,(array) $programRecord); // Into an array for L5
			}
		}

		if($value->idList->id)
		{
			foreach ($value->idList->id as $idRecord)
			{
				$idRecord->sdnuid = $value->uid;
				array_push($idList,(array) $idRecord); // Into an array for L5
			}
		}


		if($value->akaList->aka)
		{
			foreach ($value->akaList->aka as $akaRecord)
			{
				$akaRecord->sdnuid = $value->uid;
				array_push($akaList,(array) $akaRecord); // Into an array for L5
			}
		}

		if($value->addressList->address)
		{
			foreach ($value->addressList->address as $addressRecord)
			{
				$addressRecord->sdnuid = $value->uid;
				array_push($addressList,(array) $addressRecord); // Into an array for L5
			}
		}

		if($value->nationalityList->nationality)
		{
			foreach ($value->nationalityList->nationality as $nationalityRecord)
			{
				$nationalityRecord->sdnuid = $value->uid;
				array_push($nationalityList,(array) $nationalityRecord); // Into an array for L5
			}
		}

		if($value->citizenshipList->citizenship)
		{
			foreach ($value->citizenshipList->citizenship as $citizenshipRecord)
			{
				$citizenshipRecord->sdnuid = $value->uid;
				array_push($citizenshipList,(array) $citizenshipRecord); // Into an array for L5
			}
		}

		if($value->dateOfBirthList->dateOfBirthItem)
		{
			foreach ($value->dateOfBirthList->dateOfBirthItem as $dateOfBirthRecord)
			{
				$dateOfBirthRecord->sdnuid = $value->uid;
				array_push($dateOfBirthList,(array) $dateOfBirthRecord); // Into an array for L5
			}
		}

		if($value->placeOfBirthList->placeOfBirthItem)
		{
			foreach ($value->placeOfBirthList->placeOfBirthItem as $placeOfBirthRecord)
			{
				$placeOfBirthRecord->sdnuid = $value->uid;
				array_push($placeOfBirthList,(array) $placeOfBirthRecord); // Into an array for L5
			}
		}

		if($value->vesselInfo->vesselInfo)
		{
			foreach ($value->vesselInfo->vesselInfo as $vesselRecord)
			{
				$vesselRecord->sdnuid = $value->uid;
				array_push($vesselInfo,(array) $vesselRecord); // Into an array for L5
			}
		}


		$cloned_value = clone $value;

		// We will put these in a separate table
		unset($cloned_value->programList);
		unset($cloned_value->idList);
		unset($cloned_value->akaList);
		unset($cloned_value->addressList);
		unset($cloned_value->nationalityList);
		unset($cloned_value->citizenshipList);
		unset($cloned_value->dateOfBirthList);
		unset($cloned_value->placeOfBirthList);
		unset($cloned_value->vesselInfo);

		// Convert it into an array for Laravel
		$cloned_array = (array) $cloned_value;
		// For the sdnEntry table
		array_push($sdnEntry, $cloned_array);
		
	}
} else {
    exit('Failed to open sdn.xml.');
}
?>

</article>
</div>

@endsection

@section('sidebar')
    @parent

    <aside class="large-3 columns">
	Ad placeholder
	</aside>
@endsection
