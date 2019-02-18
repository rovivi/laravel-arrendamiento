<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', function () {
    return view('demo');
});

Route::get('c/{id}', function ($id) {    
    return view('makecontratopdf',['id'=>$id]);
});

Route::get('contrato/{id}', function ($id) {

    $contrato_info =  DB::table('contrato')
    ->join('client', 'contrato.client_id', '=', 'client.id')    
    ->where('contrato.id',$id)    
    ->select('client.*','client.name as client_name','contrato.*')
    ->get();


    $data=  [
        'c'=>$contrato_info[0],        
    ];
    $html = view('contrato', $data )->render();
    return $html;
});





Route::any('getPack/{id}', function ($id) {
    //$data = DB::getDataFromRawQuery('SELECT * FROM contrato;');
    //$data = DB::table('contrato')->get();
    /*$data = DB::table('contrato')
    ->join('service_pack', 'service_pack.contrato_id', '=', 'contrato.id')
    ->join('services', 'service_pack.services_id', '=', 'services.id')
    ->where('contrato.id',$id)
    ->select('contrato.*', 'services.name as name_serv', 'services.price','services.description as desc_service', 'service_pack.count  as number_services')
    ->get();*/
    $data = DB::table('contrato')
    ->join('client', 'contrato.client_id', '=', 'client.id')    
    ->where('contrato.id',$id)    
    ->select('client.*','client.name as client_name','contrato.*')
    ->get();

    $discount_start_date = '03/27/2012 18:47';    
    $start_date = date('Y-m-d H:i:s', strtotime($discount_start_date));

    return json_encode($start_date);
});














