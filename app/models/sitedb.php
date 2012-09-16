<?
class app_model_sitedb extends lib_model_mysql {
  function connect() {
		return parent::connect (settings::get('mysqlconf'));
  }

	function rows($r) {
		if (false === ($er = parent::rows("$r")))
			return array();
		return $er;
	}

	function getuid($euid) {
		if (false === ($er = $this->row("select id from user where euid = '$euid'")))
			return 0;
		return $er['id'];
	}

	function sitestats() {
		$rows = $this->rows("select 
	1 id,
	'u' f, count(user.id) v
from user
union
select
	2 id,
	'd' f, count(midcol.id) v
from midcol");
		return (array) $rows;
	}

  function getcurrentcategory($aid, $acid) {
		$c=array('id'=>0, 'category'=>'You currently have no categories. Click on \'categories\' to add some');
		if (! ismd5($aid))
			return $c;
		$i = $this->getuid($aid);
		if ($i <1)
			return $c;
		if ($acid<1)
			if (false === ($cid = $this->row("select id, category from category where uid = $i order by category asc limit 1")))
				return $c;
			else
				return $cid;
		if (false === ($cid = $this->row("select id, category from category where uid = $i and $acid = id")))
			return $c;
		return $cid;
	}

  function categories($aid) {
		if (! ismd5($aid))
			return array();
		$i = $this->getuid($aid);
		if ($i <1)
			return array();
		$rows = (array) $this->rows("
select 
	if (SUM(IF(isnull(midcol.id),0,1))=0, '', 
		SUM(IF(isnull(midcol.id),0,1))) snipcount,
		category.datetimef,
	category.id id,
	category.category
from 
	category
	left join midcol 
		on category.id = midcol.categoryid
 where 
 	category.uid = $i
group by
	category.id
order by
	category.category asc");
		return (array) $rows;
  }

  function recycles($aid, $cid) {
		if (! ismd5($aid))
			return array();
		$i = $this->getuid($aid);
		if ($i <1)
			return array();
		$rows = (array) $this->rows("select * from midcol where uid = $i and categoryid = $cid order by id asc limit 0, 40");
		return (array) $rows;
  }

}
?>
