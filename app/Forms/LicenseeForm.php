<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LicenseeForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this->add('first_name','text',[
            'rules'=>'required',
            'label'=>'First Name'
        ])->add('last_name','text',[
            'rules'=>'required',
            'label'=>'Last Name'
        ])->add('emirate_id','text',[
            'rules'=>'required',
            'label'=>'Emirates Id'
        ])->add('dob','date',[
            'rules'=>'required|date',
            'label'=>'Date Of Birth'
        ])->add('area','text',[
            'rules'=>'required'
        ])->add('submit','submit',[
            'attr'=>[
                'class'=>'btn btn-primary'
            ]
        ]);
    }
}
