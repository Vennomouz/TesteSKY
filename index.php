<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Document</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
  <form method="post" action="" id="ajax_form">
      <label><input type="hidden" name="id" value="" /></label>
      <label>Nome: <input type="text" name="nome" value="" /></label>
      <label>Idade: <input type="text" name="idade" value="" /></label>

      <label><input type="submit" name="enviar" value="Enviar" /></label>
  </form>
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
</script>