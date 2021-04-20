<!DOCTYPE html>
<html>
<head>
    <title>Tracker Pasien</title>
    <style>
        body {
            font-size:10px;
            margin:0px;
            /* line-height: 8px; */
        }
        @page {
            margin:0px;
        }
        .page-break {
            page-break-after: always;
        }
        .aturan {
            font-size:15px;
            line-height: 10px;
            /* font-size:10px; */
            font-weight:bold;
        }
        .kanan {
            /* width: 60px; */
            /* text-align:left; */
            /* font-size:10px; */
        }
        tr.border_bottom td {
            border-bottom:1pt solid black;
        }


        div.n {
           text-align: center;
           font-size: 100px;
         }

         div.t {
           text-align: right;
           font-size:16px;
           line-height: 25px;
           margin-right: 10px;
         }

    </style>
</head>

<body>
@foreach($label as $i => $label)

      <div class="t"><b class="text-right">{{$TANGGAL_MASUK}}</b></div>
    <div class="n"><b class="text-center">{{$label->nomor}}</b></div>
<table style="margin:0;margin-left:13px;width:100%">
  <!-- <tr>
    <th>Firstname</th>

  </tr> -->
  <tr>
    <td>
    <b style="font-family:sans-serif;">No RM</b>
    </td>
    <td> :
    </td>
    <td>
    <b style="font-family:sans-serif;">{{$label->NORM}}</b>
    </td>
  </tr>
  <tr>
    <td>
    <b style="font-family:sans-serif;">Nama</b>
    </td>
    <td> :
    </td>
    <td>
    <b style="font-family:sans-serif;">{{$label->NAMA}}</b>
    </td>
  </tr>
  <tr>
    <td>
    <b style="font-family:sans-serif;">Tanggal Lahir :</b>
    </td>
    <td> :
    </td>
    <td>
    <b style="font-family:sans-serif;">{{ $label->TANGGAL_LAHIR}}</b>
    </td>
  </tr>
  <tr>
    <td>
    <b style="font-family:sans-serif;">Dokter</b>
    </td>
    <td> :
    </td>
    <td>
    <b style="font-family:sans-serif;">{{ $nama_dokter}}</b>
    </td>
  </tr>
  <tr>
    <td>
    <b style="font-family:sans-serif;">Poli</b>
    </td>
    <td> :
    </td>
    <td>
    <b style="font-family:sans-serif;">{{ $poli}}</b>
    </td>
  </tr>
</table>




@endforeach

</body>
</html>
