<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Subject;
use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Library\Widget;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('gender');
        CRUD::column('phone');
        CRUD::column('address');
        CRUD::addColumn([
            'name' => 'image',
            'type' => 'closure',
            'function' => function ($entry) {
                return "<img src='" . asset($entry->image) . "' width='37px'></img>";
            },
            'escaped' => false
        ]);
        CRUD::addColumn([
            'label'     => 'Subject', // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'subjects', // the method that defines the relationship in your Model
            'entity'    => 'subjects', // the method that defines the relationship in your Model
            'attribute' => 'subject', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Subject', // foreign key model
        ]);
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(StudentRequest::class);
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'tab' => 'Tab 1'
        ]);
        CRUD::addField([
            'name'        => 'gender',
            'label'       => "Gender",
            'type'        => 'select2_from_array',
            'options'     => ['male' => 'Male', 'femal' => 'Femal'],
            'allows_null' => false,
            'default'     => 'one',
            'tab' => 'Tab 1'
        ]);
        CRUD::addField([
            'name' => 'phone',
            'type' => 'number',
            'tab' => 'Tab 1'
        ]);
        CRUD::addField([
            'name' => 'address',
            'type' => 'text',
            'tab' => 'Tab 1'
        ]);
        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'tab' => 'Tab 2'
        ]);
        CRUD::addField([
            // 'data_source' => backpack_url('subject/fetch/student'),
            'label'     => 'Subject',
            'type'      => 'checklist',
            'name'      => 'subjects',
            'entity'    => 'subjects',
            'attribute' => 'subject',
            'model'     => "app\Models\Subject",
            'pivot'     => true,
            'tab'       => 'Tab 2'
        ]);
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

    public function destroy($id)
    {

        $this->crud->hasAccessOrFail('delete');
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $this->crud->getEntry($id)->subjects()->detach();

        return $this->crud->delete($id);
    }
    // public function show($id)
    // {
    //     $data['crud'] = $this->crud;
    //     $data['entry'] = $this->crud->getEntry($id);
    //     return view('admin.students.show', $data);

    // }
}
