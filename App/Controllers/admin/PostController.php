<?php 
    namespace App\Controllers\admin;
    use Core\Controller;
    use App\models\Post;
    use App\models\tag;
    use LDAP\Result;

    class PostController extends Controller
    {
        public function index()
        {
            $this->isConnect();
            $this->isAdmin();
            // On recupere tout les posts
            $posts=(new Post($this->getDB()))->all();
            // On return la page admin.post.index
            // La page d'accueil d'administration des publications
            return $this->view('blog.articles',compact('posts'));    
            
        }
        public function create()
        {
            $this->isConnect();
            $tags=(new tag($this->getDB()))->all();
            return $this->view('admin.post.form',compact('tags'));
        }
        public function createPost()
        {
            $this->isConnect();
            $post=new Post($this->getDB());
            $tags=array_pop($_POST);

            $result=$post->create($_POST,$tags);
            if($result){header("location:/".HTDOCS."/blog/");}


        }
        public function edit(INT $id)
        {
            $this->isConnect();
            // Ici on recupere les posts lié a un id
            $post=(new Post($this->getDB()))->findById($id);
            $thisTag=(new Post($this->getDB()))->getTags($id);
             // Ici on recupere les tags lié a un id
            $tags=(new tag($this->getDB()))->all();
           

            return $this->view('admin.post.form',compact('post','tags','thisTag'));

        }
        public function update(INT $id)
        {
            $this->isConnect();
            $post=new Post($this->getDB());
            $tags=array_pop($_POST);
            
            $result=$post->update($id,$_POST,$tags);
            
            if($result)
            {
                header ("Location:/".HTDOCS."/blog");
            }

        }
        public function destroy(int $id)
        {
            $this->isConnect();
            // On efface la donnée selectionner via ID
            $post=new Post($this->getDB());
            $result=$post->destroy($id);
            // On renvoi vers la page d'administration des posts
            if($result){return header("Location:/".HTDOCS."/admin/posts");}
        }
    }