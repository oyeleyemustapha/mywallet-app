<?php


if(isset($scripts)){
    $file=$scripts;
}
else{
    $file="";
}


echo'


        <!-- .footer-bar -->
        <!-- JavaScript (include all script here) -->
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/DataTables/datatables.min.js"></script>
        <script src="assets/DataTables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/script.js"></script>
        '.$file.'
        <script src="assets/js/custom.js"></script>
    </body>
  </html>


';
?>