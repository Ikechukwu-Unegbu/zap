<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthService
{
    /**
     * Authenticate user and retrieve token
     *
     * @param string $email
     * @param string $password
     * @return array
     */
    public function login(string $email, string $password): array
    {
        try {
            // Make an HTTP POST request to the authentication endpoint
            $response = Http::post('https://zlqr1c5l-3000.uks1.devtunnels.ms/auth/login', [
                'email' => $email,
                'password' => $password,
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(), // Return the JSON response from the endpoint
                ];
            }

            // Handle failed authentication or errors
            return [
                'success' => false,
                'message' => $response->json('message') ?? 'Authentication failed.',
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
