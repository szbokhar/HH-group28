<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Error!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">

div#container {width:90%; margin: auto auto; background-color:#DDD; padding: 25px; height: 300px; border: 1px solid #369}
div#image { width: 125px; height: 200px; float:left;
	background:url('public/img/nope.jpg') top left no-repeat;
    background-size: contain;
	} 
div#message { width: 700px; float:left}
table th {text-align:right;color:#339; padding-right:5px; width: 120px}
h3 {color:#339}
</style>
</head>

<body>
<div id="container">
 <div id="image"></div>
  <div id='message'>
          <h3>A System error has occured (ErrorHandler)!!</h3>
          <table>
            <tr>
              <th >Time:</th>
              <td><?=  $TPL["time"]    ?></td>
            </tr>
            <tr>
              <th valign="top">Message :</th>
              <td><?= $TPL['errorMessage'] ?></td>
            </tr>
            <tr>
              <th>ErrorNo:</th>
              <td><?= $TPL['errorNumber']  ?></td>
            </tr>
            <tr>
              <th>Filename:</th>
              <td><?= $TPL['errorFileName']  ?></td>
            </tr>
            <tr>
              <th>Line Number: </th>
              <td><?= $TPL['errorLineNumber'] ?></td>
            </tr>
        </table>
        <p>If the message persists, please <a href="#">contact</a> us. </p>
</div>
</div>
</body>
</html>
