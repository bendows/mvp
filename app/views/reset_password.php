<form method="post" action="<?=$this->here;?>">
<input type='hidden' value='<?=$email;?>' name='email'>
<input type='hidden' value='<?=$er;?>' name='er'>
<table>
<tr>
  <td align='right'><label>E-mail</label></td>
    <td><?=$email;?></td>
</tr>
<tr>
  <td align='right'><label>New Password</label></td>
  <td><input type='password' size=47 value='' name = 'apwd' maxlength=45></td>
</tr>
<tr>
  <td align='right'><label>Retype New Password</label></td>
  <td><input type='password' size=47 value='' name = 'apwd2' maxlength=45></td>
</tr>
<tr>
  <td><img title='Click me to get another code' alt='Click me to get another code' id='captchaimage' src='/captcha.php'></td>
  <td align='left'><input type='text' size=52 value='' name = 'captchacode' maxlength=50></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type='submit' name='btn' value='Reset Password'></td>
</tr>
</table>
</form>
<?=$this->element('msg');?>
