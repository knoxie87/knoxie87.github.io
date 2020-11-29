<?php
require_once 'models/model.class.php';

class TeamController extends Model{
    public function _construct() {
        parent::_construct();
    }

    public function index(){
        $sql = 'SELECT distinct id, team, logo FROM teams order by team asc';
        $this->query($sql);
    }

    public function show($id){
        $sql = 'SELECT * from teams WHERE id = :id';
        $this->findOne($sql,$id);
    }
}
