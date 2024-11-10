<?php

namespace Core;
class CSRFProtection
{
    // Durée de validité du token en secondes (par exemple, 1 heure)
    private $tokenExpiry = 3600;

    // Constructeur pour démarrer une session si elle n'est pas déjà démarrée
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            
        }
        $this->generateToken();
        $_SESSION['csrf_token_input']=$this->csrf_token();
    }

    // Génère un token CSRF
    public function generateToken()
    {
        if (empty($_SESSION['csrf_token']) || $this->isTokenExpired()) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Génère un token sécurisé
            $_SESSION['csrf_token_time'] = time(); // Enregistre l'heure de génération du token
        }
        return $_SESSION['csrf_token'];
    }

    // Vérifie le token CSRF
    public function verifyToken($token)
    {
        if (empty($token) || empty($_SESSION['csrf_token'])) {
            return false; // Le token est vide ou non défini
        }

        if ($this->isTokenExpired()) {
            $this->clearToken(); // Nettoie le token s'il est expiré
            return false;
        }
        $result=hash_equals($_SESSION['csrf_token'], $token);
        return $result==1? true:false; // Compare de manière sécurisée
    }

    // Vérifie si le token est expiré
    private function isTokenExpired()
    {
        if (empty($_SESSION['csrf_token_time'])) {
            return true; // Pas d'heure de génération, considéré comme expiré
        }
        return (time() - $_SESSION['csrf_token_time']) > $this->tokenExpiry;
    }

    // Nettoie le token CSRF de la session
    public function clearToken()
    {
        unset($_SESSION['csrf_token']);
        unset($_SESSION['csrf_token_time']);
    }

    public function csrf_token(){
        return "<input type='hidden' name='csrf_token' value='".$this->generateToken()."'>";
    }
}
?>
