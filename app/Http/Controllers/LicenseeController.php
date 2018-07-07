<?php

namespace App\Http\Controllers;

use App\Forms\LicenseeForm;
use App\Inspector;
use App\Licensee;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class LicenseeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $licensees=Licensee::all();
        $inspectors=Inspector::all();
        return view('licensee.index',compact('licensees','inspectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        //
        $form=$formBuilder->create(LicenseeForm::class,[
            'method'=>'POST',
            'url'=>route('licensee.store')
        ]);
        return view('licensee.form',compact('form'));
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
        $form=$formBuilder->create(LicenseeForm::class);
        if (!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data=$request->all();
        $data['status']=1;
        $data["requirement_1"]=false;
        $data["requirement_2"]=false;
        $data["requirement_3"]=false;

        Licensee::create($data);
        return redirect()->route('licensee.index')->with(['success'=>'licensee created successfully']);
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
        $form=$formBuilder->create(LicenseeForm::class,[
            'method'=>'PUT',
            'url'=>route('licensee.update',$id),
            'model'=>Licensee::find($id)
        ]);
        return view('licensee.form',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FormBuilder $formBuilder)
    {
        //
        $form=$formBuilder->create(LicenseeForm::class);
        if (!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data=$request->all();
        Licensee::find($id)->update($data);
        return redirect()->route('licensee.index')->with(['success'=>'licensee updated successfully']);
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

    public function assignInspector($id,Request $request){
        $licensee=Licensee::find($id);
        $licensee->update(['inspector_id'=>$request['inspector_id'],'status'=>2]);

        return redirect()->back()->with(['success'=>'Inspector Assigned Successfully']);
    }
    public function disapprove($id){
        $licensee=Licensee::find($id);
        $licensee->update(['status'=>3]);

        return redirect()->back()->with(['error'=>'Disapproved Successfully']);
    }
    public function approve(Request $request,$id){
        $licensee=Licensee::find($id);
        $requirement_1=false;
        $requirement_2=false;
        $requirement_3=false;
        if ($request->requirement_1)$requirement_1=true;
        if ($request->requirement_2)$requirement_2=true;
        if ($request->requirement_3)$requirement_3=true;
        $licensee->update(['status'=>4,'remarks'=>$request->remarks,'requirement_1'=>$requirement_1,'requirement_2'=>$requirement_2,'requirement_3'=>$requirement_3]);
        return redirect()->back()->with(['success'=>'Approved Successfully']);
    }
}
