<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ContratoRequest as StoreRequest;
use App\Http\Requests\ContratoRequest as UpdateRequest;

/**
 * Class ContratoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ContratoCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Contrato');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contrato');
        $this->crud->setEntityNameStrings('Contrato', 'Contratos');
        $this->crud->addButtonFromModelFunction('line', 'open_google', 'generatePDF', 'end'); // add a button whose HTML is returned by a method in the CRUD model
        $this->crud->addButtonFromModelFunction('line', 'custom_services', 'editServices', 'beginning'); // add a button whose HTML is returned by a method in the CRUD model

        $this->crud->addColumn([    // SELECT
            'label'     => 'No. Contrato',
            'type'      => 'text',
            'name'      => 'id',  
            'attributes' => [
                'placeholder' => 'Ingrese el nombre del evento',               
              ]                    
        ]);
        
        
        $this->crud->addColumn([    // SELECT
            'label'     => 'Nombre del evento',
            'type'      => 'text',
            'name'      => 'name',  
            'attributes' => [
                'placeholder' => 'Ingrese el nombre del evento',               
              ]                    
        ]);
        
        $this->crud->addColumn([    // SELECT
            'label'     => 'Cliente',
            'type'      => 'select',
            'name'      => 'client_id',
            'entity'    => 'client',
            'attribute' => 'name',
            'model'     => "App\Models\Client",        
        ]);



        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
      
        $this->crud->addField([    // SELECT
            'label'     => 'Nombre del evento',
            'type'      => 'text',
            'name'      => 'name',  
            'attributes' => [
                'placeholder' => 'Ingrese el nombre del evento',               
              ]                    
        ]);
        
        $date_today= date('Y-m-d H:i');

        $this->crud->addField([    // SELECT
            'name' => 'date_range', // a unique name for this field
            'start_name' => 'date_range_start', // the db column that holds the start_date
            'end_name' => 'date_range_end', // the db column that holds the end_date
            'label' => 'Fecha del evento',
            'type' => 'date_range',
            // OPTIONALS
            'start_default' => $date_today, // default value for start_date
            'end_default' => $date_today, // default value for end_date
            'date_range_options' => [ // options sent to daterangepicker.js
                'timePicker' => true,
                'locale' => ['format' => 'DD/MM/YYYY HH:mm']]
        ]);


        $this->crud->addField([    // SELECT
            'label'     => 'Horario de comida (Si la hay)',
            'type'      => 'time',
            'name'      => 'time_food',
        ]);



        $this->crud->addField([    // SELECT
            'label'     => 'Cliente',
            'type'      => 'select2',
            'name'      => 'client_id',
            'entity'    => 'client',
            'attribute' => 'name',
            'model'     => "App\Models\Client",        
        ]);

        $this->crud->addField([   
            'label'     => 'Personas en el evento',
            'type'      => 'number',
            'name'      => 'people_event',  
            'wrapperAttributes' => ['class' => 'col-md-4'],
                    
        ]);

        $this->crud->addField([   
            'label'     => 'Personas en la comida',
            'type'      => 'number',
            'name'      => 'people_food',                      
            'wrapperAttributes' => ['class' => 'col-md-4'],
        ]);


        $this->crud->addField([   
            'label'     => 'Deposito',
            'type'      => 'number',
            'name'      => 'deposit',                      
            'wrapperAttributes' => ['class' => 'col-md-4'],
        ]);

        $this->crud->addField([   
            'label'     => 'Descuento eventos',
            'type'      => 'number',
            'name'      => 'discount_event',     
            'suffix' => "%",                 
            'default' => '0',
            'wrapperAttributes' => ['class' => 'col-md-6'],
        ]);

        $this->crud->addField([   
            'label'     => 'Descuento comida',
            'type'      => 'number',
            'name'      => 'discount_food',     
            'default' => '0',
            'suffix' => "%",                 
            'wrapperAttributes' => ['class' => 'col-md-6'],
        ]);

        




        /*$table->increments('id');
            
            
            $table->decimal('price_total',10,2);
            $table->decimal('deposit',10,2);
            $table->string('time');
            $table->string('time2');
            $table->string('time3');
            $table->integer('');
 */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        // add asterisk for fields that are required in ContratoRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
