<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Club_model extends CI_Model
{


     /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function clubListingCount()
    {
        $this->db->select('BaseTbl.clubID , BaseTbl.name , BaseTbl.birthday , BaseTbl.city ,BaseTbl.email , BaseTbl.is_Actif ');
        $this->db->from('tbl_club as BaseTbl');
       
  

        
        
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function clubListing()
    {
        $this->db->select('BaseTbl.clubID , BaseTbl.name , BaseTbl.birthday , BaseTbl.city ,BaseTbl.email , BaseTbl.is_Actif , Users.name P , Users.avatar , Users.userId , Users.isDeleted , count(Users.userId) members ');
        $this->db->from('tbl_club as BaseTbl');
   

       $this->db->join('tbl_users as Users', 'Users.ClubID = BaseTbl.clubID', 'LEFT');
        $this->db->where('BaseTbl.is_Actif=','Actif') ;
        $this->db->group_by('BaseTbl.clubID') ;
      
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


/**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getClubInfo($clubID)
    {
        $this->db->select('BaseTbl.clubID , BaseTbl.name , BaseTbl.birthday , BaseTbl.city ,BaseTbl.email , BaseTbl.is_Actif ' );
        $this->db->from('tbl_club as BaseTbl');
        $this->db->where('BaseTbl.clubID', $clubID);
        $query = $this->db->get();
        
        return $query->row();
    }

     /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function BureauListing($clubID)
    {
        $this->db->select('BaseTbl.clubID , Users.userId , Users.name as Tname , Users.roleId role , Users.cellule , Users.avatar  ');
        $this->db->from('tbl_club as BaseTbl'); 
        $this->db->join('tbl_users as Users', 'Users.ClubID = BaseTbl.clubID', 'LEFT');

        $this->db->where('BaseTbl.clubID=',$clubID) ;
        $this->db->where('Users.clubId !=',0) ;
       $this->db->where('Users.roleId=1 or Users.roleId=2 or Users.roleId=3 or Users.roleId=6  ') ;
       

        $this->db->order_by('Users.roleId', 'ASC') ;
        
         $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }



   
}

  