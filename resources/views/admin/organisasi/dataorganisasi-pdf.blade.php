<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #024881;
  color: white;
}
</style>
</head>
<body>

<h1>Data Mahasiswa</h1>

<table id="customers">
    <tr>
        <th>No</th>
        <th>Nama Organisasi</th>
        <th>Ketua</th>
        <th>Pembina</th>
        <th>Program Studi</th>
        
      </tr>
      @php
      $no=1;
  @endphp
  @foreach ($data as $row)
  <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->namaorganisasi }}</td>
                        <td>{{ $row->ketua }}</td>
                        <td>{{ $row->pembina}}</td>
                        <td>{{ $row->periode }}</td>
                       
                    </tr>  
  @endforeach
  
</table>

</body>
</html>


