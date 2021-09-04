<?php
    # Get invoice data
    $invoice = array();
    $sql = "SELECT t.InvoiceNo, t.InvoiceDate, t.InvoiceTo, t.ShipTo, t.SalesID, t.CourierID, t.PaymentType, t.CourierFee, p.ProductID, p.ProductName, p.Weight, p.Price, td.Qty FROM trinvoice t
    LEFT JOIN trinvoicedetail td ON t.InvoiceNo = td.InvoiceNo 
    LEFT JOIN msproduct p ON td.ProductID = p.ProductID
    WHERE t.invoiceNo = '".$no_invoice."'";
    $invoices = $conn->query($sql);
    while($row = $invoices->fetch_assoc()){
        $invoice[] = $row;
    }
    
    # Get Total Wegiht
    $totalWeight = 0;
    foreach($invoice as $item){
        $totalWeight = $totalWeight + ($item['Weight'] * $item['Qty']);
    }

    # Get Courier Fee
    $sql = "SELECT * FROM ltcourierfee WHERE CourierID = '".$invoice[0]['CourierID']."'";
    $courierQuery = $conn->query($sql);
    $cost = 0;
    while($row = $courierQuery->fetch_assoc()){
        $start = $row['StartKg'];
        $end = $row['EndKg'];
        if($totalWeight >= $start && $totalWeight <= $end){
            $cost = $row['Price'];
            break;
        }else{
            $cost =  $row['Price'];
        }
    }
    $fee = $cost * $totalWeight;
?>