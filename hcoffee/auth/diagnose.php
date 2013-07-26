<?php


    // include db handler
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];  
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	$response = array("tag" => $tag, "success" => 0, "error" => 0);
	//$string ="[Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya, Ya,UID,Lat,Lng]";
	
	if ($tag == 'diagnose') {
    $string = $_POST['answer'];
	$rep = str_replace("[","",$string);
	$rep2 = str_replace("]","",$rep);
	$rep3 = str_replace(" ","",$rep2);
	$q = explode(",", $rep3);
	
	
		/*
        1)	Apakah Daun menguning?
		2)	Apakah Daun timbul dengan bercak kuning kecoklatan?  
		3)	Apakah Daun mudah sekali gugur?
		4)	Apakah Daun Kusam, Layu, dan menggantung?
		5)	Apakah Daun memiliki bercak seperti tepung berwarna orange? 
		6)	Apakah Daun pada pohon menjadi gundul ?
		7)	Apakah Daun timbul bercak menyebar?
		8)	Apakah Buah tumbuh preamatur dan kosong? 
		9)	Apakah Batang pendek/kerdil ?
		10)	Apakah Akar membusuk dan putus?
		11)	Apakah Buah timbul bercak kuning kecoklatan? 
		12)	Apakah Daun timbul bercak melingkar membentuk halo?
		13)	Apakah Akar tertutup oleh keran dari butir-butir tanah ?
		14)	Apakah Akar memiliki anyaman benang jamur berwarna coklat kehitaman?
		15)	Apakah Akar terdapat titik-titik hitam?
		16)	Apakah Batang terdapat titik-titik hitam?
		17)	Apakah Akar memiliki anyaman benang jamur berwarna putih? 
		18)	Apakah Batang memiliki benang-benang jamur tipis seperti sutra?
		19)	Batang mengalami nekrosis ?
		20)	Buah mengalami nekrosis?

        */
		
		
	
		/*
			A: Daun menguning $q[0] == 'Ya'
			B: Daun timbul dengan bercak kuning kecoklatan OR  Daun mudah  sekali gugur  $q[1] == 'Ya' || $q[2] == 'Ya' 
			C: Daun Kusam, Layu, dan menggantung $q[3] == 'Ya'
			D: Daun memiliki  bercak seperti tepung berwarna orange OR Daun pada pohon menjadi gundul OR  Daun timbul bercak menyebar $q[4] == 'Ya' || $q[5] == 'Ya' || $q[6] == 'Ya'
			E: Buah tumbuh preamatur dan kosong OR  Batang pendek/kerdil OR Akar membusuk dan putus $q[7] == 'Ya' || $q[8] == 'Ya' || $q[9] == 'Ya'
			F: Buah timbul bercak kuning kecoklatan OR  Daun timbul bercak melingkar membentuk halo $q[10] == 'Ya' || $q[11] == 'Ya'
			G: Akar tertutup oleh keran dari butir-butir tanah OR  Akar memiliki anyaman benang jamur berwarna coklat kehitaman $q[12] == 'Ya' || $q[13] == 'Ya'
			H: Akar terdapat titik-titik hitam OR  Batang terdapat titik-titik hitam $q[14] == 'Ya' || $q[15] == 'Ya'
			I: Akar memilki anyaman benang jamur berwarna putih $q[16] == 'Ya'
			J: Batang memiliki benang-benang jamur tipis seperti sutra OR  Batang mengalami nekrosis OR  Buah mengalami nekrosis $q[17] == 'Ya' || $q[18] == 'Ya' || $q[19] == 'Ya'

		*/
	
		/*	
			
			if   A   and B and D THEN 	Karat Daun Kopi//
			if   A   and B and NOT D and  E THEN	Nematoda//
			if   A   and B and NOT D and	NOT E and 	F THEN Bercak Daun Kopi//
			if   A   and B and NOT D and	NOT Eand	NOT F THEN	Jamur Upas//
			if   A   and B and E THEN Nematoda//
			if   A   and  B and NOT  E and	F THEN Bercak Daun Kopi//
			if   A   and B and NOT  E and	NOT F and	D  THEN Karat Daun Kopi //
			if   A   and  B and  NOT   E 	and  NOT  F and NOT  D THEN Jamur Upas//
			if   A   and  C and G THEN 	Jamur Akar Coklat//
			if   A   and C and NOT G and	H  THEN Jamur Akar Hitam//
			if   A   and C and NOT G and	NOT  H	and	I THEN Jamur Akar Putih//
			if   A   and  C and NOT G and	NOT  H and NOT I THEN  Jamur Upas//
			if   A   and C and J THEN 	Jamur Upas//
			if   A   and C and NOT J THEN 	Tanaman Sehat
			
			Revised
			
			IF   A    AND B AND D THEN 	Karat Daun Kopi
			IF   A    AND B AND NOT D AND E THEN Nematoda
			IF   A    AND B AND NOT D AND	NOT E AND 	F THEN Bercak Daun Kopi
			IF   A    AND B AND NOT D AND	NOT E AND	NOT F THEN	Jamur Upas
			IF   A    AND NOT B AND C AND G THEN  Jamur Akar Cokelat
			IF   A    AND NOT B AND C AND NOT G AND H THEN Jamur Akar Hitam
			IF   A    AND NOT B AND C AND NOT G AND NOT H AND I THEN Jamur Akar Putih
			IF   A    AND NOT B AND C AND NOT G AND NOT H AND NOT I THEN Jamur Upas
			IF   A    AND NOT B AND NOT C THEN Jamur Upas
			IF   NOT A   AND  J  THEN Jamur Upas
			IF   NOT A   AND NOT  J 	THEN Tanaman Sehat



		*/
		
		/*
		
		A =	 Daun Menguning $q[0] == 'Ya'
		B =	 (Daun timbul dengan bercak kuning kecoklatan + Daun mudah sekali gugur) / 2  $q[1] == 'Ya' || $q[2] == 'Ya' 
		C =  Daun Kusam, Layu, dan menggantung  $q[3] == 'Ya'
		D =	 (Daun memiliki  bercak seperti tepung berwarna orange di bagian bawah daun + Daun pada pohon menjadi gundul +  Daun timbul bercak menyebar) / 3 
		$q[4] == 'Ya' || $q[5] == 'Ya' || $q[6] == 'Ya'
		E=	 (Buah tumbuh preamatur dan kosong + Batang pendek/kerdil +Akar membusuk dan putus) / 3  $q[7] == 'Ya' || $q[8] == 'Ya' || $q[9] == 'Ya'
		F=	 (Buah timbul bercak hingga membusuk+Daun timbul bercak melingkar membentuk halo) / 2    $q[10] == 'Ya' || $q[11] == 'Ya
		G=	 Akar tertutup oleh keran dari butir-butir tanah +  Akar memiliki anyaman benang jamur berwarna coklat kehitaman) / 2 $q[12] == 'Ya' || $q[13] == 'Ya'
		H=	(Akar terdapat titik-titik hitam +  Batang terdapat titik-titik hitam) / 2  $q[14] == 'Ya' || $q[15] == 'Ya'
		I=	Akar memilki anyaman benang jamur berwarna putih $q[16] == 'Ya'
		J=	(Batang memiliki benang-benang jamur tipis seperti sutra +  Batang mengalami nekrosis +  Buah mengalami nekrosis)/3  $q[17] == 'Ya' || $q[18] == 'Ya' || $q[19] == 'Ya'

		IF(A < 0.5)  THEN A=0;  IF(A >= 0.5)  THEN A=1;
		IF(B < 0.5)  THEN A=0;  IF(B >= 0.5)  THEN B=1;
		IF(C < 0.5)  THEN A=0;  IF(C >= 0.5)  THEN C=1;
		IF(D < 0.5)  THEN A=0;  IF(D >= 0.5)  THEN D=1;
		IF(E < 0.5)  THEN A=0;  IF(E >= 0.5)  THEN E=1;
		IF(F < 0.5)  THEN A=0;  IF(F >= 0.5)  THEN F=1;
		IF(G < 0.5)  THEN A=0;  IF(G >= 0.5)  THEN G=1;
		IF(H < 0.5)  THEN A=0;  IF(H >= 0.5)  THEN H=1;
		IF(I < 0.5)  THEN A=0;  IF(I >= 0.5)  THEN I=1;
		IF(J < 0.5)  THEN A=0;  IF(J >= 0.5)  THEN J=1;
		
		*/
		/*
		for($loop=0;$loop<=19;$loop++)
		{
			if($q[$loop] == 'Ya') { $q[$loop] == 1; } else if($q[$loop] == 'Tidak') { $q[$loop] == 0; }
		}
		*/
		
		/*
		if($q[0] == 'Ya') { $q[0] == 1; } else if($q[0] == 'Tidak') { $q[0] == 0; }
		if($q[1] == 'Ya') { $q[1] == 1; } else if($q[1] == 'Tidak') { $q[1] == 0; }
		if($q[2] == 'Ya') { $q[2] == 1; } else if($q[2] == 'Tidak') { $q[2] == 0; }
		if($q[3] == 'Ya') { $q[3] == 1; } else if($q[3] == 'Tidak') { $q[3] == 0; }
		if($q[4] == 'Ya') { $q[4] == 1; } else if($q[4] == 'Tidak') { $q[4] == 0; }
		if($q[5] == 'Ya') { $q[5] == 1; } else if($q[5] == 'Tidak') { $q[5] == 0; }
		if($q[6] == 'Ya') { $q[6] == 1; } else if($q[6] == 'Tidak') { $q[6] == 0; }
		if($q[7] == 'Ya') { $q[7] == 1; } else if($q[7] == 'Tidak') { $q[7] == 0; }
		if($q[8] == 'Ya') { $q[8] == 1; } else if($q[8] == 'Tidak') { $q[8] == 0; }
		if($q[9] == 'Ya') { $q[9] == 1; } else if($q[9] == 'Tidak') { $q[9] == 0; }
		if($q[10] == 'Ya') { $q[10] == 1; } else if($q[10] == 'Tidak') { $q[10] == 0; }
		if($q[11] == 'Ya') { $q[11] == 1; } else if($q[11] == 'Tidak') { $q[11] == 0; }
		if($q[12] == 'Ya') { $q[12] == 1; } else if($q[12] == 'Tidak') { $q[12] == 0; }
		if($q[13] == 'Ya') { $q[13] == 1; } else if($q[13] == 'Tidak') { $q[13] == 0; }
		if($q[14] == 'Ya') { $q[14] == 1; } else if($q[14] == 'Tidak') { $q[14] == 0; }
		if($q[15] == 'Ya') { $q[15] == 1; } else if($q[15] == 'Tidak') { $q[15] == 0; }
		if($q[16] == 'Ya') { $q[16] == 1; } else if($q[16] == 'Tidak') { $q[16] == 0; }
		if($q[17] == 'Ya') { $q[17] == 1; } else if($q[17] == 'Tidak') { $q[17] == 0; }
		if($q[18] == 'Ya') { $q[18] == 1; } else if($q[18] == 'Tidak') { $q[18] == 0; }
		if($q[19] == 'Ya') { $q[19] == 1; } else if($q[19] == 'Tidak') { $q[19] == 0; }
		
		
		
		$A = $q[0];
		$B = ($q[1] + $q[2])/2;
		$C = $q[3];
		$D = ($q[4] + $q[5] + $q[6])/3;
		$E = ($q[7] + $q[8] + $q[9])/3;
		$F = ($q[10] + $q[11])/2;
		$G = ($q[12] + $q[13])/2;
		$H = ($q[14] + $q[15])/2;
		$I = $q[16];
		$J = ($q[17] + $q[18] + $q[19])/3;
		
		
		if($A < 0.5){$A = 0;} else if ($A >= 0.5){$A = 1;}
		if($B < 0.5){$B = 0;} else if ($B >= 0.5){$B = 1;}
		if($C < 0.5){$C = 0;} else if ($C >= 0.5){$C = 1;}
		if($D < 0.5){$D = 0;} else if ($D >= 0.5){$D = 1;}
		if($E < 0.5){$E = 0;} else if ($E >= 0.5){$E = 1;}
		if($F < 0.5){$F = 0;} else if ($F >= 0.5){$F = 1;}
		if($G < 0.5){$G = 0;} else if ($G >= 0.5){$G = 1;}
		if($H < 0.5){$H = 0;} else if ($H >= 0.5){$H = 1;}
		if($I < 0.5){$I = 0;} else if ($I >= 0.5){$I = 1;}
		if($J < 0.5){$J = 0;} else if ($J >= 0.5){$J = 1;}
		
		if(($A == 1)and($B == 1)and($D == 1))
		{
			$response["success"] = 1; 
			$response["answer"] = "Karat Daun Kopi"; 
			$diseases = $db->getDiseases("Karat Daun Kopi");
			if ($diseases != false) 
			{
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			echo json_encode($response);
		}
		else if(($A == 1)and($B == 1)and($D != 1)&&($E == 1))
		{
			$response["success"] = 1; 
			$response["answer"] = "Nematoda";
			$diseases = $db->getDiseases("Nematoda");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"]; 
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			 echo json_encode($response);
		}
		else if(($A == 1)and($B == 1)and($D != 1)and($E != 1)and($F == 1))
		{
			$response["success"] = 1; 
			$response["answer"] = "Bercak Daun Kopi";
			$diseases = $db->getDiseases("Bercak Daun Kopi");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			
			}  
			echo json_encode($response);
		}
		else if(($A == 1)and($B == 1)and($D != 1)and($E != 1)and($F != 1))
		{
			$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
			echo json_encode($response);
		}
		else if(($A == 1)and($B != 1)and($C == 1)and($G == 1))
		{
			$response["success"] = 1; 
			$response["answer"] = "Jamur Akar Coklat"; 
			$diseases = $db->getDiseases("Jamur Akar Coklat");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			echo json_encode($response);
		}
		else if(($A == 1)and($B != 1)and($C == 1)and($G != 1)and($H == 1))
		{
			$response["success"] = 1; $response["answer"] = "Jamur Akar Hitam";
			$diseases = $db->getDiseases("Jamur Akar Hitam");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
		
		 	echo json_encode($response);
		}
		else if(($A == 1)and($B != 1)and($C == 1)and($G != 1)and($H != 1)and($i == 1))
		{
			$response["success"] = 1; $response["answer"] = "Jamur Akar Putih"; 
			$diseases = $db->getDiseases("Jamur Akar Putih");
				if ($diseases != false) {
					$response["desc"] = $diseases["Diseases_Description"];
					$response["med"] = $diseases["Diseases_Medicine"];
					$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
				} 
			echo json_encode($response);
		}
		else if(($A == 1)and($B != 1)and($C == 1)and($G != 1)and($H != 1)and($i != 1))
		{
			$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
			echo json_encode($response);
		}
		else if(($A == 1)and($B != 1)and($C != 1))
		{
			$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
			echo json_encode($response);
		}
		else if(($A != 1)and($J == 1))
		{
			$response["success"] = 1; 
			$response["answer"] = "Jamur Upas";
			$diseases = $db->getDiseases("Jamur Upas");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			echo json_encode($response);
		}
		else if(($A != 1)and($J != 1))
		{
			$response["success"] = 1; $response["answer"] = "Tanaman Kopi Anda Sehat"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
			echo json_encode($response);
		}
		else
		{
			$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
		}
		*/
		
		
	
		
		
		
		if (($q[0] == 'Ya') && 
		(
			 ($q[1] == 'Ya' && $q[2] == 'Ya') || 
			 ($q[1] == 'Ya' && $q[2] == 'Tidak') || 
			 ($q[1] == 'Tidak' && $q[2] == 'Ya')
		 
		) && 
		
		(
			($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
			($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
			($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
			($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Tidak') || 
			($q[4] == 'Tidak' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
			($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
			($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Tidak')
		)
		
		)
		{
			$response["success"] = 1; 
			$response["answer"] = "Karat Daun Kopi"; 
			$diseases = $db->getDiseases("Karat Daun Kopi");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
		} 
			echo json_encode($response);}
		else if (($q[0] == 'Ya') && 
		(
		($q[1] == 'Ya' && $q[2] == 'Ya') || 
		($q[1] == 'Ya' && $q[2] == 'Tidak') || 
		($q[1] == 'Tidak' && $q[2] == 'Ya')
		
		) && 
		
		( 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  ($q[4] == 'Tidak' && $q[5] && 'Tidak' && $q[6] == 'Tidak')
		
		) &&
		   
		(
		 ($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 ($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Tidak') || 
		 ($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 ($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Tidak') || 
		 ($q[7] == 'Tidak' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 ($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 ($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Tidak')
		)
		 
		 )
		{
			$response["success"] = 1; 
			$response["answer"] = "Nematoda";
			$diseases = $db->getDiseases("Nematoda");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"]; 
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			 echo json_encode($response);}
			 
		else if (
		($q[0] == 'Ya') && 
		(
		
			($q[1] == 'Ya' && $q[2] == 'Ya') || 
			($q[1] == 'Ya' && $q[2] == 'Tidak') || 
			($q[1] == 'Tidak' && $q[2] == 'Ya')
			
		) && 
		( 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  ($q[4] == 'Tidak' && $q[5] && 'Tidak' && $q[6] == 'Tidak')
		
		) && 
		
		(
		 !($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 !($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Tidak') || 
		 !($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 !($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Tidak') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Tidak') ||
		 ($q[7] == 'Tidak' && $q[8] == 'Tidak' && $q[9] == 'Tidak')
		) && 
		
		(
			($q[10] == 'Ya' || $q[11] == 'Ya') ||
			($q[10] == 'Tidak' && $q[11] == 'Ya') ||
			($q[10] == 'Ya' && $q[11] == 'Tidak')
		)
		
		)
		{
			$response["success"] = 1; 
			$response["answer"] = "Bercak Daun Kopi";
			$diseases = $db->getDiseases("Bercak Daun Kopi");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			
			}  
			echo json_encode($response);}
			
			
		else if (($q[0] == 'Ya') && 
		(
		
			($q[1] == 'Ya' && $q[2] == 'Ya') || 
			($q[1] == 'Ya' && $q[2] == 'Tidak') || 
			($q[1] == 'Tidak' && $q[2] == 'Ya')
			
		) && 
		( 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Ya' && $q[5] == 'Tidak' && $q[6] == 'Tidak') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Tidak' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Ya') || 
		  !($q[4] == 'Tidak' && $q[5] == 'Ya' && $q[6] == 'Tidak') || 
		  ($q[4] == 'Tidak' && $q[5] && 'Tidak' && $q[6] == 'Tidak')
		
		) && 
		
		(
		 !($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 !($q[7] == 'Ya' && $q[8] == 'Ya' && $q[9] == 'Tidak') || 
		 !($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 !($q[7] == 'Ya' && $q[8] == 'Tidak' && $q[9] == 'Tidak') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Tidak' && $q[9] == 'Ya') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Ya') || 
		 !($q[7] == 'Tidak' && $q[8] == 'Ya' && $q[9] == 'Tidak') ||
		 ($q[7] == 'Tidak' && $q[8] == 'Tidak' && $q[9] == 'Tidak')
		) && 
		
		(
			!($q[10] == 'Ya' || $q[11] == 'Ya') ||
			!($q[10] == 'Tidak' && $q[11] == 'Ya') ||
			!($q[10] == 'Ya' && $q[11] == 'Tidak') ||
			($q[10] == 'Tidak' && $q[11] == 'Tidak')
		)
		)
		{
		 $response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
		$response["desc"] = "Tidak Ada Informasi";
		$response["med"] = "Tidak Ada Informasi";
		echo json_encode($response);}
		
		else if (
			($q[0] == 'Ya') && 
			(
		
				!($q[1] == 'Ya' && $q[2] == 'Ya') || 
				!($q[1] == 'Ya' && $q[2] == 'Tidak') || 
				!($q[1] == 'Tidak' && $q[2] == 'Ya') ||
				($q[1] == 'Tidak' && $q[2] == 'Tidak')
			
			)
			&&
			($q[3] == 'Ya') && 
			
			(
				($q[12] == 'Ya' && $q[13] == 'Ya') ||
				($q[12] == 'Ya' && $q[13] == 'Tidak') ||
				($q[12] == 'Tidak' && $q[13] == 'Ya')
			
			)
			
			) 
		{
			$response["success"] = 1; 
			$response["answer"] = "Jamur Akar Coklat"; 
			$diseases = $db->getDiseases("Jamur Akar Coklat");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
			echo json_encode($response);}
		
		else if (
		($q[0] == 'Ya') && 
		(
		
				!($q[1] == 'Ya' && $q[2] == 'Ya') || 
				!($q[1] == 'Ya' && $q[2] == 'Tidak') || 
				!($q[1] == 'Tidak' && $q[2] == 'Ya') ||
				($q[1] == 'Tidak' && $q[2] == 'Tidak')
			
		) 
		&& ($q[3] == 'Ya') && 
		(
				!($q[12] == 'Ya' && $q[13] == 'Ya') ||
				!($q[12] == 'Ya' && $q[13] == 'Tidak') ||
				!($q[12] == 'Tidak' && $q[13] == 'Ya') ||
				($q[12] == 'Tidak' && $q[13] == 'Tidak')
			
		) && 
		
		(
			($q[14] == 'Ya' && $q[15] == 'Ya') ||
			($q[14] == 'Tidak' && $q[15] == 'Ya') ||
			($q[14] == 'Ya' || $q[15] == 'Tidak')
		
		)
		)
		{$response["success"] = 1; $response["answer"] = "Jamur Akar Hitam";
			$diseases = $db->getDiseases("Jamur Akar Hitam");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
		
		 echo json_encode($response);}
		
		else if (($q[0] == 'Ya') && 
		(
		
				!($q[1] == 'Ya' && $q[2] == 'Ya') || 
				!($q[1] == 'Ya' && $q[2] == 'Tidak') || 
				!($q[1] == 'Tidak' && $q[2] == 'Ya') ||
				($q[1] == 'Tidak' && $q[2] == 'Tidak')
			
		) 
		&& ($q[3] == 'Ya') && 
		(
				!($q[12] == 'Ya' && $q[13] == 'Ya') ||
				!($q[12] == 'Ya' && $q[13] == 'Tidak') ||
				!($q[12] == 'Tidak' && $q[13] == 'Ya') ||
				($q[12] == 'Tidak' && $q[13] == 'Tidak')
			
		) && 
		
		(
			!($q[14] == 'Ya' && $q[15] == 'Ya') ||
			!($q[14] == 'Tidak' && $q[15] == 'Ya') ||
			!($q[14] == 'Ya' || $q[15] == 'Tidak') ||
			($q[14] == 'Tidak' || $q[15] == 'Tidak')
		
		) && ($q[16] == 'Ya')
		)
		{$response["success"] = 1; $response["answer"] = "Jamur Akar Putih"; 
		$diseases = $db->getDiseases("Jamur Akar Putih");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
		echo json_encode($response);}
		
		else if (($q[0] == 'Ya') && 
		(
		
				!($q[1] == 'Ya' && $q[2] == 'Ya') || 
				!($q[1] == 'Ya' && $q[2] == 'Tidak') || 
				!($q[1] == 'Tidak' && $q[2] == 'Ya') ||
				($q[1] == 'Tidak' && $q[2] == 'Tidak')
			
		) 
		&& ($q[3] == 'Ya') && 
		(
				!($q[12] == 'Ya' && $q[13] == 'Ya') ||
				!($q[12] == 'Ya' && $q[13] == 'Tidak') ||
				!($q[12] == 'Tidak' && $q[13] == 'Ya') ||
				($q[12] == 'Tidak' && $q[13] == 'Tidak')
			
		) && 
		
		(
			!($q[14] == 'Ya' && $q[15] == 'Ya') ||
			!($q[14] == 'Tidak' && $q[15] == 'Ya') ||
			!($q[14] == 'Ya' || $q[15] == 'Tidak') ||
			($q[14] == 'Tidak' || $q[15] == 'Tidak')
		
		) && 
		(
			!($q[16] == 'Ya') || 
			($q[16] == 'Tidak')
		)
		)
		{$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
		$response["desc"] = "Tidak Ada Informasi";
		$response["med"] = "Tidak Ada Informasi";
		echo json_encode($response);}
		
		else if (
			($q[0] == 'Ya') && 
			(
		
				!($q[1] == 'Ya' && $q[2] == 'Ya') || 
				!($q[1] == 'Ya' && $q[2] == 'Tidak') || 
				!($q[1] == 'Tidak' && $q[2] == 'Ya') ||
				($q[1] == 'Tidak' && $q[2] == 'Tidak')
			
			)  && 
				(
					!($q[3] == 'Ya') ||
					($q[3] == 'Tidak')
				
				)
			) 
		{	
			$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
			$response["desc"] = "Tidak Ada Informasi";
			$response["med"] = "Tidak Ada Informasi";
			echo json_encode($response);}
		
		else if (
		
			(
					!($q[0] == 'Ya') ||
					($q[0] == 'Tidak')
				
			) && 
			(
			 ($q[17] == 'Ya' && $q[18] == 'Ya' && $q[19] == 'Ya') || 
			 ($q[17] == 'Ya' && $q[18] == 'Ya' && $q[19] == 'Tidak') || 
			 ($q[17] == 'Ya' && $q[18] == 'Tidak' && $q[19] == 'Ya') || 
			 ($q[17] == 'Ya' && $q[18] == 'Tidak' && $q[19] == 'Tidak') || 
			 ($q[17] == 'Tidak' && $q[18] == 'Tidak' && $q[19] == 'Ya') || 
			 ($q[17] == 'Tidak' && $q[18] == 'Ya' && $q[19] == 'Ya') || 
			 ($q[17] == 'Tidak' && $q[18] == 'Ya' && $q[19] == 'Tidak')
			)
		) 
		{$response["success"] = 1; $response["answer"] = "Jamur Upas"; 
		$diseases = $db->getDiseases("Jamur Upas");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			} 
		echo json_encode($response);}
		
		
		else if ((
					!($q[0] == 'Ya') ||
					($q[0] == 'Tidak')
				
			) && 
			(
			 !($q[17] == 'Ya' && $q[18] == 'Ya' && $q[19] == 'Ya') || 
			 !($q[17] == 'Ya' && $q[18] == 'Ya' && $q[19] == 'Tidak') || 
			 !($q[17] == 'Ya' && $q[18] == 'Tidak' && $q[19] == 'Ya') || 
			 !($q[17] == 'Ya' && $q[18] == 'Tidak' && $q[19] == 'Tidak') || 
			 !($q[17] == 'Tidak' && $q[18] == 'Tidak' && $q[19] == 'Ya') || 
			 !($q[17] == 'Tidak' && $q[18] == 'Ya' && $q[19] == 'Ya') || 
			 !($q[17] == 'Tidak' && $q[18] == 'Ya' && $q[19] == 'Tidak') ||
			 ($q[17] == 'Tidak' && $q[18] == 'Tidak' && $q[19] == 'Tidak')
			))
		{$response["success"] = 1; $response["answer"] = "Tanaman Kopi Anda Sehat"; 
		$response["desc"] = "Tidak Ada Informasi";
		$response["med"] = "Tidak Ada Informasi";
		echo json_encode($response);}
		else
		{$response["success"] = 1; $response["answer"] = "Data Penyakit Tidak Diketahui"; 
		$response["desc"] = "Tidak Ada Informasi";
		$response["med"] = "Tidak Ada Informasi";
		echo json_encode($response);}
		
		
		/*
		else if (($q[0] == 'Ya') && ($q[1] == 'Ya' || $q[2] == 'Ya') &&  !($q[4] == 'Ya' || $q[5] == 'Ya' || $q[6] == 'Ya') && !($q[7] == 'Ya' || $q[8] == 'Ya' || $q[9] == 'Ya') && !($q[10] == 'Ya' || $q[11] == 'Ya')) 
		{
			$response["success"] = 1; 
			$response["answer"] = "Bercak Daun Kopi"; 
			$diseases = $db->getDiseases("Bercak Daun Kopi");
			if ($diseases != false) {
				$response["desc"] = $diseases["Diseases_Description"];
				$response["med"] = $diseases["Diseases_Medicine"];
				$db->updateHistory($q[20],$q[21],$q[22],$diseases["Diseases_ID"]);
			}  
			echo json_encode($response);}
			*/
	}
	
}
?>
