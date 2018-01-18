<html>
	<head>
		<title>CercaLuoghi</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- utilizzata per responsive-->
        <style>
              #stiletab {
                  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
              }

              #stiletab td, #stiletab th {
                  border: 1px solid #ddd;
                  padding: 8px;
              }

              #stiletab tr:nth-child(even){background-color: #f2f2f2;}

              #stiletab tr:hover {background-color: #ddd;}

              #stiletab th {
                  padding-top: 12px;
                  padding-bottom: 12px;
                  text-align: left;
                  background-color: #4CAF50;
                  color: white;
              }
        </style>
	</head>
	
	<body align="center" background="http://www.themefoxx.com/wp-content/uploads/2017/08/Android-Oreo-Stock-Wallpapers-ThemeFoxx-7.png"><font face="calibri" size="5"> <!--bgcolor="#C99840"-->
		<?php
        	//compongo le variabili per l'url
            $host = "https://api.foursquare.com/v2/venues/search?";
			$client_id = "XXXXX";
			$client_secret = "YYYYY";
			$near = $_POST['citta'];
			$query = $_POST['servizio'];
			$limit = $_POST['limite'];
			$v = "20171206"; //20170801
			$url = $host."query=".$query."&near=".$near."&limit=".$limit."&client_id=".$client_id."&client_secret=".$client_secret."&v=".$v."";

            //recupero i dati tramite richiesta https
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            //decodifico il file json ottenuto
            $content = json_decode($result,true);
            
            //stampo la tabella
            print "<table align=\"center\" bgcolor=\"#FFFFFF\" id=\"stiletab\"><tr bgcolor=\"#FCBF50\"><td align=\"center\"><b>NOME</b></td><td align=\"center\"><b>LUOGO</b></td><td align=\"center\"><b>INDIRIZZO</b></td><td align=\"center\"><b>TELEFONO</b></td></tr>";
			foreach($content['response']['venues'] as $pizz) {
              print "<tr bgcolor=\"#FFFFFF\"><td>".$pizz['name']."</td><td>".$pizz['location']['city']."</td><td>".$pizz['location']['address']."</td><td>".$pizz['contact']['phone']."</td></tr>";
			}
            print "</table>";
		?>
        <br>
        <input type=button onClick="location.href='index.html'" value='Torna alla home!'>
	</font></body>
</html>
