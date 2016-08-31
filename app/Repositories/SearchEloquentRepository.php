<?php

namespace App\Repositories;

use App\Repositories\SearchRepository;
use DB;

class SearchEloquentRepository implements SearchRepository
{
    public function all()
    {
/*
        $ofac = DB::table('ofac')->get();

        return view('search', ['ofac' => $ofac]);*/
        return DB::table('sdnentry')->get();
    }

   public function find($query)
    {
        return DB::table('sdnEntry')
		->where('firstName','like', '%'.$query.'%')
		->orWhere('lastName','like', '%'.$query.'%')
		->get();

    }

   public function fuzzy_find($query)
    {

        return DB::table('sdnEntry')->where('firstName',$query);
    }


	public function bulk_insert()
	{


		if (file_exists('../storage/sdn.xml')) {
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
			
			/*DB::table('publshInformation')->insert(
				$(array) $publshInformation // Into an array for L5
			);*/

			foreach ($xml->sdnEntry as $value)
			{

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
				DB::table('sdnEntry')->insert(
					$cloned_array
				);

				// We generate an array based on SDN record
				// And for each record, we're attaching a foreign reference to primary SDN record
				if($value->programList)
				{
					foreach ($value->programList as $programRecord)
					{
						$programRecord->sdnuid = $value->uid;
						$arrayRecord = (array) $programRecord;
						
						// Sometimes an array of values is given, not a string. L5 chokes. ie  array('program' => array('SDT', 'SDGT'), 'sdnuid' => '2676')
						if(is_array($arrayRecord['program']))
						{ 
							foreach ($arrayRecord['program'] as $program)
							{
								//Lets replace the array with a string
								$programLine = $arrayRecord;
								$programLine['program'] = $program;

								DB::table('programList')->insert(
									(array) $programLine // Into an array for L5
								);
							}

						}else{
							DB::table('programList')->insert(
								(array) $programRecord // Into an array for L5
							);
						}
					}
				}

				if($value->idList->id)
				{
					foreach ($value->idList->id as $idRecord)
					{
						$idRecord->sdnuid = $value->uid;
				
						DB::table('idList')->insert(
							(array) $idRecord // Into an array for L5
						);
					}
				}


				if($value->akaList->aka)
				{
					foreach ($value->akaList->aka as $akaRecord)
					{
						$akaRecord->sdnuid = $value->uid;
				
						DB::table('akaList')->insert(
							(array) $akaRecord // Into an array for L5
						);
					}
				}

				if($value->addressList->address)
				{
					foreach ($value->addressList->address as $addressRecord)
					{
						$addressRecord->sdnuid = $value->uid;
				
						DB::table('addressList')->insert(
							(array) $addressRecord // Into an array for L5
						);
					}
				}

				if($value->nationalityList->nationality)
				{
					foreach ($value->nationalityList->nationality as $nationalityRecord)
					{
						$nationalityRecord->sdnuid = $value->uid;
				
						DB::table('nationalityList')->insert(
							(array) $nationalityRecord // Into an array for L5
						);
					}
				}

				if($value->citizenshipList->citizenship)
				{
					foreach ($value->citizenshipList->citizenship as $citizenshipRecord)
					{
						$citizenshipRecord->sdnuid = $value->uid;
				
						DB::table('citizenshipList')->insert(
							(array) $citizenshipRecord // Into an array for L5
						);
					}
				}

				if($value->dateOfBirthList->dateOfBirthItem)
				{
					foreach ($value->dateOfBirthList->dateOfBirthItem as $dateOfBirthRecord)
					{
						$dateOfBirthRecord->sdnuid = $value->uid;
				
						DB::table('dateOfBirthList')->insert(
							(array) $dateOfBirthRecord // Into an array for L5
						);
					}
				}

				if($value->placeOfBirthList->placeOfBirthItem)
				{
					foreach ($value->placeOfBirthList->placeOfBirthItem as $placeOfBirthRecord)
					{
						$placeOfBirthRecord->sdnuid = $value->uid;
				
						DB::table('placeOfBirthList')->insert(
							(array) $placeOfBirthRecord // Into an array for L5
						);
					}
				}

				if($value->vesselInfo)
				{
					foreach ($value->vesselInfo as $vesselRecord)
					{
						$vesselRecord->sdnuid = $value->uid;
				
						DB::table('vesselInfo')->insert(
							(array) $vesselRecord // Into an array for L5
						);
					}
				}

		
			}

		} else {
			exit('Failed to open sdn.xml.');
		}

	} // end public function bulk_insert()

}
