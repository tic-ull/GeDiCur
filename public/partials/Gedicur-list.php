<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GeDiCur
 * @subpackage GeDiCur/public/partials
 */


function print_curso_list (&$rows, &$mydb) {
			echo "<table>
						<thread>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Profesor</th>
								<th>Inicio</th>
								<th>Fin</th>
								<th>Social</th>
							</tr>
						</thread>
						<tbody>";

		foreach ($rows as $obj) :
			$aux_rows = $mydb->get_results("SELECT * FROM profesor NATURAL JOIN
																			profesor_curso WHERE ID =". $obj->ID . ";");

			echo "<tr>";
			$proffessor = "";
			echo "<td>".$obj->Name. "</td>".
					 "<td>".$obj->Description  . "</td>";

				foreach ($aux_rows as $aux_obj) :
					$proffessor = $proffessor . $aux_obj->Name . $aux_obj->Surname . ", ";
				endforeach;

			echo "<td>".$proffessor."</td>";
			echo "<td>".$obj->InitDate  . "</td>" .
					 "<td>".$obj->EndDate  . "</td>";

			echo "</tr>";
		endforeach;

		echo "</tbody>
						</table>";
	}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h1> Listado de cursos </h1>
<h2> Próximos cursos </h2>

<?php
	global $wpdb;
	$rows = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix. "cursos
														  NATURAL JOIN ".$wpdb->prefix. "cursos_temp_data
															WHERE status = 40;");
	print_curso_list ($rows, $mydb);
?>

<h2>Histórico</h2>

<?php
	global $wpdb;
	$rows = $wpdb->get_results("SELECT * FROM " .$wpdb->prefix. "cursos
															LEFT JOIN " .$wpdb->prefix. "cursos_temp_data USING (ID) 
														  WHERE "  .$wpdb->prefix. "cursos_temp_data.ID IS NULL;");
	print_curso_list ($rows, $mydb);
?>

