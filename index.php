<?php
    ERROR_REPORTING(0);
    $button = false;
    # Declare Connection
    require "connection.php";

    # Get Sales
    $sales_names = array();
    $sql = "SELECT * FROM mssales";
    $sales = $conn->query($sql);
    while($row = $sales->fetch_assoc()){
        $sales_names[] = $row;
    }

    # Get Courier
    $courier = array();
    $sql = "SELECT * FROM mscourier";
    $couriers = $conn->query($sql);
    while($row = $couriers->fetch_assoc()){
        $courier[] = $row;
    }

    # Get Payment
    $payment = array();
    $sql = "SELECT * FROM mspayment";
    $payments = $conn->query($sql);
    while($row = $payments->fetch_assoc()){
        $payment[] = $row;
    }
    
    if(isset($_POST['view'])){
        #If user click view
        $button = true;
        $no_invoice = $_POST['no_invoice'];
        require "load.php";

        if(!$invoice){
            if($no_invoice == ''){
                $button = false;
                echo '<script language="javascript">';
                echo 'alert("Mohon masukkan nomor invoice!")';
                echo '</script>';
            }else{
                $button = false;
                echo '<script language="javascript">';
                echo 'alert("Invoice dengan nomor '.$no_invoice.' tidak ditemukan!")';
                echo '</script>';
            }
        }
    }else if(isset($_POST['save'])){
        # Update invoice
        $button = true;
        require "update.php";
        require "load.php";
        echo '<script language="javascript">';
        echo 'alert("Data berhasil disimpan!")';
        echo '</script>';
    }else if(isset($_POST['delete'])){
        # Delete invoice
        $button = true;
        require "delete.php";
        require "load.php";
        echo '<script language="javascript">';
        echo 'alert("Data berhasil dihapus!")';
        echo '</script>';
    }
    
    $conn-> close();

    require "form.php";
?>