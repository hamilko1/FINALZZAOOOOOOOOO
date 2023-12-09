<?php
  /*criando conexão com o bd que fiz */

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



  if(isset($_GET["action"])&& $_GET["action"] == "delete"){
    $productName = $_GET["name"];
    $deleteQuery = "DELETE FROM `produto_2` WHERE descricao = '$productName'";   
    mysqli_query($conn, $deleteQuery);
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

   <nav> <!-- box de navegação onde coloca os links (sessão de navegação web)-->
 <div class="header">
  <a href="index.php"><img src="img/logo.png"> <!--ao clicar na logo, direciona pra loja-->

<div>
      <a class="carrinho" href="carrinho.php">Seu Carrinho  <i class="fa fa-shopping-cart"></i></a>       
</div>
   </nav> 
     <div class="table_container">
    <table>               <!--criando a tabela de carrinho--> 
        <tr> <!--inicio de linha-->
            <th> Produtos </th>  <!--titulo de coluna-->
            <th> Descrição  </th>
            <th> Preço unitário </th>
            <th> Preço Total </th>
            <th> Remover item</th>
</tr>
<?php
$query = "SELECT * FROM `produto_2` ORDER BY id ASC"; /*consulta o bd, a tabela prod_1 */
$result = mysqli_query($conn, $query); /*armazena os dados recebidos na variavel result */
$total = 0;
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
        <td><img src="img/<?php echo $row["image"];?>" alt=""></td>
        <td><?php echo $row["descricao"];?></td>
        <td><?php echo $row["price"];?></td>
        <td><?php echo number_format($row["price"],2);?></td>  <!--formatação para numerop em foprmato de 2 casas decimais-->
        <td><a href="carrinho.php?action=delete&name=<?php echo $row["descricao"];?>" class="remover"><span><i class="fa fa-trash-o"></i></span></a></td> 
        <?php
        $total+=($row["price"]); /*somando os itens do carrinho */
        
    }
}
?>
</tr>
<tr></tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Total R$</td>
    <td><?php echo number_format($total,2);?></td>
    <td><a href="agradecimentos.html"><button style="padding: 8px 16px; background-color: #3498db; color: #ffffff; border: none; border-radius: 4px; cursor: pointer;">
        Finalizar compra</button></a>
</tr>
</table>
</div>
<footer>© 2023 Nostalgie. Todos os direitos reservados.</footer>
</body>
</html>

