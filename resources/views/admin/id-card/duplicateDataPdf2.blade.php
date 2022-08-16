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
         <th>Count </th>
         <th>Sl</th>
         <th>FId </th>
         <th>Count </th>
         </tr>
         </thead>
         <tbody>
         @php
         $chunks = array_chunk($fisherList, 2);
         $index=0;
         @endphp
         @foreach($chunks as $key=>$value)
         <tr>
            <td>{{$index+1}}</td>
            <td>{{isset($value[0]['fId']) ? $value[0]['fId'] : ''}}</td>
            {{-- <td>{{isset($value[0]['count']) ? $value[0]['count'] : ''}}</td> --}}
            <td>{{$index+2}}</td>
            <td>{{isset($value[1]['fId']) ? $value[1]['fId'] : ''}}</td>
            {{-- <td>{{isset($value[1]['count']) ? $value[1]['count'] : ''}}</td> --}}
            @php 
            $index=$index+2;
            @endphp
         </tr>
         @endforeach
         </tbody>
      </table>
   </body>
</html>
