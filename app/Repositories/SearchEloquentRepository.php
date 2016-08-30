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
/*
        $ofac = DB::table('ofac')->get();

        return view('search', ['ofac' => $ofac]);*/
        return DB::table('sdnentry')->get();
    }

   public function fuzzy_find($query)
    {
/*
        $ofac = DB::table('ofac')->get();

        return view('search', ['ofac' => $ofac]);*/
        return DB::table('sdnentry')->get();
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

			$sdnEntry = new ArrayObject();
			$programList = new ArrayObject();
			$idList = new ArrayObject();
			$akaList = new ArrayObject();
			$addressList = new ArrayObject();
			$nationalityList = new ArrayObject();
			$citizenshipList = new ArrayObject();
			$dateOfBirthList = new ArrayObject();
			$placeOfBirthList = new ArrayObject();
			$vesselInfo = new ArrayObject();


			foreach ($xml->sdnEntry as $value)
			{

				// We generate an array based on SDN record
				// And for each record, we're attaching a foreign reference to primary SDN record
				if($value->programList)
				{
					foreach ($value->programList as $programRecord)
					{
						$programRecord->sdnuid = $value->uid;
						$programList->append($programRecord);
					}
				}

				if($value->idList->id)
				{
					foreach ($value->idList->id as $idRecord)
					{
						$idRecord->sdnuid = $value->uid;
						$idList->append($idRecord);
					}
				}

		
				if($value->akaList->aka)
				{
					foreach ($value->akaList->aka as $akaRecord)
					{
						$akaRecord->sdnuid = $value->uid;
						$akaList->append($akaRecord);
					}
				}

				if($value->addressList->address)
				{
					foreach ($value->addressList->address as $addressRecord)
					{
						$addressRecord->sdnuid = $value->uid;
						$addressList->append($addressRecord);
					}
				}

				if($value->nationalityList->nationality)
				{
					foreach ($value->nationalityList->nationality as $nationalityRecord)
					{
						$nationalityRecord->sdnuid = $value->uid;
						$nationalityList->append($nationalityRecord);
					}
				}

				if($value->citizenshipList->citizenship)
				{
					foreach ($value->citizenshipList->citizenship as $citizenshipRecord)
					{
						$citizenshipRecord->sdnuid = $value->uid;
						$citizenshipList->append($citizenshipRecord);
					}
				}

				if($value->dateOfBirthList->dateOfBirthItem)
				{
					foreach ($value->dateOfBirthList->dateOfBirthItem as $dateOfBirthRecord)
					{
						$dateOfBirthRecord->sdnuid = $value->uid;
						$dateOfBirthList->append($dateOfBirthRecord);
					}
				}

				if($value->placeOfBirthList->placeOfBirthItem)
				{
					foreach ($value->placeOfBirthList->placeOfBirthItem as $placeOfBirthRecord)
					{
						$placeOfBirthRecord->sdnuid = $value->uid;
						$placeOfBirthList->append($placeOfBirthRecord);
					}
				}

				if($value->vesselInfo->vesselInfo)
				{
					foreach ($value->vesselInfo->vesselInfo as $vesselRecord)
					{
						$vesselRecord->sdnuid = $value->uid;
						$vesselInfo->append($vesselRecord);
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

				// For the sdnEntry table
				$sdnEntry->append($cloned_value);
	
			} //end foreach $xml

		} else {
			exit('Failed to open sdn.xml.');
		}

	} // end public function bulk_insert()

}
