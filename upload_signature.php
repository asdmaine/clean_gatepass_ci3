<?php
try {
   
    $pdo = new PDO('pgsql:host=localhost;dbname=dbgatepass', 'postgres', '123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $new_signature = $_POST['signature'];
    $pst_pnr = $_POST['pst_pnr'];
    $sql = "UPDATE pst SET signature = '$new_signature' WHERE pst_pnr = '$pst_pnr'";
    $pdo->exec($sql);
    echo '<script>window.location.href = "dashboard";</script>';

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>