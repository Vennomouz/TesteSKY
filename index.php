<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teste da SKY</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>

  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Minhas Despesas</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="card-deck">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Despesas de hoje (R$)</h5>
          <h2 class="card-text">R$ 0,00</h2>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Despesas do mês (R$)</h5>
          <h2 class="card-text">R$ 0,00</h2>
        </div>
      </div>

    </div>
  </div>

  <br>

  <div class="container"> 
    <div class="row-2"> 
      <button type="button" class="btn btn-secondary btn-lg" onclick="Mudar_Estado('ajax_form')">Cadastrar nova despesa</button>
    </div>
  </div>

  <br>

  <form method="post" action="" id="ajax_form">
    <div class="form row col-md-12"> 

      <div class="form-group col-md-4">
        <input type="text" class="form-control" name="nome" placeholder="Nome">
      </div>

      <div class="form-group col-md-4">
        <select class="form-control" name="categoria" placeholder="Categoria">
          <option disabled selected style="display: none;">Categoria</option>
          <option value="Alimentação">Alimentação</option>
          <option value="Saúde">Saúde</option>
          <option value="Transporte">Transporte</option>
          <option value="Entretenimento">Entretenimento</option>
          <option value="Casa">Casa</option>
        </select>
      </div>

      <div class="form-group col-md-4">
        <input type="text" class="form-control" name="valor" placeholder="Valor (R$)">
      </div>

    </div>

    <div align="center">
      <button type="submit" class="btn btn-secondary btn-lg" name="enviar">Cadastrar</button>
    </div>

    <!-- <label><input id = "btn" type="submit" name="enviar" value="Enviar" /></label> -->

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

  function Mudar_Estado(elmt) {
        var display = document.getElementById(elmt).style.display;
        if(display == "none")
            document.getElementById(elmt).style.display = 'block';
        else
            document.getElementById(elmt).style.display = 'none';
    }

</script>