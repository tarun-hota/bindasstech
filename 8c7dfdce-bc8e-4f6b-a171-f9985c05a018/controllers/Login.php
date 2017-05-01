<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Ganadeb
 */
class Login extends CI_Controller{
    public $body_data;
    private $resource_data;
    public function __construct(){
        parent::__construct();
        $this->body_data=[];
        $this->resource_data=FALSE;
    }

    /*public function _rationingLoginIndex() {
        if($this->session->userdata('ISLOGIN')  ) :
                redirect(URL.$this->session->userdata('REDIRECT_URL').'dashboard');
        else:
                $this->body_data['title']='Rationing System | Login';
                $this->load->view('login/login',$this->body_data,FALSE);
        endif;
    }*/

    /**
     * Index view / Default view\
     *
     */
    public function _rationingLoginIndex() {
        if($this->session->userdata('ISLOGIN')) :
            redirect(URL.$this->session->userdata('REDIRECT_URL').'dashboard');
        else:
            $this->body_data['title']='Rationing System | Login';
            $this->load->view('login/login',$this->body_data,FALSE);
        endif;
    }

    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_rationingLogin'.ucfirst($method)))
            {
                $this->{"_rationingLogin".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }

    }
    public function _rationingLoginChecklogindata()
    {
        if($this->input->post('loginSubmit'))
        {
            $this->form_validation->set_rules('username','Login Id','required|xss_clean');
            $this->form_validation->set_rules('password','Password','required|xss_clean');
            if($this->form_validation->run()===FALSE)
            {
                 $this->index();
            }
            else {
                 $this->load->model("login_model");
                 if($this->login_model->checkLoginData())
                 {
                     $this->dataarray['login_data']=$this->login_model->data_resource->row();
                     if($this->dataarray['login_data']->user_status==1)
                     {
                        $this->session->set_userdata('ISLOGIN',TRUE);
                        $this->session->set_userdata('LOGINID',$this->dataarray['login_data']->userid);
                        $this->session->set_userdata('DISPLAYNAME',$this->dataarray['login_data']->loginid);
                        $this->session->set_userdata('USERTYPE',$this->dataarray['login_data']->user_type);
                        $this->login_model->fetchUserData($this->dataarray['login_data']->userid,$this->dataarray['login_data']->user_type);
                        $this->dataarray['user_data']=$this->login_model->data_resource?$this->login_model->data_resource->row():FALSE;
                        if($this->dataarray['user_data'])
                        {

                            $this->session->set_userdata('FULLNAME',  ucwords(str_replace('~',' ',$this->dataarray['user_data']->user_full_name)));
                            $this->session->set_userdata('CONTACTNO',str_replace('~','/',$this->dataarray['user_data']->user_contact_no));
                            $this->session->set_userdata('EMAIL',$this->dataarray['user_data']->user_email);
                            $this->session->set_userdata('USERTYPECODE',$this->dataarray['user_data']->short_code);
                            $this->session->set_userdata('USERTYPENAME',  ucwords($this->dataarray['user_data']->user_type_name));
                            $this->session->set_userdata('EMPLOYEEORCUSTNO',$this->dataarray['user_data']->employee_or_cust_id);
                            $this->session->set_userdata('USERLABELORDER',$this->dataarray['user_data']->user_level_order);
                            $this->session->set_userdata('USERPROPIC',$this->dataarray['user_data']->user_profile_pic);
                            $this->session->set_userdata('USERGENDER',$this->dataarray['user_data']->gender);
                            $this->session->set_userdata($this->dataarray['login_data']->userid,  time()+3600);
                            //save action data message                        
                            $this->action_data['action_log_message']="Login successfull by user id : ".$this->dataarray['login_data']->userid;
                            $this->action_data['action_functionality']='login';
                            $this->action_data['last_modify_by']=$this->session->userdata('LOGINID');                        
                            $this->saveActionLog('login_model');
                            $this->session->set_userdata('USERLASTACCESSTIME',$this->login_model->getLastAccessTime());
                            redirect(URL.$this->session->userdata('REDIRECT_URL').'dashboard'); 
                        }
                        
                     }
                     else if($this->dataarray['login_data']->user_status==0)
                     {   
                        //save action data message
                        $this->action_data['action_log_message']="Try login by blocked user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been blocked.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==2)
                     {  
                         //save action data message
                        $this->action_data['action_log_message']="Try login by temporary suspended user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been temporary suspended.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==3)
                     {
                        //save action data message
                        $this->action_data['action_log_message']="Try login by suspended user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been suspended.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==4)
                     {
                        //save action data message
                        $this->action_data['action_log_message']="Try login by deleted user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model'); 
                        $this->session->set_userdata('LOGINMSG','Your account has been deleted from our list.For more information please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                 }
                 else
                 {
                    //save action data message
                    $this->action_data['action_log_message']="Try login by user login id : ".$this->input->post('username')." And password:".$this->input->post('password');
                    $this->action_data['action_functionality']='login';
                    $this->saveActionLog('login_model'); 
                    $this->session->set_userdata('LOGINMSG','Mismatch username and Password');
                    redirect('login');
                 }
            }
        }else
        {
            redirect('login', 'refresh');
        }
    }

    /**
     * Login ajax
     *
     * @param username (request data)
     * @param password (request data)
     *
     * @return otp (int)
     */
    public function _rationingLoginChecklogin() {
        // get ajax post data
        if (!$this->input->post('username') || !$this->input->post('password')) {
            throw new Exception("Request data not found",404);
        }

        // load login model
        $this->load->model('Loginmodel');

        // user check login by accessing model
        if ($this->Loginmodel->checkLogin()) {
            // generate random number for otp
            $otp = random_string('numeric', 4);

            // set session data to use after otp enter
            $this->session->set_userdata('user_uuid', $this->Loginmodel->data_resource->row()->user_uuid);
            $this->session->set_userdata('otp', $otp);

            // send email for otp
            sendMailOtp($this->Loginmodel->data_resource->row()->email_id, $otp);

            echo $otp;
        }

    }

    /**
     * OTP check ajax after login
     *
     * @param otp (request data)
     *
     * @return (string) success
     */
    public function _rationingLoginOtpcheck() {
        // get ajax post data
        if (!$this->input->post('otp')) {
            throw new Exception("Request data not found",404);
        }

        // check intput otp with session otp
        if (isset($this->session->userdata['otp'])
            && $this->session->userdata['otp'] == $this->input->post('otp')
            && isset($this->session->userdata['user_uuid'])) {

            // get user details from login model and set user details into session
            $this->load->model('Loginmodel');
            if ($this->Loginmodel->getUserDetails($this->session->userdata['user_uuid'])) {

                // set session data
                $this->session->set_userdata('ISLOGIN', TRUE);
                $this->session->set_userdata('LOGIN_ID', $this->Loginmodel->data_resource->row()->login_id);
                $this->session->set_userdata('DISPLAY_NAME', $this->Loginmodel->data_resource->row()->display_name);
                $this->session->set_userdata('USER_TYPE_ID', $this->Loginmodel->data_resource->row()->id);
                $this->session->set_userdata('USER_TYPE_NAME', $this->Loginmodel->data_resource->row()->user_type);
                $this->session->set_userdata('EMAIL_ID', $this->Loginmodel->data_resource->row()->email_id);
                $this->session->set_userdata('USER_CODE', $this->Loginmodel->data_resource->row()->user_code);
                $this->session->set_userdata('SHORT_CODE', $this->Loginmodel->data_resource->row()->short_code);
                $this->session->set_userdata('REDIRECT_URL', $this->Loginmodel->data_resource->row()->redirect_url);
                $this->session->set_userdata('FIRST_NAME', $this->Loginmodel->data_resource->row()->first_name);
                $this->session->set_userdata('LAST_NAME', $this->Loginmodel->data_resource->row()->last_name);
                $this->session->set_userdata('MIDDlE_NAME', $this->Loginmodel->data_resource->row()->middle_name);
                $this->session->set_userdata('ADDRESS', $this->Loginmodel->data_resource->row()->address);
                $this->session->set_userdata('STATE', $this->Loginmodel->data_resource->row()->state);
                $this->session->set_userdata('CITY', $this->Loginmodel->data_resource->row()->city);
                $this->session->set_userdata('COUNTRY', $this->Loginmodel->data_resource->row()->country);
                $this->session->set_userdata('PINCODE', $this->Loginmodel->data_resource->row()->pincode);
                $this->session->set_userdata('CONTACT_NO', $this->Loginmodel->data_resource->row()->contact_no);

                // unset previous session data which is inserted before entering otp
                $this->session->unset_userdata['user_uuid'];
                $this->session->unset_userdata['otp'];

                echo 'success';
            }
        }
    }

    /**
     * Logout and unset session datA
     */
    public function _rationingLoginLogout() {
        $this->session->sess_destroy();
        echo 'success';
    }
}
