<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->where('email', '=', 'admin@ujacha.net')->delete();

        $password   = Hash::make('@m6admin@');

        User::create(array(
                'email' => 'admin@ujacha.net', 
                'password' => $password,
                'username' => 'Mybook Admin',
                ));
    }

}

?>
