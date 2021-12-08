<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePuestoRequest;
use App\Http\Requests\EditPuestoRequest;
use Illuminate\Support\Facades\Validator;

class PuestoController extends Controller{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = [];
        $data['puestos'] = Puesto::All();
        return view('puesto.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('puesto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePuestoRequest $request){
        $work = new Puesto($request->all());
        $data = [];
        try{
            $result = $work->save();
            $data['type'] = "success";
            $data['message'] = "Puesto añadido";
            return redirect('puesto')->with($data);
        } catch(\Exception $e){
            $data['type'] = "danger";
            $data['message'] = "Ha ocurrido un error al añadir el puesto";
            return back()->withInput()->with($data);
        }    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $data = [];
        $work = Puesto::find($id);
        if($work){
            $data['puesto'] = $work;
            return view('puesto.show', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el puesto";
            $data['type'] = "danger";
            return redirect('puesto')->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = [];
        $work = Puesto::find($id);
        if($work){
            $data['puesto'] = $work;
            return view('puesto.edit', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el puesto";
            $data['type'] = "danger";
            return redirect('puesto')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EditPuestoRequest $request, $id){
        try{
            $work = Puesto::find($id);
            $result = $work->update($request->all());    
            // $local->fill($request->all());
            // $ result = $local->save();
        }catch (\Exception $e){
            $result = false;

        }
        if (!$result){
            $data['type'] = "danger";
            $data['message'] = "Error al actualizar";
            return back()->withInput()->with($data);           
        }
        $data['type'] = "success";
        $data['message'] = "Puesto actualizado";
        return redirect('puesto')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto, Request $request){
        $data = [];
        try{
            if($request->exists('all') && $request->input('all') == 'on'){
                $empleados = Empleado::where('idpuesto', $puesto->id)->get();
                foreach ($empleados as $empl){
                    $empl->delete();
                }
            }
            $puesto -> delete();
            $data['type'] = "success";
            $data['message'] = "El puesto ha sido borrado";
        }catch (\Exception $e) {
            $data['type'] = "danger";
            $data['message'] = "El puesto no ha podido ser borrado";
        }
        return redirect('puesto')->with($data);
    }
    
    public function search(Request $request){
        $data =[];
        
        $search = $request->all();
        //dd([$search['busqueda'] , $search['order'],$search['where']]);
        try{
            if($search['where'] != 'nombre'){
                if($search['order'] == 'asc'){
                    $data['puestos'] = Puesto::where($search['where'], '>=', $search['busqueda'])
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['puestos'] = Puesto::where($search['where'], '>=', $search['busqueda'])
                    ->orderByDesc($search['where'])
                    ->get();
                }
            } else{
                if($search['order'] == 'asc'){
                    $data['puestos'] = Puesto::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['puestos'] = Puesto::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }
        } catch(\Exception $e){
            $data['message'] = "Ha ocurrido un error con su busqueda";

            $data['type'] = "danger";
            return redirect('puesto')->with($data);
        }
        
        $data['input'] =  $search['busqueda'];
        $data['where'] =  $search['where'];
        $data['order'] =  $search['order'];
//        dd($data);
        return view('puesto.search', $data);
    }
    

}