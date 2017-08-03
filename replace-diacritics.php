<?php
/*
Plugin Name: Replace diacritics
Plugin URI: http://sj-ol.ro/download/wp-plugins/replace-diacritics.html
Description: Replaces diacritics with standard letters.
Version: 1.0
Author: Ortan Sebastian
Author URI: http://sj-ol.ro
License: GPL2
*/

/*  Copyright 2011  Sebi Ortan  (email : sebi@sj-ol.ro)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require("diacritics.php");

if (isset($_POST["mode"]) && $_POST["mode"]!="")
{
	update_option("replace-diacritics-mode",$_POST["mode"]);
}


function get_vars($mode=0) //default=html codes
{
	$rom_en["ă"]="a"; $rom_en["Ă"]="A"; $rom_en["î"]="i"; $rom_en["Î"]="I"; $rom_en["ș"]="s"; $rom_en["Ș"]="S"; $rom_en["ț"]="t"; $rom_en["Ț"]="T"; $rom_en["â"]="a"; $rom_en["Â"]="A"; $rom_en["ţ"]="t"; $rom_en["ş"]="s"; $rom_en["Ş"]="S"; $rom_en["Ţ"]="T"; 
	$romtohtml["Ă"]="&#258;"; $romtohtml["ă"]="&#259;"; $romtohtml["Â"]="&#194;"; $romtohtml["â"]="&#226;"; $romtohtml["Î"]="&#206;"; $romtohtml["î"]="&#238;"; $romtohtml["Ș"]="&#x218;"; $romtohtml["ș"]="&#x219;"; $romtohtml["Ş"]="&#350;"; $romtohtml["ş"]="&#351;"; 
	$romtohtml["Ț"]="&#538;"; $romtohtml["ț"]="&#539;"; 
	$romtohtml["Ţ"]="&#354;"; $romtohtml["ţ"]="&#355;"; 
	if ($mode==1) return $rom_en;
	return $romtohtml;
}

register_activation_hook( __FILE__, 'initialise' );
 
 add_filter('the_content', function($content) {	
		$mode=get_option("replace-diacritics-mode");
		foreach (get_vars($mode) as $key=>$value)
		{
				$content=str_replace($key,$value,$content);
		}
		return $content;
	}); 
 
 
 
 function rmRomDiacritics($string)
	{
		for ($i=0; $i<count($rom);$i++)
		{
			$string=str_replace($rom[$i],$en[$i],$string);
		}
		
		return $string;
	}

	
//settings
define("plugin_page","replace-diacritics");

add_action('admin_menu', 'replace_diacritics_menu');

function replace_diacritics_menu() {
	add_options_page('Replace diacritics settings', 'Replace diacritics', 'manage_options', plugin_page, 'replace_diacritics_settings');
}


function initialise($mode="0")
{	
	update_option("replace-diacritics-mode","0");
}

function replace_diacritics_settings()
{
	$mode=get_option("replace-diacritics-mode");
?>
	<h3>
	<input type="radio" name="type" id="options_0" value="0" /> Diacritics to HTML codes 
	<br />
	<input type="radio" name="type" id="options_1" value="1" /> Diacritics to standard letters
	</h3>
	<input type="button" value="Save" class="save button-primary" />
	<br /> <br />
	<div id="div_0">
		<?php generate_table(get_vars()) ?>
	</div>
	
	<div id="div_1">
		<?php generate_table(get_vars(1),1) ?>
	</div>
	
	<br /> 
	<form id="form" method="post">
		<input type="hidden" name="mode" id="mode" />
	</form>
	
	<input type="button" value="Save"  class="save button-primary" />
	
	<script type="text/javascript">
	//jQuery(radio);
	jQuery("#options_<?php echo $mode ?>").attr("checked",true);
	jQuery('[id^="div_"]').hide();
	jQuery("#div_<?php echo $mode ?>").show();
	
	jQuery('[id^="options_"]').click(function(){
		var val=jQuery(this).val();
		jQuery('[id^="div_"]').hide();
		jQuery("#div_"+val).show();
	});
	
	jQuery(".save").click(function(){
		var mode=jQuery('input[name=type]:checked').val();
		jQuery("#mode").val(mode);
		jQuery("#form").submit();
	});
	
	</script>
<?php
}

	//update_option('christi',"marian");
?>
