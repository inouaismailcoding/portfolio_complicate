
<h2><?=isset($params['post'])? "Modifier un article":"Créer un article"  ?> </h2>

<div class="form-group">
<form action="<?= isset($params['post']) ? "/".HTDOCS."/admin/posts/edit/".$params['post']->id : "/".HTDOCS."/admin/posts/create/"?>" method="POSt">
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" value="<?= isset($params['post']->title)? $params['post']->title: "" ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" id="" rows="7" class="form-control"><?= isset($params['post']->content)?$params['post']->content: "" ?></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags de L'article</label>
        <select multiple name="tag[]" id="tags" class="form-control">
           <?php foreach($params['tags'] as $tag ): ?>
                <option value="<?= $tag->id; ?>"
                <?php if(isset($params['post']))
                {
                    foreach ($params['thisTag'] as $postTag) 
                        {echo ($tag->id==$postTag->id) ? 'selected': "";}
                }?>
                ><?= $tag->name; ?></option>
           <?php endforeach  ?>
        </select>
    </div>
    <button type="submit"class="btn btn-primary mt-2" name=""><?= isset($params['post'])? "Enregistrer les modifications":"Enregistrer nouveau Article" ?></button>
</form>
</div>
