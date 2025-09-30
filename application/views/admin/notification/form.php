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
                                      <label>Description *</label>
                                      <textarea class="form-control" name="description" required><?php if(!empty($row))echo $row->description ?></textarea>
                                      <!-- <script>CKEDITOR.replace( 'description' );</script> -->
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
            





