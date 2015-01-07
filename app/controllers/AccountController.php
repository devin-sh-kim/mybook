<?php

class AccountController extends BaseController 
{

    public function login()
    {
        
        $email      = Input::get('email');
        $password   = Input::get('password');
        $remember   = Input::get('remember');
        
        if( $remember != ''){
            $remember = true;
        }else{
            $remember = false;
        }
        
        if (Auth::attempt(array('email' => $email, 'password' => $password), $remember)){
            $event = Event::fire('user.login', array(Auth::user()));
            
            return Redirect::to('/');
        }else{
            return Redirect::guest('login/error');
        }
        
    }

    /**
     * Email 이 사용 가능한지 확인
     */
    public function checkEmailExist()
    {
        $email      = Input::get('email');
        $results    = DB::select('select * from users where email = ?', array($email));
        
        $isValid    = true;
        
        if(count($results) > 0){
            $isValid = false;    
        }
        
        return Response::json(array('valid' => $isValid));
    }

    public function createAccount(){
        
        $email      = Input::get('email');
        $password   = Hash::make(Input::get('password'));
        $username   = Input::get('username');
        
        //var_dump($input);
        $user           = new User;
        $user->email    = $email;
        $user->password = $password;
        $user->username = $username;
        
        $results        = DB::select('select * from users where email = ?', array($email));
        
        if(count($results) == 0){
            $user->save();
            return Response::json(array('result' => true));
        }else{
            return Response::make("Exist Email : " . $mail, 400);
        }
    }
}
?>