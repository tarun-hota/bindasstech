<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_validation
 *
 * @author Ganadeb
 * @copyright	Copyright gdfstechnology pvt ltd
 * @copyright	Copyright gdfstechnology pvt ltd
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	
 * @since	Version 1.0.0
 * @filesource
 */
class My_Form_validation  extends CI_Form_validation{
    public function __construct($rules = array()) {
        parent::__construct($rules);
    }    
    public function alpha_space($data_string=NULL)
    {        
        return (bool) preg_match('/^[A-Z\s ]+$/i', $data_string);
    }
    
}
