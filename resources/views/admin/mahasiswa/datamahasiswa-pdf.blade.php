<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #024881;
            color: white;
        }

        /* Gaya tambahan untuk kolom Program Studi dan Status */
        .kolom-program-studi {
            width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
            vertical-align: middle;
        }

        .kolom-status {
            width: 80px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <h1>Data Mahasiswa</h1>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th class="kolom-program-studi">Program Studi</th>
            <th>NIK</th>
            <th>Jenis Beasiswa</th>
            <th class="kolom-status">Status</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->namamhs }}</td>
                <td>{{ $row->nim }}</td>
                <td class="kolom-program-studi">{{ $row->programstudi }}</td>
                <td>{{ $row->nik }}</td>
                <td>{{ $row->jenisbeasiswa }}</td>
                <td class="kolom-status">{{ $row->status }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
