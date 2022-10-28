<?php
echo PHP_EOL;
echo PHP_EOL;
echo "############ Consulta DNS no RegistroBR ###########";
echo PHP_EOL;
echo PHP_EOL;
echo "\033[0;31m                ###  Atenção!  ###                 ";
echo PHP_EOL;
echo PHP_EOL;

echo "Você deve rodar este programa utilizando uma VPN." . PHP_EOL;
echo "Caso você não faça isso o RegistroBr poderá bloquear" . PHP_EOL;
echo "o ip da sua rede e você não poderá efetuar novas operações.\033[0m";
echo PHP_EOL;
echo PHP_EOL;

$vpn = readline("Você está utilizando uma VPN [Y/N]: ");

if ($vpn != "Y" && $vpn != "y") {

    echo PHP_EOL;
    echo "Fim do programa Consulta DNS no RegistroBR.";
    echo PHP_EOL;
    echo PHP_EOL;
    exit();
}

echo PHP_EOL;

$file = readline("Digite o caminho completo para o arquivo CSV: ");

if (!file_exists($file)) {
    echo PHP_EOL;
    echo "\033[0;31mNão foi possível abrir este arquivo. Verifique o caminho e tente novamente.\033[0m";
    echo PHP_EOL;
    echo PHP_EOL;
    exit();
}

$handle = fopen($file, "r");

while ($row = fgetcsv($handle, 1000, ",")) {
    $lista_dns[] = $row[0];
}

fclose($handle);

$lista_final = [];

$handle = fopen('resultado.csv', 'w');

foreach ($lista_dns as $dns) {

    $linha = [];

    array_push($linha, $dns);

    $curl = curl_init("https://rdap.registro.br/domain/" . $dns);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);

    curl_close($curl);

    $Dados = json_decode($response, true);

    if (!empty($Dados['nameservers'][0]['ldhName'])) {
        array_push($linha, $Dados['nameservers'][0]['ldhName']);
    } else {
        array_push($linha, "Sem Informacoes");
    }

    if (!empty($Dados['nameservers'][1]['ldhName'])) {
        array_push($linha, $Dados['nameservers'][1]['ldhName']);
    } else {
        array_push($linha, "Sem Informacoes");
    }

    if (!empty($Dados['nameservers'][2]['ldhName'])) {
        array_push($linha, $Dados['nameservers'][2]['ldhName']);
    } else {
        array_push($linha, "Sem Informacoes");
    }

    fputcsv($handle, $linha);
}

fclose($handle);

echo PHP_EOL;
echo "O resultado da consulta está disponível em: \033[0;32m" . __DIR__ . DIRECTORY_SEPARATOR . "resultado.csv\033[0m";
echo PHP_EOL;
echo PHP_EOL;
echo "Fim do programa Consulta DNS no RegistroBR.";
echo PHP_EOL;
echo PHP_EOL;
