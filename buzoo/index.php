<?php
	function fibonacci($n){
  
  	$a = 0;
  	$b = 1;
  	for ($i = 0; $i < $n; $i++){
    	echo $a."&nbsp;";
   	 	$sum = $a+$b;
	    $a = $b;
	    $b = $sum;
  		}
	}	
	

	function even($n)
	{
		$number = 0;
		for($number = 1; $number <= $n; $number++)
		{
			if(($number%2) == 0)
			{
				echo $number."&nbsp;";
				
			}
						
		}

	}
	

	function odd($n)
	{
		$number = 0;
		for($number = 1; $number <= $n; $number++)
		{
			if(($number%2) == 1)
			{
				echo $number."&nbsp;";
				
			}
						
		}

	}

	function reverse($word)
	{
		$length = strlen($word);
		for($i = 0; $i <= ($length-1)/2; $i++)
		{
			$temp = $word[$i];
       		$word[$i] = $word[$length-$i-1];
        	$word[$length-$i-1] = $temp;

		}
		echo $word;
	}
	
	reverse("WAHYU");
	
	echo "<br/>";

	for ($i=1; $i<=10; $i++){
	for($j=1; $j<=$i; $j++){ 
	echo '*';
	}echo '<br>';
	}

	echo "<br/>";


	for ($i=10; $i>=0; $i--){
	for($j=1; $j<=$i; $j++){ 
	echo '*';
	}echo '<br>';
	}

	for ($i=3; $i<=10; $i++){
	for ($a=3; $a<=10; $a++){
	
	echo '*';}
	echo '<br>';
	}	

	
	/*
	echo "<br/>";
	odd(100);
	echo "<br/>";
	even(100);
	echo "<br/>";
	fibonacci(100);
	*/
?>