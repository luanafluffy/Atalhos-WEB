<?php

// session_start();
// $atalho = $_SESSION['atalho'];

$atalhos = Atalhos::get();
$selectedAtalhoId = $_POST['atalho'] ? $_POST['atalho'] : $atalho->atalho_id;

$exception = null;
if(isset($_GET['delete'])) {
    try {
        Atalhos::deleteById($_GET['delete']);
        addSuccessMsg('Atalho excluído com sucesso.');
    } catch(Exception $e) {
        $exception = $e;
    }
}

$date = (new Datetime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);
loadTemplateView('atalhos', [
    'today' => $today, 
    'exception' => $exception,
    'selectedAtalhoId' => $selectedAtalhosId,
    'atalhos' => $atalhos
]);