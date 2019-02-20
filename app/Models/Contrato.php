<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Contrato extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */


    protected $table = 'contrato';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];            
    protected $fillable = ['client_id','name','people_food','people_event','price_total','deposit','time_food','date_range_start','date_range_end','discount_food','discount_event'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    function client(){
        return $this->belongsTo(Client::class);

    }
    public function generatePDF($crud = false)
    {
        return '<a class="btn btn-xs btn-default" href="/c/'.urlencode($this->id).'" data-toggle="tooltip" title="Genarar contrato."><i class="fa fa-cogs"></i> Contrato</a>';
    }

    public function editServices($crud = false)
    {
        return '<a class="btn btn-xs btn-default"  href="/cotiza/'.urlencode($this->id).'" data-toggle="tooltip" title="Gestionar Servicios"><i class="fa fa-cutlery"></i> Servicios</a>';
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
