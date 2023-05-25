<?php
if (!isset($pagina))
    exit;


//puxar banner
$sql = "select * from banner order by rand() limit 1";
$consulta = $pdo->prepare($sql);
$consulta->execute();

$dados = $consulta->fetch(PDO::FETCH_OBJ);
$imagem = $dados->banner;

$sqlCategoria = "select * from categorias 
        where id = :id limit 1";
$consultaCategoria = $pdo->prepare($sqlCategoria);
$consultaCategoria->bindParam(":id", $id);
$consultaCategoria->execute();
$dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)

?>

<!-- banner promocional -->
<img src="../../admin/fotos/<?= $imagem ?>.jpg" class="img-fluid" alt="<?= $imagem ?>">
<br>

<h1><?= $dadosCategoria->categoria ?></h1>

<!-- puxar todos os produtos -->
<?php
if (!empty($_POST["busca"])) {
    $busca = "%" . trim($_POST["busca"] ?? NULL) . "%";
    $sqlProdutos = "select p.*, c.categoria from produtos p 
        inner join categorias c on (c.id = p.categorias_id)
        where p.produto like :busca AND c.id = :id
        order by p.produto";
    $consultaProduto = $pdo->prepare($sqlProdutos);
    $consultaProduto->bindParam(":busca", $busca);
    $consultaProduto->bindParam(":id", $id);
    $consultaProduto->execute();
} else {
    $sqlProduto = "select p.*, c.categoria from produtos p 
        inner join categorias c on (c.id = p.categorias_id)
        where c.id = :id
        order by p.produto";
    $consultaProduto = $pdo->prepare($sqlProduto);
    $consultaProduto->bindParam(":id", $id);
    $consultaProduto->execute();
}

?>

<div class="container text-center">
    <div class="row row-cols-3">

        <?php
        //if ()
        while ($dados = $consultaProduto->fetch(PDO::FETCH_OBJ)) {
        ?>
            <div class="col">
                <div class="card">
                    <img src="../../admin/fotos/<?= $dados->imagem ?>m.jpg" class="card-img-top" alt="<?= $dados->produto ?>">

                    <div class="card-body">
                        <h5 class="card-title"><?= $dados->produto ?></h5>
                        <p class="card-text"><?= $dados->descricao ?></p>
                        <a href="produto" class="btn btn-primary" value="<?= $dados->id ?>">Detalhes</a>
                    </div>
                </div>
                <br>
            </div>
        <?php
        }
        ?>
    </div>
</div>