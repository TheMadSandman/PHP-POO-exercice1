<?php 
    include 'common/connect.php'; 
    $request = "SELECT customerName, contactLastName, contactFirstName, addressLine1, city, orders.orderNumber, productName, priceEach, quantityOrdered FROM orders INNER JOIN customers ON orders.customerNumber = customers.customerNumber INNER JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber INNER JOIN products ON orderdetails.productCode = products.productCode WHERE orders.orderNumber = " . $_GET['orderNum'] . " ORDER BY orderLineNumber;";
    $query = $pdo->query($request);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    $priceTotal = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <main>
        <h1>Bons de commande</h1>
        <a href="index.php">Retourner à l'accueil</a>
        <h2><?= $data[0]['customerName'] ?></h2>
        <h3><?= $data[0]['contactFirstName'] . ' ' . $data[0]['contactLastName'] ?></h3>
        <p><?= $data[0]['addressLine1'] ?></p>
        <p><?= $data[0]['city'] ?></p>

        <hr>

        <table>
            <caption>Bon de commande n° <?= $_GET['orderNum'] ?></caption>
            <tr>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Quantité</th>
                <th>Prix Total</th>
            </tr>

            <?php foreach($data as $item) { ?>
                <tr>
                    <td><?= $item['productName'] ?></td>
                    <td><?= number_format($item['priceEach'], 2, ',', '.') . ' €' ?></td>
                    <td><?= $item['quantityOrdered'] ?></td>
                    <td><?php 
                        $total = $item['priceEach'] * $item['quantityOrdered'];
                        echo number_format($total, 2, ',', '.') . ' €';
                        $priceTotal += $total;
                    ?></td>
                </tr>
            <?php } ?>

            <tr class="totals">
                <td colspan="3">Montant Total HT</td>
                <td><?= number_format($priceTotal, 2, ',', '.') . ' €' ?></td>
            </tr>
            <tr class="totals">
                <td colspan="3">TVA (20 %)</td>
                <td><?= number_format($priceTotal * 0.2, 2, ',', '.') . ' €' ?></td>
            </tr>
            <tr class="totals">
                <td colspan="3">Montant Total TTC</td>
                <td><?= number_format($priceTotal * 1.2, 2, ',', '.') . ' €' ?></td>
            </tr>
        </table>
    </main>
</body>
</html>