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
         <th>FId </th>
         <th>NId </th>
         <th>Name English </th>
         <th>Name Bangla </th>
         <th>Gender </th>
         <th>Mothers Name </th>
         <th>Fathers Name </th>
         <th>dateOfBirth </th>
         </tr>
         </thead>
         <tbody>
            @php
                $index=0;
            @endphp
         @foreach($fisherList as $key=>$value)
         <tr>
            <td>{{$index+1}}</td>
            <td>{{$value->fId}}</td>
            <td>{{$value->nationalIdNo }}</td>
            <td>{{$value->fishermanNameEng}}</td>
            <td>{{$value->fishermanNameBng}}</td>
            <td>{{$value->gender}}</td>
            <td>{{$value->mothersName}}</td>
            <td>{{$value->fathersName}}</td>
            <td>{{$value->dateOfBirth}}</td>
            @php
                $index++;
            @endphp
         </tr>
         @endforeach
         </tbody>
      </table>
   </body>
</html>
