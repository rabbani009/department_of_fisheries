<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 10px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #174A17;
  color: white;
}
</style>
</head>
<body>
    <div style="text-align: center;">
        <img src="../public/admin/assets/dist/img/logo.png" style="width: 100px;">
        <h3>Fisher List ({{$startDate}} to {{$endDate}})</h3>
    </div>
<table id="customers">
  <tr>
    <th>Sl</th>
    <th>Form Id</th>
    <th>Name</th>
    <th>National ID</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>PostOFficeID</th>
  </tr>
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
</table>

</body>
</html>


