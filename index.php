<?php
  /*criando conexão com o bd que fiz */
session_start();
  $servername = "localhost";
  $username = "root";
  $password ="";
  $dbname = "produtosdb";

   /*puxando a conexão */
  $conn = mysqli_connect($servername, $username, $password, $dbname); 

  /*condição: se o reslt for diferente de conexão, vai exibir o echo */
  if(!$conn){
    echo "Conexão falhada";
  }



if(isset($_POST["add"])){  /*o ususario enviou para o carrinho */
  $productId = $_GET["id"]; /*pega a id do prod */
  $productName = $_POST["hidden_name"];
  $productImage = $_POST["hidden_image"];
  $productPrice = $_POST["hidden_price"];
  $sql= "INSERT INTO `produto_2` (`descricao`, `image`, `price`) VALUES ('$productName','$productImage', '$productPrice');";
  mysqli_query($conn, $sql);
}


?>
<!DOCTYPE html>  
<html lang="pt-br">     
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Nostalgie</title>
</head>
<body>
<header>
  
</header>
   <nav> <!-- box de navegação onde coloca os links (sessão de navegação web)-->
     <div class="header">
 <p class="logo"><img src="img/logo.png"></p>

<div>
    <a class ="login" href="login.html">Registrar/Logar <i class="fa fa-user"></i></a> 
    <a class="carrinho" href="carrinho.php">Seu Carrinho  <i class="fa fa-shopping-cart"></i></a>       

</div>
   </nav> 
     <main>
      
      <h2>Nostalgie - Moda Sustentável </h2>
      <div class="container">
        <?php
        $query = "SELECT * FROM `produto_1` ORDER BY id ASC"; /*consulta o bd, a tabela prod_1 */
        $result = mysqli_query($conn, $query); /*armazena os dados recebidos na variavel result */
  
          if(mysqli_num_rows($result)>0){ /*conta o n de linhas retornados no $result */
            while($row = mysqli_fetch_array($result)){ /*pega o resultado e modifica pro php entender, faz isso enquanto houver linhas restant */
                ?>
            <div class="produto">   
<form action="index.php?action=add&id=<?php echo $row["id"]?>" method="post">  <!--formulario de adição, usando o metodo post para envio de dados de maneira mais privada, usa o id pra identificar os itens no carrinho e aparição na URL-->
        <div class="produto">
            <img src="img/<?php echo $row["image"];?>" alt="">  <!--Procura o caminho da img no BD-->
            <h3><?php echo $row["descricao"]?></h3> <!--imprime a desc da img na web, obtida na variavel $row-->
            <p>R$<?php echo $row["price"];?></p> <!--imprime o preço da img na web-->
            <input type="hidden" name="hidden_image" value="<?php echo $row["image"];?>">  <!--cria um espaço invisivel no form web, guarda o valor da $row, é enviado junto com outras info ao9 enviar o formulario-->
            <input type="hidden" name="hidden_name" value="<?php echo $row["descricao"];?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
            <button type="submit" class="button" name="add">Adicionar ao Carrinho</button>
       </div>  
</form>
 </div>
    <?php    
            }

          }
      ?>   
</div>       

     </main>
     <footer>
        © 2023 Nostalgie. Todos os direitos reservados.
    </footer>
  </body>
</html>