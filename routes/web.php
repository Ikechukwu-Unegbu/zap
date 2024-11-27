<?php

use App\Http\Controllers\BuildingVerificationController;
use App\Http\Controllers\ProfileController;
use App\Services\AuthService;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Route;

Route::get('/call', function(){
    // var_dump(env('PAYSTACK_SECRET'));DIE;
    $service = new AuthService();
    $response = $service->login('samsmith22@gmail.com', '1234567890');
    $jwtToken = $response['data']['data']['accessToken'];

    $propService = new PropertyService();
    // dd($jwtToken);


    $searchParameters = [
        // 'document_name' => 'document name',
        'approval_number' => 'lag-1234567',
        // 'organization_name' => 'organization name',
        // Add other parameters as needed
    ];

    // Call the service
    $response = $propService->searchDocuments($searchParameters);

    // Return the response
    return response()->json($response);
});

Route::get('/', [BuildingVerificationController::class, 'index']);
Route::get('/verification-success', [BuildingVerificationController::class, 'success'])->name('verification.initiate');
Route::post('/verify', [BuildingVerificationController::class, 'initiateVerification'])->name('verify');
Route::get('/details/{transactionRef}', [BuildingVerificationController::class, 'details'])->name('more');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
