<?php

class Pustaka {

	function IntervalDays($CheckIn,$CheckOut){
		$CheckInX = explode("-", $CheckIn);
		$CheckOutX =  explode("-", $CheckOut);
		$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
		$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
		$interval =($date2 - $date1)/(3600*24);
		// returns numberofdays
		return  $interval ;
	}

	function ambil_awal_dan_akhir_triwulan($triwulan) {
		switch ($triwulan) {
			case 1:
				$awal = 1;
				$akhir = 3;
				break;
			
			case 2:
				$awal = 4;
				$akhir = 6;
				break;
			
			case 3:
				$awal = 7;
				$akhir = 9;
				break;
			
			case 4:
				$awal = 10;
				$akhir = 12;
				break;
			
			default:
				$triwulan = "ERROR !!!";
				break;
		}

		return array($awal, $akhir);
	}

	function ambil_triwulan_dari_tanggal($tanggal) {
		$bulan = date("n", strtotime($tanggal));
		
		switch ($bulan) {
			case 1:
				$triwulan = 1;
				break;
			
			case 2:
				$triwulan = 1;
				break;
			
			case 3:
				$triwulan = 1;
				break;
			
			case 4:
				$triwulan = 2;
				break;
			
			case 5:
				$triwulan = 2;
				break;
			
			case 6:
				$triwulan = 2;
				break;
			
			case 7:
				$triwulan = 3;
				break;
			
			case 8:
				$triwulan = 3;
				break;
			
			case 9:
				$triwulan = 3;
				break;
			
			case 10:
				$triwulan = 4;
				break;
			
			case 11:
				$triwulan = 4;
				break;
			
			case 12:
				$triwulan = 4;
				break;
						
			default:
				$triwulan = "ERROR !!!";
				break;
		}

		return $triwulan;
	}	

	function tanggal_indo($tanggal) {
		return date("d-m-Y", strtotime($tanggal));
	}	
	 
	function tanggal_indo_string($param_tanggal) {
		$tanggal = date("d", strtotime($param_tanggal));
		$bulan = date("n", strtotime($param_tanggal));
		$tahun = date("Y", strtotime($param_tanggal));
		
		switch ($bulan) {
			case 1:
				$bulan_jadi = "Januari";
				break;
			
			case 2:
				$bulan_jadi = "Februari";
				break;
			
			case 3:
				$bulan_jadi = "Maret";
				break;
			
			case 4:
				$bulan_jadi = "April";
				break;
			
			case 5:
				$bulan_jadi = "Mei";
				break;
			
			case 6:
				$bulan_jadi = "Juni";
				break;
			
			case 7:
				$bulan_jadi = "Juli";
				break;
			
			case 8:
				$bulan_jadi = "Agustus";
				break;
			
			case 9:
				$bulan_jadi = "September";
				break;
			
			case 10:
				$bulan_jadi = "Oktober";
				break;
			
			case 11:
				$bulan_jadi = "November";
				break;
			
			case 12:
				$bulan_jadi = "Desember";
				break;
						
			default:
				$bulan_jadi = "ERROR !!!";
				break;
		}

		return $tanggal . ' ' . $bulan_jadi . ' ' . $tahun;
	}	
	 
}

?>