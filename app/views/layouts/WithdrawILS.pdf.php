<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(VANITY_OUTPUT_DIR."SiiCrypto-Withdraw-ILS-VANTU-".$data['data']['data']['Reference'].'-'.gmdate('Y-M-d',$data['data']['DateTime']->sec).'-'.$data['data']['Currency'].'-'.$data['data']['netAmount'].".pdf","F");
?>