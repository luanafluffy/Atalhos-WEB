<main class="content">
<?php
    renderTitle(
        'Acessar Atalhos',
        'Procure seus atalhos cadastrados.',
        'icofont-reply-all'
    );
    include(TEMPLATE_PATH . "/messages.php");
?>

<a class="btn btn-lg btn-danger mb-3" href="salvar_atalho.php">Novo Atalho</a>
<form class="mb-4" action="#" method="post">
    <div class="input-group">   
        <select name="atalho" class="form-control mr-2" placeholder="Selecione o usuário...">
        <option value="">Procure aqui...</option>
            <?php
                foreach($atalhos as $atalho) {
                    $selected = $atalho->atalho_id === $selectedUserId ? 'selected' : '';
                    echo "<option value='{$atalho->atalho_id}' {$selected}>{$atalho->titulo}</option>";
                }
            ?>
        </select>
        <button class="btn btn-warning ml-2">
            <i class="icofont-search"></i>
        </button>
    </div>
</form>

<table class="table table-bordered table-striped table-hover">
        
</table>

<div class="card">
    <div class="card-header">
        <p class="mb-0">Aqui você encontra e arquiva seus atalhos de sites de maneira mais rápida!</p>
    </div>
    <div class="card-body">
        <div class="summary-boxes">

            <?php foreach($atalhos as $atalho): ?>
                <div class="summary-box">
                    <!-- Titulo -->
                    <h3 class="title"><?= $atalho->titulo ?></h3>
                    <!-- Imagem -->
                    <img src="assets/img/<?= $atalho->img_logo ?>" height="120"> <!-- Mostrando as imagens em miniaturas -->
                    <!-- Subtitulo e links -->
                    <p class="subtitle"><a href="<?= $atalho->link_subtitulo1 ?>"><?= $atalho->subtitulo1 ?></a></p>
                    <p class="subtitle"><a href="<?= $atalho->link_subtitulo2 ?>"><?= $atalho->subtitulo2 ?></a></p>
                    <div>
                        <a href="salvar_atalho.php?update=<?= $atalho->atalho_id ?>" class="btn btn-warning rounded-circle mr2">
                            <i class="icofont-edit"></i>
                        </a>
                        <a href="?delete=<?= $atalho->atalho_id ?>" class="btn btn-danger rounded-circle">
                            <i class="icofont-trash"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>   
</div>
</main>