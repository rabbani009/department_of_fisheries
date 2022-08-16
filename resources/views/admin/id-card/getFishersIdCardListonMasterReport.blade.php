<!DOCTYPE html>
<html>
<head>
<style>
.container {
  padding: 2px 16px;
}
table{
  width: 100%;
  margin : 90px;
}
.tableBorder {
  border: 1px solid black;
  padding: 40px;
  text-align: center;
  width : 50%;
  background-color: #e4ebe4;
}

</style>
</style>
</head>
<body>
    <table>
        <tbody>
            <?php 
            $array = array_chunk($fisherList,2);
            foreach($array as $value)
            {
                echo '<tr>';
                $qr1 = SimpleSoftwareIO\QrCode\Facades\QrCode::encoding('UTF-8')->size(50)->generate('Fishers Id: ' . $value[0]['fId'] . "\n" . 'Name: ' . $value[0]['fishermanNameEng'] . "\n" . 'National Id No: ' . $value[0]['nationalIdNo'] . "\n" . 'Date of Birth: ' . date('d-M-Y', strtotime($value[0]['dateOfBirth'])) . "\n" . 'Gender: ' . $value[0]['gender']);
                $qr1 = str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",$qr1);  
                echo '<td class="tableBorder"><div class="card">
                <img src="http://mis.fisheries.gov.bd/assets/dashboard_assets/images/B_and_F_Logo_Ai1.png" alt="Avatar" style="width:10%"><br><br><h4>Department of Fisheries</h4><br>
                <div class="container">
                  <h4>'.$value[0]['fishermanNameEng'].'</h4> 
                  <p><b>FID : </b>'.$value[0]['fId'].'</p> 
                  <p><b>NID : </b>'.$value[0]['nationalIdNo'].'</p> 
                  <p><b>Gender : </b>'.$value[0]['gender'].'</p> 
                  <p>'.$qr1.'</p>
                </div>
              </div></td>';
              if(empty($value[1]['gender']))
              {
                echo '<td></td></tr>';
                break;
              }
              $qr2 = SimpleSoftwareIO\QrCode\Facades\QrCode::encoding('UTF-8')->size(50)->generate('Fishers Id: ' . $value[1]['fId'] . "\n" . 'Name: ' . $value[1]['fishermanNameEng'] . "\n" . 'National Id No: ' . $value[1]['nationalIdNo'] . "\n" . 'Date of Birth: ' . date('d-M-Y', strtotime($value[1]['dateOfBirth'])) . "\n" . 'Gender: ' . $value[1]['gender']);
              $qr2 = str_replace('<?xml version="1.0" encoding="UTF-8"?>',"",$qr2);

              echo '<td class="tableBorder"><div class="card">
              <img src="http://mis.fisheries.gov.bd/assets/dashboard_assets/images/B_and_F_Logo_Ai1.png" alt="Avatar" style="width:10%"><br><br><h4>Department of Fisheries</h4><br>
              <div class="container">
                <h4>'.$value[1]['fishermanNameEng'].'</h4> 
                <p><b>FID : </b>'.$value[1]['fId'].'</p> 
                <p><b>NID : </b>'.$value[1]['nationalIdNo'].'</p> 
                <p><b>Gender : </b>'.$value[1]['gender'].'</p> 
                <p>'.$qr2.'</p>
              </div>
            </div></td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>


                


