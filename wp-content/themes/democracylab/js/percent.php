<?php
/*Dlab's little survey on the front page. 
 *statistically invalid, I know. Mark's idea. haha
 * he just likes interactivity 
*/

$response = $_POST['response'];

survey($response);
 
function survey($response){
	
	$file="percentage.txt";
			
	  $answers = explode(',', file_get_contents($file));
	  $theAgreed = $answers[0];
	  $theContrary = $answers[1];
	  
	  if($response == 1){
	  	 $theAgreed++;
	  }
	  elseif($response == 0){
	  	$theContrary++;
	  }
	  else{
	  	
	  }
	  
	  $total = $theAgreed + $theContrary;
	  
	  $agreedPercent = round(($theAgreed * 100/$total), 2);
	  echo $agreedPercent;
	  
	  $results = $theAgreed . ',' . $theContrary;
	  
	  if(!$file = fopen($file, 'w')){
	  	echo 'error';
	  }
	  fwrite($file, $results);

	  fclose($file);
	  
}
 
?>