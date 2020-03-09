<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teste da SKY</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
          <h2 class="card-text" id="card1"></h2>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Despesas do mês (R$)</h5>
          <h2 class="card-text" id="card2">R$ 0,00</h2>
        </div>
      </div>

    </div>
  </div>

  <br><br>

  <div align="center"> 
      <button type="button" class="btn btn-secondary btn-lg" id="btnExibir">Cadastrar nova despesa</button>
  </div>

  <br><br>

  <div class="container">
    <form method="post" action="" id="ajax_form">

      <div class="form row"> 

        <div class="form-group col-md-4 col-xs-12">
          <input type="text" class="form-control" name="nome" placeholder="Nome">
        </div>

        <div class="form-group col-md-4 col-xs-12">
          <select class="form-control" name="categoria" placeholder="Categoria">
            <option disabled selected style="display: none;">Categoria</option>
            <option value="Alimentação">Alimentação</option>
            <option value="Saúde">Saúde</option>
            <option value="Transporte">Transporte</option>
            <option value="Entretenimento">Entretenimento</option>
            <option value="Casa">Casa</option>
          </select>
        </div>

        <div class="form-group col-md-1 col-2">
            <h4>R$</h4>
        </div>

        <div class="form-group col-md-3 col-10">
          <input type="text" class="form-control" name="valor" placeholder="Valor">
        </div>

      </div>

      <div align="center">
        <button type="submit" class="btn btn-secondary btn-lg" name="enviar">Cadastrar</button>
      </div>

    </form>
  </div>

  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-auto col-xs-auto"><h1>Lista de Despesas</h1></div>
    </div>
  </div>

  <div class="container">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Categoria</th>
          <th scope="col">Data</th>
          <th scope="col">Valor (R$)</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="linha">
        
      </tbody>
    </table>
  </div>

</body>
</html>

<script>

  jQuery(document).ready(function(){

    var card1 = 0;
    var card2 = 0;

    jQuery.ajax({ // FUNÇÃO CARREGADA COM A PAGINA PARA LISTAR OS DADOS DO BANCO
        type: "GET",
        url: "classes/listar.php",
        datatype: "json",
        success: function(data)
        {
          for(const despesa in data) { // CRIA VARIAVEL DESPESA QUE RECEBE OS INDICES DO ARRAY JSON
            
            let day = new Date (data[despesa].data);
            let today = new Date();

            if(day.getDay() == today.getDay()){
              card1 += Number.parseFloat(data[despesa].valor);
            }
            document.querySelector("#card1").innerHTML = new Number (card1).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});

            if(day.getMonth() == today.getMonth()){
              card2 += Number.parseFloat(data[despesa].valor);
            }
            document.querySelector("#card2").innerHTML = new Number (card2).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});

            let linha = document.querySelector('#linha'); //SETA VARIAVEL LINHA RECEBENDO O OBJETO COM ID "LINHA"
            //MANIPULAÇÃO DE DOM NO HTML
            //innerHTML ADICIONA TUDO O QUE EU QUISER DENTRO DO OBJETO HTML
            //NESTE LOOP CONCATENEI DENTRO DA VARIAVEL LINHA OS VALORES DOS OBJETOS PEGOS NESTE LOOP
            linha.innerHTML += `<tr>                                  
                                  <td>${data[despesa].nome}</td>
                                  <td>${data[despesa].categoria}</td>
                                  <td>${new Date (data[despesa].data).toLocaleDateString()}</td>
                                  <td>${new Number (data[despesa].valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }</td>
                                  <td><button class="btn btn-default fas fa-trash-alt" name="excluir"></button></td>
                                  <input class="idDespesa" type="hidden" value="${data[despesa].id}"></input>
                                </tr>`

            let botoesExcluir = document.querySelectorAll('[name="excluir"]'); // PEGO TODOS OBJETOS HTML COM NAME "EXCLUIR"
            for (let excluir of botoesExcluir){ //SETA VARIAVEL EXCLUIR PARA CADA OBJETO HTML COM ID "EXCLUIR"
                excluir.addEventListener('click', function(){ // ADICIONA EVENTO CLICK NOS OBJETOS COM ID "EXCLUIR"
                var input = excluir.closest('tr'); // SETA VARIAVEL "INPUT" REFERENCIANDO TODOS OS OBJETOS DE "TR" 
                var data = input.children // SETA VARIAVEL DATA ACESSANDO OS OBJETOS DA CLASSE PAI "TR"
                deletar(data.item(5).value); // CHAMA A FUNÇÃO DELETAR PASSANDO O VALOR DO OBJETO DA POSIÇÃO 6 DA CLASSE PAI "TR"
              })
            }

            function deletar(id){
              jQuery.ajax({
                type: "DELETE",
                url: `classes/deletar.php?id=${id}`,
                
                success: function(data)
                {
                  window.alert(data.message);
                  window.location.reload();
                },
                error: function(err){
                  let mensagem = JSON.parse(err.responseText);
                  alert(mensagem.message);
                }
              });
            }

          }
        },
        error: function(err){
          alert("Erro ao cadastrar!");
        }
      });

    jQuery('#ajax_form').submit(function(e){
      e.preventDefault();
      var dados = jQuery(this).serialize();

      jQuery.ajax({
        type: "POST",
        url: "classes/cadastrar.php",
        data: dados,
        success: function(data)
        {
          window.alert("Dados cadastrados com sucesso!")
          window.location.reload();
        },
        error: function(err){
          let mensagem = JSON.parse(err.responseText);
          alert(mensagem.message);
        }
      });
    });
    
  });

  const buttomExibe = document.querySelector("#btnExibir");

  buttomExibe.addEventListener('click', function(e){
    e.preventDefault() 

    let form = document.querySelector("#ajax_form");
    if (form.style.display != "block"){
      form.setAttribute("style", "display: block;");
    }else{
      form.setAttribute("style", "display: none;");
    }
  });
    
</script>