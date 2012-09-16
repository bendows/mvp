<?
class app_model_auth extends lib_model_mysql {
  function connect() {
   return parent::connect (settings::get('mysqlconf'));
  }
}
?>
