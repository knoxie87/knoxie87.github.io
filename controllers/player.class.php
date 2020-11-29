<?php
require_once 'models/model.class.php';

class PlayerController extends Model{
    public function _construct(){
        parent::_construct();
    }
    public function byTeam($id){
        $arr = array('id'=>$id);
        $sql = 'SELECT * FROM players_teams_vw where team_id = :id LIMIT 30';
        $this->all($sql, $arr);
    }
    public function byPlayer($id){
        $arr = array('player_id'=>$id);
        $sql = 'SELECT player_id,image,team,position,age,height,name,weight FROM players_teams_vw where player_id =:id';
        $this->findOne($sql, $id);
    }
}