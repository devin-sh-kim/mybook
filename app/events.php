<?php

Event::listen('user.login', function($user) {
    $user->last_login = new DateTime;
    $user->save();
});

?>