<?php
    if (!isset($pagina))
        exit;

    //puxar banner
    $sql = "select * from banner order by rand() limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $imagem = $dados->banner;

    $sqlProduto = "select p.*, c.categoria from produtos p 
    inner join categorias c on (c.id = p.categorias_id)
    order by rand() limit 3";
    $consultaProduto = $pdo->prepare($sqlProduto);
    $consultaProduto->execute();
    $dadosProduto = $consultaProduto->fetch (PDO::FETCH_OBJ)
?>

<!-- banner promocional -->
<img src="../../admin/fotos/<?=$imagem?>.jpg" class="img-fluid" alt="<?=$imagem?>">
<br>

<h1>Home</h1>

<!-- Carrosel de produtos -->
<h2>Recomendados</h2>
<div id="produtos" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#produtos" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#produtos" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#produtos" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#produtos" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <?php
    While ($dados = $consultaProduto->fetch (PDO::FETCH_OBJ)){
    ?>
        <div class="carousel-item active">
        <a href="pages/produto/<?=$dadosProduto->id?>"><img src="../../admin/fotos/<?=$dadosProduto->imagem?>m.jpg" class="d-block w-100" alt="<?=$dadosProduto->produto?>"></a>
            <div class="carousel-caption d-none d-md-block">
                <h5><?=$dadosProduto->produto?></h5>
                <p><?=$dadosProduto->descricao?></p>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="carousel-item">
        <!-- Colocar uma imagem de mais produtos -->
      <a href="pages/produtos"><img src="../../admin/images/icone.png" class="d-block w-100" alt="Mais produtos"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Mais Produtos</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#produtos" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#produtos" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Carrosel de produtos -->
<?php
    $sqlCategorias = "select * from categorias order by rand() limit 3";
    $consultaCategorias = $pdo->prepare($sqlCategorias);
    $consultaCategorias->execute();

    $sqlProduto2 = "select p.*, c.categoria from produtos p 
    inner join categorias c on (c.id = p.categorias_id)
    where c.id = :categoria
    order by rand() limit 3";
    $consultaProduto2 = $pdo->prepare($sqlProduto2);
    $consultaProduto2->bindParam(":categoria", $categoria);
    $consultaProduto2->execute();

    While ($dadosCategorias = $consultaCategorias->fetch (PDO::FETCH_OBJ)){
        ?>
<h2><?=$dadosCategorias->categoria?></h2>
<div id="<?=$dadosCategorias->id?>" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#<?=$dadosCategorias->id?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#<?=$dadosCategorias->id?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#<?=$dadosCategorias->id?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#<?=$dadosCategorias->id?>" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <?php
    While ($dadosProduto2 = $consultaProduto2->fetch (PDO::FETCH_OBJ)){
    ?>
        <div class="carousel-item active">
        <a href="pages/produto/<?=$dadosProduto2->id?>"><img src="../../admin/fotos/<?=$dadosProduto2->imagem?>m.jpg" class="d-block w-100" alt="<?=$dadosProduto2->produto?>"></a>
            <div class="carousel-caption d-none d-md-block">
                <h5><?=$dadosProduto2->produto?></h5>
                <p><?=$dadosProduto2->descricao?></p>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="carousel-item">
        <!-- Colocar uma imagem de mais produtos -->
      <a href="pages/produtos"><img src="../../admin/images/icone.png" class="d-block w-100" alt="Mais produtos"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Mais Produtos</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#<?=$dadosCategorias->id?>>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#<?=$dadosCategorias->id?>>" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
 <?php
}
?>

