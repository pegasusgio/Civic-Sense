<script>
  var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "addClassNames": true,
    "marginLeft": 25,
    "marginRight": 25,
    "marginTop": 45,
    "marginBottom": 0,
    "autoMarginOffset": 15,
    "startDuration": 2,
    "sequencedAnimation": false,
    "dataProvider": [{
      "month": "GEN",
      "value1":



        <?php

        $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
        mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

        $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 01 AND tipo = '1' ");

        if (mysqli_num_rows($quer) > 0) {
          while ($row = mysqli_fetch_assoc($quer)) {
            echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
          }
        }
        ?>,







      "value2": 15,
      "value3": 0,
      "value4": 20,
      "color": "#807fd3"
    }, {
      "month": "FEB",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 02 AND tipo = '1'");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,

      "value2": 15,
      "value3": 0,
      "value4": 0,
      "color": "#6e6abc"
    }, {
      "month": "MAR",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 03 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 20,
      "color": "#807fd3"
    }, {
      "month": "APR",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 04 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 2,
      "color": "#6e6abc"
    }, {
      "month": "MAG",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 05 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 33,
      "color": "#807fd3"
    }, {
      "month": "GIU",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 06 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": -5,
      "color": "#6e6abc"
    }, {
      "month": "LUG",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 07 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 45,
      "color": "#807fd3"
    }, {
      "month": "AGOS",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 08 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 10,
      "color": "#6e6abc"
    }, {
      "month": "SETT",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 09 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 38,
      "color": "#807fd3"
    }, {
      "month": "OTT",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 10 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": -5,
      "color": "#6e6abc"
    }, {
      "month": "NOV",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 11 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

	";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 48,
      "color": "#807fd3"
    }, {
      "month": "DIC",
      "value1": <?php

                $conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");
                mysqli_select_db($conn, "civicsense") or die("DataBase non trovato");

                $quer = mysqli_query($conn, "Select COUNT(*) AS cont
FROM segnalazioni
Where month(datainv) = 12 AND tipo = '1' ");

                if (mysqli_num_rows($quer) > 0) {
                  while ($row = mysqli_fetch_assoc($quer)) {
                    echo   "
	
		       
			  " . filter_var($row['cont'], FILTER_SANITIZE_NUMBER_INT) . "  

";
                  }
                }
                ?>,
      "value2": 15,
      "value3": 0,
      "value4": 62,
      "color": "#6e6abc"
    }],
    "graphs": [{
      "id": "g1",
      "lineAlpha": 0,
      "lineThickness": 3,
      "valueField": "value1",
      "showBalloon": false
    }, {
      "id": "g2",
      "lineAlpha": 0,
      "lineColor": "#fff",
      "lineThickness": 0,
      "fillColors": "#807fd3",
      "fillColorsField": "color",
      "fillAlphas": 1,
      "valueField": "value2",
      "showBalloon": false
    }, {
      "id": "g3",
      "lineAlpha": 1,
      "lineColor": "#fff",
      "lineThickness": 5,
      "valueField": "value3",
      "balloonColor": "#5fb3f3",
      "balloonText": "[[value1]]",
      "balloon": {
        "drop": true,
        "adjustBorderColor": false,
        "color": "#ffffff"
      }
    }, {
      "id": "g4",
      "lineAlpha": 1,
      "lineColor": "#000",
      "lineThickness": 10,
      "valueField": "value4",
      "showBalloon": false,
      "stackable": false,
      "lineAlpha": 0.6
    }],
    "categoryField": "month",
    "categoryAxis": {
      "color": "#8a86c7",
      "axisColor": "#5957b1",
      "gridAlpha": 0,
      "startOnAxis": false,
      "balloon": {
        "fillAlpha": 1,
        "fontSize": 15,
        "horizontalPadding": 10
      }
    },
    "valueAxes": [{
      "stackType": "regular",
      "gridAlpha": 0,
      "gridColor": "#5957b1",
      "axisAlpha": 0,
      "labelsEnabled": false,
      "minimum": 0,
      "maximum": 100,
      "ignoreAxisWidth": true
    }],
    "balloon": {
      "borderThickness": 0,
      "shadowAlpha": 0,
      "fontSize": 18
    },
    "chartCursor": {
      "cursorAlpha": 0.7,
      "cursorColor": "#5fb3f3",
      "limitToGraph": "g3",
      "categoryBalloonColor": "#5e59b9",
      "categoryBalloonAlpha": 1,
      "zoomable": false
    },
    "defs": {
      "filter": [{
        "x": "-50%",
        "y": "-50%",
        "width": "200%",
        "height": "200%",
        "id": "blur",
        "feGaussianBlur": {
          "in": "SourceGraphic",
          "stdDeviation": "15"
        }
      }]
    }
  });
</script>