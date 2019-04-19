<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
*/
Route::get('/', function () {
    return redirect('/control');});

Route::get('/cotiza/{id}', function ($id) {
    $data= ['id' => $id];
    return view('demo',$data);
});

Route::get('c/{id}', function ($id) {    
    $data=getAllContratoData($id) ;
    return view('makecontratopdf',['data'=>$data]);
});

Route::get('contrato/{id}', function ($id) {
    $data=getAllContratoData($id) ;
    return  view('contrato', $data )->render();
});

Route::any('getPack/{id}', function ($id) {    
    $data = getAllContratoData($id);     
    return json_encode($data);
});



function getAllContratoData($id){
    $contrato_info =  DB::table('contrato')
    ->join('client', 'contrato.client_id', '=', 'client.id')    
    ->where('contrato.id',$id)    
    ->select('client.*','client.name as client_name','contrato.*')
    ->get();
    $servicios=DB::table('service_pack')
    ->join('services', 'services.id', '=', 'service_pack.services_id')    
    ->join('category', 'services.cate_id', '=', 'category.id')    
    ->whereRaw('contrato_id = '.$id.' and services.cate_id != 1')
    ->select('services.name','count','category.name as category','services.price')
    ->get();
    $serviciosLugar=DB::table('service_pack')
    ->join('services', 'services.id', '=', 'service_pack.services_id')    
    ->join('category', 'services.cate_id', '=', 'category.id')    
    ->whereRaw('contrato_id = '.$id.' and services.cate_id = 1')
    ->select('services.name','count','category.name as category','services.price')
    ->get();
    $data=  ['c'=>$contrato_info[0],
    'servTotal' =>$servicios,
    'servLugares' =>$serviciosLugar];    
  
    return $data;
}