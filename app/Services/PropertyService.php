<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PropertyService
{

    public function getToken()
    {
        $service = new AuthService();
        $response = $service->login('samsmith22@gmail.com', '1234567890');
        $jwtToken = $response['data']['data']['accessToken'];
        return $jwtToken;
    }
   
     /**
     * Search for documents using specified parameters.
     *
     * @param array $searchParameters
     * @param string $jwtToken
     * @return array
     */
    public function searchDocuments(array $searchParameters): array
    {
        try {
            // Make a GET request to the document search endpoint
            $response = Http::withToken($this->getToken())
                ->get('https://zlqr1c5l-3000.uks1.devtunnels.ms/documents/search', $searchParameters);
            // dd($response->body());
            // Check if the request was successful
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            // Handle failure responses
            return [
                'success' => false,
                'message' => $response->json('message') ?? 'Failed to search documents.',
                'status_code' => $response->status(),
            ];
        } catch (\Exception $e) {
            // Handle exceptions
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
