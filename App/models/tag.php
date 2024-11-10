<?php
    
    namespace App\models;
    use Core\Model;

    class tag extends Model

    {
        public $table='tags';

        public function all()
        {
            return $this->fetchTable($this->table);
        }
        public function create($data)
        {
            return $this->save_row($this->table,$data);
        }
        public function update($id,$data)
        {
            return $this->update_row($this->table,$id,$data);
        }
        public function destroy($id)
        {
            return $this->destroy_row($this->table,$id);
        }
        public function findById($id)
        {
            parent::get($this->table,$id);
        }

        public function getPost($id)
        {
            return $this->query('
            SELECT p.* FROM posts p INNER JOIN post_tags pt ON pt.id_posts=p.id WHERE pt.id_tags=?',[$id])  ;
        }
        
    }



?>