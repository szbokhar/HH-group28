<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Error!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">

div#container {width:90%; margin: auto auto;  padding: 25px; height: 300px; border: 1px solid #369}
div#image { width: 200px; height: 500px; float:left;
	background:url('http://i.bittwiddlers.org/KOo.gif') top left no-repeat;
    background-size: contain;
	} 
div#message { width: 800px; float:left}
table th {text-align:right;vertical-align:top;color:#339; padding-right:5px; width: 150px}
h3 {color:#339}
</style>
</head>
<body>
<div id="container">
 <div id="image"></div>
  <div id='message'>
          <h3>A Database error has occured ! </h3>
          <table>
            <tr>
              <th >Time:</th>
              <td><?=  $TPL["time"]    ?></td>
            </tr>
            <tr>
              <th valign="top">Message :</th>
              <td><?= $TPL['message'] ?></td>
            </tr>
            <tr>
              <th>Exception Message:</th>
              <td><?= $TPL['exceptionMsg']  ?></td>
            </tr>
            <tr>
              <th>PDOS Values:</th>
              <td><?= $TPL['PDOS_Values']  ?></td>
            </tr>
            <tr>
              <th>Line Number: </th>
              <td><?= $TPL['traceDetails'] ?></td>
            </tr>
        </table>
        <p>If the message persists, please <a href="#">contact</a> us. </p>
        <p><a href="./system/logFiles/logfile.txt" target=_blank>Logfile</a>
        </p>
</div>
</div>
</body>
</html>
