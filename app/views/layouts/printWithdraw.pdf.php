<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(VANITY_OUTPUT_DIR."SiiCrypto-Withdraw-".$data['Reference'].'-'.gmdate('Y-M-d',time()).'-'.$data['Currency'].'-'.$data['Amount'].".pdf","F");
?>