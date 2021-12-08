<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Http\Requests\CreateDepartamentoRequest;
use App\Http\Requests\EditDepartamentoRequest;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = [];
        $data['departamentos'] = Departamento::All();
        return view('departamento.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data = [];
        $data['workers'] = Empleado::All();
        return view('departamento.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartamentoRequest $request){
        //dd($request->all());
        $department = new Departamento($request->all());
        
        $data = [];
        try{
            $result = $department->save();
            $data['type'] = "success";
            $data['message'] = "Departamento añadido";
            return redirect('departamento')->with($data);
        } catch(\Exception $e){
            dd($e);
            $data['type'] = "danger";
            $data['message'] = "Ha ocurrido un error al añadir el departamento";
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
        $department = Departamento::find($id);
        if($department){
            $data['department'] = $department;
            return view('departamento.show', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el departamento";
            $data['type'] = "danger";
            return redirect('departamento')->with($data);
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
        $department = Departamento::find($id);
        $data['workers'] = Empleado::All();
        if($department){
            $data['department'] = $department;
            return view('departamento.edit', $data);
        } else{
            $data['message'] = "No se ha podido encontrar el departamento";
            $data['type'] = "danger";
            return redirect('departamento')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EditDepartamentoRequest $request, $id){
        $data = [];
        try{
            $department = Departamento::find($id);
            //$department->fill($request->all());
            $result = $department->update($request->all());
            $data['type'] = "success";
            $data['message'] = "Departamento actualizado";
            return redirect('departamento')->with($data);
        }catch (\Exception $e){
            dd($e);
            $data['type'] = "danger";
            $data['message'] = "Error al actualizar el departamento";
            return back()->withInput()->with($data);           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        $data = [];
        try{
            $departamento = Departamento::find($id);
            if($request->exists('all') && $request->input('all') == 'on'){
                $empleados = Empleado::where('iddepartamento', $departamento->id)->get();
                foreach ($empleados as $empl){
                    $empl->delete();
                }
            }
            $result = $departamento-> delete();
            if($result){
                $data['type'] = "success";
                $data['message'] = "El departamento ha sido borrado";    
            } else{
                $data['type'] = "danger";
                $data['message'] = "El departamento no ha podido ser borrado";    
            }
            
        }catch (\Exception $e) {
            dd($e);
            $data['type'] = "danger";
            $data['message'] = "El departamento no ha podido ser borrado nice try";
        }
        return redirect('departamento')->with($data);
    }
    
    public function search(Request $request){
        $data =[];
        
        
        $search = $request->all();
        //dd([$search['busqueda'] , $search['order'],$search['where']]);
        try{
            if($search['where'] == 'idempleadojefe'){
                $empleado = Empleado::where('nombre', 'like', '%'. $search['busqueda'] . '%')->first();
                if ($empleado == null){
                    $data['message'] = "Ha ocurrido un error con su busqueda";
                    $data['type'] = "danger";
                    return redirect('departamento')->with($data);
                }
                if($search['order'] == 'asc'){
                    $data['departamentos'] = Departamento::where($search['where'], $empleado->id)
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['departamentos'] = Departamento::where($search['where'], $empleado->id)
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }else{
                if($search['order'] == 'asc'){
                    $data['departamentos'] = Departamento::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderBy($search['where'])
                    ->get();
                } else{
                    $data['departamentos'] = Departamento::where($search['where'], 'like', '%'. $search['busqueda'] . '%')
                    ->orderByDesc($search['where'])
                    ->get();
                }
            }
            
        } catch(\Exception $e){
            dd($e);
            $data['message'] = "Ha ocurrido un error con su busqueda";
            $data['type'] = "danger";
            return redirect('departamento')->with($data);
        }
        
        $data['input'] =  $search['busqueda'];
        $data['where'] =  $search['where'];
        $data['order'] =  $search['order'];
        return view('departamento.search', $data);
    }
}
