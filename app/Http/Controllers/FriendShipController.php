<?php

namespace App\Http\Controllers;

use App\Services\FriendShipService;
use App\User;
use Illuminate\Http\RedirectResponse;

class FriendShipController extends Controller
{
    private FriendShipService $friendService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->friendService = new FriendShipService(auth()->user);
    }
    public function sendFriendRequest(int $id){
       // $user=auth()->user;
        $friend = User::find($id);
        $this->friendService->friendRequest($friend);
        return response()->json([
          "friend requested" => $friend->hasFriendRequestFrom(auth()->user),
           "with"=>$friend->id                     
        ]);
    }
    public function confirmOrDeny(int $senderId){
        $sender=User::find($senderId);
        $confirm=int($request->only("confirm"));
        $this->friendService($sender, $confirm)
        return response()->json([
          "confirmed" => auth()->user->isFriendWith($sender)                     
        ]);
    }
    
    
}
