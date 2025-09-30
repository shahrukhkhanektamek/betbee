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


                                  <div class="form-group col-xl-12" style="display: none;">
                                      <label>Title *</label>
                                      <input class="form-control" type="text" placeholder="Title" value="<?php if(!empty($row))echo $row->name ?>" name="name" />
                                  </div>


                                  <div class="form-group col-xl-12">
                                    <label>Image</label>
                                    <?php
                                      $file_data = array(
                                          "position"=>1,
                                          "columna_name"=>"image",
                                          "multiple"=>false,
                                          "accept"=>'image/*',
                                          "col"=>"col-md-4",
                                          "alt_text"=>"none",
                                          "row"=>$row,
                                      );
                                      $this->load->view('upload-multiple/index',$file_data);
                                    ?>
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
            





