<?php 
    include 'common/connect.php'; 
    $request = "SELECT orderNumber, orderDate, shippedDate, status FROM orders;";
    $query = $pdo->query($request);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Bons de commande</h1>
        <table>
            <caption>Liste des commandes</caption>
            <tr>
                <th>Commande</th>
                <th>Date de la commande</th>
                <th>Date de livraison</th>
                <th>Statut</th>
            </tr>
            <?php 
                foreach ($data as $order) {
                    echo '<tr>';
                        echo '<td><a href="order.php?orderNum=' . $order['orderNumber'] . '">' . $order['orderNumber'] . '</a></td>';
                        echo '<td>' . $order['orderDate'] . '</td>';
                        echo '<td>' . $order['shippedDate'] . '</td>';
                        echo '<td>' . $order['status'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </main>
</body>
</html>