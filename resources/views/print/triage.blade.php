<!DOCTYPE html>
<html>
<head>
    <title>Triage Pasien</title>
    <style>
       /* @page { size: 4cm 11cm portrait; } */
        body {
            font-size:15px;
            margin:15px;
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

        div.t {
           text-align: right;
           font-size: 12px;
           margin-top: 5px;
         }

        div.n {
           text-align: center;
           font-size: 15px;
           margin-top: 4px;
           text-decoration: underline;
         }

         div.r {
           float: right;
           text-align: right;
           font-size:15px;
           line-height: 25px;
           margin-right: 5px;
         }

         /* div.l {
           float: left;
           text-align: left;
           font-size:15px;
           line-height: 25px;
           margin-left: 3px;
         } */

         div.l {
           text-align: center;
           font-size: 16px;
           margin-top: -5px;
         }

         div.b {
           text-align: center;
           font-size: 15px;
           margin-top: 0px;
         }

         div.i {
           float: left;
           text-align: left;
           font-size:14px;
           line-height: 25px;
           margin-left: 6px;
           margin-top: 7px;
         }

         table, th, td {
  border: 2px solid black;
  border-collapse: collapse;
}

td {
  text-align: center;
}


.widthno{
        width: 70px;
        height: 10px;
    }
  
    .widthno2{
        width: 15px;
        height: 5px;
    }    
  


    * {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 21%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -2px;
}

.column2 {
  float: left;
  width: 3%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -2px;
}

.column3 {
  float: left;
  width: 100%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -2px;
}


.column4 {
  float: left;
  width: 50%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  font-size:12px;

}

.column5 {
  float: left;
  width: 50%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  font-size:12px;

}





.column6 {
  float: left;
  width: 10%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
}

 .column6a {
  float: left;
  width: 3%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
}

.column6b {
  float: left;
  width: 39%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
} */

.column7 {
  float: left;
  width: 10%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
}

 .column7a {
  float: left;
  width: 3%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
}

.column7b {
  float: left;
  width: 39%;
  padding: 3px;
  height: 18px; /* Should be removed. Only for demonstration */
  margin-top: -5px;
  font-size:12px;
} */

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;

}


.rowl {
        border: 2px solid;
        border-radius: 10px;
        height: 100px;
      }



      div.1unv {
           float: left;
         }

         div.2unv {
           float: right;
         }

       .widthjtt{
        /* width: 70px; */
        height: 30px;
       }

       .widthjum{
        /* width: 70px; */
        height: 30px;
       }

    </style>
</head>

<body>

    <!-- <div class="i"><b class="text-left"><img style="width:80px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAF+mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE5LTA3LTI1VDEyOjEyOjA1KzA3OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDphMzZiZGZlZS04MmU1LWQ2NDctYWVmZS01MDM3NzZjMTljY2EiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoxNTA0MzI5Zi1jYmJmLTI2NGItOWU3Yy0zYjU1Y2IxOGFjYzEiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjE1MDQzMjlmLWNiYmYtMjY0Yi05ZTdjLTNiNTVjYjE4YWNjMSIgc3RFdnQ6d2hlbj0iMjAxOS0wNy0yNVQxMjoxMjowNSswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHN0RXZ0OndoZW49IjIwMTktMDctMjZUMTM6MzM6MzcrMDc6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4sQVSVAAAV0ElEQVRogb1aa3hU1bl+155JZjKXTGZymUkygSQQknAr9yACAkUuVipW1ICKyPEUTk+1Si1VpKc9ttYHHrUcBSyoKAJWSatBKAGCInILuQwJIZAQcp1MMrlNZjL3mb3Xd36EpCAJ0tP2vM8zP2at/a3vfdf69rp8e8kwCBQKBeLj48E5RzgcBgBotVro9Xp4vV6o1WrIZDJIkoTIyEhERkZCo9FAqVQCABhjSElJgcvl0jHG3mKMzQdQGB0dTfHx8VAoFPD5fAAA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" style="height:30px;"></b></div> -->
    <!-- <div class="1unv"><img style="width:50px;" float="left" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAF+mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE5LTA3LTI1VDEyOjEyOjA1KzA3OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDphMzZiZGZlZS04MmU1LWQ2NDctYWVmZS01MDM3NzZjMTljY2EiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoxNTA0MzI5Zi1jYmJmLTI2NGItOWU3Yy0zYjU1Y2IxOGFjYzEiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjE1MDQzMjlmLWNiYmYtMjY0Yi05ZTdjLTNiNTVjYjE4YWNjMSIgc3RFdnQ6d2hlbj0iMjAxOS0wNy0yNVQxMjoxMjowNSswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHN0RXZ0OndoZW49IjIwMTktMDctMjZUMTM6MzM6MzcrMDc6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4sQVSVAAAV0ElEQVRogb1aa3hU1bl+155JZjKXTGZymUkygSQQknAr9yACAkUuVipW1ICKyPEUTk+1Si1VpKc9ttYHHrUcBSyoKAJWSatBKAGCInILuQwJIZAQcp1MMrlNZjL3mb3Xd36EpCAJ0tP2vM8zP2at/a3vfdf69rp8e8kwCBQKBeLj48E5RzgcBgBotVro9Xp4vV6o1WrIZDJIkoTIyEhERkZCo9FAqVQCABhjSElJgcvl0jHG3mKMzQdQGB0dTfHx8VAoFPD5fAAA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" style="height:50px;"></div> -->
    <div class="l"><b style="font-family:sans-serif;" class="text-center">RUMAH SAKIT UNIVERSITAS TANJUNGPURA</b></div>
    <!-- <div class="b"><b style="font-family:sans-serif;" class="text-center"> Jalan Prof. Dr. H. Hadari Nawawi Pontianak 78124 <br> Telp. (0561) 576242, Fax. (0561) 765342</b></div> -->
    <!-- <div class="2unv"><img style="width:50px;" float="right" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAF+mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE5LTA3LTI1VDEyOjEyOjA1KzA3OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOS0wNy0yNlQxMzozMzozNyswNzowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDphMzZiZGZlZS04MmU1LWQ2NDctYWVmZS01MDM3NzZjMTljY2EiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoxNTA0MzI5Zi1jYmJmLTI2NGItOWU3Yy0zYjU1Y2IxOGFjYzEiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjE1MDQzMjlmLWNiYmYtMjY0Yi05ZTdjLTNiNTVjYjE4YWNjMSIgc3RFdnQ6d2hlbj0iMjAxOS0wNy0yNVQxMjoxMjowNSswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDozMGRlM2Y0YS1mMmI0LTU1NGItYWMyNy1kYzVhM2VjYzkxNmQiIHN0RXZ0OndoZW49IjIwMTktMDctMjZUMTM6MzM6MzcrMDc6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4sQVSVAAAV0ElEQVRogb1aa3hU1bl+155JZjKXTGZymUkygSQQknAr9yACAkUuVipW1ICKyPEUTk+1Si1VpKc9ttYHHrUcBSyoKAJWSatBKAGCInILuQwJIZAQcp1MMrlNZjL3mb3Xd36EpCAJ0tP2vM8zP2at/a3vfdf69rp8e8kwCBQKBeLj48E5RzgcBgBotVro9Xp4vV6o1WrIZDJIkoTIyEhERkZCo9FAqVQCABhjSElJgcvl0jHG3mKMzQdQGB0dTfHx8VAoFPD5fAAA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" style="height:50px;"></div> -->
    <!-- <hr size="3" width="100%" color="black">   -->
    <!-- <div class="r"><b class="text-right"></b></div> -->
    <div class="n"><b style="font-family:sans-serif;" class="text-center">TRIAGE PASIEN</b></div>


    <br>
    @foreach($triage as $i => $triage)
<div class="row rowl">
  <div class="column6">
    <p><b style="font-family:sans-serif;font-size:15px;">No RM</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">Nama</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">Dokter</b></p>
  </div>
  <div class="column6a">
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
  </div>
  <div class="column6b">
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->RM}}</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->NAMA_PASIEN}}</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->DPJP}}</b></p>
  </div>
  <div class="column7">
    <p><b style="font-family:sans-serif;font-size:15px;">Tgl Lahir</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">Unit</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">Tgl/Jam</b></p>
  </div>
  <div class="column7a">
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
    <p><b style="font-family:sans-serif;font-size:15px;"> : </b></p>
  </div>
  <div class="column7b">
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->TANGGAL_LAHIR}}</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->UNIT}}</b></p>
    <p><b style="font-family:sans-serif;font-size:15px;">{{$triage->TANGGAL}}</b></p>
  </div>

</div>
@endforeach
<br>

<table style="margin:0;margin-left:0px;margin-right:0px;width:100%">
  <tr>
    <th colspan="1" style="font-family:sans-serif;font-size:13px;" class="widthjtt">
      CARA KEDATANGAN<br>
      Tanggal Kedatangan: {{$kedatangan_tanggal}}<br>
      Alat Transportasi: {{$kedatangan_alat_transportasi}} <br>
      @if($kedatangan_jenis == '1')
        Datang Sendiri, Diantar Oleh: {{$kedatangan_pengantar}} <br>
      
      @elseif($kedatangan_jenis == '2')
        Rujukan Dari: {{$kedatangan_asal_rujukan}} <br>
        @if($kedatangan_sisrute == '1')
        Melalui SISRUTE
        @endif
      @elseif($kedatangan_jenis == '3')
        Dikirim Oleh Polisi Dari: {{$kedatangan_kepolisian}} <br>
        @if($kedatangan_visum == '1')
        Disertai Permintaan Visum et Repertum
        @endif
      @endif
    </th>
  </tr>

  <tr>
    <td>
    <b style="font-family:sans-serif;font-size:13px;"> 
      JENIS KASUS<br>

      <!-- @if(isset($kasus_jenis) == 1 ? $kasus_jenis : ' ')
        Trauma :
        @if(isset($kasus_laka_lantas) == 1)
          Kecelakaan Lalu Lintas
        @elseif(isset($kasus_kecelakaan_kerja)== 1)
          Kecelakaan Kerja
        @elseif(isset($kasus_uppaisset) == 1)
          Kasus Perempuan dan Anak (UPPA)
        @endif  
      @elseif(isset($kasus_jenis) == 0 ? $kasus_jenis : ' ')
          Non Trauma :
          @if(isset($kasus_endemis) == 1)
          Riwayat Ke Daereh Endemis
          Dimana : {{$kasus_dimana}}<br>
          @endif
      @endif -->

     
      @if($kasus_jenis == '1')
      Trauma:
        @if($kasus_laka_lantas == '1')
          Kecelakaan Lalu Lintas
        @elseif($kasus_kecelakaan_kerja == '1')
          Kecelakaan Kerja
        @elseif($kasus_uppa == '1')
          Kasus Perempuan dan Anak (UPPA)
        @endif  
      @elseif($kasus_jenis == '0')
          Non Trauma:
          @if($kasus_endemis == '1')
          Riwayat Ke Daereh Endemis
          Dimana : {{$kasus_dimana}}<br>
          @endif
      @endif



       <!-- @if(isset($kasus_jenis) == '1')
        Trauma: 
        @if(isset($kasus_laka_lantas) == 1)
          Kecelakaan Lalu Lintas
        @elseif(isset($kasus_kecelakaan_kerja)== 1)
          Kecelakaan Kerja
        @elseif(isset($kasus_uppaisset) == 1)
          Kasus Perempuan dan Anak (UPPA)
        @endif
       @else

       @endif

       @if(isset($kasus_jenis)  == '0')
          Non Trauma: <br>
          @if(isset($kasus_endemis) == 1)
          Riwayat Ke Daereh Endemis
          Dimana : {{$kasus_dimana}}<br>
          @endif
       @else

       @endif -->
   
    <!-- @if(isset($kasus_jenis) == 0)
          Non Trauma: <br>
          @if(isset($kasus_endemis) == 1)
          Riwayat Ke Daereh Endemis
          Dimana : {{$kasus_dimana}}<br>
          @endif
    @endif -->
   
    </b> 
    </td>
  </tr>

  <tr>
    <td colspan="1" style="font-family:sans-serif;font-size:13px;" class="widthjum">
      <b>AMNANESE<br> 
      Keluhan Utama: {{$anamnese_keluhan_utama}}<br>
      Terpimpin: {{$anamnese_terpimpin}}<br>  
      <b>
      </td>
  </tr>

  <tr>
    <td>
    <b style="font-family:sans-serif;font-size:13px;"> 
      TANDA VITAL<br>
      Tekanan Darah (Sistolik / Distolik) mmHg: {{$tanda_vital_sistole}} / {{$tanda_vital_diastole}}<br>
      Frekuensi Nafas (RR) (X/Menit): {{$tanda_vital_frek_nafas}}<br>
      Frekuensi Nadi (HR) (X/Menit): {{$tanda_vital_frek_nadi}}<br>
      Suhu (OC): {{$tanda_vital_suhu}}<br>
      Skala Nyeri: {{$tanda_vital_skala_nyeri}} <br>
      Metode Ukur: {{$tanda_vital_metode_ukur}}
    </b> 
    </td>
  </tr>

  <tr>
    <td>
    <b style="font-family:sans-serif;font-size:13px;"> 
      KHUSUS OBGYN<br>
      Usia Gestasi (Minggu): {{$obgyn_usia_gestasi}}<br>
      Kontrasi Uterus: {{$obgyn_detak_jantung}}<br>
      Detak Jantung Janin (x/menit): {{$obgyn_dilatasi_serviks}}<br>
      Dilatasi Serviks (cm): {{$obgyn_kontraksi_uterus}}<br>
    </b> 
    </td>
  </tr>

  <tr>
    <td>
    <b style="font-family:sans-serif;font-size:13px;"> 
      KEBUTUHAN KHUSUS<br>
      Airbone: {{$kebutuhan_khusus_airbone}}<br>
      Dekontaminan: {{$kebutuhan_khusus_dekontaminan}}<br>
    </b> 
    </td>
  </tr>

  <tr>
    <td>
    <b style="font-family:sans-serif;font-size:13px;"> 
      PEMERIKSAAN<br>
      @if($pemeriksaan_kategori == '1')
      Kategori: Umum
      @elseif($pemeriksaan_kategori == '2')
      Kategori: Neonatus
      @elseif($pemeriksaan_kategori == '3')
      Kategori: Obgyn
      @elseif($pemeriksaan_kategori == '0')
      Kategori: Umum
      @endif
      <br>
      @if($pemeriksaan_resusitasi_checked == '1')
      <b style="font-style:italic;font-size:20px;color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="color:gray;">DOA</b>
      @elseif($pemeriksaan_emergency_checked == '1')
      <b style="color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="color:gray;">DOA</b>
      @elseif($pemeriksaan_urgent_checked == '1')
      <b style="color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="color:gray;">DOA</b>
      @elseif($pemeriksaan_less_urgent_checked == '1')
      <b style="color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="color:gray;">DOA</b>
      @elseif($pemeriksaan_non_urgent_checked == '1')
      <b style="color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="color:gray;">DOA</b>
      @elseif($pemeriksaan_doa_checked == '1')
      <b style="color:blue;">Resusitasi (R1)</b>&nbsp;&nbsp;<b style="color:red;">Emergency (R2)</b>&nbsp;&nbsp;<b style="color:orange;">Urgent (R3)</b>&nbsp;&nbsp;<b style="color:green;">Less Urgent (R4)</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Non Urgent (R5)</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:gray;">DOA</b>
      @endif
      <br>
      Kriteria Triage: {{$kriteria}}<br>
      Handover Jaga: {{$handover}}<br>
      Plan Zone:&nbsp;
      @if($plan == '1')
      <b style="font-style:italic;font-size:20px;color:red;">Zona Merah</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Zona Kuning</b>&nbsp;&nbsp;<b style="color:green;">Zona Hijau</b>&nbsp;&nbsp;<b style="color:black;">Zona Hitam</b>
      @elseif($plan == '2')
      <b style="color:red;">Zona Merah</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:#FDDA0D;">Zona Kuning</b>&nbsp;&nbsp;<b style="color:green;">Zona Hijau</b>&nbsp;&nbsp;<b style="color:black;">Zona Hitam</b>
      @elseif($plan == '3')
      <b style="color:red;">Zona Merah</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Zona Kuning</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:green;">Zona Hijau</b>&nbsp;&nbsp;<b style="color:black;">Zona Hitam</b>
      @elseif($plan == '4')
      <b style="color:red;">Zona Merah</b>&nbsp;&nbsp;<b style="color:#FDDA0D;">Zona Kuning</b>&nbsp;&nbsp;<b style="color:green;">Zona Hijau</b>&nbsp;&nbsp;<b style="font-style:italic;font-size:20px;color:black;">Zona Hitam</b>
      @endif

    </b> 
    </td>
  </tr>

</table>

<!-- <div class="row">
  <div class="column4" style="text-align:center;">
    <p><b style="font-family:sans-serif;font-size:15px;">PETUGAS</b></p>
  </div>
  <div class="column5" style="text-align:center;">
  <p><b style="font-family:sans-serif;font-size:15px;">DPJP</b></p>
  </div>
</div>
    
    <br>
    <br>
<div class="row">
  <div class="column4" style="text-align:center;">
    <p><b style="font-family:sans-serif;font-size:15px;">(........................................)</b></p>
  </div>
  <div class="column5" style="text-align:center;">
  <p><b style="font-family:sans-serif;font-size:15px;">(........................................)</b></p>
  </div>
</div> -->



</body>
</html>
