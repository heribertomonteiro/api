<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index() : JsonResponse
    {
        $contacts = Contacts::orderBy('id', 'ASC')->get();
        return response()->json([
            'status' => true,
            'contacts' => $contacts
        ],200);
    }

    public function show(Contacts $contact) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'contact' => $contact
        ],200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $user = Contacts::create([
                "nome" => $request->nome,
                "email" => $request->email,
                "telefone" => $request->telefone,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'contact' => $user,
                'message' => "Usuario Cadastrado"
            ],201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Contato não cadastrado"
            ],400);
        }
    }

    public function update(Request $request, Contacts $contact) : JsonResponse
    {
        DB::beginTransaction();

        try{
            $contact->update([
                "nome" => $request->nome,
                "email" => $request->email,
                "telefone" => $request->telefone,
            ]);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Contato não atualizado"
            ],400);
        }

        return response()->json([
            'status' => true,
            'user' => $request->contact,
            'message' => "Atualizado com sucesso"
        ],200);
    }

    public function destroy(Contacts $contact) : JsonResponse
    {
        DB::beginTransaction();

        try {
            $contact->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Contato deletado"
            ],200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Contato não deletado"
            ],400);
        }
    }
}
