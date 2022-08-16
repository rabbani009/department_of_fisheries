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
         <th>FormId</th>
         <th>FId</th>
         <th>Name</th>
         <th>Father Name</th>
         <th>National ID</th>
         <th>BirthDate</th>
         <th>Division</th>
         <th>District</th>
         <th>Village</th>
         <th>Ward</th>
         </tr>
         </thead>
         <tbody>
         @foreach($fisherList as $key=>$value)
         <tr>
         <td>{{$key+1}}</td>
         <td>{{$value['formId']}}</td>
         <td>{{$value['fId']}}</td>
         <td>{{$value['fishermanNameEng']}}</td>
         <td>{{$value['fathersName']}}</td>
         <td>{{$value['nationalIdNo']}}</td>
         <td>{{date('d-m-Y', strtotime($value['dateOfBirth']))}}</td>
         <td>{{$value['division']}}</td>
         <td>{{$value['district']}}</td>
         <td>{{$value['village']}}</td>
         <td>{{$value['ward']}}</td>
         </tr>
         @endforeach
         </tbody>
      </table>
   </body>
</html>

