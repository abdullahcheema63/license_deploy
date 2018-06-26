<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class InspectorsForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this->add('name','text',[
            'rules'=>'required'
        ])->add('email','text',[
            'rules'=>'required|email'
        ])->add('password','text',[
            'rules'=>'required'
        ])->add('contact','text',[
            'rules'=>'required'
        ])->add('submit','submit',[
            'attr'=>[
                'class'=>'btn btn-primary'
            ]
        ]);


    }
}
