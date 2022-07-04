<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Web Service</title>
</head>
<body>
<?php
    if (isset($_POST['method'])) {
        $client = new SoapClient("http://localhost:8000/BankService?wsdl");
        if ($_POST['method'] == "conversion") 
        {
            $result = $client->__soapCall("conversion", ["amount" => $_POST['amount']]);
        }
        else
        {
            $accounts = $client->__soapCall("getAccounts", []);
        }
    }

?>

    <form action="index.php" method="post">
        Montant : <input type="text" name="amount">
        <input type="submit" value="conversion" name="method">
        <input type="submit" value="comptes" name="method">
    </form>
    <?php
        if (isset($result)) {
            
            echo "Resultat: " . $_POST['amount'] . " = " . $result->return;

        }
    if (isset($accounts)) {
        # code...
?>    
    <table border="2" style="margin: 7px;">
    <tr>
        <th>Code</th>
        <th>Solde</th>
        <th>Date de creation</th>
    </tr>
<?php
        # code...
foreach ($accounts->return as $account) {
?>
    <tr>
       <td> <?= $account->code ?></td>
       <td> <?= $account->balance ?></td>
       <td> <?= $account->createdAt ?></td>
    </tr>
<?php
}
?>
</table>
<?php
}
?>
</body>
</html>