<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClientRequest as StoreRequest;
use App\Http\Requests\ClientRequest as UpdateRequest;

/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClientCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Client');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/client');
        $this->crud->setEntityNameStrings('Cliente', 'Clientes');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------                            
        */
        $this->crud->addColumn([    // SELECT
          'label'     => 'Nombre del cliente',
          'type'      => 'text',
          'name'      => 'name',                               
        ]);
        $this->crud->addColumn([    // SELECT
        'label'     => 'Teléfono',
        'type'      => 'text',
        'name'      => 'phone1',                               
        ]);
        $this->crud->addColumn([    // SELECT
      'label'     => 'R.F.C.',
      'type'      => 'text',
      'name'      => 'rfc',                               
        ]);


        // TODO: remove setFromDb() and manually define Fields and Columns
     //   $this->crud->setFromDb();


        
        $this->crud->addField([
          'name' => 'name',
          'type' => 'text',
          'label' => "Nombre",
          'minimum_input_length' => 5,
          'attributes' => [
            'placeholder' => 'Nombre del cliente',
            'class' => 'form-control some-class'
          ]

        ]);
        $this->crud->addField([
          'name' => 'rfc',
          'type' => 'text',
          'label' => "RFC",
          'minimum_input_length' => 8,
          'attributes' => [
            'placeholder' => 'XXX010101XXX',          
          ]

        ]);
        $this->crud->addField([
          'name' => 'phone1',
          'type' => 'text',
          'label' => "Teléfono",
          'attributes' => [
            'placeholder' => 'Inserte telefono de contacto',          
          ]
        ]);
        $this->crud->addField([
          'name' => 'phone2',
          'type' => 'text',
          'tab' => "Extras",
          'label' => "Teléfono alternativo",
          'attributes' => [
            'placeholder' => 'Inserte telefono de contacto alternativo',          
          ]
        ]);
        $this->crud->addField([
          'name' => 'extras', 
          'tab' => "Extras",
          'type' => 'textarea',
          'label' => "Notas del cliente"
        ]);
        $this->crud->addField([
          'name' => 'email',
          'type' => 'email',
          'label' => "Correo electrónico",
          'attributes' => [
            'placeholder' => 'correo@ejemplo.net',          
          ]
        ]);
       /**--------------FILTERS------------------- */

   

        // add asterisk for fields that are required in ClientRequest
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
