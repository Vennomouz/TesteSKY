<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>

  <p id="test">Despesas Pessoais</p>

  <form method="post" action="" id="ajax_form">
      <label><input type="hidden" name="id" value="" /></label>
      <label>Nome: <input type="text" name="nome" value="" /></label>
      <label>Idade: <input type="text" name="idade" value="" /></label>

      <label><input id = "btn" type="submit" name="enviar" value="Enviar" /></label>

  </form>

  <button type="button" class="btn btn-secondary btn-lg" onclick="Mudar_Estado('test')">Large button</button>

</body>
</html>

<script type="text/javascript">

  jQuery(document).ready(function(){
    jQuery('#ajax_form').submit(function(){
      var dados = jQuery(this).serialize();

      jQuery.ajax({
        type: "POST",
        url: "test.php",
        data: dados,
        success: function(data)
        {
          console.log(data);
        }
      });
      return false;
    });
  });

  function Mudar_Estado(elmt) {
        var display = document.getElementById(elmt).style.display;
        if(display == "none")
            document.getElementById(elmt).style.display = 'block';
        else
            document.getElementById(elmt).style.display = 'none';
    }

</script>