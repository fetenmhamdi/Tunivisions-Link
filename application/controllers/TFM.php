<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



class TFM extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('notification_model');
        $this->load->model('club_model');
        $this->load->model('tfm_model');
        $this->isLoggedIn();   
    }
    

		public function TFMListing()
		        {
		        		 
		                $searchText='' ;
		                $data['tfmRecords'] = $this->tfm_model->TFMListing();
		                $data['tfmpartRecords'] = $this->tfm_model->TFMPListing($this->vendorId);
		                $this->global['pageTitle'] = 'CodeInsect : club  Listing';
		             	$this->global['active'] = 'TFM';
		                $this->loadViews("TFM/list", $this->global, $data, NULL);   
		        }


		public function partant()
		        {		
		        	$data['auto'] =  $this->club_model->getClubInfo($this->clubID) ;
		                $searchText='' ;
		                $data['tfmRecords'] = $this->tfm_model->TFMListing();
		                $this->global['pageTitle'] = 'CodeInsect : club  Listing';
		             	$this->global['active'] = 'TFM';
		                $this->loadViews("TFM/new", $this->global, $data, NULL);   
		        }


		public function partanTfm (){

				//club
				if($this->role == 1 || $this->SA==1  ){
				$date = $this->input->post('dateFonde');
				$email = $this->input->post('email');
				$facebook = $this->input->post('facebook');

				$clubInfo = array(
		          'facebook'=>$email,
		          'email'=>$facebook,
		          'birthday'=>$date ,

		        );

				$resultC = $this->club_model->editclub($clubInfo, $this->clubID) ; 
				}
				//user
				$annee = $this->input->post('annee');
				$userInfo = array(
		          'affectedYear'=>$annee 
		        );
				$resultU = $this->user_model->editUser($userInfo, $this->vendorId);
			
				//tfm
				$moto = $this->input->post('bus');
				$sys = $this->input->post('sys');
			

				$partanTfm = array(
		          'tfmId'=>'6',
		          'dateInscrip'=>date('Y-m-d H:i:s'),
		          'userId'=>$this->vendorId ,
		          'statut'=>2 ,
		          'moto'=> $moto ,
		          'sysMobile'=> $sys ,
		        );

		         $result = $this->tfm_model->addNewPartTFM($partanTfm) ;

		        if($this->input->post('TFMS') > 0 ){
			        foreach ($this->input->post('TFMS') as $TFM ) {
				        $partanTfm = array(
				          'tfmId'=>$TFM,
				          'dateInscrip'=>date('Y-m-d H:i:s'),
				          'userId'=>$this->vendorId ,
				          'statut'=>1 ,
				          'moto'=> $moto ,
				          'sysMobile'=> $sys ,
				        );
					 $this->tfm_model->addNewPartTFM($partanTfm) ;
		       	 	}
		   		 }
				
		if ( $result){	
		   			redirect('TFM/TFMListing') ; 		
		   }
		
		}

		

}