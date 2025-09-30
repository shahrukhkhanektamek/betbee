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
                                      <label>Title *</label>
                                      <input class="form-control" type="text" required placeholder="Game Name" value="<?php if(!empty($row))echo $row->name ?>" name="name" />
                                  </div>

                                  <div class="form-group col-xl-6">
                                      <label>Open Time *</label>
                                      <input class="form-control" type="time" required placeholder="Open Time" value="<?php if(!empty($row))echo $row->open_time ?>" name="open_time" />
                                  </div>

                                  <div class="form-group col-xl-6">
                                      <label>Close Time *</label>
                                      <input class="form-control" type="time" required placeholder="Close Time" value="<?php if(!empty($row))echo $row->close_time ?>" name="close_time" />
                                  </div>


                                    <div class="col-12 mb-3">
                                          <h3>Times</h3>
                                        
                                          <?php 
                                          if(!empty($row))
                                          {
                                             $times = json_decode($row->times);
                                          }
                                          $i = 0;
                                          foreach (days() as $key => $value) { ?>
                                             <div class="form-group row">
                                                <div class="col-2">
                                                    <label><?=$value ?> :</label>                                              
                                                </div>
                                                <div class="col-4">
                                                   <select class="form-control" name="days[]">
                                                      
                                                      <option value="1" <?php if(!empty($row)) if($times[$i]==1) echo 'selected'; ?> >Open</option>
                                                      <option value="2" <?php if(!empty($row)) if($times[$i]==2) echo 'selected'; ?> >Close</option>
                                                   </select>
                                                </div>
                                             </div>
                                          <?php $i++; } ?>


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
            





