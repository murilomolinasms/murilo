<?php
// Definir os preços dos itens
$precos = [
    'qtd_xburger' => 8.30,
    'qtd_mistoquente' => 7.00,
    'qtd_xsalada' => 8.90,
    'qtd_coca' => 6.00,
    'qtd_fanta' => 5.00,
    'qtd_pepsi' => 5.50,
    'qtd_batata' => 10.00,
    'qtd_onionrings' => 12.00,
    'qtd_brigadeiro' => 2.00,
    'qtd_beijinho' => 2.50
];

// Inicializa o total
$total = 0;
$itens_selecionados = [];

// Percorre os itens para calcular o total e armazenar os itens selecionados
foreach ($_POST as $item => $quantidade) {
    if ($quantidade > 0 && isset($precos[$item])) {
        $subtotal = $precos[$item] * $quantidade;
        $total += $subtotal;
        $itens_selecionados[] = ucfirst(str_replace('qtd_', '', $item)) . " (Qtd: $quantidade) - Subtotal: R$ " . number_format($subtotal, 2, ',', '.');
    }
}

// Exibe o resumo da compra
echo "<h1>Resumo da Compra</h1>";

if (!empty($itens_selecionados)) {
    echo "<ul>";
    foreach ($itens_selecionados as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
    echo "<p><strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
} else {
    echo "<p>Nenhum item selecionado.</p>";
}
?>
