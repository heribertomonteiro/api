<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::get('/contacts', function (Request $request) {
//     return response()->json([
//         'status' => true,
//         'message' => "Listar Usuarios"
//     ],200);
// });

Route::get('/contacts', [ContactController::class, 'index']); //GET http://127.0.0.1:8000/api/contacts
Route::get('/contacts/{contact}', [ContactController::class, 'show']); //GET http://127.0.0.1:8000/api/contacts/id
Route::post('/contacts', [ContactController::class, 'store']); //POST http://127.0.0.1:8000/api/contacts
Route::put('/contacts/update/{contact}', [ContactController::class, 'update']); //PUT http://127.0.0.1:8000/api/contacts/update/id
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']); //DELETE http://127.0.0.1:8000/api/contacts/id