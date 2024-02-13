<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        try {
            return Tool::OrderBy('id', 'desc')->get();
            } catch (\Exception $e) {
                Log::error('Erro ao buscar ferramentas: ' . $e->getMessage());
                return response()->json(['error' => 'Erro ao buscar vagas: ' . $e->getMessage()], 500);
            }
    }

    public function show($id)
    {
        try {
            return Tool::find($id);
            } catch (\Exception $e) {
                Log::error('Erro ao buscar ferramentas: ' . $e->getMessage());
                return response()->json(['error' => 'Erro ao buscar vagas: ' . $e->getMessage()], 500);
            }
    }

    public function store(Request $request)
    {
        try {
            $tool = new Tool();
            $tool->fill($request->all());
            $tool->save();
            return response()->json($tool, 201);
        } catch (\Exception $e) {
            Log::error('Erro ao salvar vaga: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao salvar vaga: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $tooltoupdate = Tool::findOrFail($id);
            $tooltoupdate->fill($request->all());
            $tooltoupdate->save();
            return response()->json($tooltoupdate, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao editar tool: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao editar tool: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $tool = Tool::findOrFail($id);
            $tool->delete();
            return response()->json(null, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao deletar tool: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao deletar tool: ' . $e->getMessage()], 500);
        }
    }

    public function handleToolRequest(Request $request)
    {
        try {
            if ($request->has('tag')) {
                $tag = $request->input('tag');
                $tools = Tool::whereJsonContains('tags', [$tag])->get();
                return response()->json($tools);
            } else {
                return $this->index();
            }
        } catch (\Exception $e) {
            Log::error('Erro ao processar requisição de ferramentas: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao processar requisição de ferramentas: ' . $e->getMessage()], 500);
        }
    }
}
