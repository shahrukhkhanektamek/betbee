        </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="#"><?=website_name ?></a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
               <b>Version</b> 1.0
            </div>
         </footer>
         
      </div>
      <!-- ./wrapper -->



<div class="modal fade" id="deletemodal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">         
            <i class="fa fa-trash-alt"></i>
            <p>Are you sure to delete...</p>
         </div>   
         <div class="row m-0 modal-f">
            <div class="col-6">
               <button class="btn btn-danger" data-dismiss="modal" style="border-bottom-left-radius: 3px;">No</button>
            </div>
            <div class="col-6">
               <button class="btn btn-success done-btn" style="border-bottom-right-radius: 3px;">Yes</button>
            </div>
         </div>      
      </div>
   </div>
</div>




<div class="modal fade" id="withdrowPoints">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Withdraw Points</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="post" autocomplete="off">
               <div class="form-group">
                  <label>Withdraw Points</label>
                  <input type="number" name="pointsWithdwaw" value="" class="form-control" placeholder="Enter Points Here" required/>
               </div>
               <div class="form-group">
                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button class="btn btn-success" type="submit" name="WithdwawPoints">Submit</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--Add Points-->
<div class="modal fade" id="addPoint">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Add Points</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="post" autocomplete="off">
               <div class="form-group">
                  <label>Add Points</label>
                  <input type="number" name="pointsAdd" value="" class="form-control" placeholder="Enter Points Here" required />
               </div>
               <div class="form-group">
                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button class="btn btn-success" type="submit" name="AddPoints">Submit</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- big image modal -->
<div class="modal fade" id="bigimage">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <img src="<?=base_url('upload/default.jpg') ?>" id="b-image" style="width: 100%;">
         </div>
      </div>
   </div>
</div>


<!--Change M-Pin-->
<div class="modal fade" id="ChangeMpin">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Change M-Pin</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="post" autocomplete="off">
               <div class="form-group">
                  <label>M-Pin</label>
                  <input type="text" name="mPin" value="" pattern="[0-9]{4}" class="form-control" placeholder="Enter M-Pin Here" required/>
               </div>
               <div class="form-group">
                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button class="btn btn-success" type="submit" name="ChangeMpin">Submit</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>




      <!-- jQuery -->
      <!-- jQuery UI 1.11.4 -->
      <script src="<?=base_url() ?>assetsadmin/plugins/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="<?=base_url() ?>assetsadmin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- ChartJS -->
      <script src="<?=base_url() ?>assetsadmin/plugins/chart.js/Chart.min.js"></script>
      <!-- Sparkline -->
      <script src="<?=base_url() ?>assetsadmin/plugins/sparklines/sparkline.js"></script>
      <!-- JQVMap -->
      <!-- <script src="<?=base_url() ?>assetsadmin/plugins/jqvmap/jquery.vmap.min.js"></script> -->
      <!-- <script src="<?=base_url() ?>assetsadmin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
      <!-- jQuery Knob Chart -->
      <script src="<?=base_url() ?>assetsadmin/plugins/jquery-knob/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="<?=base_url() ?>assetsadmin/plugins/moment/moment.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="<?=base_url() ?>assetsadmin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <!-- Summernote -->
      <script src="<?=base_url() ?>assetsadmin/plugins/summernote/summernote-bs4.min.js"></script>
      <!-- overlayScrollbars -->
      <script src="<?=base_url() ?>assetsadmin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?=base_url() ?>assetsadmin/dist/js/adminlte.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?=base_url() ?>assetsadmin/dist/js/demo.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="<?=base_url() ?>assetsadmin/dist/js/pages/dashboard.js"></script>
      <!-- DataTables  & <?=base_url() ?>assetsadmin/Plugins -->
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/jszip/jszip.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/pdfmake/pdfmake.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/pdfmake/vfs_fonts.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="<?=base_url() ?>assetsadmin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <!-- Select2 -->
      <script src="<?=base_url() ?>assetsadmin/plugins/select2/js/select2.full.min.js"></script>



      <script src="<?=base_url() ?>toast/saber-toast.js"></script>
      <script src="<?= base_url('toast/script.js') ?>"></script>


      <script>
           $(document).on("click", ".big-img",(function(e) {
              $("#bigimage").modal("show");
              $("#b-image").attr("src",$(this).attr("src"));
           }));
           $(document).on("click", ".remove-btn",(function(e) {
              $(this).parent().remove();
           }));

          $(document).on("click", ".add-more-btn",(function(e) {
            e.preventDefault();
            var id = '';
            var this_btn = $(this);
            var url = $(this).data('url');
            var target = $(this).data('target');        
            $(this_btn).html("Wait..");
            $(this_btn).attr("disabled",true);
            $.ajax({
                url:url,
                type:"post",
                data:{id:id},
                success:function(d)
                {
                   // console.log(d);
                   $(target).before(d);
                   $(this_btn).html("Add More");
                   $(this_btn).attr("disabled",false);
                   // $(".select2").select2();
                },
                error: function(e) 
                 {
                 } 
            });
          }));        

            var path = window.location.href;
            $(".nav-link").removeClass("active");
            $(".nav-link").parent().removeClass("menu-open");
            $(".nav-link").each(function() {
                if (this.href === path) {
                    $(this).addClass("active");
                    $(this).parent().parent().parent().children('ul').css("display","block");
                    $(this).parent().parent().parent().addClass("menu-open");
                }
            });

            $(".ui-sortable").sortable();
            $(".upload-single-image").on('change', function(){
              var files = [];
              var j=1;
              var upload_div = $(this).data("target");
              var name = $(this).data('name');
              console.log(name);
              $( "."+upload_div ).empty();
              //iterate through the native DOM 'this' object, not jQuery $(this)
              
                for (var i = 0; i < this.files.length; i++)
                {
                    if (this.files && this.files[i]) 
                    {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                        var image_field="";
                        var image_field = image_field + `
                            
                            <div class="single-image-div "><input type="hidden" name="`+name+`" value="`+e.target.result+`"><img src="`+e.target.result+`" alt="img" style="width: 100px;"></div>
                            `;
                        $('.'+upload_div).append(image_field);
                        j++;
                    }
                    reader.readAsDataURL(this.files[i]);
                }
              }      
            });

            $('.select2').select2();
            $('.tags').select2({
              tags: true,
              tokenSeparators: ['||', '\n']
            });


        </script>
<script>
     $('#select-user1').select2({
       ajax: {
         url: "<?=base_url('home/select_user') ?>",
         method:"post",
         dataType:"json",
         data: function (params) {
           var query = {
             search: params.term,
             type: 'public'
           }
           return query;
         }
       }
     });
 </script>
     
   </body>
   
</html>
