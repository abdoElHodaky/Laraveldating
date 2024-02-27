<?php

namespace App\Services;

use App\User;

class FriendShipService
{
  User $user;
  public function __construct(User $user){
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
  public function removeFriend(User $friend){
      $this->user->unfriend($friend);
  }
  private function confirmFriend(User $sender){
      $user->acceptFriendRequest($sender);
  }
  private function denyFriend(User $sender){
      $user->denyFriendRequest($sender);
  }
  public function confirmOrdenyFriend(User $sender,$confirm=1){
      if ($confirm==1){
          confirmFriend($sender);
      }
      else{
          denyFriend($sender);
      }
  }
public function blockOrUnblock(User $friend,$block=0){
    if($block==1){
        $this->user->blockFriend($friend);
    }
    else{
        $this->user->unblockFriend($friend);
    }
}
public function getFriends(){
   return $this->user->getAllFriendships();
}
    
}
