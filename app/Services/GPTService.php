<?php

namespace App\Services;

use GuzzleHttp\Client;

class GPTService
{

    protected $client;
    protected $baseUrl = 'https://api.openai.com/v1';
    protected $secretKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->secretKey = env('OPENAI_API_KEY');
    }


    public function getEmoji($keyword)
    {
        try {
            $response = $this->client->post('https://api.openai.com/v1/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->secretKey,
                ],
                'json' => [
                    'model' => 'text-davinci-003',
                    'prompt' => "suggest me a closely relative emoji for $keyword",
                    'temperature' => 0,
                    'max_tokens' => 256,
                    'top_p' => 1,
                    'frequency_penalty' => 0,
                    'presence_penalty' => 0,
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            $completion = trim(stripcslashes($result['choices'][0]['text']));
            $pattern = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F1E0}-\x{1F1FF}\x{1F191}-\x{1F251}\x{1F004}\x{1F0CF}\x{1F170}-\x{1F171}\x{1F17E}-\x{1F17F}\x{1F18E}\x{3030}\x{2B50}\x{2B55}\x{2934}-\x{2935}\x{2B05}-\x{2B07}\x{2B1B}-\x{2B1C}\x{3297}\x{3299}\x{303D}\x{00A9}\x{00AE}\x{2122}\x{23F3}\x{24C2}\x{23E9}-\x{23EF}\x{25B6}\x{23F8}-\x{23FA}]/u';
            preg_match_all($pattern, $completion, $matches);
            $emoji = $matches[0][0];
            return $emoji ?? false;
        } catch (\Exception $e) {
            return '📄';
        }
    }
}
