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
                                      <label>First Name *</label>
                                      <input class="form-control" type="text" required placeholder="First Name" value="<?php if(!empty($row))echo $row->fname ?>" name="fname" />
                                  </div>

                                  <div class="form-group col-xl-4">
                                      <label>Last Name *</label>
                                      <input class="form-control" type="text" required placeholder="Last Name" value="<?php if(!empty($row))echo $row->lname ?>" name="lname" />
                                  </div>

                                  <div class="form-group col-xl-4">
                                      <label>Email </label>
                                      <input class="form-control" type="text"  placeholder="Email" value="<?php if(!empty($row))echo $row->email ?>" name="email" />
                                  </div>

                                  <div class="form-group col-xl-6">
                                      <label>Mobile *</label>
                                      <input class="form-control" type="text" required placeholder="Last Name" value="<?php if(!empty($row))echo $row->mobile ?>" name="mobile" />
                                  </div>

                                  <div class="form-group col-xl-6">
                                      <label>Password *</label>
                                      <input class="form-control" type="text" required placeholder="Password" value="<?php if(!empty($row))echo $row->password ?>" name="password" />
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
            





