<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sdnEntry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sdnEntry';


    protected $fillable = ['uid','firstName', 'lastName', 'title', 'sdnType', 'remarks', 'programList', 'idList', 'akaList', 'addressList', 'nationalityList', 'citizenshipList', 'dateOfBirthList', 'placeOfBirthList', 'vesselInfo'];

    public $timestamps = false;
    public $primaryKey = 'uid';
    public $incrementing = false;
}
