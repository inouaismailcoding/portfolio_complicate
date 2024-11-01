<?php
namespace Core;

use Core\MYSQL_DB;


// La classe mere de tout les classes ******Controller


class Controller
{

    private $db;
    private $access_token = '3931b24572fb87';
    //Comme tout les enfants de controller auront besoin de la connection
    public function __construct(MYSQL_DB $db)
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
        //$this->db = new Model(new MYSQL_DB());
        $this->db=$db;
    }
    public function view(string $path, array $params = null)
    {
        // On commence par lancer le systeme de bevery 
        // les fonction de rappelle 
        ob_start();
        // on remplace les . par les directory_separator /
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        
        ob_clean();
        require VIEWS . $path . ".php";
        // On gere les vue qui ont un id en parametre

        $contents = ob_get_clean();
        require VIEWS . "layout.php";
    }
    public function getDB()
    {
        return $this->db;
    }
    protected function isConnect()
    {
        // On verifie si l'utilisateur est connecté ici il faudrait mettre ici les conditions de connexion
        if(isset($_SESSION['auth']) && $_SESSION['auth']==1){return true;}
        else{return header('location:'.HTDOCS.'/login');}
    }
    protected function isAdmin()
    {
        if($_SESSION['auth']==true){echo $_SESSION['role'];  }
    }

    
}


?>