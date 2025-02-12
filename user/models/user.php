<?php 
namespace User\models;
use Core\Model;
use PDO; use Exception;
use ipinfo\ipinfo\IPinfo;


class user extends Model
{
    public $table='users';
    private $access_token = '3931b24572fb87';
    
    public function getByUsername(string $username)
    {
        return $this->executeQuery("SELECT * FROM {$this->table} WHERE username=?",[$username],true)->data;
    }

    public function create(array $data)
    {
        return $this->save_row($this->table,$data);
    }

    public function all()
    {
        return $this->fetchTable($this->table);
    }

    public function findById($id){
        return $this->get($this->table,$id)[0];
    }
    public function update($data){
        return $this->save_row($this->table,$data);
    }
    public function destroy($id){
        return $this->destroy_row($this->table,$id);
    }
        // Fonction pour récupérer la dernière connexion
    public function getLastLogin($userId) {
        $stmt = $this->conn->getConnection()->prepare("SELECT login_time, logout_time, session_duration FROM user_logins WHERE user_id = ? ORDER BY login_time DESC LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
        // Fonction pour récupérer l'historique des connexions
        public function getLoginHistory($userId) {
            $stmt = $this->conn->getConnection()->prepare("SELECT login_time, logout_time, session_duration, ip_address, mac_address, location FROM user_logins WHERE user_id = ? ORDER BY login_time DESC");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Calcul du temps total passé connecté
        public function getTotalSessionTime($userId) {
            $stmt = $this->conn->getConnection()->prepare("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(session_duration))) AS total_time FROM user_logins WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['total_time'];
        }
    
        // Récupérer les transactions d'un utilisateur
        public function getUserTransactions($userId) {
            $stmt = $this->conn->getConnection()->prepare("SELECT transaction_details, transaction_time FROM user_transactions WHERE user_id = ? ORDER BY transaction_time DESC");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Enregistrer une connexion
        public function recordLogin($userId) {
            $ip = $this->getUserIP();
            $location = $this->getUserLocation();
            $stmt = $this->conn->getConnection()->prepare("INSERT INTO user_logins (user_id, ip_address, location) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $ip, $location]);
        }
    
        // Enregistrer une déconnexion et calculer la durée de la session
        public function recordLogout($userId) {
            $stmt = $this->conn->getConnection()->prepare("
                UPDATE user_logins 
                SET logout_time = NOW(), 
                    session_duration = TIMEDIFF(NOW(), login_time) 
                WHERE user_id = ? AND logout_time IS NULL
            ");
            $stmt->execute([$userId]);
        }
        
    // Récupérer l'adresse IP de l'utilisateur
    public function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
        
   
            
    public function getUserLocation() {
        $ip = $this->getUserIP();
        $client = new IPinfo($this->access_token);
        $ip_address = $ip;
        $location = $client->getDetails($ip_address);

        //echo $location->city; // Mountain View
        //echo $location->loc; // 37.4056,-122.0775
        var_dump($location);
        // Vérification IP locale
        
        if ($ip === '127.0.0.1' || strpos($ip, '192.168.') === 0) {
            return 'Lieu inconnu (IP locale)';
        }
        return isset($location->city) ? $location->country. ', '.$location->city. ', ' . $location->loc : 'Lieu inconnu localhost';
    }

    
}