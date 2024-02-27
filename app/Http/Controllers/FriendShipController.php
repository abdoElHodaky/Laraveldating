<?php

namespace App\Http\Controllers;

use App\Services\FriendShipService;
use App\User;
use Illuminate\Http\RedirectResponse;

class FriendShipController extends Controller
{
    private FriendShipService $friendService;

    public function __construct(FriendShipService $friendService)
    {
        $this->middleware('auth');
        $this->friendService = $reactionService;
    }

    
    
}
