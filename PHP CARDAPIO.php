<?php

function calcularValor($item, $quantidade) {
    $precos = [
        'x-burguer' => 8.30,
        'misto_quente' => 7.00,
        'x-salada' => 8.90,
        'coca-cola' => 6.00,
        'fanta' => 5.00,
        'conquista' => 5.50,
        'brigadeiro' => 2.50,
        'sorvete' => 3.00,
        'batata_frita' => 12.00,
      
       
    ];
    
    $item = strtolower(str_replace(' ', '_', $item)); 
    return isset($precos[$item]) ? $precos[$item] * $quantidade : 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $pedidos = [];

    if (!empty($_POST['lanche'])) {
        foreach ($_POST['lanche'] as $index => $lanche) {
            $quantidade = $_POST['quantidade_' . strtolower(str_replace(' ', '_', $lanche))] ?? 0;
            if ($quantidade > 0) {
                $pedidos[] = [
                    'item' => $lanche,
                    'quantidade' => $quantidade,
                    'valor' => calcularValor($lanche, $quantidade)
                ];
            }
        }
    }

    if (!empty($_POST['bebida'])) {
        foreach ($_POST['bebida'] as $index => $bebida) {
            $quantidade = $_POST['quantidade_' . strtolower(str_replace(' ', '_', $bebida))] ?? 0;
            if ($quantidade > 0) {
                $pedidos[] = [
                    'item' => $bebida,
                    'quantidade' => $quantidade,
                    'valor' => calcularValor($bebida, $quantidade)
                ];
            }
        }
    }

    if (!empty($_POST['doce'])) {
        foreach ($_POST['doce'] as $index => $doce) {
            $quantidade = $_POST['quantidade_' . strtolower(str_replace(' ', '_', $doce))] ?? 0;
            if ($quantidade > 0) {
                $pedidos[] = [
                    'item' => $doce,
                    'quantidade' => $quantidade,
                    'valor' => calcularValor($doce, $quantidade)
                ];
            }
        }
    }

    if (!empty($_POST['porcao'])) {
        foreach ($_POST['porcao'] as $index => $porcao) {
            $quantidade = $_POST['quantidade_' . strtolower(str_replace(' ', '_', $porcao))] ?? 0;
            if ($quantidade > 0) {
                $pedidos[] = [
                    'item' => $porcao,
                    'quantidade' => $quantidade,
                    'valor' => calcularValor($porcao, $quantidade)
                ];
            }
        }
    }

    echo "<h1>Resumo do Pedido</h1>";
    echo "<table border='1'>
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>";
    
    $total = 0;

    foreach ($pedidos as $pedido) {
        echo "<tr>
                <td>{$pedido['item']}</td>
                <td>{$pedido['quantidade']}</td>
                <td>R$ " . number_format($pedido['valor'], 2, ',', '.') . "</td>
              </tr>";
        $total += $pedido['valor'];
    }

    echo "</table>";
    echo "<h2>Total: R$ " . number_format($total, 2, ',', '.') . "</h2>";
} else {
    echo "Nenhum pedido foi realizado.";
}
?>
