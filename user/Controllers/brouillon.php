<?php

namespace User\Controllers;
use User\models\user;
use Core\Controller;
use Core\Table_MYSQL;
use Core\MYSQL_DB;


class Brouillon extends Controller
{
    public $tab;
    public $db;
    public function __construct(MYSQL_DB $db) {
        $this->db=new MYSQL_DB();
        $this->tab=new Table_MYSQL($this->db,'users');
        
    }
    public function brouillon(){
       
        //var_dump($this->tab->getAttributes());echo "<br/>";
        $this->tab->setFieldAttributes('username',['class'=>'form-control']); echo "<br/>";
        
        $this->tab->setFieldAttributes('password',['class'=>'form-control']); echo "<br/>";
        $this->tab->setFieldBlockAttributes('username',['class'=>'group']); echo "<br/>";
        $this->tab->setFieldBlockAttributes('password',['class'=>'group']); echo "<br/>";
        //var_dump($this->tab->getAttributes());echo "<br/>";
        //var_dump($this->tab->fieldForm['password']);
        //print_r($this->tab->fieldForm); echo "</pre>";
        $fields=$this->tab->getFieldForm();
        $form=$this->tab->getAddForm();
        $instance=$this->tab->getEditableForm(1);
        $groups=$this->tab->getFieldBlockForm();
        $attrs=$this->tab->attrs;
        $table=$this->tab->generateHtmlTable();
        return $this->view('brouillon',compact('fields','form','groups','instance','table'));
    }


}








