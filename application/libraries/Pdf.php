<?php
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Pdf extends FPDF{
    public function __construct()
    {
        parent::__construct();
    }
}