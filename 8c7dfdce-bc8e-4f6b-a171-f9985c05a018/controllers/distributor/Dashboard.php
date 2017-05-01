<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Ganadeb
 */
class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        checkAuthentication();
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_rationingDashboard'.ucfirst($method)))
            {
                $this->{"_rationingDashboard".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }
    public function _rationingDashboardIndex(){
        $this->body_data['title']='Rationing System | Distributor Dashboard';
        $this->body_data['session_data'] = $this->session->userdata();

        // load views
        $this->load->view('distributor/include/header', $this->body_data, FALSE);
        $this->load->view('distributor/templates/dashboard', $this->body_data, FALSE);
        $this->load->view('distributor/include/footer', $this->body_data, FALSE);
    }
}
