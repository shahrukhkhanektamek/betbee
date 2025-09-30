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
                                      <label>Single Digit *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->single_digit ?>" name="single_digit" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Jodi Digit *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->jodi_digit ?>" name="jodi_digit" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Single Pana *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->single_pana ?>" name="single_pana" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Double Pana *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->double_pana ?>" name="double_pana" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Triple Pana *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->triple_pana ?>" name="triple_pana" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Half Sangam *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->half_sangam ?>" name="half_sangam" />
                                  </div>

                                  <div class="form-group col-xl-12">
                                      <label>Full Sangam *</label>
                                      <input class="form-control" type="number" required placeholder="Single Digit" value="<?php if(!empty($row))echo $row->full_sangam ?>" name="full_sangam" />
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
            





