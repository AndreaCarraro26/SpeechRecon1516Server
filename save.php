<?php

	ini_set( 'default_charset', 'UTF-8' );

	// set working directory
	$dirpath = '../../../home/andrea/Scrivania/decode-wav';

	// set file name as given from client
	$file = basename( $_FILES['uploadedfile']['name']);
	
	// change directory where save audio file
	chdir($dirpath."/audio/");

	// add the date to filename
	$suffix = substr ( $file , strlen($file) -4, strlen($file));
	$file = substr ( $file , 0, strlen($file) -4) .'-'. date('y-m-j-h-i-s').$suffix;

	// in the very rare case where two file have the same name, add an index
	$i = 0;
	$file1 = substr ( $file , 0, strlen($file) -4);	
	while(file_exists($file )){
		$i = $i + 1;
		$file = $file1."-$i".$suffix;
	}
	
	
	$result = '***ERROR***';

	// save in the directory audio file
	if(copy($_FILES['uploadedfile']['tmp_name'], "./$file")) {
		
		// change directory where bash script is located
		chdir("..");
		$message=shell_exec("./decode-wav.sh $file 2>&1");

		// retrive the output file
		$file = "./data/texts/$file"."_text.txt";
		if (file_exists($file)){
			$result = shell_exec("cat $file");
			if($result == ""){ $result = '***SILENCE***';}
		}else{
			$result = '***ERROR***';
		}	
	
	} else{	
		$result = '***ERROR***';
	}

	// send the output to the client
	print $result;



	// garbage routine

	// delete file audio older than 3 days
	foreach (glob("./audio/*") as $delete) {
		if (filemtime($delete) < time() - 259200) { // 3 days in seconds
		    unlink($delete);
		}
	}
	// delete text results older than 3 days
	foreach (glob("./data/texts/*") as $delete) {
		if (filemtime($delete) < time() - 259200) { 
		    unlink($delete);
		}
	}
	// delete scrap file older than 3 days
	foreach (glob("./data/scrap/*") as $delete) {
		if (filemtime($delete) < time() - 259200) { 
		    unlink($delete);
		}
	}


?>
