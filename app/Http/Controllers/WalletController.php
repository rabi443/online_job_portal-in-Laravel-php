<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    public function getWalletBalance(): JsonResponse
    {
        $user = Auth::user();
        $employer = $user->employer;
    
        if ($employer && $employer->wallet) {
            return response()->json(['wallet_balance' => $employer->wallet->wallet_balance]);
        }
    
        return response()->json(['wallet_balance' => 0.00]);
    }
}
