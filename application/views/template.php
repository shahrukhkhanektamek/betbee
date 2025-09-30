<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    if ($this->session->userdata('id')){ ?>
        <!-- include your header view here -->
        <?php $this->load->view('admin/headers/header'); ?>
        <?= $contents ?>
        <!-- include your footer view here -->
        <?php $this->load->view('admin/headers/footer'); ?>
    <?php }else {
	   $this->load->view('admin/login');
    } ?>