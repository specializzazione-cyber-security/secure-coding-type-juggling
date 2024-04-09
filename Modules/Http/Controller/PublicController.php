<?php


namespace App\Modules\Http\Controller;

use PDO;
use DateTime;
use PDOException;
use App\Modules\App;
use App\Modules\Csrf;
use BadMethodCallException;
use App\Modules\Http\Controller\BaseController;

class PublicController extends BaseController{
    
    public function login(){

        return view('login');
    }

    public function tryLogin(){
        
        if(!Csrf::checkForToken()){
            http_response_code(419);
            return view('errors/419');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        try{
            $user = $this->findUserByEmail($email);
        }
        catch(PDOException $e){
            echo "Errore nell'esecuzione della query: " . $e->getMessage();
            return false;
        }

        if(!$user){
            return redirect('/login');
        }

        if($user && $user['is_locked']){
            if($password !== $user['password']){
                return redirect('/login');
            }
        }
        
        if($user['secret_code'] !== $_POST['secret_code']){
            return redirect('/login');
        }

        try{
            $user = $this->findUser($email, $password);
        }
        catch(PDOException $e){
            echo "Errore nell'esecuzione della query: " . $e->getMessage();
            return false;
        }

        if($user && !$user['is_locked']){
            $this->_login($user, '/');
        } else {
            $message = date(DateTime::ATOM) . ",ACCESS DENIED," . $email . "\n";
            error_log($message, 3 , basePath("log.log"));
            LogController::checkForBruteForce($email);
            // error_log("Accesso Negato\n", 3 , basePath("log.log"));
            return redirect('/login');
        }
    }


    
    public function findUser($email,$password){
        $query = "select * from users where email=:email and password=:password limit 1";
        $db = App::$app->database->pdo;
        $sth = $db->prepare($query);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $password);
        $sth->execute();
        $data = $sth->fetchAll();
        
        return reset($data);
    }

    public function findUserByEmail($email){
        $query = "select * from users where email=:email limit 1";
        $db = App::$app->database->pdo;
        $sth = $db->prepare($query);
        $sth->bindParam(':email', $email);
        $sth->execute();
        $data = $sth->fetchAll();
        
        return reset($data);
    }

    public function _login($user, $uri){
        
        $_SESSION['user'] = $user;
        return redirect($uri);
    }


    public function logout(){
        App::$app->regenerateSession();
        return redirect('/');
    }
}