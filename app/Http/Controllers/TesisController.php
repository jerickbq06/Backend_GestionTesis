<?php

namespace App\Http\Controllers;

use App\Models\Tesis;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
	    return response()->json([
	    	'message' => 'Lista de tesis',
		'tesis' => Tesis::with(['estudiante', 'tutor', 'estudianteCompanero', 'comentarios', 'calificaciones'])->get()
	    ]);

        //return response()->json([
        //    'message' => 'Lista de tesis',
        //    'tesis' => Tesis::with('estudiante', 'tutor')->get()
        //]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $request->validate([
       //     'titulo' => 'required|string|max:255',
       //     'id_estudiante' => 'required|exists:usuarios,id_usuario',
       //     'id_tutor_docente' => 'required|exists:usuarios,id_usuario',
       //     'descripcion' => 'nullable|string',
       //     'ambito' => 'required|in:investigacion,desarrollo web,desarrollo movil,desarrollo videojuegos,inteligencia artificial',
        //    'grupal' => 'required|boolean',
	//    'estado' => 'required|in:aprobado,rechazado,en espera',
	//    'id_estudiante_companero' => 'nullable|exists:usuarios,id_usuario'
        //]);

        $idTutorDocente = $request->id_tutor_docente;
        $idEstudiante = $request->id_estudiante;

        // asegurarse que el id de tutor_docente sea de un docente
        if ($usuario = Usuario::find($idTutorDocente)) {
            if ($usuario->id_rol != 2) {
                return response()->json([
                    'message' => 'El Id pasado en id_docente_tutor no es un docente, solo los docentes pueden ser tutores'
                ]);
            }
        } 

        // asegurarse que el id de estudiante sea de un estudiante 
        if ($usuario = Usuario::find($idEstudiante)) {
            if ($usuario->id_rol != 1) {
                return response()->json([
                    'message' => 'El Id pasado en id_estudiante no es un estudiante, solo los estudiantes pueden registrar tesis'
                ]);
            }
        } //else {
           // return response()->json([
            //    'message' => 'El usuario no existe'
            //]);
       // }


        if ($tesis = Tesis::where('id_estudiante', $idEstudiante)->first()) {
            return response()->json([
                'message' => 'El estudiante ya tiene una tesis registrada',
                'tesis' => $tesis
            ]);
        }
        //
        $tesis = new Tesis();
        $tesis->titulo = $request->titulo;
        $tesis->id_estudiante = $request->id_estudiante;
	$tesis->id_tutor_docente = $request->id_tutor_docente;
	$tesis->descripcion = $request->descripcion;
	$tesis->ambito = $request->ambito;
	$tesis->grupal = $request->grupal;
	$tesis->estado = $request->estado;
	$tesis->id_estudiante_companero = $request->id_estudiante_companero;
        $tesis->save();

        return response()->json([
            'message' => 'Tesis creada correctamente',
            'tesis' => $tesis
        ]);
    
    }
    public function actualizarEstadoTesis(Request $request, string $id) {
	    $tesis = Tesis::FindOrFail($id);
	    $tesis->estado = $request->estado;
	    $tesis->save();
	    return response()->json([
	    	'message' => 'tesis actualizada con exito',
		'tesis'=> $tesis
	    ]);
    
    }

    	

    // obtener tesis, con estudiante, tutor y calificaion por id
    public function getWithAllById(string $id) {
    	return response()->json([
		'message'=> 'lista de tesis con estudiante, docente y calificacion',
		'data'=> Tesis::with(['tesis', 'estudiante', 'tutor'])->find($id)
	]);
    }


    // obtener tesis con estudiante y tutor por id
   public function tesisWithEstudianteAndTutorById(string $id)
    {
        $tesis = Tesis::with('estudiante', 'tutor')->find($id);

        if (!$tesis) {
            return response()->json(['message' => 'Tesis no encontrada'], 404);
        }

        return response()->json([
            'tesis' => $tesis
        ]);
    }

    // obtener todas las tesis con estudiante y tutor
    public function tesisWithEstudianteAndTutor()
    {
        
        return response()->json([
            'message' => 'Lista de tesis con estudiantes y tutores',
            'tesis' => Tesis::with('estudiante', 'tutor')->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tesis = Tesis::with('estudiante', 'tutor')->find($id);

        return response()->json([
            'tesis' => $tesis
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tesis = Tesis::FindOrFail($id);
        $tesis->titulo = $request->titulo;
        $tesis->id_estudiante = $request->id_estudiante;
        $tesis->id_tutor_docente = $request->id_tutor_docente;
        $tesis->save();

        return response()->json([
            'message' => 'Tesis actualizada correctamente',
            'tesis' => $tesis
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tesis = Tesis::FindOrFail($id);
        $tesis->delete();

        return response()->json([
            'message' => 'Tesis eliminada correctamente'
        ]);
    }
}
