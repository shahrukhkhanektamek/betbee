<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('template','database','session','parser','encryption');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','custom','file');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('Custom_model','Image_model');