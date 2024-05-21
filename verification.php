<?php
// Função para verificar se uma data/hora está dentro dos próximos 30 dias e dentro dos horários de trabalho válidos
function verificarDataHora($date, $time) {
    // Verifica se a data está dentro dos próximos 30 dias
    $currentDate = strtotime("today"); // Data atual (sem horário)
    $next30Days = strtotime("+30 days", $currentDate);
    $inputDateTime = strtotime("$date $time");
    if ($inputDateTime < $currentDate || $inputDateTime > $next30Days) {
        return "Inválido. A data e hora devem estar dentro dos próximos 30 dias.";
    }

    // Verifica se a hora está dentro dos horários de trabalho válidos (9h às 12h e das 13h às 18h)
    $inputHour = date("H", $inputDateTime);
    if ($inputHour < 9 || ($inputHour >= 12 && $inputHour < 13) || $inputHour >= 18) {
        return "Inválido. A hora fornecida não está dentro dos horários de trabalho válidos.";
    }

    // Se passou por todas as verificações, retorna sucesso
    return "A data e hora fornecidas são válidas.";
}

// Verifica se a requisição é POST e se as chaves "date" e "time" foram enviadas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["date"]) && isset($_POST["time"])) {
    $inputDate = $_POST["date"];
    $inputTime = $_POST["time"];
    echo verificarDataHora($inputDate, $inputTime);
} else {
    // Caso a requisição não seja POST ou não tenha as chaves "date" e "time"
    echo "Requisição inválida.";
}
?>
