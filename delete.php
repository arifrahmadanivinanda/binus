<?php
    # Delete invoice
    $no_invoice = $_POST['no_invoice'];
    $sql = "DELETE FROM trinvoice WHERE InvoiceNo = '".$no_invoice."'";
    $conn->query($sql);
    $sql = "DELETE FROM trinvoicedetail WHERE InvoiceNo = '".$no_invoice."'";
    $conn->query($sql);
?>