<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="{{URL::to('/pdf/css/pdf.css')}}">
   </head>
   <body>
      <table class="blueTable">
         <thead>
         <tr>
         <th>Sl</th>
         <th>Form Id</th>
         <th>FId</th>
         <th>Name</th>
         <th>NID</th>
         <th>Gender</th>
         <th>Fathers Name</th>
         <th>Mothers Name</th>
         <th>Spouse Name</th>
         <th>Date of Birth(YYYY-MM-DD)</th>
         <th>Religion</th>
         <th>Education</th>
         <th>Total Family Member</th>
         <th>Number of Father</th>
         <th>Number of Mother</th>
         <th>Number of Son</th>
         <th>Number of Daughter</th>
         <th>Number of Spouse</th>
         <th>Mobile</th>
         <th>Annual Income</th>
         <th>Main Profession Income</th>
         <th>Sub Profession Income</th>
         <th>Time of Fishing</th>
         <th>Fishing Method</th>
         <th>Division</th>
         <th>Distrct</th>
         <th>PostOFfice</th>
         </tr>
         </thead>
         <tbody>
         @foreach($fisherList as $key=>$value)
         <tr>
         <td>{{$key+1}}</td>
         <td>{{$value['formId']}}</td>
         <td>{{$value['fId']}}</td>
         <td>{{$value['fishermanNameEng']}}</td>
         <td>{{$value['nationalIdNo']}}</td>
         <td>{{$value['gender']}}</td>
         <td>{{$value['fathersName']}}</td>
         <td>{{$value['mothersName']}}</td>
         <td>{{$value['spouseName']}}</td>
         <td>{{$value['dateOfBirth']}}</td>
         <td>{{$value['religion']}}</td>
         <td>{{$value['education']}}</td>
         <td>{{$value['totalFamilyMember']}}</td>
         <td>{{$value['numberOfFather']}}</td>
         <td>{{$value['numberOfMother ']}}</td>
         <td>{{$value['numberOfSon']}}</td>
         <td>{{$value['numberOfDaughter']}}</td>
         <td>{{$value['numberOfSpouse']}}</td>
         <td>{{$value['mobile']}}</td>
         <td>{{$value['annualIncome']}}</td>
         <td>{{$value['incomeMainProfession']}}</td>
         <td>{{$value['incomeSubProfession']}}</td>
         <td>{{$value['timeOfFishingEng']}}</td>
         <td>{{$value['howToFishing']}}</td>
         <td>{{$value['divisionName']}}</td>
         <td>{{$value['districtName']}}</td>
         <td>{{$value['postOfficeName']}}</td>
         </tr>
         @endforeach
         </tbody>
         </tr>
      </table>
   </body>
</html>

