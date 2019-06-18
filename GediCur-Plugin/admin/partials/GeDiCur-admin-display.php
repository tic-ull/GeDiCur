<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GeDiCur
 * @subpackage GeDiCur/admin/partials
 */

function print_curso_list_admin (&$rows, &$mydb) {
  echo "<table>
					<thread>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Profesor</th>
							<th>Estado</th>
						</tr>
					</thread>
					<tbody>";

	foreach ($rows as $obj) :
		$aux_rows = $mydb->get_results("SELECT * FROM profesor NATURAL JOIN
																	  profesor_curso WHERE ID =". $obj->ID . ";");

		echo "<tr>";
		$proffessor = "";
		echo "<td>".$obj->ID. "</td>".
				 "<td>".$obj->Name. "</td>".
				 "<td>".$obj->Description  . "</td>";

			foreach ($aux_rows as $aux_obj) :
				$proffessor = $proffessor . $aux_obj->Name . $aux_obj->Surname . ", ";
			endforeach;

		echo "<td>".$proffessor."</td>";
		if ($obj->Metadata != null)
			echo "<td>".$obj->Metadata."</td>";
		else
			echo "<td> Finalizado </td>";
		echo "</tr>";
	endforeach;

	echo "</tbody>
					</table>";
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h1>Listado de cursos</h1>
<h2>Cursos que requieren acción</h2>

<?php
	global $wpdb;
	$rows = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix. "cursos_temp_data
														  NATURAL JOIN ".$wpdb->prefix. "cursos;");
	print_curso_list_admin ($rows, $mydb);
?>

<h2>Cursos cerrados</h2>

<?php
	global $wpdb;
	$rows = $wpdb->get_results("SELECT * FROM " .$wpdb->prefix. "cursos
															LEFT JOIN " .$wpdb->prefix. "cursos_temp_data USING (ID) 
														  WHERE "  .$wpdb->prefix. "cursos_temp_data.ID IS NULL;");
	print_curso_list_admin ($rows, $mydb);
?>
