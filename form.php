<html>
    <head>
        <title>Study Case - Invoice</title>
        <style>
            .static table {
            border-spacing: 0px;
            border-collapse: separate;
            ;font-family: arial;
            font-size:10pt;
            width:740px;
            border:1px solid #b5b5b5;
            }

            .static table tr {
            background-color: #e6e6e6;
            }

            .static table tr:nth-child(even) {
            background-color: #FFFFFF;
            }
        </style>
    </head>
    <body style="font-family: arial;font-size:10pt">
    <form action="#" method="POST">
        No Invoice &nbsp; <input type="text" name="no_invoice" <?php if($invoice[0]['InvoiceNo'])echo 'value="'.$invoice[0]['InvoiceNo'].'"'?>> &nbsp; <button type="submit" name="view">VIEW</button>
        <br/><br/>
        <div style="border:1px solid #b5b5b5;width:700px;padding:20px">
        <table style="font-family: arial;font-size:10pt">
                <tr>
                    <td>Invoice Date</td>
                    <td>&nbsp;</td>
                    <td><input type="datetime-local" name="invoice_date" <?php if($invoice[0]['InvoiceDate'])echo 'value="'.date('Y-m-d\TH:i', strtotime($invoice[0]['InvoiceDate'])).'"'?>></td>
                    <td style="width:75px">&nbsp;</td>
                    <td>Ship to</td>
                    <td>&nbsp;</td>
                    <td><textarea name="ship_to"><?php if($invoice[0]['ShipTo'])echo $invoice[0]['ShipTo'];?></textarea></td>
                </tr>
                <tr>
                    <td>To</td>
                    <td>&nbsp;</td>
                    <td><textarea name="to"><?php if($invoice[0]['InvoiceTo'])echo $invoice[0]['InvoiceTo'];?></textarea></td>
                    <td>&nbsp;</td>
                    <td>Payment Type</td>
                    <td>&nbsp;</td>
                    <td>
                        <select name="payment" style="width:100pt">
                            <option disabled selected>&nbsp;</option>
                            <?php
                                if($payment){
                                    foreach($payment as $paymentData){
                                        ?> <option value="<?php echo $paymentData['PaymentID']; ?>" <?php if($invoice[0]['PaymentType'] && $invoice[0]['PaymentType'] == $paymentData['PaymentID'])echo "selected"; ?>><?php echo $paymentData['PaymentName']; ?></option><?php
                                    }
                                }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Sales Name</td>
                    <td>&nbsp;</td>
                    <td>
                        <select name="sales_name" style="width:100pt">
                            <option disabled selected>&nbsp;</option>
                            <?php
                                if($sales_names){
                                    foreach($sales_names as $sales_name){
                                        ?> <option value="<?php echo $sales_name['SalesID']; ?>" <?php if($invoice[0]['SalesID'] && $invoice[0]['SalesID'] == $sales_name['SalesID'])echo "selected"; ?>><?php echo $sales_name['SalesName']; ?></option><?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Courier</td>
                    <td>&nbsp;</td>
                    <td>
                        <select name="courier" style="width:100pt">
                            <option disabled selected>&nbsp;</option>
                            <?php
                                if($courier){
                                    foreach($courier as $courierData){
                                        ?> <option value="<?php echo $courierData['CourierID']; ?>" <?php if($invoice[0]['CourierID'] && $invoice[0]['CourierID'] == $courierData['CourierID'])echo "selected"; ?>><?php echo $courierData['CourierName']; ?></option><?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <br/>
        <div class="static">
        <table>
            <tr>
                <th style="text-align:left;padding:5px">Item</th>
                <th style="text-align:right;padding:5px">Weight(Kg)</th>
                <th style="text-align:right;padding:5px">QTY</th>
                <th style="text-align:right;padding:5px">Unit Price</th>
                <th style="text-align:right;padding:5px">Total</th>
            </tr>
            <?php
                $subTotal = 0;
                $totalWeight = 0;
                foreach($invoice as $data){
                    ?>
                    <tr>
                        <td style="text-align:left;padding:5px"><?php echo $data['ProductName'];?></td>
                        <td style="text-align:right;padding:5px;"><?php $totalWeight = $totalWeight + $data['Weight']; echo $data['Weight'];?></td>
                        <td style="text-align:right;padding:5px"><?php echo $data['Qty'];?></td>
                        <td style="text-align:right;padding:5px"><?php echo $data['Price'];?></td>
                        <td style="text-align:right;padding:5px"><?php $total = $data['Qty'] * $data['Price']; $subTotal = $subTotal+$total; echo $total;?></td>
                    </tr>
                    <?php
                }
            ?>
            <tr>
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px">&nbsp;</td>
            </tr>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:rightpadding:5px;">&nbsp;</td>
                <td style="text-align:right;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px"><b>Sub Total</b></td>
                <td style="text-align:right;padding:5px"><b><?php echo $subTotal;?></b></td>
            </tr>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:rightpadding:5px;">&nbsp;</td>
                <td style="text-align:right;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px;border-bottom:2px solid black"><b>Courier Fee</b></td>
                <td style="text-align:right;padding:5px;border-bottom:2px solid black"><b><?php echo $fee;?></b></td>
                <input type="hidden" name="courier_fee" value="<?php echo $fee;?>">
            </tr>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:left;padding:5px">&nbsp;</td>
                <td style="text-align:rightpadding:5px;">&nbsp;</td>
                <td style="text-align:right;padding:5px">&nbsp;</td>
                <td style="text-align:left;padding:5px"><b>Total</b></td>
                <td style="text-align:right;padding:5px"><b><?php echo $subTotal + $fee;?></b></td>
            </tr>
        </table>
        
        <br>
        <div style="width:740px">
        <button type="submit" name="delete" id="delete" onclick="return  confirm('Apakah anda yakin ingin menghapus invoice ini?')" <?php if(!$button) echo "disabled";?>>DELETE</button><button type="submit" name="save" style="float:right" onclick="return  confirm('Apakah anda yakin menyimpan perubahan ini?')" <?php if(!$button) echo "disabled";?>>SAVE</button>
        </div>
        </div>
    </form>
    </body>
</html>