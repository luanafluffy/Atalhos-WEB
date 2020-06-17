<?php
$exception = null;
$atalhoDado = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $atalho = Atalhos::getOne(['atalho_id' => $_GET['update']]);
    $atalhoDado = $atalho->getValues();
    
} elseif(count($_POST) > 0) {
    try {
        $dbAtalho = new Atalhos($_POST);
        $nomeDoArquivo = $_FILES['img_logo']['name'];

        $dir = 'assets/img/'; //Diretório para uploads
        if(move_uploaded_file($_FILES['img_logo']['tmp_name'], $dir. $nomeDoArquivo)) { 
            echo "<br>Arquivo válido e enviado com sucesso.";
        }
        
        if($dbAtalho->atalho_id) {
            $dbAtalho->update();
            addSuccessMsg('Atalho alterado com sucesso!');
            exit();
        } else {
            $dbAtalho->insert();
            addSuccessMsg('Atalho cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $atalhoDado = $_POST;
    }
}

$date = (new Datetime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);
loadTemplateView('salvar_atalho', $atalhoDado + ['exception' => $exception]);