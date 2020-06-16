<?php
$exception = null;
$atalhoDado = [];

if(stripos($img_logo, '.png') > 0): // Filtrando apenas as extensões .png 
    $pastaUpload = IMG_LOGO;
    $nomeArquivo = $_FILES[$img_logo]['name'];
    $arquivo = $pastaUpload . $nomeArquivo;
    $tmp = $_FILES['arquivo']['tmp_name'];

    if(move_uploaded_file($tmp, $arquivo)) { 
        echo "<br>Imagem válido";
    } else {
        echo "<br>Erro no upload da imagem!";
    }
endif;

if(count($_POST) === 0 && isset($_GET['update'])) {
    $atalho = Atalhos::getOne(['atalho_id' => $_GET['update']]);
    $atalhoDado = $atalho->getValues();
    
}elseif(count($_POST) > 0) {
    try {
        $dbAtalho = new Atalhos($_POST);
        
        
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