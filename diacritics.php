<?php	
		/*
		$rom=Array("ă","Ă","î","Î","ș","Ș","ț","Ț","â","Â","ţ","ş","Ş","Ţ");
		 $en=Array("a","A","i","I","s","S","t","T","a","A","t","s","S","T");
		 for ($i=0; $i<count($rom);$i++)
		 {
			 echo '$rom_en["'.$rom[$i].'"]="'.$en[$i].'"; ';
		 }
		  exit;
		 */
		
	
	function generate_table($array,$mode="0")  //default=html codes
	{
	  $letter="Diacritic";
	  if ($mode==1)
	  {
		 $transformation="Standard letter";
	  }	
	  else $transformation="HTML CODES";
	?>
				<style>
			th{
			  width:152px;
			  border:2px solid black;
			}
			table, td{
				font-size:15px;
				text-align:center;
				color:#1569C7;
				border:1px solid black;
			}
			</style>

			<table>
			<tr>
			<th><?php echo $letter ?></th>
				<th><?php echo $transformation ?></th>
			</tr>

	<?php
		foreach ($array as $key=>$value)
		{
			?>
				<tr>
					<td><?php echo $key ?></td>
					<td><?php 
						if ($mode==0) $value=str_replace("&","&amp;",$value);
						echo $value; 
						?>
					</td>
				</tr>
				<?php
		}
	?>
		</table>
	<?php	
	}
	

?>

