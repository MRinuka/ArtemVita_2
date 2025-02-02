<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Middleware\EnsureUserIsAdmin;  // Add this

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Apply the custom 'admin' middleware globally for admin routes
        $this->middleware(EnsureUserIsAdmin::class)->only([
            'productRequests', 'acceptProductRequest', 'declineProductRequest'
        ]);
    }
}