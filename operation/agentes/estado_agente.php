<?php

// Pandora - The Free Monitoring System
// This code is protected by GPL license.
// Este codigo esta protegido por la licencia GPL.
// Sancho Lerena <slerena@gmail.com>, 2003-2006
// Raul Mateos <raulofpandora@gmail.com>, 2005-2006

// Load global vars
require("include/config.php");
//require("include/functions.php");
//require("include/functions_db.php");
if (comprueba_login() == 0) {
 	if ((give_acl($id_user, 0, "AR")==1) or (give_acl($id_user,0,"AW")) or (dame_admin($id_user)==1)) {

 	if (isset($_POST["ag_group"]))
			$ag_group = $_POST["ag_group"];
		elseif (isset($_GET["group_id"]))
		$ag_group = $_GET["group_id"];
	else
		$ag_group = -1;

	if (isset($_GET["ag_group_refresh"])){
		$ag_group = $_GET["ag_group_refresh"];
	}
	echo "<h2>".$lang_label["ag_title"]."</h2>";
	echo "<h3>".$lang_label["summary"]."<a href='help/".substr($language_code,0,2)."/chap3.php#331' target='_help'><img src='images/help.gif' border='0' class='help'></a></h3>";

	$iduser_temp=$_SESSION['id_usuario'];
	
	// Show group selector

	if (isset($_POST["ag_group"])){
		$ag_group = $_POST["ag_group"];
		echo "<form method='post' action='index.php?sec=estado&sec2=operation/agentes/estado_agente&refr=60&ag_group_refresh=".$ag_group."'>";
	} else {
		echo "<form method='post' action='index.php?sec=estado&sec2=operation/agentes/estado_agente&refr=60'>";
	}

	echo "<table border='0'><tr><td valign='middle'>";
	echo "<select name='ag_group' onChange='javascript:this.form.submit();'>";

	if ( $ag_group > 1 ){
		echo "<option value='".$ag_group."'>".dame_nombre_grupo($ag_group);
	}
	echo "<option value=1>".dame_nombre_grupo(1); // Group all is always active 
	// Group 1 (ALL) gives A LOT of problems, be careful with this code:
	// Run query on all groups and show data only if ACL check its ok: $iduser_temp is user, and acl is AR (agent read)
	$mis_grupos[]=""; // Define array mis_grupos to put here all groups with Agent Read permission
	
	$sql='SELECT * FROM tgrupo';
	$result=mysql_query($sql);
	while ($row=mysql_fetch_array($result)){
	if ($row["id_grupo"] != 1){
		if (give_acl($iduser_temp,$row["id_grupo"], "AR") == 1){
			echo "<option value='".$row["id_grupo"]."'>".dame_nombre_grupo($row["id_grupo"]);
			$mis_grupos[]=$row["id_grupo"]; //Put in  an array all the groups the user belongs
		}
	}
	}
	echo "</select>";
	echo "<td valign='middle'><noscript><input name='uptbutton' type='submit' class='sub' value='".$lang_label["show"]."'></noscript></form>";
	// Show only selected groups	

	if ($ag_group > 1)
		$sql='SELECT * FROM tagente WHERE id_grupo='.$ag_group.' order by nombre';
	else 
		$sql='SELECT * FROM tagente order by id_grupo, nombre';	

	$result=mysql_query($sql);
	if (mysql_num_rows($result)){
	
		// Load icon index from tgrupos
		$iconindex_g[]="";
		$sql_g='SELECT id_grupo, icon FROM tgrupo';
		$result_g=mysql_query($sql_g);
		while ($row_g=mysql_fetch_array($result_g)){
		$iconindex_g[$row_g["id_grupo"]] = $row_g["icon"];
		}
		echo "<td class='f9l30'>";
		echo "<img src='images/dot_red.gif'> - ".$lang_label["fired"];
		echo "&nbsp;&nbsp;</td>";
		echo "<td class='f9'>";
		echo "<img src='images/dot_green.gif'> - ".$lang_label["not_fired"];
		echo "</td></tr></table>";
		echo "<br>";
		echo "<table cellpadding='3' cellspacing='3' width='700'>";
		echo "<th>".$lang_label["agent"]."</th>";
		echo "<th>".$lang_label["os"]."</th>";
		echo "<th>".$lang_label["interval"]."</th>";
		echo "<th>".$lang_label["group"]."</th>";
		echo "<th>".$lang_label["modules"]."</th>";
		echo "<th>".$lang_label["status"]."</th>";
		echo "<th>".$lang_label["alerts"]."</th>";
		echo "<th>".$lang_label["last_contact"]."</th>";
		// For every agent deficed in the agent table
		$color = 0;
		while ($row=mysql_fetch_array($result)){
			if ($row["disabled"] == 0) {
				$intervalo = $row["intervalo"]; // Interval in seconds
				$id_agente = $row['id_agente'];	
				$nombre_agente = $row["nombre"];
				$direccion_agente =$row["direccion"];
				$id_grupo=$row["id_grupo"];
				$id_os = $row["id_os"];
				$agent_type = $row["agent_type"];
				$ultimo_contacto = $row["ultimo_contacto"];

				foreach ($mis_grupos as $migrupo){	//Verifiy if the group this agent begins is one of the user groups
					if (($migrupo ==1) || ($id_grupo==$migrupo)){
						$pertenece = 1;
						break;
					}
					else
						$pertenece = 0;
				}
				if ($pertenece == 1) { // Si el agente pertenece a uno de los grupos que el usuario puede visualizar
					// Obtenemos la lista de todos los modulos de cada agente
					$sql_t="SELECT * FROM tagente_estado, tagente_modulo WHERE tagente_estado.id_agente_modulo = tagente_modulo.id_agente_modulo AND tagente_modulo.id_agente=".$id_agente;
					$result_t=mysql_query($sql_t);
					$estado_general = 0; $numero_modulos = 0; $numero_monitor = 0; $est_timestamp = ""; $monitor_bad=0;
					$estado_cambio=0; // Oops, I forgot initialize this fucking var... many problems due it
					while ($row_t=mysql_fetch_array($result_t)){
						$est_modulo = $row_t["estado"]; # Sumamos los estados los modulos de  cada agente, si hay uno mal, resultado total malo
						if ($est_modulo <> 100) {
							$estado_general = $estado_general + $est_modulo;
							$estado_cambio = $estado_cambio + $row_t["cambio"]; 
							$numero_monitor ++;
							if ($est_modulo <> 0)
								$monitor_bad++;									
						}
						$numero_modulos++;
					}
					
					# Defines if Agent is down (interval x 2)
					$ahora=date("Y/m/d H:i:s");
					if ($ultimo_contacto <> "")
						$seconds = strtotime($ahora) - strtotime($ultimo_contacto);
					else 
						$seconds = -100000;
					# Defines if Agent is down (interval x 2 > time last contact	
					if ($seconds >= ($intervalo*2)) // If (intervalx2) secs. ago we don't get anything, show alert
						$agent_down = 1;
					else
						$agent_down = 0;
					// Color change for each line (1.2 beta2)
					if ($color == 1){
						$tdcolor = "datos";
						$color = 0;
					}
					else {
						$tdcolor = "datos2";
						$color = 1;
					}
					echo "<tr>";
					echo "<td class='$tdcolor'>";
					$id_grupo=dame_id_grupo($id_agente);
					if (give_acl($id_user, $id_grupo, "AW")==1){
						echo "<a href='index.php?sec=gagente&sec2=godmode/agentes/configurar_agente&id_agente=".$id_agente."'><img src='images/setup.gif' border=0 width=15></a>";
					}
					echo "&nbsp;&nbsp;<a href='index.php?sec=estado&sec2=operation/agentes/ver_agente&id_agente=".$id_agente."'><b>".$nombre_agente."</b></a>";
					if ( $agent_type == 0) {
						// Show SO icon :)
						echo "<td class='$tdcolor' align='center'><img border=0 src='images/".dame_so_icon($id_os)."' height=18 alt='".dame_so_name($id_os)."'>";
					} elseif ($agent_type == 1) {
						// Show network icon (for pandora 1.2)
						echo "<td class='$tdcolor' align='center'><img border=0 src='images/network.gif' height=18 alt='Network Agent'>";
					}
					echo "<td class='$tdcolor'>".$intervalo;
					echo '<td class="'.$tdcolor.'"><img src="images/g_'.$iconindex_g[$id_grupo].'.gif" border="0"> ( '.dame_grupo($id_grupo).' )';
					echo "<td class='$tdcolor'> ".$numero_modulos." <b>/</b> ".$numero_monitor;
					if ($monitor_bad <> 0)
						echo " <b>/</b> <font class='red'>".$monitor_bad."</font>";
					if ($agent_down == 1)
						echo "<td class='$tdcolor' align='center'><img src='images/b_down.gif'>";
					else
						if ($numero_monitor <> 0)
							if ($estado_general <> 0)
								if ($estado_cambio == 0)
									echo "<td class='$tdcolor' align='center'><img src='images/b_red.gif'>";
								else
									echo "<td class='$tdcolor' align='center'><img src='images/b_yellow.gif'>";
							else
								echo "<td class='$tdcolor' align='center'><img src='images/b_green.gif'>";
						elseif ($numero_modulos <> 0) 
							echo "<td class='$tdcolor' align='center'><img src='images/b_white.gif'>";
						else
							echo "<td class='$tdcolor' align='center'><img src='images/b_blue.gif'>";
					// checks if an alert was fired recently
						echo "<td class='$tdcolor' align='center'>";
						if (check_alert_fired($id_agente) == 1)
							echo "<img src='images/dot_red.gif'>";
						else
							echo "<img src='images/dot_green.gif'>";
								
						echo "<td class='$tdcolor'>";
						if ($agent_down == 1) // if agent down, red and bold
							echo "<b><font class='red'>";
						if ( $ultimo_contacto == "0000-00-00 00:00:00")
							echo $lang_label["never"];
						else  {
							$ultima = strtotime($ultimo_contacto);
							$ahora = strtotime("now");
							$diferencia = $ahora - $ultima;
							if ($intervalo > 0){
								$percentil = round($diferencia/(($intervalo*2) / 100));	
							} else {
								echo "N/A";
							}
							echo "<a href='#' class='info'><img src='reporting/fgraph.php?tipo=progress&percent=".$percentil."&height=15&width=80' border='0'>
							<!--[if IE]>
							<a href='#' class='tip' style='padding: 2px 0px 0px 20px; height: 20px; z-index: 1'>&nbsp;
							<![endif]-->
							<span>$ultimo_contacto</span></a>";
							// echo $ultimo_contacto;
						}
						
					} // writing agent data
			} // Disabled agent
		}
		echo "<tr><td colspan='8'><div class='raya'></div></td></tr>";
		echo "</table><br>";
		echo "<table>";
		echo "<tr><td class='f9i'>";
		echo "<img src='images/b_green.gif'> - ".$lang_label["green_light"]."</td>";
		echo "<td class='f9i'>";
		echo "<img src='images/b_red.gif'> - ".$lang_label["red_light"]."</td>";
		echo "<td class='f9i'>";
		echo "<img src='images/b_yellow.gif'> - ".$lang_label["yellow_light"]."</td>";
		echo "<tr><td class='f9i'>";
		echo "<img src='images/b_white.gif'> - ".$lang_label["no_light"]."</td>";
		echo "<td class='f9i'>";
		echo "<img src='images/b_blue.gif'> - ".$lang_label["blue_light"]."</td>";
		echo "<td class='f9i'>";
		echo "<img src='images/b_down.gif'> - ".$lang_label["broken_light"]."</td>";
		echo "</table>";
	}
	else {
		echo '<tr><td></td></tr><tr><td class="red">'.$lang_label["no_agent"].'</td></tr></table>';
	}

} else {
	audit_db($id_user,$REMOTE_ADDR, "ACL Violation","Trying to access Agent view");
		require ("general/noaccess.php");
}
}
?>