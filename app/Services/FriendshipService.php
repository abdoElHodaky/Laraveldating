<?php

namespace App\Services;

use App\User;

class FriendShipService
{
  User $user;
  public  __construct(User $user){
    $this->user=$user;
  }
 /* public function friend(User $friend){
    $this->friend=$friend;
    return $friend;
  }*/
  public function friendRequest (User $friend){
     // $user->acceptFriendRequest($sender);
    $this->user->befriend($friend);
  }
  public function block(User $friend){
      $this->user->unblockFriend($friend);
  }
  public function removeFriend(User $friend){
      $this->user->unfriend($friend);
  }
  public function confirmFriend(User $sender){
      $user->acceptFriendRequest($sender);
  }
  public function denyFriend(User $sender){
      $user->denyFriendRequest($sender);
  }
    
}
