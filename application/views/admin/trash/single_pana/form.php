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


                                  <div class="form-group col-xl-12">
                                      <label>Select Digit *</label>
                                      <select class="form-control select2" name="number1">
                                         <?php 
                                         $select = $this->db->get_where("single_digit")->result_object();
                                         foreach ($select as $key => $value) {
                                            echo '<option value="'.$value->number.'">'.$value->number.'</option>';
                                         }
                                         ?>
                                      </select>
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Value *</label>
                                      <input class="form-control" type="number" placeholder="Value" value="<?php if(!empty($row))echo $row->number2 ?>" name="number2" />
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
            





