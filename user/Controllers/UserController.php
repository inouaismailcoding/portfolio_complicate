<?php 

namespace User\Controllers;
use User\validation\validator;
use User\models\user;
use Core\Controller;
use Core\Logger;
use Core\CSRFProtection;
use stdClass;

class UserController extends Controller
{
    public function welcome(){
        return $this->view('welcome');
    }

    public function signUp()
    {
        $token=new  CSRFProtection();
        $csrf_token=$token->csrf_token();
        return $this->view('/auth/signUp',compact('csrf_token'));
    }

    public function signUpPost()
    {
        $csrf=new  CSRFProtection();
        $token = $_POST['csrf_token'] ?? '';

        if (!$csrf->verifyToken($token)) {
            die("Erreur : Le token CSRF est invalide ou a expiré.");
        }else{
            $user=new user($this->getDB());
       
        $result=$user->create($_POST);
        if($result){
           $user=(new user($this->getDB()))->getByUsername($_POST['username']);
           $this->setSessionInfo($user);
           $views="/".HTDOCS."?success=true";
           return header("location: {$views}");
        }
        }

        
    }

    public function login()
    {
        //$csrf_token=$_SESSION['csrf_token_input'];
        $token=new CSRFProtection();
        $csrf_token=$token->csrf_token();
        return $this->view('/auth/login',compact('csrf_token'));
    }

    
    public function loginPost(){
      
            $validator=new validator($_POST);
        $errors=$validator->validate([
            'username' => ['required','min:4'],
            'password' => ['required','min:4']
        ]); 
        if($errors)
        {
          
            $_SESSION['errors'][]=$errors;
           // $views=VIEWS."/admin/posts?success=true";
            header('location: /'.HTDOCS.'/login');
            exit;
        }
        $myUser= new user($this->getDB());
        $user=$myUser->getByUsername($_POST['username']);
        
        // On verifie le mot de passe
        if(password_verify(htmlspecialchars($_POST['password']),$user->password))
        {
            // On ajoute les informations des seesions
            $this->setSessionInfo($user);
            // On enregistre les informations de lutilisateur dans la table users_logins
            $myUser->recordLogin($user->id);

           // On redirige vers la page des post
           $views='/'.HTDOCS.'?success=true';
           return header("location:{$views}");

        }else{ header('location:/'.HTDOCS.'/login');}
        
        
    }

    public function createUser()
    {
        return $this->view('/admin/formUser');
    }

    public function editUser(INT $id)
    {
        $this->isConnect();
        // Ici on recupere les posts lié a un id
        $user=(new user($this->getDB()))->findById($id);       
        return $this->view('/admin/formUser',compact('user'));
    }

    public function viewUser(INT $id)
    {
        $this->isConnect();
        // Ici on recupere les posts lié a un id
        $User=(new user($this->getDB())); 
        $user=$User->findById($id);
        $lastLogin=$User->getLastLogin($id);   
        $loginHistory=$User->getLoginHistory($id); 
        $totalSession=$User->getTotalSessionTime($id);   
        return $this->view('/admin/viewUser',compact('user','lastLogin','loginHistory','totalSession'));
    }

    public function updateUser(INT $id)
        {
            $this->isConnect();
            $user=new user($this->getDB());
            
            $result=$user->update($_POST);
            
            if($result)
            {
                $views="/".HTDOCS."/admin?success=true&message=user n°:{$id} updated successfully";
                return header("location: {$views}");
                ;
            }

        }
        public function destroyUser(int $id)
        {
            $this->isConnect();
            // On efface la donnée selectionner via ID
            $post=new user($this->getDB());
            $result=$post->destroy($id);
            // On renvoi vers la page d'administration des Utilisaterurs
            if($result){
                $views="/".HTDOCS."/admin?success=true&message=user deleted Successfully !";
            return header("location: {$views}");
            }
        }

    
        public function listUser()
    {
        $user=new user($this->getDB());
        $users=$user->all();
        return $this->view('/admin/listUser',compact('users'));
    }


    public function createUserPost()
    {
        $user=new user($this->getDB());

        $result=$user->create($_POST);
        if($result){
           $views="/".HTDOCS."/admin?success=true";
           return header("location: {$views}");
        }

    }
    public function loginStaff(){ 
        return $this->view('/admin/loginStaff');
    }

    public function setSessionInfo(stdClass $user){
           $_SESSION['auth']=true;
           $_SESSION['id']=$user->id;
           $_SESSION['email']=$user->email;
           $_SESSION['role']=$user->role;
           $_SESSION['username']=$user->username;
           $_SESSION['password']=$user->password;
           //$_SESSION['level']=(INT) $user->level;
           $_SESSION['created_at']=$user->created_at;
    }

    public function loginStaffPost()
    {
        $validator=new validator($_POST);
        $errors=$validator->validate([
            'username' => ['required','min:4'],
            'password' => ['required','min:4']
        ]);
        
        if($errors)
        {
            $_SESSION['errors'][]=$errors;
            header('location: /'.HTDOCS.'/admin');
            exit;
        }


        $user=(new user($this->getDB()))->getByUsername($_POST['username']);
        //echo password_hash('admin',PASSWORD_BCRYPT);
        
        // On verifie le mot de passe
        if(password_verify($_POST['password'],$user->password))
        {
           // On ajoute les informations des seesions
            $this->setSessionInfo($user);
           // On redirige vers la page des post
           $views='/'.HTDOCS.'?success=true';
           return header("location:{$views}");

        }else{ header('location:/'.HTDOCS.'/admin');}
    }

    public function logout()
    {
        $User= (new user($this->getDB()))->recordLogout(htmlspecialchars($_SESSION['id']));
        session_unset();
        session_destroy();
        return header('location:/'.HTDOCS.'/');
    }

    public function dashboard()
    {
        $user=new user($this->getDB());
        $users=$user->all();
        return $this->view('dashboard',compact('users'));
    }
}




?>