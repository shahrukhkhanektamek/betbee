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


                                  <div class="form-group col-xl-6" style="display:none;">
                                      <label>Name *</label>
                                      <input class="form-control" type="text" placeholder="Name" value="<?php if(!empty($row))echo $row->name ?>" name="name" />
                                  </div>
                                  <div class="form-group col-xl-6" style="display:none;">
                                      <label>Ticket Price *</label>
                                      <input class="form-control" type="number" placeholder="Ticket Price" value="<?php if(!empty($row))echo $row->price ?>" name="price" />
                                  </div>
                                  <div class="form-group col-xl-3">
                                      <label>Type *</label>
                                      <select class="form-control" name="type">
                                         <option value="1" <?php if(!empty($row))if($row->type==1)echo 'selected'; ?> >Sec</option>
                                         <option value="2" <?php if(!empty($row))if($row->type==2)echo 'selected'; ?>>Minute</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-xl-3">
                                      <label>Total Duration *</label>
                                      <input class="form-control" type="number" required placeholder="Ticket Price" value="<?php if(!empty($row))echo $row->total_minute ?>" name="total_minute" />
                                  </div>
                                  <div class="form-group col-xl-3">
                                      <label>Type *</label>
                                      <select class="form-control" name="type2">
                                         <option value="1" <?php if(!empty($row))if($row->type2==1)echo 'selected'; ?> >Sec</option>
                                         <option value="2" <?php if(!empty($row))if($row->type2==2)echo 'selected'; ?>>Minute</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-xl-3">
                                      <label>Stop Before Duration *</label>
                                      <input class="form-control" type="number" placeholder="Ticket Price" value="<?php if(!empty($row))echo $row->stop_before_minute ?>" name="stop_before_minute" />
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
            





