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
                                 <input type="hidden" name="game_id" value="<?=$game_id ?>">

                                 <div class="form-group col-xl-6">
                                      <label>Select Game *</label>
                                      <select class="form-control select2" disabled>
                                          <option value="">Select</option>
                                          <?php 
                                          $users = $this->db->get_where("game",array("status"=>1,"is_delete"=>0,))->result_object();
                                          foreach ($users as $key => $value) {
                                            $selected = '';
                                               if($game_id==$value->id) $selected = 'selected';
                                          ?>
                                            <option <?=$selected ?> value="<?=$value->id ?>"><?=$value->name ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                                  <div class="form-group col-xl-6">
                                      <label>Select Game *</label>
                                      <select class="form-control select2" name="category_card_id">
                                          <option value="">Select</option>
                                          <?php 
                                          
                                          foreach (game_card_category() as $key => $value) {
                                            $selected = '';
                                            if(!empty($row))
                                               if($row->category_card_id==$key) $selected = 'selected';
                                          ?>
                                            <option <?=$selected ?> value="<?=$key ?>"><?=$value ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>


                                  


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
            





