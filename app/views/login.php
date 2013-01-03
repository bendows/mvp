<form action='<?=$this->here;?>' method='POST'>
<table>
<tr>
<td align='right'><label>Username</label></td>
<td><input type='text' size=47 value='' name = 'uid' maxlength=45></td>
</tr>
<tr>
<td align='right'><label>Password</label></td>
<td><input type='password' size=47 value='' name = 'apwd' maxlength=45></td>
</tr>
<tr>
 <td align=center><input name='btn' type='submit' value='Login'></td>
<td><a href="/request_password_reset.php">Forgot your password?</a></td>
</tr>
</table>
</form>
<?
if (! empty($msg))
   echo "<font color=green><b>$msg</b></font>";
if (! empty($ermsg))
   echo "<font color=red><b>$ermsg</b></font>";?>
