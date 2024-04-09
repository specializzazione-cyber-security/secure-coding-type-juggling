<?php


namespace App\Modules\Http\Controller;

use PDO;
use DateTime;
use DateInterval;
use PDOException;
use Carbon\Carbon;
use App\Modules\App;
use App\Modules\Csrf;
use BadMethodCallException;
use App\Modules\Models\User;
use App\Modules\Http\Controller\BaseController;

class ProfileController extends BaseController{
    
    public function profilePage(){
        if(!isset($_SESSION['user'])){
            return view('errors/403');
        }

        return view('profile');
    }

    public function update(){
        if(!Csrf::checkForToken()){
            http_response_code(419);
            return view('errors/419');
        }
        
        $user = User::select('SELECT * FROM users WHERE email = ?', [$_SESSION['user']['email']]);

        $user->update([
            'email' => boolval($_POST['email']) ? $_POST['email'] : $user->email,
            'password' => boolval($_POST['password']) ? $_POST['password'] : $user->password,
        ]);

        $_SESSION['user'] = (array) $user;
        return redirect('/profile');
    }
}