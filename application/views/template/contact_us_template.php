<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
</head>
<body>
	<table width="85%" cellspacing="0" cellpadding="0" border="0" align="center">
		<tbody>
			<tr>
				<td style="background:#605ca8;height:40px; padding-left:15px; color:#ffffff;">
					<strong>
						<span style="font-family:Verdana" class="il"><font size="4"><?php echo WEBSITE_NAME; ?></font></span>
					</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="background:#f6f6f6;padding-left:20px;padding-top:10px;padding-bottom:10px;line-height:20px;">
					<p style="font-family:Verdana"><font  size="2"><strong>Dear <?php if(!empty($name)) echo $name;?>,</strong></font></p><br>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="background:#f6f6f6;padding-left:20px;padding-bottom:10px;line-height:20px;">
					<p style="font-family:Verdana"><font  size="2"><?php if(!empty($message)) echo $message; ?></font></p>
				</td>
			</tr>
			<tr>
				<td style="background:#f6f6f6;color:#000;padding:18px;line-height:20px;" colspan="2" height="10" >
					<p style="font-family:Verdana">
						<font size="2">
							<a style="text-decoration:none;color:#000">Best Regards,<br>
								<span class="il"><?php echo WEBSITE_NAME; ?></span> 
							</a> 
						</font>
					</p>
				
				</td>
			</tr>
			<tr>
				<td style="background:#c4c4c4;height:30px; padding-left:15px;"></td>
			</tr>
		</tbody>
	</table>
	</body>
</html>