<?php

    $client = new SoapClient("http://localhost:8000/BankService?wsdl");

    $response = $client->__soapCall("getAccounts", []);
?>
    <table border="2">
        <tr>
            <th>Code</th>
            <th>Solde</th>
            <th>Date de creation</th>
        </tr>
<?php
    foreach ($response->return as $account) {
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