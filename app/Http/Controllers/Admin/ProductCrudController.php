<?php

namespace App\Http\Controllers\Admin;

use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation{ store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {

        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('top', 'import', 'import', 'end');
        $this->crud->enableExportButtons();
    
        CRUD::column('name');
        CRUD::column('gender');
        CRUD::column('phone');
        CRUD::column('address');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'tab' =>  'Product',
        ]);
        CRUD::addField([
            'name' => 'gender',
            'tab' => 'Product',
        ]);
        CRUD::addField([
            'name' => 'phone',
            'tab' => 'Product',
        ]);
        CRUD::addField([
            'name' => 'address',
            'type'  => 'text',
            'tab' => 'Product',
        ]);
        // comment field
        // CRUD::addField([
        //     'name' => 'comment',
        //     'tab' => 'Comment',
        // ]);
        // CRUD::addField([
        //     'name' => 'rating',
        //     'type' => 'number',
        //     'tab' => 'Comment',
        // ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    
    // public function store()
    // {
    //     $response = $this->traitStore();
    //     Comment::create([
    //         'product_id' => $this->crud->entry->id,
    //         'comment' => request()->comment,
    //         'rating' => request()->rating,
    //     ]);
    //     return $response;
    // }

    public function import() {
        if(request()->hasFile('file')) {
            Excel::import(new CustomerImport, request()->file);
            return response()->json([
                'success' => true,
                'message' => "Import customer successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "File does not exist"
            ]);
        }
    }

    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation { bulkDelete as traitBulkDelete; }

    public function bulkDelete()
    {
        Product::destroy(request()->entries);
        return request()->entries;
    }

}

