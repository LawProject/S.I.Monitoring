<!DOCTYPE html>
<html>

<head>
    <style>
        /* @media print {
            body {
                background-image: url("{{ asset('images/logopoltek.png') }}");
                background-repeat: no-repeat;
                background-position: center;
                background-size: auto 297mm;
            }
        } */

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

        header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 5px solid black;
            padding-bottom: 10px;
        }

        .header-logo {
            width: 100px;
            margin-right: 10px;
        }

        .header-title {
            font-size: 36px;
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: left;
        }



        .header-subtitle {
            font-size: 20px;
            margin-top: 5px;
            margin-bottom: 0;
            font-family: 'Courgette', cursive;
            color: red;
        }


        .signature-text {
            font-size: 12px;
            text-align: center;
            line-height: 1.5;
            margin-bottom: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="{{ asset('images/logopoltek.png') }}" alt="Logo" class="header-logo">
        <div class="header-content">
            <h1 class="header-title">Politeknik Hasnur</h1>
            <h2 class="header-subtitle">Stairs to the Future</h2>
        </div>
        {{-- <hr class="header-divider"> --}}
    </header>

    <h1>Data Mahasiswa</h1>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th class="kolom-program-studi">Program Studi</th>
            {{-- <th>NIK</th> --}}
            <th>Jenis Beasiswa</th>
            <th class="kolom-status">Status</th>
            <th>Semester</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->namamhs }}</td>
                <td>{{ $row->nim }}</td>
                <td class="kolom-program-studi">
                    @switch($row->programstudi)
                        @case('TeknikInformatika')
                            TI
                        @break

                        @case('BudidayaTanamanPerkebunan')
                            BTP
                        @break

                        @case('TeknikOtomotif')
                            TO
                        @break

                        @default
                            {{ $row->programstudi }}
                    @endswitch
                </td>
                {{-- <td>{{ $row->nik }}</td> --}}
                <td>{{ $row->jenisbeasiswa }}</td>
                <td class="kolom-status">
                    @if ($row->status === 'tidak_aktive')
                        Tidak Aktif
                    @elseif ($row->status === 'aktive')
                        Aktif
                    @else
                        {{ $row->status }}
                    @endif
                </td>
                <td>{{ $row->semester }}</td>
            </tr>
        @endforeach
    </table>
    <br><br><br>
    <div class="signature-space">
        <div class="signature-text">Mengetahui,</div>
        <div class="signature-text">Koordinator Program Studi D3 Teknik Informatika</div>
        <br><br><br>
        <div class="signature-text">Yazid Aufar, M.Kom</div>
        <div class="signature-text">NIK. 190224</div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
