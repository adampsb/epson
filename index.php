<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="post">
		<label>A : </label>
		<?php if(!empty($_POST['a'])){ ?>
		<input type="text" name="a" value="<?php echo $_POST['a']; ?>"><br>
		<?php }else{ ?>
		<input type="text" name="a" value="" required=""><br>
		<?php } ?>
		<label>B : </label>
		<?php if(!empty($_POST['b'])){ ?>
		<input type="text" name="b" value="<?php echo $_POST['b']; ?>"><br>
		<?php }else{ ?>
		<input type="text" name="b" value="" required=""><br>
		<?php } ?>
		<label>N : </label>
		<?php if(!empty($_POST['n'])){ ?>
		<input type="number" name="n" value="<?php echo $_POST['n']; ?>"><br>
		<?php }else{ ?>
		<input type="number" name="n" value="" required=""><br>
		<?php } ?>
		<label>	Rumus : </label>
		<?php if(!empty($_POST['rumus'])){ ?>
		<input type="text" name="rumus" style="width: 200px;" value="<?php echo $_POST['rumus']; ?>"><br>
		<?php }else{ ?>
		<input type="text" name="rumus" style="width: 200px;" value=""><br>
		<?php } ?>
		<button type="submit">Hitung</button>
	</form>

<?php
	if (!empty($_POST['a'])) {
		echo "A = ".$_POST['a'].'<br>';
		echo "B = ".$_POST['b'].'<br>';
		$e = 2.71828;
		// a
		$search_a  = array('x', 'e');
		$replace_a = array($_POST['a'], $e);
		$eval_a = str_replace($search_a, $replace_a, $_POST['rumus']);
		eval( '$result_a = (' . $eval_a. ');' );
		// b
		$search_b  = array('x', 'e');
		$replace_b = array($_POST['b'], $e);
		$eval_b = str_replace($search_b, $replace_b, $_POST['rumus']);
		eval( '$result_b = (' . $eval_b. ');' );

		$a = $_POST['a'];
		$b = $_POST['b'];
		$fa = $result_a;
		echo "f(a) = ".$fa.'<br>';
		$fb = $result_b;
		echo "f(b) = ".$fb.'<br>';
		$x = (($fb*$a)-($fa*$b))/(($fb-$fa));

		echo '<table border="1" width="100%">
				<tr>
					<th>Iterasi</th>
					<th>a</th>
					<th>b</th>
					<th>x</th>
					<th>fx</th>
					<th>fa</th>
					<th>fb</th>
				</tr>';
		for ($i=1; $i <= $_POST['n'] ; $i++) { 
			if ($i == 1) {
				$a = $_POST['a'];
				$b = $_POST['b'];

				// a
				$search_a  = array('x', 'e');
				$replace_a = array($_POST['a'], $e);
				$eval_a = str_replace($search_a, $replace_a, $_POST['rumus']);
				eval( '$result_a = (' . $eval_a. ');' );

				// b

				$search_b  = array('x', 'e');
				$replace_b = array($_POST['b'], $e);
				$eval_b = str_replace($search_b, $replace_b, $_POST['rumus']);
				eval( '$result_b = (' . $eval_b. ');' );

				$fa = round($result_a,4);
				$fb = round($result_b,4);

				$x = round((($fb*$a)-($fa*$b))/(($fb-$fa)),4);

				$eval_x = str_replace("x", $x, $_POST['rumus']);
				eval( '$result_x = (' . $eval_x. ');' );

				$fx = round($result_x,4);
				echo "<tr>
					<td>".$i."</td>
					<td>".$a."</td>
					<td>".$b."</td>
					<td>".$x."</td>
					<td>".$fx."</td>
					<td>".$fa."</td>
					<td>".$fb."</td>
				</tr>";
			}else{
				if ($fa*$fb < 0) {
					$a = $x;
					$b = $b;
					// a
					$search_a  = array('x', 'e');
					$replace_a = array($a, $e);
					$eval_a = str_replace($search_a, $replace_a, $_POST['rumus']);
					eval( '$result_a = (' . $eval_a. ');' );

					// b
					$search_b  = array('x', 'e');
					$replace_b = array($b, $e);
					$eval_b = str_replace($search_b, $replace_b, $_POST['rumus']);
					eval( '$result_b = (' . $eval_b. ');' );

					$fa = round($result_a,4);
					$fb = round($result_b,4);
					$x = round((($fb*$a)-($fa*$b))/(($fb-$fa)),4);

					$eval_x = str_replace("x", $x, $_POST['rumus']);
					eval( '$result_x = (' . $eval_x. ');' );

					$fx = round($result_x,4);
					echo "<tr>
						<td>".$i."</td>
						<td>".$a."</td>
						<td>".$b."</td>
						<td>".$x."</td>
						<td>".$fx."</td>
						<td>".$fa."</td>
						<td>".$fb."</td>
					</tr>";
				}
			}
		}
		echo '</table>';
	}
?>
</body>
</html>