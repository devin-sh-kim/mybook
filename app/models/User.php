<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface{

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	protected $hidden = array('password');

    public function getReminderEmail()
    {
        return $this->email;
    }

}
?>