<?php  
include"admin-nav-array.php";
?>
   <li class="nav-item menu-open">
      <a href="<?=base_url(panel) ?>" class="nav-link active">
         <i class="nav-icon fas fa-tachometer-alt"></i>
         <p>
            Dashboard
         </p>
      </a>
   </li>
   <?php 
   if($this->session->userdata('id')!=2){
   foreach ($nav_array as $key => $value) { ?>
      <li class="nav-item">
         <a href="<?=base_url(panel.'/').$value['slug'] ?>" class="nav-link">
            <i class="<?=$value['icon'] ?>"></i>
            <p>
               <?=$value['name'] ?>
               <?php if(!empty($value['sub_menu'])){ ?><i class="fas fa-angle-left right"></i><?php } ?>
            </p>
         </a>
         <?php if(!empty($value['sub_menu'])){ ?>
            <ul class="nav nav-treeview">
               <?php  foreach ($value['sub_menu'] as $key2 => $value2) { ?>
               <li class="nav-item">
                  <a href="<?=base_url(panel.'/'.$value2['slug']) ?>" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p><?=$value2['name'] ?></p>
                  </a>
               </li>
               <?php } ?>
            </ul>
         <?php } ?>
      </li>
   <?php } 
   }
   
   ?>