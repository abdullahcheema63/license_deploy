<?php

namespace App\Http\Controllers;

use App\Forms\InspectorsForm;
use App\Inspector;
use App\Licensee;
use App\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class InspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inspectors=Inspector::all();
        return view('inspector.index',compact('inspectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        //
        $form=$formBuilder->create(InspectorsForm::class,[
           'method'=>'POST',
            'url'=>route('inspector.store')
        ]);
        return view('inspector.form',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FormBuilder $formBuilder)
    {
        //
        $form=$formBuilder->create(InspectorsForm::class);
        if (!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data=$request->all();
        $data['password']=bcrypt($data['password']);
        $user=User::create($data);
        $user->assignRole('inspector');
        $data['user_id']=$user->id;

        Inspector::create($data);
        return redirect()->route('inspector.index')->with(['success'=>'Inspector created successfully']);

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
    public function edit($id,FormBuilder $formBuilder)
    {
        //
        $inspector=Inspector::find($id);
        $user=$inspector->User;
        $model=[];
        $model['name']=$user->name;
        $model['email']=$user->email;
        $model['contact']=$inspector->contact;
        $form=$formBuilder->create(InspectorsForm::class,[
            'method'=>'PUT',
            'url'=>route('inspector.update',$id),
            'model'=>$model
        ]);
        return view('inspector.form',compact('form'));

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
    public function viewLicensees($id){
        $inspector=Inspector::find($id);
        $licensees=$inspector->Licensees;
        return view('licensee.index',compact('licensees'));
    }
}
