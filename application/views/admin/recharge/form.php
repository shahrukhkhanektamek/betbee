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



                                  <div class="form-group col-xl-4">
                                      <label>Select User *</label>
                                      <select class="form-control select2" required name="user_id">
                                          <option value="">Select</option>
                                          <?php 
                                          $users = $this->db->get_where("users",array("status"=>1,"role"=>2,"is_delete"=>0,))->result_object();
                                          foreach ($users as $key => $value) {
                                          ?>
                                            <option value="<?=$value->id ?>"><?=$value->fname.'('.$value->mobile.')' ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>

                                  <div class="form-group col-xl-4">
                                      <label>Select Type *</label>
                                      <select class="form-control select2" required name="type">
                                          <option value="">Select</option>
                                          <option value="1">Add</option>
                                          <option value="2">Deduct</option>                                            
                                      </select>
                                  </div>                                  

                                  <div class="form-group col-xl-4">
                                      <label>Amount *</label>
                                      <input class="form-control" type="number" required placeholder="Amount" name="amount" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Message</label>
                                      <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                  </div>


                                  


                                  




                                  <div class="mt-4">
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
            





