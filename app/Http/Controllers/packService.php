<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class packService extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //       
       // DB::table('service_pack')->where('contrato_id', '=',1)->delete();

       DB::table('service_pack')->insert(
        ['contrato_id' => '1',
         'services_id' => '1',
         'count' => '2']
    );


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        header( 'Access-Control-Allow-Origin', '*' );
        header( 'Access-Control-Allow-Headers', 'Origin, Content-Type' );    
        $data = $request->input('services');
        $id = $request->input('id');    
        DB::table('service_pack')->where('contrato_id',$id)->delete();
        if (count($data)>0){            
            for($i=0;$i<count($data);$i++){                            
                DB::table('service_pack')->insert(
                    ['contrato_id' => $id,
                     'services_id' => $data[$i]['idService'],
                     'count' => $data[$i]['c']]
                );                
            }            
        }                    
        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
