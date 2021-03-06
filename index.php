<html>
<head>
  <title>Passwort Generator</title>
  <style>
  body {
    font-family: monospace;
  }
  </style>
</head>
<body>
  <?php
  // Prüfe ob Formular abgesendet wurde
  if (isset($_POST["submit"])) {
      // Prüfe ob Länge gesetzt wurde
      if (isset($_POST["laenge"]) && $_POST["laenge"] != "" &&
          isset($_POST["menge"]) && $_POST["menge"] != "") {
          // Prüfe ob mindestens eine Zeichenoption gesetzt wurde
          if (isset($_POST["grossbuchstaben"]) ||
              isset($_POST["kleinbuchstaben"]) ||
              isset($_POST["zahlen"]) ||
              isset($_POST["sonderzeichen"])) {

              // Variablen Initialisieren
              $menge = (int)$_POST["menge"];          
              $laenge = (int)$_POST["laenge"];
              $characters = "";
              $output = array();

              // Erweitere die Möglichen Charaktere je nach Optionsauswahl
              if (isset($_POST["grossbuchstaben"])) $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
              if (isset($_POST["kleinbuchstaben"])) $characters .= "abcdefghijklmnopqrstuvwxyz";
              if (isset($_POST["zahlen"])) $characters .= "1234567890";
              if (isset($_POST["sonderzeichen"])) $characters .= "@!%&()=?";

              // Generiere Passwort/Passwörter
              for ($i = 0; $i < $menge; $i++) {
                  $temp_output = "";
                  for ($c = 0; $c < $laenge; $c++) {
                      $temp_output .= $characters[rand(1,strlen($characters)-1)];
                  }
                  $output[] = $temp_output;  
              }

              // Passwort/Passwörter ausgeben
              echo "<strong>generiertes Passwort / generierte Passw&ouml;rter:</strong><br />";
              foreach ($output AS $key => $value) {
                  echo $value."<br />";
              }
          } else echo "Es muss mindestens eine Zeichenoption angew&auml;hlt werden!<br />";
      } else echo "Es muss eine L&auml;nge und Menge angegeben werden!<br />";
      echo "<br /><hr /><br />";
  }
  ?>
  <form action="<?= $_SERVER["PHP_SELF"]; ?>" 
        method="POST" 
        style="width:40%;">
    <div style="width:50%;float:left;">
      <u>Zeichenoptionen</u><br />
      <br />
      <input type="checkbox" 
             name="grossbuchstaben" 
             <?php if (isset($_POST["grossbuchstaben"])) echo "checked='checked'"; ?>> 
      Gro&szlig;buchstaben<br />
      <input type="checkbox" 
             name="kleinbuchstaben" 
             <?php if (isset($_POST["kleinbuchstaben"])) echo "checked='checked'"; ?>> 
      Kleinbuchstaben<br />
      <input type="checkbox" 
             name="zahlen" 
             <?php if (isset($_POST["zahlen"])) echo "checked='checked'"; ?>> 
      Zahlen<br />
      <input type="checkbox" 
             name="sonderzeichen" 
             <?php if (isset($_POST["sonderzeichen"])) echo "checked='checked'"; ?>> 
      Sonderzeichen<br />
    </div>
    <div style="width:50%;float:right;">
      L&auml;nge:<br /> 
      <input type="number" 
             min="1" 
             step="1"
             name="laenge"
             value="<?= (int)$_POST["laenge"]; ?>"><br />
      Anzahl der Passw&ouml;rter:<br />       
      <input type="number"
             min="1"
             step="1"
             name="menge"
             value="<?= (int)$_POST["menge"]; ?>">       
      <br /><br />        
      <input type="submit"
             name="submit"
             value="Generieren"
             style="width:100%;">        
    </div>
  </form>
</body>
</html>
