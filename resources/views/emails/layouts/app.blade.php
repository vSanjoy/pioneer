<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>{{ $siteSetting['website_title'] }}</title>
  	<style type="text/css">
  		p{ margin:0; padding:12px 0 0 0; line-height:22px;}
  	</style>
</head>
<body style="background:#efefef; margin:0; padding:0;">
  	<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
    	<tbody>
      		<tr>
        		<td align="center" valign="middle" bgcolor="#fff" height="100" style="padding:15px; margin:0; line-height:0px; border:1px solid #0a0b0d; height: 100px;">
          			<a href="{{ getBaseUrl() }}" target="_blank" style="display:block;"><img src="{{asset('images/admin/logo.png')}}" alt="" width="300" height="89" style="border:0; width: 300px; height: 89px; display: block;" /></a>
        		</td>
      		</tr>
      		<tr>
        		<td align="left" valign="top" bgcolor="#ffffff" style="color:#3c3c3c; margin:0; padding:30px 15px 30px 15px; border-left: 1px solid #3d4549; border-right: 1px solid #3d4549;">
          			@yield('content')
        		</td>
      		</tr>
      		<tr>
        		<td align="center" valign="middle" bgcolor="#000000" style="padding:20px; color:#ffffff; margin:0; border: 1px solid #0a0b0d; line-height: 22px;">&copy; {{ date('Y') }} <a href="{{ getBaseUrl() }}" style="color: #ffffff; text-decoration: none;">{!! $siteSetting['website_title'] !!}</a>, all rights reserved.</td>
      		</tr>
    	</tbody>
  	</table>
</body>
</html>
