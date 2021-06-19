# Código fuente del ejemplo de la calculadora:

<!DOCTYPE html >
<html>
<head>
<title>Overriding Methods in the Parent Class</title>
<link rel="stylesheet" type="text/css" href="common.css" />
</head>
	<body>
		<h1>Calculator Class Example</h1>

		<?php
			class Calculator {
				protected $_val1;
				protected $_val2;

				function __construct($val1, $val2) {
					$this->_val1 = $val1;
					$this->_val2 = $val2;
				}

				public function setVal1($val1) {
					$this->_val1 = $val1;
				}
				public function setVal2($val2) {
					$this->_val2 = $val2;
				}

				public function sum() {
					echo $this->_val1." + ".$this->_val2." = ";
					echo $this->_val1+$this->_val2;
					echo "<br>";
				}
				public function subtract() {
					echo $this->_val1." - ".$this->_val2." = ";
					echo $this->_val1-$this->_val2;
					echo "<br>";
				}
				public function multiply() {
					echo $this->_val1." * ".$this->_val2." = ".$this->_val1 * $this->_val2;
					echo "<br>";
				}
				public function divide() {
					echo $this->_val1." / ".$this->_val2." = ".$this->_val1 / $this->_val2;
					echo "<br>";
				}
				public function compute() {
					$this->sum();
					$this->subtract();
					$this->multiply();
					$this->divide();
				}
			}

			class ComplexCalculator extends Calculator {
				function __construct($val1) {
					parent::__construct($val1, 1);
				}
				public function pow() {
					echo $this->_val1." ^ ".$this->_val2." = ";
					echo pow($this->_val1,$this->_val2);
					echo "<br>";
				}
				public function sqrt() {
					echo "sqrt (".$this->_val1.") = ";
					echo sqrt($this->_val1);
					echo "<br>";
				}
				public function exp() {
					echo "exp (".$this->_val1.") = ";
					echo exp($this->_val1);
					echo "<br>";
				}
				public function compute() {
					parent::compute();
					$this->pow();
					$this->sqrt();
					$this->exp();
				}

			}

			echo "<h2>Calculator with values 2 and 3:</h2>";
			$calc = new Calculator(2, 3);
			$calc->compute();

			echo "<h2>Complex Calculator with single value 5:</h2>";
			$complex_calc = new ComplexCalculator(5);
			$complex_calc->compute();


			echo "<h2>Complex Calculator with values 5 and 3:</h2>";
			$complex_calc->setVal2(3);
			$complex_calc->compute();
		?>
	</body>
</html>