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
    if (isset($_POST['method'])) 
    {
        $client = new SoapClient("http://localhost:8020/BankService?wsdl");

        if ($_POST['method'] == "xofToEuro") 
        {
            $param = new stdClass();
            $param->amount = $_POST['amount'];
            $result = $client->__soapCall("xofToEuro", array($param));
        }
        elseif ($_POST['method'] == "euroToXof") 
        {
            $param = new stdClass();
            $param->amount = $_POST['amount'];
            $result = $client->__soapCall("euroToXof", array($param));
        }
        else
            $accounts = $client->__soapCall("getAccounts", []);
    }
    ?>

    <form action="index.php" method="post">
        Montant : <input type="text" name="amount">
        <input type="submit" value="xofToEuro" name="method">
        <input type="submit" value="euroToXof" name="method">
        <input type="submit" value="comptes" name="method">
    </form>
    <?php
        if (isset($result))
            echo "Resultat: " . $_POST['amount'] . " = " . $result->return;
        elseif (isset($accounts)) 
        {
    ?>   
    <p>Liste des comptes:</p> 
    <table border="2" style="margin: 7px;">
        <tr>
            <th>Code</th>
            <th>Solde</th>
            <th>Date de creation</th>
        </tr>
    <?php
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