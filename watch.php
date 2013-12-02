<?php 
	include 'serverTime.php';
	$filename = 'lastStart.php';
	$startTime = time()*1000;
	if(isset($_GET["start"])) {
		
		
    // Wir öffnen $filename im "Anhänge" - Modus.
    // Der Dateizeiger befindet sich am Ende der Datei, und
    // dort wird $somecontent später mit fwrite() geschrieben.
    if (!$handle = fopen($filename, "w")) {
         exit;
    }

    // Schreibe $somecontent in die geöffnete Datei.
    if (!fwrite($handle, '<?php $startTime='.$startTime.'; ?>')) {
        exit;
    } 


    	fclose($handle);
	} 

	else {
		include $filename;
	}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html style="height: 100%">
  <head>
    <title>Stoppuhr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    	* {
			margin: 0;
			padding: 0;
		}
    	html, body
			{
    			height: 100%;
    			width: 100%;
			}

    </style>
    <script type="text/javascript">
    	function StopWatch(){
			var startTime = null;
			var stopTime = null;
			var running = false;

   			startTime = <?php echo $startTime;?>;
   			serverTime = <?php echo $serverTime;?>;
   			clientTime = new Date();

   			client_server_diff = clientTime - serverTime;

			this.stop = function(){
			    
			    if (running == false)
			        return;    
			    
			    stopTime = getTime();
			    running = false;
			}

			this.duration = function(){
				var c_stopTime = stopTime;
				if (c_stopTime == null) {
					c_stopTime = getTime();
				}
			    if (startTime == null )
			        return 'Undefined';
			    else
			    	var diff = new Date(c_stopTime - startTime);
			    	
			    	var msec = diff - client_server_diff;
					var hh = Math.floor(msec / 1000 / 60 / 60);
					msec -= hh * 1000 * 60 * 60;
					var mm = Math.floor(msec / 1000 / 60);
					msec -= mm * 1000 * 60;
					var ss = Math.floor(msec / 1000);
					msec -= ss * 1000;



					hh = hh < 10 ? "0"+hh : hh;
					mm = mm < 10 ? "0"+mm : mm;
					ss = ss < 10 ? "0"+ss : ss;

					return hh+"h "+mm+"m "+ss+"s";
			        //return (c_stopTime - startTime) / 1000;
			}

			this.isRunning = function() { return running; }

			function getTime(){
			    return new Date();
			}


			}
    </script>
    <script type="text/javascript">
    	var st = new StopWatch(); 
    	var update = function () { 
    		document.getElementById("StopWatchView").innerHTML = st.duration();
    	}; 

		var timerFunction = function () {
			update();
			window.setTimeout(timerFunction, 10);
		}
    </script>

  </head>
  <body style="height: 100%;" onload='timerFunction();window.onresize = function(){ location.reload(); }'>
    <h1 style="height: 100%; font-size: 15vw; color:#529DDF; text-align: center; font-weight:normal; " id="StopWatchView">  </h1>
  </body>
</html>