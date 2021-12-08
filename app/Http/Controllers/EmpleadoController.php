<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmpleadoRequest;
use App\Http\Requests\EditEmpleadoRequest;
class EmpleadoController extends Controller{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = [];
        $data['empleados'] = Empleado::All();
        return view('empleado.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data = [];
        $data['departamentos'] = Departamento::All();
        $data['puestos'] = Puesto::All();
        return view('empleado.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateEmpleadoRequest $request)
    {
        $worker = new Empleado($request->all());
        $data = [];
        try{
            $result = $worker->save();
            $data['type'] = "success";
            $data['message'] = "Empleado añadido";
            return redirect('empleado')->with($data);
        } catch(\Exception $e){
            dd($e);
            $data['type'] = "danger";
            $data['message'] = "Ha ocurrido un error al añadir al empleado";
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
        $empleado = Empleado::find($id);
        if($empleado){
            $data['empleado'] = $empleado;
            return view('empleado.show', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el empleado";
            $data['type'] = "danger";
            return redirect('empleado')->with($data);
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
        $empleado = Empleado::find($id);
        if($empleado){
            $data['empleado'] = $empleado;
            $data['puestos'] = Puesto::All();
            $data['departamentos'] = Departamento::All();
            return view('empleado.edit', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el empleado";
            $data['type'] = "danger";
            return redirect('empleado')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EditEmpleadoRequest $request, $id){
        $data = [];
        try{
            $empleado = Empleado::find($id);
            $empleado->update($request->all());
            $data['type'] = "success";
            $data['message'] = "Empleado actualizado";
            return redirect('empleado')->with($data);
        }catch (\Exception $e){
            $data['type'] = "danger";
            $data['message'] = "Error al actualizar el empleado";
            return back()->withInput()->with($data);           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado){
        $data = [];
        try{
            $empleado -> delete();
            $data['type'] = "success";
            $data['message'] = "El empleado ha sido borrado";
        }catch (\Exception $e) {
            $data['type'] = "danger";
            $data['message'] = "El empleado no ha podido ser borrado";
        }
        return redirect('empleado')->with($data);
    }

    public function search(Request $request){
        $data =[];
        
        $search = $request->all();
        //dd([$search['busqueda'] , $search['order'],$search['where']]);
        try{
            if($search['where'] == 'fechacontrato'){
                $fecha = date('Y-m-d', strtotime( $search['busqueda'] ));
            
                if($search['order'] == 'asc'){
                    //dd(Empleado::whereDate($search['where'], $search['busqueda'])->orderBy($search['where']));
                    $data['empleados'] = Empleado::whereDate($search['where'], /*'>=',*/ $fecha)
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['empleados'] = Empleado::whereDate($search['where'], /*'>=',*/ $fecha)
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }else if($search['where'] == 'idpuesto') {
                $puesto = Puesto::where('nombre', 'like', '%'. $search['busqueda'] . '%')->first();
                if ($puesto == null){
                    $data['message'] = "Ha ocurrido un error con su busqueda";
                    $data['type'] = "danger";
                    return redirect('empleado')->with($data);
                }
                if($search['order'] == 'asc'){
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $puesto->id . '%')
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $puesto->id . '%')
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }else if($search['where'] == 'iddepartamento') {
                $departamento = Departamento::where('nombre', 'like', '%'. $search['busqueda'] . '%')->first();
                if ($departamento == null){
                    $data['message'] = "Ha ocurrido un error con su busqueda";
                    $data['type'] = "danger";
                    return redirect('empleado')->with($data);
                }
                if($search['order'] == 'asc'){
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $departamento->id . '%')
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $departamento->id . '%')
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }else{
                if($search['order'] == 'asc'){
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['empleados'] = Empleado::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }
        } catch(\Exception $e){
            dd($e);
            $data['message'] = "Ha ocurrido un error con su busqueda";
            $data['type'] = "danger";
            return redirect('empleado')->with($data);
        }
        
        $data['input'] =  $search['busqueda'];
        $data['where'] =  $search['where'];
        $data['order'] =  $search['order'];
//        dd($data);
        return view('empleado.search', $data);
    }
}
