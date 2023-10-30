<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title></title>
</head>
<body>
    <table width="85%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody>
            <tr>
                <td style="background:#605ca8;height:40px; padding-left:15px; color:#ffffff;">
                    <strong>
                        <span class="il" style="color:#ffffff; font-family:Verdana"><font size="4"><?php echo WEBSITE_NAME; ?></font></span>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background:#f6f6f6;padding-left:20px;padding-top:20px;line-height:20px;">
                    <p style="font-family:Verdana">
                        <strong><font size="2">Dear <?php if(!empty($name)) echo ucwords($name); ?>,</strong></font>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background:#f6f6f6;padding-left:20px; line-height:20px;">
                    <p style="font-family:Verdana"><font  size="2"><?php if(!empty($message)) echo $message; ?></font></p>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="background:#f6f6f6;padding:0px 0 10px 20px;line-height:20px;" >
                    <p style="font-family:Verdana">
                        <font  size="2">Please feel free to get in touch for any other assistance. </font>
                    </p>
                    <p style="font-family:Verdana">
                        <font size="2">
                            Best Regards,<br>
                            <?php echo WEBSITE_NAME.' Team.';?> 
                        </font>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="background:#c4c4c4;height:30px; padding-left:20px;">
                    <p style="font-family:Verdana">
                        <font size="2"><?php if(isset($note) && !empty($note)) echo $note; ?></font>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    </body>
</html>