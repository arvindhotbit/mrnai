<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>Forgot Password</title>
</head>
<body>
    <table width="85%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody>
            <tr>
                <td colspan="2" style="background:#605ca8;color:#ffffff;padding:10px;font-size:14px">
                    <strong>
                        <span class="il"><?php echo WEBSITE_NAME; ?></span>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background:#f6f6f6;color:#000;padding:20px 25px 0px;line-height:20px;">
                    <strong>Dear <?php if(!empty($name)) echo ucwords($name); ?>,</strong><br>
                    <p><font face="Arial, Helvetica, sans-serif" size="3"><?php if(!empty($message)) echo $message; ?></font></p>
                    <p><font face="Arial, Helvetica, sans-serif" size="3">
                        Please <a href="<?php echo $reset_password_url; ?>" target="_blank">click here</a>  to reset your password.</font>
                    </p>
                    <p><font face="Arial, Helvetica, sans-serif" size="3"></font></p>
                    <p><font face="Arial, Helvetica, sans-serif" size="3"></font></p>

                    <p><font face="Arial, Helvetica, sans-serif" size="3">Please feel free to get in touch for any other assistance. </font></p>
                </td>
            </tr>

            <tr>
                <td style="background:#f6f6f6;color:#000;padding:25px;line-height:20px;" colspan="2" height="10" >
                    <p style="font-family:Verdana">
                        <font size="2">
                            <a style="text-decoration:none;color:#000">Best Regards,<br>
                                <span class="il"><?php echo WEBSITE_NAME.' Team.';?></span> 
                            </a> 
                        </font>
                    </p>
                
                </td>
            </tr>
            <tr>
                <td style="background:#c4c4c4;height:30px; padding-left:15px;">

                </td>
            </tr>
        </tbody>
    </table>
    </body>
</html>