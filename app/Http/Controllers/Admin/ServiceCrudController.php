<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ServiceRequest as StoreRequest;
use App\Http\Requests\ServiceRequest as UpdateRequest;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ServiceCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Service');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/service');
        $this->crud->setEntityNameStrings('Servicio', 'Servicios');


        /*-------Field Colums------ */
       $this->crud->addColumn([
        'name' => 'name',
        'type' => 'text',
        'label' => 'Nombre',
        ]);
        /*$this->crud->addColumn([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Descripción',
        ]);*/

        $this->crud->addColumn([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Precio',
        ]);
        
     /*   $this->crud->addColumn([
            'name' => 'cate_id', // The db column name
            'label' => "Categoria", // Table column heading
            'type' => 'text',
            //'prefix' => 'folder/subfolder/',
             // optional width/height if 25px is not ok with you
             // 'height' => '30px',
              //'width' => '30px',
         ]);
*/


        /*-------Field Form------ */
        $this->crud->addField([            
          'name' => 'name',
          'type' => 'text',
          'label' => "Nombre",
          'attributes' => [ 'required' => true, ],
        ]);
        $this->crud->addField([        
            'name' => 'description',
            'type' => 'textarea',
            'label' => "Descripción",
            'minimum_input_length' => 10,
          'attributes' => [ 'required' => true, ],

          ]);
          



          $this->crud->addField([    // SELECT
            'label'     => 'Categoría',
            'type'      => 'select',
            'name'      => 'cate_id',
            'entity'    => 'cate',
            'attribute' => 'name',
            'model'     => "App\Models\Cate",
            
        ]);

        $this->crud->addField([   // Number
            'name'  => 'price',
            'label' => 'Precio',
            'type'  => 'number',
            // optionals
            'attributes' => ["step" => "any"], // allow decimals
            'prefix' => '$',
            //'suffix' => '.00',
                 'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
              ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            'tab' => 'Costes',
          'attributes' => [ 'required' => true, ],
        ]);


        $this->crud->addField([   // Number
            
            'name'  => 'taxes',
            'label' => 'Impuesto',
            'type'  => 'number',
            // optionals
            'attributes' => ["step" => "any"], // allow decimals
            'prefix' => '$',
            //'suffix' => '.00',
             'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
              ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            'tab' => 'Costes',
        ]);

        $this->crud->addField([ // base64_image
            

            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
            'tab'          => 'Extras'
           // 'disk' => 'uploads',
           /*'label'        => 'Imagén (Opcional)',
            'name'         => 'base64_image',
            'filename'     => null, // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'src'          => null, // null to read straight from DB, otherwise set to model accessor function
            ,*/
        ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
     //   $this->crud->setFromDb();

        // add asterisk for fields that are required in ServiceRequest
       // $this->crud->setRequiredFields(StoreRequest::class, 'create');

       /*$this->crud->enableDetailsRow();
       $this->crud->allowAccess('details_row'); */
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
         $redirect_location = parent::storeCrud($request);
       //  your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        if ($request->hasFile('image'))
        {
            $file =$request->file('image');
            $name= $request->input('name');
            $file ->move(public_path().'/images/services/',$name);
        }
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
