<?php
    
    namespace App\models;
    use Core\Model;
    use DateTime;

    class Post extends Model

    {
        public $table='posts';

        public function all()
        {
            return $this->fetchTable($this->table);
        }
        public function create(array $data,?array $relation=null)
        {
            $data['author']=$_SESSION['id'];
            $result=$this->save_row($this->table,$data);
            

            if(isset($result['success'])){
                $id=$this->conn->lastInsertRow();
                // On enregistre les nouveaux tags
                foreach ($relation as $tagId) {
                    $stmt=$this->conn->getConnection()->prepare('INSERT INTO post_tags(id_posts,id_tags)VALUES(?,?);');
                    $stmt->execute([$id,$tagId]);
                }
                return true;
            }else{return false;}


        }
        public function findById($id){
            return $this->get($this->table,$id)[0];
        }

        public function update($id,$data,?array $relation=null){
            $result=$this->update_row($this->table,$id,$data);
            if(isset($result->success)){
                // On supprime les anciens tags
                $res=$this->executeQuery('DELETE FROM post_tags WHERE id_posts=?',[$id]);
                if(isset($result->success)){
                    // On enregistre les nouveaux tags liés au posts
                foreach ($relation as $tagId) {
                    $stmt=$this->conn->getConnection()->prepare('INSERT INTO post_tags(id_posts,id_tags)VALUES(?,?);');
                    $stmt->execute([$id,$tagId]);
                }
                
                }
                return true;
            }else{return false;}
        }

        public function getTags($id){
            // On fais une requete de jointure
            $req="SELECT t.* FROM tags t INNER JOIN post_tags pt ON pt.id_tags=t.id WHERE pt.id_posts=?;";
            return $this->executeQuery($req,[$id])->data;
        }

        public function destroy($id){
            $result=$this->delete_row($this->table,$id);
            if (isset($result->success)) {
                $res=$this->executeQuery('DELETE FROM post_tags WHERE id_posts=?',[$id]);
                return isset($res->success) ? true : false;
            }
            
        }

    }



?>