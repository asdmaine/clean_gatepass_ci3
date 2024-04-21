<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Register
 */
class M_signature extends CI_Model
{
    public function SetSignature()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=dbgatepass', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $new_signature = $_POST['signature'];
            $pst_pnr = $_POST['pst_pnr'];
            $sql = "UPDATE pst SET signature = '$new_signature' WHERE pst_pnr = '$pst_pnr'";
            $pdo->exec($sql);
            redirect('AuthAdmin/logout');

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>