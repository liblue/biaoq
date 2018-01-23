<?php 
//取文件夹中的所有表情
function getsmiles() {
  if ($handle = opendir('images/smiles')) {
    while (false !== ($file = readdir($handle))) {
      if (preg_match('/(.+?)[.]gif/ie',$file, $name)) {
        $result[$name[1]]=$file;
      }
    }
    closedir($handle);
    return $result;
  }else{
    return;
  }
}
// 评论表情
function displaysmiley($smile) {
  $smile=htmlspecialchars($smile);
  if(is_file('images/smiles/'.$smile.'.gif')) {
    $img='<img src="./images/smiles/'.$smile.'.gif" >';
  }
  return $img;
}
?>
<script>
function $(id) {
	return document.getElementById(id);
}
function insertsmiley(icon) {  
  $('word').value+= ':'+icon+':';   
}
</script>
<style>
	#face{
		width:400px;
	}
</style>
<?php 
	if($_POST["Submit"]){
		$word=$_POST["word"];
		if(trim($word)!=""){
			echo "您的评论内容为：<br />";
			echo preg_replace("/[:](.+?)[:]/ies", "displaysmiley('\\1')", $word);
		}else{
			$wrong="评论内容不能为空！";
		}
	}
	if($wrong!=""){
		echo $wrong;
		unset($wrong);
	}
?>
<hr />
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>插入评论表情</strong></td>
  </tr>
  <tr>
    <td>
	  <div id="face">
	  	<?php 
			$smiles=getsmiles();
			foreach($smiles as $key => $value){
				echo "<img src=\"images/smiles/".$value."\" style=\"cursor:pointer\" onclick=\"insertsmiley('".$key."')\"/>";
			}
			unset($smiles);
		?>
	  </div>
	</td>
  </tr>
  <tr>
    <td>
		<form action="" method="post" name="form1">
			<textarea name="word" cols="52" rows="10" id="word"></textarea><br />
			<input name="Submit" type="submit" value="发表评论" />
		</form>
	</td>
  </tr>
</table>
