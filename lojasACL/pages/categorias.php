<?php
if (!isset($pagina))
    exit;


//puxar banner
$sql = "select * from banner order by rand() limit 1";
$consulta = $pdo->prepare($sql);
$consulta->execute();

$dados = $consulta->fetch(PDO::FETCH_OBJ);
$imagem = $dados->banner;
?>

<!-- banner promocional -->
<img src="../../admin/fotos/<?= $imagem ?>.jpg" class="img-fluid" alt="<?= $imagem ?>">
<br>

<h1>Categorias</h1>

<!-- puxar todos as categorias -->
<?php
if(empty($_POST["busca"])){
    $sql = "select * from categorias 
            order by categoria";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
} else {
    $busca = "%" . trim($_POST["busca"] ?? NULL) . "%";
    $sql = "select * from categorias
    where categoria like :busca 
    order by categoria";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":busca", $busca);
    $consulta->execute();
}
?>

<div class="container text-center">
    <div class="row row-cols-3">

        <?php
        //if ()
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <a href = "pages/categoria/<?=$dados->id?>" title ="id Categoria" class="card-title"><?= $dados->categoria?></a>
                    </div>
                </div>
                <br>
            </div>
        <?php
        }
        ?>
    </div>
</div>