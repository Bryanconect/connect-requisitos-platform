<?php

namespace App\Services;

use App\Models\Models\ModelHistoria;
use Illuminate\Support\Facades\Http;

class InsightsService
{
    protected $historiaModel;

    public function __construct(ModelHistoria $historiaModel)
    {
        $this->historiaModel = $historiaModel;
    }

    public function gerarInsightsParaHistoria($id)
    {
        $historia = $this->historiaModel->find($id);

        if (!$historia) {
            return ['success' => false, 'message' => 'História não encontrada'];
        }

        $insights = $this->analisarHistoria($historia);

        $insightsJson = json_encode($insights, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $atualizado = $this->historiaModel->where('id', $id)->update([
            'insights' => $insightsJson,
        ]);

        return ['success' => (bool) $atualizado];
    }

    private function analisarHistoria($historia)
    {
        $insights = [];

        if (strlen($historia->necessidade) < 20) {
            $insights[] = ['message' => 'A necessidade está muito vaga, por favor, forneça mais detalhes.'];
        }

        if (stripos($historia->necessidade, 'erro') !== false || stripos($historia->necessidade, 'problema') !== false) {
            $insights[] = ['message' => 'Cuidado com a redundância de palavras como "erro" ou "problema", que podem ser vagas.'];
        }

        if (strlen($historia->necessidade) <= 50) {
            $insights[] = ['message' => 'A descrição da necessidade está muito curta. Considere detalhar mais a funcionalidade.'];
        }

        if (stripos($historia->necessidade, 'aceitação') === false) {
            $insights[] = ['message' => 'Falta definição clara de critérios de aceitação. Verifique se todos os critérios estão definidos.'];
        }

        if (empty($insights)) {
            $insights[] = ['message' => 'Nenhum insight relevante encontrado. Certifique-se de que a história esteja bem definida.'];
        }

        return $insights;
    }

    // Caso queira reativar uso de OpenAI futuramente
    public function chamarOpenAI($prompt)
    {
        $apiKey = env('OPENAI_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'Você é um assistente especialista em análise de requisitos de software.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

        if ($response->successful()) {
            return $response->json()['choices'][0]['message']['content'] ?? 'Sem resposta gerada.';
        }

        return 'Erro ao se comunicar com a API da OpenAI.';
    }
}
