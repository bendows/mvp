<?
if (! empty($ermsg))
    echo "<font color=red><b>$ermsg</b></font>";?>
<form method="post" action="<?=$this->here;?>">
<table>
<tr>
  <td align='right'><label>E-mail</label></td>
  <td><input type='text' size=52 value='' name = 'uid' maxlength=50></td>
</tr>
<tr>
  <td><img title='Click me to get another code' alt='Click me to get another code' id='captchaimage' src='/captcha.php'></td>
  <td align='left'><input type='text' size=52 value='' name = 'captchacode' maxlength=50></td>
</tr>
<tr>
<td><input type='submit' name='btn' value='Sign Up'></td>
<td><a href="/login.php">login</a></td>
</tr>
</table>
</form>

