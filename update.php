<?php
    # Edit invoice detail
    $no_invoice = $_POST['no_invoice'];
    $sql = "UPDATE trinvoice
            SET SalesID = '".$_POST['sales_name']."', InvoiceDate = '".$_POST['invoice_date']."', InvoiceTo = '".$_POST['to']."', ShipTo = '".$_POST['ship_to']."', CourierId = '".$_POST['courier']."', PaymentType = '".$_POST['payment']."'
            WHERE InvoiceNo = '".$no_invoice."'";
    $conn->query($sql);
    require "load.php";
    $sql = "UPDATE trinvoice
    SET CourierFee = '".$fee."'
    WHERE InvoiceNo = '".$no_invoice."'";
    $conn->query($sql);
?>