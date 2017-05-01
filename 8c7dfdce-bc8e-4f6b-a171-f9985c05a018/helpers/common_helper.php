<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!function_exists('generateUUID'))
{
    function generateUUID() 
        {
            return isValidUUID(sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    // 32 bits for "time_low"
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

                    // 16 bits for "time_mid"
                    mt_rand( 0, 0xffff ),

                    // 16 bits for "time_hi_and_version",
                    // four most significant bits holds version number 4
                    mt_rand( 0, 0x0fff ) | 0x4000,

                    // 16 bits, 8 bits for "clk_seq_hi_res",
                    // 8 bits for "clk_seq_low",
                    // two most significant bits holds zero and one for variant DCE1.1
                    mt_rand( 0, 0x3fff ) | 0x8000,

                    // 48 bits for "node"
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
                ));
        }
}
if(!function_exists('isValidUUID'))
{
    function isValidUUID($uuid)
    {
            return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
                  '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1?$uuid:generateUUID();
    }
}
if(!function_exists('checkExistsUUID'))
{
    function checkExistsUUID($table,$fieldname,$uuid)
    {
        try{
            if(empty($table) || $table==NULL || empty($fieldname) || $fieldname==NULL || empty($uuid) || $uuid==NULL )
                throw new Exception("Error encounter for check in uuid");
            $ci=& get_instance();
            $ci->load->database();
            $ci->db->select('tag_name')->from($table)->where($fieldname,$uuid);
            $res_data=$ci->db->get();
            if($res_data->num_rows()>0)
            {            
               if($res_data->num_rows()>0)
               {
                  return FALSE;
               }
               return TRUE;
            }
            return FALSE;
        }  catch (Exception $ex)
        {
            echo die('{error:{'.$ex->getMessage().'},errorcode:{4501258}}');
        }
    }
}

/**
 *
 */
if (!function_exists('sendMailOtp')) {
    function sendMailOtp($to, $otp) {
        $CI =& get_instance();

        // config data for local server
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'info@bindasstech.com', // change it to yours
            'smtp_pass' => '*****', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        // Load email library for localhost and live server
        if ($_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            $CI->load->library('email', $config);
        } else {
            $CI->load->library('email');
        }

        $CI->email->from($CI->config->item('fromEmail'), 'Bindasstech');
        $CI->email->to($to);

        $CI->email->subject('OTP For Login Access');
        $CI->email->message('Your OTP is '. $otp);

        $CI->email->send();
    }
}

/**
 * Authentication to check session data is set or not and successfully logged in or not
 * This method should be called from constructor method from all controller
 * If user try to access different page by typing in url should be redirected to dashboard page
 *
 */
if (!function_exists('checkAuthentication')) {
    function checkAuthentication() {
        $CI =& get_instance();
        if (!$CI->session->userdata('ISLOGIN')) {
            redirect(base_url() . 'login');
        } else {
            // get current url
            $current_url = base_url(uri_string());

            // redirect to user specific dashboard if user tries to access other user's functionality by typing in url
            if ($CI->session->userdata('USER_TYPE_ID') == 1) { // for super admin
                if (strpos($current_url, base_url() . 'admin') === false) {
                    redirect(base_url() . '' . $CI->session->userdata('REDIRECT_URL'));
                }
            } elseif ($CI->session->userdata('USER_TYPE_ID') == 2) {
                if (strpos($current_url, base_url() . 'distributor') === false) {
                    redirect(base_url() . '' . $CI->session->userdata('REDIRECT_URL'));
                }
            } else {}
        }
    }
}