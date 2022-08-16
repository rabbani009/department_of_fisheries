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
         <th>Name</th>
         <th>National ID</th>
         <th>Gender</th>
         <th>DOB</th>
         <th>PostOFficeID</th>
         </tr>
         </thead>
         <tbody>
         @foreach($fisherList as $key=>$value)
         <tr>
         <td>{{$key+1}}</td>
         <td>{{$value['formId']}}</td>
         <td>{{$value['fishermanNameEng']}}</td>
         <td>{{$value['nationalIdNo']}}</td>
         <td>{{$value['gender']}}</td>
         <td>{{$value['dateOfBirth']}}</td>
         <td>{{$value['postOfficeId']}}</td>
         </tr>
         @endforeach
         </tbody>
         </tr>
      </table>
   </body>
</html>

