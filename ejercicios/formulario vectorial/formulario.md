# Cogido del ejercicio de Formulario Vectorial

<!-- Ejemplo tomado del libro: Beginning PHP 5.3. Matt Doyle. Wiley Publishing, Inc. 2010 -->
<!DOCTYPE html >
<html>
<head>
<link rel="stylesheet" type="text/css" href="common.css" />
</head>
	<body>
		<h1>Vectorial Form Example</h1>

		<?php
			class VectForm {
				private $n_elems;
				private $ids = array();
				private $labels = array();
				private $types = array();

				function __construct($my_ids, $my_labels, $my_types) {
					$this->n_elems = count($my_ids);
					$this->ids = $my_ids;
					$this->labels = $my_labels;
					$this->types = $my_types;
				}

				public function print_form() {
					echo "<form>";
						for($i = 0; $i < $this->n_elems; $i++) {
							echo '<label for="'.$this->ids[$i].'">'.$this->labels[$i].':</label>   ';
							echo '<input type="'.$this->types[$i].'"id="'.$this->ids[$i].'"><br>';
						}
					echo '<br><input type="submit" value="Submit">';
					echo '</form>';
				}
			}

			$my_form = new VectForm(
				array('username', 'password', 'color', 'age'),
				array('Username', 'Password', 'Favorite color', 'Age'),
				array('text', 'password', 'color', 'number'));


			$my_form->print_form();
		?>
	</body>
</html>