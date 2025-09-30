<meta charset="utf-8">
      <!-- <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title><?=website_name ?></title>

      <link rel="icon" type="image/png" href="<?=base_url() ?>assets/logo.png">
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@100;400;500;600&amp;family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&amp;display=swap" rel="stylesheet">
      <style>:root{--adminuiux-content-font:'Roboto';--adminuiux-content-font-weight:400;--adminuiux-title-font:"Fira Sans Condensed";--adminuiux-title-font-weight:500}</style>
      <script defer="defer" src="<?=base_url() ?>assets/js/app8032.js"></script>
      <link href="<?=base_url() ?>assets/css/app8032.css" rel="stylesheet">
      <!-- <link href="<?=base_url() ?>assets/css/bootstrap-icons.min.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
      



      <link rel="stylesheet" type="text/css" href="<?=base_url() ?>front_css.css">    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="<?=base_url() ?>front_script.js"></script>
      <script type="module" src="<?=base_url() ?>firebase.js"></script>



<style>
      .toaster {
        position: fixed;
        top: 86%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #047ff9;
        border-radius: 10px;
        padding: 10px 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: none;
        color: white;
      }

      .toaster.success {
        background-color: #047ff9;
          color: #fff;
          font-size: 16px;
          width: max-content;
          z-index: 9999;
      }
      .form-label {
          font-size: 0.975rem;
          font-weight: 600;
          color: #000000;
          margin-bottom: 5px;
          font-family: var(--font-family-base);
      }

.history {
    list-style: none;
    margin: 0;
    padding: 0;
}
.history li {
    margin-bottom: 10px;
}



.custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999999999;
    padding: 25px 25px;
    background: rgba(0, 0, 0, 0.5);
    display: none;
}
.custom-modal .modal-inner {
    background: white;
    height: 100%;
    padding: 15px 0 15px 0;
    overflow: auto;
    position: relative;
}
.custom-modal-close {
    position: fixed;
    right: 0;
    top: 0;
    background: black;
    color: white;
    text-align: center;
    display: grid;
    align-items: center;
    font-size: 20px;
    padding: 0px 10px 0 10px;
}
.avtar-modal img {
    margin-bottom: 15px;
    border-radius: 50%;
    width: 100%;
}
.select-avtar.selected {
    border: 2px solid #ffffff;
    padding: 3px;
}

.sppinser-timer {
    position: absolute;
    top: 4.5%;
    left: 10px;
    z-index: 9;
    color: white;
    width: 75px;
    height: 75px;
    display: grid;
    align-items: center;
    text-align: center;
    border: 8px solid;
    border-radius: 50%;
    font-weight: 800;
    font-size: 13px;
    line-height: 1;
}

.sppinser-timer {
    color: black;
    background: white;
}




.violet-black-bg
{
   background: linear-gradient(151deg, #8C3BBD 50%, #000000 50%) !important;
}
.violet-red-bg
{
   background: linear-gradient(151deg, #8C3BBD 50%, #FA1414 50%) !important;
}

.violet-black-bg-round
{
   background: linear-gradient(90deg, #8C3BBD 50%, #000000 50%) !important;
}
.violet-red-bg-round
{
   background: linear-gradient(90deg, #8C3BBD 50%, #FA1414 50%) !important;
}





.black-bg
{
   background: #000000 !important;
}
.violet-bg
{
   background: #8C3BBD !important;
}
.red-bg
{
   background: #FA1414 !important;
}
.white-bg
{
   background: white !important;
}




.join-black, .join-red, .join-violet {
    position: relative;
}
.enimate-coin {
    position: fixed;
    z-index: 9;
/*    display: none;*/
    width: 20px !important;
    height: 20px !important;
}
.coininn {
    position: relative;
    display: flex;
    align-items: center;
    text-align: center;
}
.color-button img {
    /* height: 60px !important; */
    display: block;
    margin: 0 auto;
    width: 100%;
}
.coin-amt {
position: absolute;
    top: 0;
    left: 0%;
    font-size: 5px;
    color: black;
    display: flex;
    width: 100%;
    font-weight: 900;
    height: 100%;
    align-items: center;
    text-align: center;
}
.coin-amt2 {
    display: block;
    text-align: center;
    width: 100%;
}
.coininn img
{
    width: 100%;
}






</style>