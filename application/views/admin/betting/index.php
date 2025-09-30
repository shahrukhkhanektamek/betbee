<?php if(!empty($row))$row = $row[0];else $row = array(); ?>

                 <style>
.win_number {
text-align: center;
    padding: 8px 0 0 0;
    color: white;
    display: block;
    /*position: absolute;*/
    top: 0;
    left: 0;
    width: 40px;
    height: 40px;
    box-shadow: 0px 0px 3px rgb(0 0 0 / 50%);
    border-radius: 50%;
    margin: 0 auto;
}
.in-div {
        width: 65px;
    height: 65px;
    margin: 0 auto;
    display: block;
    position: relative;
}

.win-popup-number {
    position: relative;
    color: white;
    width: 60px;
    display: block;
    text-align: center;
    height: 60px;
    /* font-size: 40px; */
    border-radius: 50%;
    margin: 0 auto;
}
.in-div > div {
    width: 100%;
    height: 100%;
}
.in-div .win_number {
    font-size: 35px;
}
.in-div > span {
    width: 100% !important;
    height: 100% !important;
    font-size: 35px !important;
}
.number-color-btn li {
    display: inline-block;
    /*background: #A90041;*/
    color: white;
/*    padding: 2px 10px;*/
    margin-bottom: 10px;
    border-radius: 3px;
    cursor: pointer;
}
.number-color-btn.green li
{
    /*background: #15971A;*/
}
.win_numbers li {
    margin-left: 5px;
}
.numbers {
    text-align: center;
    background: #15971a;
    color: white;
    font-weight: 800;
    border-radius: 4px;
    padding: 10px 0;
    cursor: pointer;
    margin: 0 0 10px 0;
    position: relative;
}
.numbers i {
    position: absolute;
    top: -10px;
    right: -10px;
    background: white;
    font-size: 16px;
    height: 25px;
    width: 25px;
    text-align: center;
    align-items: center;
    border-radius: 50%;
    display: none;
    color: black;
    border: 2px solid black;
}
.numbers.active i {
    display: grid;
}
.best-user {
    border: 1px solid #dee2e6;
    padding: 10px 10px;
    border-radius: 5px;
}
.join-violet.numbers.active i {
    border-color: #8c3bbd;
}
.join-red.numbers.active i {
    border-color: #fa1414;
}
.select-numbers-modal {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: white;
    z-index: 999999;
    padding: 15px 0;
    display: none;
}
.select-numbers-modal.active {
    display: flex;
}
.select-numbers-modal .number-color-btn {
    margin: 0 auto;
    padding: 0;
}
.select-numbers-modal .number-color-btn li {
    margin-left: 5px;
}
.breadcrumb {
    margin: 0 !important;
}
.numbers.active {
    /*background: black;*/
}
.number-color-btn {
    margin: 0 auto;
    padding: 0;
}
.sspp11, .sspp55 {
    font-weight: 800;
}
.sspp11 span, .sspp55 span {
    font-weight: 500;
}

.join-black, .join-violet, .join-red {
    width: 90px;
    background: gray;
    display: inline-block;
    padding: 20px 0;
    margin: 0 auto;
    color: white !important;
    border-radius: 5px;
    box-shadow: -3px 3px 4px 0px rgba(0, 0, 0, 0.25);
}
.color-button img {
    height: 60px !important;
    display: block;
    margin: 0 auto;
}
.p_id_type {
    background: gray;
    width: 50px;
    height: 50px;
    display: grid !important;
    margin: 0 auto;
    border-radius: 50%;
    color: white;
    text-align: center !important;
    align-items: center;
    font-weight: 800;
    font-size: 20px;
}

.join-violet {
    background: #8C3BBD;
}
.join-black {
    background: #000000;
}
.join-red {
    background: #FA1414;
}
.color-button {
    display: block;
}
.game-total-bet b {
    width: 100%;
    display: block;
}






</style>

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
                 
                 


                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                                <div class="row" style="margin: 0;">

                                   
                                        
                                    <div class="row" style="width:100%">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success" onclick="live_session_id()">Live</button>
                                        </div>
                                        <div class="col-4">
                                            <h2 style="margin: 0;letter-spacing: 2px;font-weight: 900;text-align: center;font-size: 35px;"><?=$game_name ?></h2>
                                        </div>
                                        <div class="col-4" style="text-align: right;">                                            
                                            <button type="button" onclick="get_about_to_win()" class="btn btn-success"><i class="fa fa-redo"></i></button>
                                        </div>
                                        <ul class="number-color-btn green win_numbers">
                                            
                                        </ul>
                                    </div>

                                                                      


                                    <div class="row" style="width:100%">
                                        <div class="col-md-4">
                                            <span  class="sspp11" style="font-size: 15px;float: left;">Total bet amount: Rs. 
                                            <span class="sspp22" id="total_bet_amount">Wait..</span></span>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="hh11" style="font-weight: 700;text-align: center;margin-top: 0px;font-size: 16px;margin-bottom: 0;width: 100%;">You have to pay in this session: Rs. <spa id="have_to_pay">Wait..</spa></h3>                        
                                        </div>
                                        <div class="col-md-4">
                                            <span class="sspp55" style="font-size: 15px;float: right;margin-right: 0;">Total P & L amount: Rs. 
                                            <span class="sspp66" id="total_profit">Wait..</span></span>
                                        </div>
                                    </div>


                                    <h4 style="text-align: center;margin-top: 15px;width: 100%;">
                                      <span class="sspp33">(<?=$session_id ?>)</span><br>
                                      <span>Remening Time: </span><span class="sspp44" id="mint-count">Wait..</span><br>
                                      <span>Betting Time: </span><span class="sspp44" id="mint-count2">Wait..</span>
                                    </h4>

                                    <div class="card-body-table row" style="width: 100%;margin: 0;">

                                        <div class="col-md-4 text-center">
                                            <button class="btn join-black color-button numbers" data-number="1">
                                                <i class="fa fa-check"></i>
                                                <img src="<?=base_url() ?>assets/icons/f1.png">
                                                Join Black
                                            </button>
                                            <span class="game-total-bet "><b>Total Bet Amount</b> <span  id="blackcolorbet">0</span></span>
                                        </div>

                                        <div class="col-md-4 text-center">
                                            <button class="btn join-violet color-button numbers" data-number="2">
                                                <i class="fa fa-check"></i>
                                                <img src="<?=base_url() ?>assets/icons/f1.png">
                                                Join Violet
                                            </button>
                                            <span class="game-total-bet"><b>Total Bet Amount</b> <span  id="bluecolorbet">0</span></span>
                                        </div>

                                        <div class="col-md-4 text-center">
                                            <button class="btn join-red color-button numbers" data-number="3">
                                                <i class="fa fa-check"></i>
                                                <img src="<?=base_url() ?>assets/icons/f1.png">
                                                Join Red
                                            </button>
                                            <span class="game-total-bet"><b>Total Bet Amount</b> <span  id="redcolorbet">0</span></span>
                                        </div>
                                            
                                    </div>

                                    <button type="button" class="btn btn-success submit-manual" style="margin: 0 auto;margin-top: 15px;">Submit</button>   


                     
                                <h1 style="display: block;width: 100%;text-align: center;margin-top: 18px;">Bettings</h1>
                                <?php
                                foreach ($list as $key => $row)
                                {
                                ?>
                                    <div class="mb-4 text-center col-md-3">
                                        <div class="best-user">
                                            <ul class="number-color-btn green" style="margin: 0;padding: 0;">
                                                <?php foreach (explode(",", $row->p_id) as $key2 => $value) {
                                                    $class = '';
                                                    if($value==1) $class = 'join-black';
                                                    if($value==2) $class = 'join-violet';
                                                    if($value==3) $class = 'join-red';
                                                 ?>
                                                    <li><span class="p_id_type <?=$class ?>"></span></li>
                                                <?php } ?>
                                            </ul>
                                            <div class="shopowner-dt-left">
                                                <h4>Name: <?=$row->name ?></h4>
                                                <h4>User ID: <?=$row->user_id ?></h4>
                                                <h4>Amount: <?=$row->bet_amount ?></h4>
                                                <h4>
                                                    <?php if($row->win_amount>0){ ?>
                                                        <span style="color: green;font-size: 25px;font-weight: 500;">WIN</span>
                                                    <?php }else{ ?>
                                                        <span style="color: red;font-size: 25px;font-weight: 500;">LOSE</span>
                                                    <?php } ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>


                                </div>
                            
                        </div>
                    </div>


                    <div class="select-numbers-modal row" style="margin: 0;">
                        <button type="button" class="btn btn-danger close-modal" style="margin: 0px 0px 0px auto;margin-top: -15px !important;">Close</button>
                        <div class="row col-12" style="margin: 0;">
                            <ul class="number-color-btn green">
                                <li data-number="33">33</li>
                            </ul>
                        </div>
                        <div class="col-12" style="text-align: center;">
                            <button type="button" class="btn btn-success submit-manual">Submit</button>        
                        </div>
                    </div>


                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
            






<script>

function live_session_id()
{
    var game_id = <?=$game_id ?>;
    var form = new FormData();
    form.append("game_id", game_id);
    var settings = {
      "url": "<?=base_url('admin/'.$controller_name.'/live_session_id') ?>",
      "method": "POST",
      "dataType": "json",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data":form
    };

    $.ajax(settings).done(function (response) {
      var uri = "<?=base_url('admin/'.$controller_name.'/index/') ?>"+response.session_id+"/<?=$game_id ?>";
      window.location.href=uri;
    });
}

<?php
$iddd = $session_id+1;
?>
    type = 1;
    var win_number2 = 0;
    function next_uri(type)
    {
        var uri = "<?=base_url('admin/'.$controller_name.'/index/'.$iddd.'/'.$game_id) ?>";
        if(type==2)
            window.location.href=uri;
    }
    function msToTime(duration)
    {
      var milliseconds = Math.floor((duration % 1000) / 100),
        seconds = Math.floor((duration / 1000) % 60),
        minutes = Math.floor((duration / (1000 * 60)) % 60),
        hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;
      return minutes + ":" + seconds;
    }
    function timer(duration,type)
    {
        var interval = setInterval(function() {
            $("#mint-count").html(msToTime(duration));
            duration = duration-1000;
            if(duration>=0)
                type = 2;
            if(duration<=0)
            {   
                next_uri(type);
                clearInterval(interval);
                $("#mint-count").html("done");
            }
        }, 1000);
    }
    function timer2(duration,type)
    {
        var interval2 = setInterval(function() {
            $("#mint-count2").html(msToTime(duration));
            duration = duration-1000;
            if(duration>=0)
                type = 2;
            if(duration<=0)
            {   
                clearInterval(interval2);
                $("#mint-count2").html("Over");
            }
        }, 1000);
    }
    function get_about_to_win()
    {
        $("#total_profit").html("Wait...");
        $("#total_bet_amount").html("Wait...");
        $("#have_to_pay").html("Wait...");        
        var session_id = <?=$session_id ?>;
        var game_id = <?=$game_id ?>;
        $.ajax({
            url:"<?=base_url('admin/'.$controller_name.'/amount_detail') ?>",
            type:"post",
            data:{session_id:session_id,game_id:game_id},
            success:function(d)
            {
                var result_data = JSON.parse(d);
                console.log(result_data);
                if(result_data.status==200)
                {
                    $('.numbers').removeClass("active");
                    var data = result_data.data;
                    win_number2 = data.win_numbers[1];
                    var win_numbers = [data.win_numbers[0]];
                    var win_numbers_html = '';

                    $("#blackcolorbet").html(data.blackbet);
                    $("#bluecolorbet").html(data.bluebet);
                    $("#redcolorbet").html(data.redbet);

                    $(win_numbers).each(function(index, item){
                        var num = String(item);

                        classs = '';
                        classs_text = '';
                        if(item=='1')
                        {
                            classs = 'join-black';
                            classs_text = 'Join Black';
                        }
                        if(item=='2')
                        {
                            classs = 'join-violet';
                            classs_text = 'Join Violet';
                        } 
                        if(item=='3') 
                        {
                            classs = 'join-red';
                            classs_text = 'Join Red';
                        }

                        win_numbers_html = win_numbers_html + `<li data-number="`+item+`">
                            <button class="btn  `+classs+` color-button" data-p_id="1">
                                <img src="<?=base_url('assets/icons/f1.png') ?>">
                                `+classs_text+`
                            </button>
                        </li>`;
                        $(".numbers[data-number='"+num+"']").addClass('active');
                    });
                    $(".win_numbers").html(win_numbers_html);
                    $("#total_bet_amount").html(data.bet_total_amount);
                    $("#have_to_pay").html(data.win_total_amount);
                    $("#total_profit").html(data.profit_loss_amount);   
                    selected_winning_numbers();             
                }
            },
            error: function(e) 
            {
            } 
        });
    }

    $(document).on("click", ".close-modal",(function(e) {
        $(".select-numbers-modal").removeClass("active");
    }));

    $(document).on("click", ".numbers",(function(e) {
        var numbers = $(".numbers.active");
        $('.numbers').removeClass("active");
        // $(".select-numbers-modal").addClass("active");
        if($(this).hasClass("active"))
        {
            // $(this).removeClass("active");
        }
        else
        {
            if($(numbers).length>=7)
            {
                alert("You already select 7 numbers...");
                return false;
            }
            $(this).addClass("active");
        }
        selected_winning_numbers();    
    }));
    $(document).on("click", ".submit-manual",(function(e) {
        e.preventDefault();
        var numbers = $(".numbers.active");
        // if($(numbers).length!=7)
        // {
        //     alert("Select 7 numbers...");
        //     return false;
        // }
        var session_id = <?=$session_id ?>;
        var game_id = <?=$game_id ?>;
        selected_numbers.push(win_number2);
        $.ajax({
            url:"<?=base_url('admin/'.$controller_name.'/manual') ?>",
            type:"post",
            data:{numbers:selected_numbers,session_id:session_id,game_id:game_id},
            success:function(d)
            {
                console.log(d);
                get_about_to_win();
                $(".select-numbers-modal").removeClass("active");
            },
            error: function(e) 
          {
          } 
        });        
    }));
    var selected_numbers = [];
    function selected_winning_numbers()
    {
        selected_numbers = [];
        var numbers = $(".numbers.active");
        $(numbers).each(function(index, item){
            selected_numbers.push($(item).data('number'));
        });
        win_numbers_html = '';
        $(selected_numbers).each(function(index, item){
            var num = String(item);
            win_numbers_html = win_numbers_html + `<li data-number="`+item+`">`+item+`</li>`;
        });
        $(".select-numbers-modal .number-color-btn").html(win_numbers_html);
    }
    get_about_to_win();
    timer(<?=$duration ?>);
    timer2(<?=$stop_betting_after ?>);
</script>