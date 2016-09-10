<?php

namespace App\Repositories;

use App\Repositories\SearchRepository;
use DB;
use App\sdnEntry;

class SearchEloquentRepository implements SearchRepository
{
    public function all()
    {
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
		

		$lastname = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("lastName", ?) As sim_score'))
            ->where('lastName', '<>', $query)
            ->whereRaw('"lastName" % ?', [ $query,$query]);

		$title = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("title", ?) As sim_score'))
            ->where('title', '<>', $query)
            ->whereRaw('"title" % ?', [$query,$query]);

		$sdnType = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("sdnType", ?) As sim_score'))
            ->where('sdnType', '<>', $query)
            ->whereRaw('"sdnType" % ?', [$query,$query]);

		$remarks = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("remarks", ?) As sim_score'))
            ->where('remarks', '<>', $query)
            ->whereRaw('"remarks" % ?', [$query,$query]);

		/* We don't really need to search programList
		$programList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("programList", ?) As sim_score'))
            ->where('programList', '<>', $query)
            ->whereRaw('"programList" % ?', [$query,$query]); */

		$idList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("idList", ?) As sim_score'))
            ->where('idList', '<>', $query)
            ->whereRaw('"idList" % ?', [$query,$query]);

		$akaList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("akaList", ?) As sim_score'))
            ->where('akaList', '<>', $query)
            ->whereRaw('"akaList" % ?', [$query,$query]);

		/* We don't really need to search addresses
		$addressList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("addressList", ?) As sim_score'))
            ->where('addressList', '<>', $query)
            ->whereRaw('"addressList" % ?', [$query,$query]); */

		/* We don't really need to search nationality
		$nationalityList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("nationalityList", ?) As sim_score'))
            ->where('nationalityList', '<>', $query)
            ->whereRaw('"nationalityList" % ?', [$query,$query]);*/

		/* We don't really need to search citizenship
		$citizenshipList = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("citizenshipList", ?) As sim_score'))
            ->where('citizenshipList', '<>', $query)
            ->whereRaw('"citizenshipList" % ?', [$query,$query]);*/

		$vesselInfo = DB::table('sdnEntry')
			->select('*', DB::raw('similarity("vesselInfo", ?) As sim_score'))
            ->where('vesselInfo', '<>', $query)
            ->whereRaw('"vesselInfo" % ?', [$query,$query]);

		try {

			$firstname = DB::table('sdnEntry')
				->select('*', DB::raw('similarity("firstName", ?) As sim_score'))
		        ->where('firstName', '<>', $query)
		        ->whereRaw('"firstName" % ?', [$query,$query])
				->union($lastname)
				->union($title)
				->union($sdnType)
				->union($remarks)
				//->union($programList)
				->union($idList)
				->union($akaList)
				//->union($addressList)
				//->union($nationalityList)
				//->union($citizenshipList)
				->union($vesselInfo)
		 		->orderBy('sim_score', 'desc')
				->limit(15)
				->get();
		} catch (\Exception $e) {
			\Log::error("Search failure with ".$query." ErrorMsg: ".$e->getMessage());
			// Lets return no results instead of a server error so that it's not scary
			return new \Illuminate\Database\Eloquent\Collection;
    	}

        return $firstname;
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


				// We generate an array based on SDN record
				// And for each record, we're attaching a foreign reference to primary SDN record
				$programList = array();
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

								array_push($programList, implode(" ",(array) $programLine)); // Into an array for L5
							}

						}else{
							$programList = (array) $programRecord; // Into an array for L5
						}
					}
				}

				$idList = array();
				if($value->idList->id)
				{
					foreach ($value->idList->id as $idRecord)
					{	
						unset($idRecord->uid);
						array_push($idList, " ID: ".implode(" ",(array) $idRecord));
					}
				}


				$akaList = array();
				if($value->akaList->aka)
				{
					foreach ($value->akaList->aka as $akaRecord)
					{
						unset($akaRecord->uid);
						unset($akaRecord->category);
						unset($akaRecord->type);
						array_push($akaList, " AKA: ".implode(" ",(array) $akaRecord));
				
					}
				}

				$addressList = array();
				if($value->addressList->address)
				{
					foreach ($value->addressList->address as $addressRecord)
					{
						unset($addressRecord->uid);
						array_push($addressList, " Address: ".implode(" ",(array) $addressRecord));
					}
				}

				$nationalityList = array();
				if($value->nationalityList->nationality)
				{
					foreach ($value->nationalityList->nationality as $nationalityRecord)
					{
						unset($nationalityRecord->uid);
						unset($nationalityRecord->mainEntry);
						array_push($nationalityList, " Nationality: ".implode(" ",(array) $nationalityRecord));
					}
				}

				$citizenshipList = array();
				if($value->citizenshipList->citizenship)
				{
					foreach ($value->citizenshipList->citizenship as $citizenshipRecord)
					{
						unset($citizenshipRecord->uid);
						unset($citizenshipRecord->mainEntry);
						array_push($citizenshipList, " Citizenship: ".implode(" ",(array) $citizenshipRecord));
					}
				}

				$dateOfBirthList = array();
				if($value->dateOfBirthList->dateOfBirthItem)
				{
					foreach ($value->dateOfBirthList->dateOfBirthItem as $dateOfBirthRecord)
					{
						unset($dateOfBirthRecord->uid);
						unset($dateOfBirthRecord->mainEntry);
						array_push($dateOfBirthList, " DOB: ".implode(" ",(array) $dateOfBirthRecord));
					}
				}

				$placeOfBirthList = array();
				if($value->placeOfBirthList->placeOfBirthItem)
				{
					foreach ($value->placeOfBirthList->placeOfBirthItem as $placeOfBirthRecord)
					{
						unset($placeOfBirthRecord->uid);
						unset($placeOfBirthRecord->mainEntry);
						array_push($placeOfBirthList, " POB: ".implode(" ",(array) $placeOfBirthRecord));
					}
				}

				$vesselInfo = array();
				if($value->vesselInfo)
				{
					foreach ($value->vesselInfo as $vesselRecord)
					{
						array_push($vesselInfo, " Vessel Info: ".implode(" ",(array) $vesselRecord));
					}
				}

				$cloned_value = clone $value;

				// We will update the values
				$cloned_array = (array) $cloned_value;
				
				$cloned_array['programList'] = implode(" ",$programList);
				$cloned_array['idList'] = implode(" ",$idList);
				$cloned_array['akaList'] = implode(" ",$akaList);
				$cloned_array['addressList'] = implode(" ",$addressList);
				$cloned_array['nationalityList'] = implode(" ",$nationalityList);
				$cloned_array['citizenshipList'] = implode(" ",$citizenshipList);
				$cloned_array['dateOfBirthList'] = implode(" ",$dateOfBirthList);
				$cloned_array['placeOfBirthList'] = implode(" ",$placeOfBirthList);
				$cloned_array['vesselInfo'] = implode(" ",$vesselInfo);

				// Convert it into an array for Laravel
				// For the sdnEntry table
				try {

					\App\sdnEntry::firstOrCreate($cloned_array);
					/*DB::table('sdnEntry')->insert(
						$cloned_array
					);*/
				} catch (\Exception $e) {
					// \Log::error("SearchEloquentRepo->bulk_insert() ErrorMsg: ".$e->getMessage());
				}

				
			}

		} else {
			exit('Failed to open sdn.xml.');
		}

	} // end public function bulk_insert()

}
