<?php

class Invoice {
    private $invoiceId;
    private $OrderNumber;
    private $invoiceDate;
    private $invoiceTotal;

    public function __constructor($iId = null, $oNumber = null, $iDate = null, $iTotal = null) {
        $this->$invoiceId = $iId;
        $this->$OrderNumber = $oNumber;
        $this->$invoiceDate = $invoiceDate;
        $this->$invoiceTotal = $iTotal;
    }

    public function getInvoices($db) {
        
        $sql = "SELECT * FROM invoice";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $invoices;
    }    
}