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

                                  <div class="form-group col-xl-6">
                                      <label>Bet *</label>
                                      <input class="form-control" type="number" required placeholder="Bet" name="bet" value="<?=$row->bid ?>" />
                                  </div>                          

                                  <div class="form-group col-xl-6">
                                      <label>Amount *</label>
                                      <input class="form-control" type="number" required placeholder="Amount" name="amount" value="<?=$row->amount ?>" />
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
            





