<?php if(!empty($row))$row = $row[0];else $row = array(); ?>
            <section class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="card card-primary">
                           <div class="card-header">
                              <h3 class="card-title"><?=$page_title ?>
                              </h3>
                           </div>
                           <div class="card-body">
                             
                             
                             
                              <form class="form_data row" method="post" enctype="multipart/form-data" action="<?=base_url($submit_url) ?>" id="form1" novalidate>

                                <?php  
                                $game_card = $this->db->get_where("card",array("is_delete"=>0,))->result_object();
                                foreach ($game_card as $key => $value) {
                                ?>
                                  <input type="hidden" name="card_id[]" value="<?=$value->id ?>">
                                  <div class="form-group col-xl-12">
                                      <label><?=$value->name ?> *</label>
                                      <input class="form-control" type="number" placeholder="<?=$value->name ?>" value="<?=$value->win_price ?>" name="win_price[]" />
                                  </div>
                                <?php } ?>

                                  

                                  <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Save</button>
                                      <a href="<?=base_url($back_btn) ?>" class="btn btn-link">Cancel</a>
                                  </div>
                              </form>
                              
                             
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            





