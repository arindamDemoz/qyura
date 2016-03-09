<?php defined('BASEPATH') OR exit('No direct script access allowed.');

 function getDistance($lat,$lng, $preLat, $preLong){
        //  return $lat; die();    
        $R = 6371; // Radius of the earth in km
        $dLat = deg2rad($lat - $preLat);  // deg2rad below
        $dLon = deg2rad($lng - $preLong); 

        $a = sin($dLat/2) *  sin($dLat/2) +  cos(deg2rad($lat)) * cos(deg2rad($preLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
        $d = $R * $c; // Distance in km
        return ($d / 1.609344);  // Distance in mi
    }

if (!function_exists('getYearBtTwoDate')) {
function getYearBtTwoDate($datetime1,$datetime2){
            $datetime1 = new DateTime("@$datetime1");
 
            $datetime2 = new DateTime("@$datetime2");

            $startDate = new DateTime($datetime1->format('Y-m-d'));
            $endDate = new DateTime($datetime2->format('Y-m-d'));
             
            $difference = $endDate->diff($startDate);

            return $difference->y; // This will print '12' die();
            
 }
}    

   function convertNumberToDay($number) {
      $days = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday');
      return $days[$number]; // we subtract 1 to make "0" match "Monday", "1" match "Tuesday"
 }
 
   function getDoctorAvailibilitySession($number){
     $session = array('Morning','Afternoon','Evening');
     return $session[$number];
  }
  
  function getDay($day){
    $days = array('Monday' => 0, 'Tuesday' => 1, 'Wednesday' => 2, 'Thursday' => 3, 'Friday' => 4, 'Saturday' => 5, 'Sunday' => 6);
    return $days[$day];
}

if ( ! function_exists('createImage'))
{
    function createImage($img,$path,$name=null)
    {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);

        $data = base64_decode($img);

        if($name == null)
        $name = time().'.png';

        $success = file_put_contents($path.$name, $data);
        
        if($success)
            return $name;
        
        return $success;
    }
}


if ( ! function_exists('dateFormate'))
{
    function dateFormate($strToTime)
    {
        
        return date("m  D, Y g:i A",$strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }
}

<<<<<<< HEAD
if ( ! function_exists('getStatus'))
{
    function getStatus($status)
    {
      return  isset($status) && $status == 1 ? 'Active' : 'Deactive';
        
    }
}

if ( ! function_exists('getOppStatus'))
{
    function getOppStatus($status)
    {
      return  isset($status) && $status == 0 ? 'Enable' : 'Disable';
        
    }
}


if ( ! function_exists('getGender'))
{
    function getGender($gender)
    {
      if($gender == 'M'){
          return 'Male';
      }elseif($gender == 'F'){
          return 'Female';
      }elseif($gender == 'O'){
          return 'Other';
      }
        
    }
}
 //   function deg2rad($deg) {
  //      return $deg * (pi()/180);
  //  }
=======
if ( ! function_exists('dateFormateConvert'))
{
    function dateFormateConvert($strToTime)
    {
        
        return date("M d, Y",$strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }
}

if ( ! function_exists('checkStatus'))
{
    function checkStatus($status)
    {
        if($status == 1){
            return "Active";
        }else{
            return "Inactive";
        }
        
        //return date("Y-m-d H:i:s",$strToTime);
    }
}

if ( ! function_exists('isUnique'))
{
    function isUnique()
    {
        $default = "QYURA";
        $random = rand(0,999);
        return $default.$random;
    }
}
>>>>>>> 4050d841246ccc8959b159e217f2f2f26b0f3b3d

    ?>