<?php 
if(!empty($row))$row = $row[0];else $row = array();
?>

<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">


         <div class="col-6">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">User Details</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                     <img src="<?=base_url('upload/'.$row->profile_image) ?>" alt="user" class="img-thumbnail" style="display: block;margin: 0 auto;">
                  </div>
                  <div class="comment-widgets scrollable">
                     <div class="d-flex flex-row">
                        <table class="table table-bordered mt-3">
                           <tr>
                              <th>User Status</th>
                              <td class="text-center">
                                 <a href="#"><span class="badge badge-success">Yes</span></a>
                              </td>
                           </tr>
                           <tr >
                              <th>Betting Status</th>
                              <td class="text-center">
                                 <a href="#"><span class="badge badge-danger">No</span></a>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class=" text-center">
                        <h2 style="color:#999">Wallet Balance</h2>
                        <h3>
                           6
                           <b style="color:green; font-size:15px;">Points</b>
                        </h3>
                        <div class="comment-footer">
                           <a href="#addPoint" data-toggle="modal" class="btn btn-success btn-md">Add Points</a>
                           <a href="#withdrowPoints" data-toggle="modal" class="btn btn-danger btn-md">Withdraw Points</a>
                        </div>
                     </div>
                  </div>                  
               </div>
            </div>
         </div>
         <div class="col-6 pb-3">
            <div class="card card-primary" style="height: 100%;">
               <div class="card-header">
                  <h3 class="card-title">Personal Information</h3>
               </div>
               <div class="card-body">
                  <table class="table table-bordered personalInfo">
                     <tbody>
                        <tr>
                           <th>Full Name</th>
                           <td><?=$row->fname.' '.$row->lname ?></td>
                        </tr>
                        <tr>
                           <th>Email</th>
                           <td><?=$row->email ?></td>
                        </tr>
                        <tr>
                           <th>Mobile Number</th>
                           <td><?=$row->mobile ?></td>
                        </tr>
                        <tr>
                           <th>Password</th>
                           <td><?=$row->password ?></td>
                        </tr>
                        <tr>
                           <th>Registration Date</th>
                           <td><?=date("d M Y",strtotime($row->date_time)) ?></td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="text-center mb-4 mt-4">
                     <div class="comment-footer pt-3">
                        <a href="https://api.whatsapp.com/send?phone=91<?=$row->mobile ?>" target="_blank" class="btn btn-success btn-md">WhatsApp</a>
                        <a href="tel:+91 <?=$row->mobile ?>" target="_blank" class="btn btn-danger btn-md">Call</a>
                     </div>
                  </div>                 
               </div>
            </div>
         </div>

         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Payment Information</h3>
               </div>
               <div class="card-body">
                  <table class="table table-bordered paymentInfo">
                     <tbody>
                        <tr>
                           <th>Account Holder Name</th>
                           <td><?=$row->holder_name ?></td>
                           <th>Account Number</th>
                           <td><?=$row->account_no ?></td>
                        </tr>
                        <tr>
                           <th>IFSC Code</th>
                           <td><?=$row->ifsc_code ?></td>
                           <th>UPI</th>
                           <td><?=$row->upi_id ?></td>
                        </tr>
                     </tbody>
                  </table>                
               </div>
            </div>
         </div>


         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Withdwaw Points Requests</h3>
               </div>
               <div class="card-body">
                  <table id="withdraw_e" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>S. No.</th>
                           <th>Points</th>
                           <th>Request No.</th>
                           <th>Date</th>
                           <th>Status</th>
                           <th>View</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>               
               </div>
            </div>
         </div>


         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Bid History</h3>
               </div>
               <div class="card-body">
                  <table id="example" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>S. No.</th>
                           <th>Game Name</th>
                           <th>Game Type</th>
                           <th>Digits</th>
                           <th>Points</th>
                           <th>Date</th>
                           <th>Placed on</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>              
               </div>
            </div>
         </div>

         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Wallet History</h3>
               </div>
               <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#walletAll" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All</span></a> </li>
                     <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#walletCredit" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Credit</span></a> </li>
                     <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#walletDebit" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Debit</span></a> </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content tabcontent-border">
                     <div class="tab-pane active" id="walletAll" role="tabpanel">
                        <table id="walletAllTable" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>S. No.</th>
                                 <th>Points</th>
                                 <th>Transaction Note</th>
                                 <th>Date</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                     <div class="tab-pane  p-20" id="walletCredit" role="tabpanel">
                        <table id="walletCreditTable" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>S. No.</th>
                                 <th>Points</th>
                                 <th>Transaction Note</th>
                                 <th>Date</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                     <div class="tab-pane p-20" id="walletDebit" role="tabpanel">
                        <table id="walletDebitTable" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>S. No.</th>
                                 <th>Points</th>
                                 <th>Transaction Note</th>
                                 <th>Date</th>
                                 <th>TXN ID</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>            
               </div>
            </div>
         </div>





         
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!--Withdrawal Points-->








