<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Scores_model extends CI_Model
{


    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function RaitingClub()
    {
        $this->db->select('BaseTbl.score_clubID ,  BaseTbl.clubID , Clubs.name , sum(score) as scores ');
        $this->db->from('tbl_score_club as  BaseTbl');
        $this->db->join('tbl_club as Clubs', 'Clubs.clubID = BaseTbl.clubID','left');
        $this->db->order_by('scores', 'DESC');
        $this->db->group_by('Clubs.clubID'); 
        $this->db->limit(10);    
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function RaitingUsers()
    {
        $this->db->select('BaseTbl.ressourceID , Users.name , Users.avatar , Users.clubID ,   BaseTbl.userID , sum(score) as scores ');
        $this->db->from('tbl_ressource as  BaseTbl');
        $this->db->join('tbl_users as Users', 'Users.userId = BaseTbl.userID','left');
        $this->db->order_by('scores', 'DESC');
        $this->db->group_by('Users.userId');  
        $this->db->limit(10);  
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

     



   
}

  