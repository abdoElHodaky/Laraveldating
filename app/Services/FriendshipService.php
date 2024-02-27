<?php

namespace App\Services;

use App\User;

class FriendShipService
{
  User $user;
  User $friend;
  public  __construct(User $user){
    $this->user=$user;
  }
  public function friend(User $friend){
    $this->friend=$friend
  }
  public function addFirend(){
      
  }
  public function block(){
      
  }
  public function removeFriend(){
      
  }
    
}
