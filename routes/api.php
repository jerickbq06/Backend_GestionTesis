<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalificaionTesisController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\PropuestaTesisController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TesisController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\IsStudent as StudentTypeMiddleware;
use Illuminate\Support\Facades\Route;

// rutas para el registro y login de acceso publico
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// aplicacion de middleware para proteger las rutas, el middleware se encarga de verificar si el token es valido, en caso de no serlo, se retorna un error 401, el middleware se encuentra den App\Http\Middleware\JwtMiddleware.php
// no se agrega a bootstrap/app.php porque se agrega en el archivo de rutas

Route::middleware([JwtMiddleware::class])->group(function () {
  // rutas para el logout
  Route::post('/logout', [AuthController::class, 'logout']);

  // rutas para el crud de roles
  Route::get('/roles', [RolesController::class, 'index']);
  Route::post('/roles', [RolesController::class, 'store']);
  Route::get('/roles/{id}', [RolesController::class, 'show']);
  Route::put('/roles/{id}', [RolesController::class, 'update']);
  Route::delete('/roles/{id}', [RolesController::class, 'destroy']);

  // rutas para el crud de usuarios
  Route::post('/usuarios', [UsuarioController::class, 'store']);
  Route::get('/usuarios', [UsuarioController::class, 'index']);
  Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
  Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
  Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
  
  // rutas para el crud de tesis, como el usuario de rol estudiante puede crear tesis, no se aplica un middleware para que pueda modificar tesis
  Route::get('/tesis', [TesisController::class, 'index']);
  Route::put('/tesis/actualizarEstado/{id}', [TesisController::class, 'actualizarEstadoTesis']);
  Route::post('/tesis', [TesisController::class, 'store']);
  Route::get('/tesis/{id}', [TesisController::class, 'show']);
  Route::put('/tesis/{id}', [TesisController::class, 'update']);
  Route::delete('/tesis/{id}', [TesisController::class, 'destroy']);
  // rutas para obtener las listas de tesis con estudiante y tutor
  Route::get('/tesis/estudiante_tutor', [TesisController::class, 'tesisWithEstudianteAndTutor']);
  // rutas para obtener una tesis con estudiante y tutor por id
  Route::get('/tesis/{id}/estudiante_tutor', [TesisController::class, 'tesisWithEstudianteAndTutorById']);
  
  // rutas para el crud de calificacion de tesis
  Route::get('/calificacion_tesis', [CalificaionTesisController::class, 'index']);
  Route::post('/calificacion_tesis', [CalificaionTesisController::class, 'store']);
  Route::get('/calificacion_tesis/{id}', [CalificaionTesisController::class, 'show']);
  Route::put('/calificacion_tesis/{id}', [CalificaionTesisController::class, 'update']);
  Route::delete('/calificacion_tesis/{id}', [CalificaionTesisController::class, 'destroy']); 

  // rutas para el crud de comentarios
  Route::get('/comentarios', [ComentariosController::class, 'index']);
  Route::post('/comentarios', [ComentariosController::class, 'store']);
  Route::get('/comentarios/{id}', [ComentariosController::class, 'show']);
  Route::put('/comentarios/{id}', [ComentariosController::class, 'update']);
  Route::delete('/comentarios/{id}', [ComentariosController::class, 'destroy']);

  // rutas para el get de propuesta de tesis, solo se permite el post, put y delete si el usuario es un docente
  Route::get('/propuesta_tesis', [PropuestaTesisController::class, 'index']);
  Route::get('/propuesta_tesis/{id}', [PropuestaTesisController::class, 'show']);

  // este middleware comprueba si el estudiante esta intentando modificar una propuesta de tesis, si es asi, no se le permite
  Route::middleware(StudentTypeMiddleware::class)->group(function () {
    Route::post('/propuesta_tesis', [PropuestaTesisController::class, 'store']);
    Route::put('/propuesta_tesis/{id}', [PropuestaTesisController::class, 'update']);
    Route::delete('/propuesta_tesis/{id}', [PropuestaTesisController::class, 'destroy']);  
  });
 
});


  





