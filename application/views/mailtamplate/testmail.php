<?php  
$logo = 'demo-logo.png';
$favicon = 'demo-logo.png';
$setting = setting();
$website_name = website_name;
if(!empty($setting))
{
  if(!empty($setting->logo))
     if(json_decode($setting->logo))
        $logo = json_decode($setting->logo)[0]->image_path;

  if(!empty($setting->favicon))
     if(json_decode($setting->favicon))
        $favicon = json_decode($setting->favicon)[0]->image_path;
}
?>
<body style="margin:0;padding:0" dir="ltr" bgcolor="#ffffff">
  <table border="0" cellspacing="0" cellpadding="0" align="center" id="m_-7626415423304311386email_table" style="border-collapse:collapse">
    <tbody>
      <tr>
        <td id="m_-7626415423304311386email_content" style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;background:#ffffff">
          <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
            <tbody>
              <tr>
                <td height="20" style="line-height:20px" colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td height="1" colspan="3" style="line-height:1px"></td>
              </tr>
              <tr>
                <td>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;text-align:center;width:100%">
                    <tbody>
                      <tr>
                        <td width="15px" style="width:15px"></td>
                        <td style="line-height:0px;max-width:600px;padding:0 0 15px 0">
                          <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                            <tbody>
                              <tr>
                                <td style="width:100%;text-align:left;height:33px"><img height="33" src="<?=base_url('upload/'.$logo) ?>" style="border:0" class="CToWUd" data-bit="iit"></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td width="15px" style="width:15px"></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table border="0" width="430" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0 auto 0 auto">
                    <tbody>
                      <tr>
                        <td>
                          <table border="0" width="430px" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0 auto 0 auto;width:430px">
                            <tbody>
                              <tr>
                                <td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td>
                              </tr>
                              <tr>
                                <td>
                                  <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                              <tr>
                                                <td width="20" style="display:block;width:20px">&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                  <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                                    <tbody>
                                                      <tr>
                                                        <td>
                                                          <p style="margin:10px 0 10px 0;color:#565a5c;font-size:18px">Hi <?=$website_name ?>!</p>
                                                          <p style="margin:10px 0 10px 0;color:#565a5c;font-size:18px">Test Mail successfully....</p>
                                                        </td>
                                                      </tr>                                                    
                                                    </tbody>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>                             
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>