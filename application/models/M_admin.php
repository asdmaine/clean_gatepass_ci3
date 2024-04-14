<?php defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * Model Register
 */
class M_admin extends CI_Model
{

    public function is_login()
    {
        $is_login = $this->session->userdata('auth');
        if (!empty ($is_login)) {
            return true;
        } else {
            return false;
        }
    }

    public function do_login()
    {
        $post = $this->input->post();
        if (!empty ($post)) {
            $username = $post['username'];
            $password = md5($post['password']);
            $user = $this->db->query('select * from pst where pst_pnr = ?', $username)->row_array();
            $user = $this->db->query(
                "SELECT 
            a.pst_status,
            a.pst_pnr,
            a.pst_password,
            b.job_level,
            a.jobtl_idx,
            a.signature,
            b.jobtl_name,
            a.br_idx,
            c.br_name,
            a.pst_name,
            d.verifikasi1,
            v1.pst_name as name_verif1,
            d.verifikasi2,
            v2.pst_name as name_verif2,
            d.approval1,
            d.approval2,
            d.gpverifikasi1,
            d.gpverifikasi2,
            d.gpapproval1,
            d.gpapproval2,
            v1.pst_name as verifikasi1_name,
            v2.pst_name as verifikasi2_name,
            v3.pst_name as approval1_name,
            v4.pst_name as approval2_name
            FROM 
                pst a
            left JOIN 
                hrms_jobtitle as b ON a.jobtl_idx = b.jobtl_idx
            left JOIN 
                dsaw_mdept as c ON a.br_idx = c.br_idx
            left JOIN 
                tbmleave_setting as d ON a.pst_pnr = d.pst_pnr
            left join 
                pst as v1 on v1.pst_pnr = d.verifikasi1
            left join
                pst as v2 on v2.pst_pnr = d.verifikasi2
            left join
                pst as v3 on v3.pst_pnr = d.approval1
            left join
                pst as v4 on v4.pst_pnr = d.approval2
            where a.pst_pnr = ? and a.pst_status >= 0",
                $username
            )->row_array();
            if (!empty ($user)) {
                if ($user['pst_password'] == $password) {
                    // masih salah ini session expiration
                    $this->session->sess_expiration = 2000;


                    $this->session->set_userdata('auth', $user);
                    redirect('dashboard');
                    // $we = $this->session->userdata('auth');
                    // cara panggilnya $we['username'] pokoknya sesuai isi tabel karena tepat diatas dibuat untuk menjadi row_array()
                } else {
                    return 'Password tidak valid';
                }
            } else {
                return 'Username dan Password tidak valid';
            }
        }
    }

    public function GetRecommended()
    {
        $sql =
            "SELECT DISTINCT
            a.verifikasi1,
            b.pst_name
        FROM
            tbmleave_setting a
        LEFT JOIN
            pst b ON a.verifikasi1 = b.pst_pnr
        WHERE
            b.pst_status >= 0
        ORDER BY
            b.pst_name ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }
    public function GetApproved()
    {
        $sql =
            "SELECT DISTINCT
            a.approval1,
            b.pst_name
        FROM
            tbmleave_setting a
        LEFT JOIN
            pst b ON a.approval1 = b.pst_pnr
        WHERE
            b.pst_status >= 0
        ORDER BY
            b.pst_name ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }
    public function SubmitGatepass()
    {
        $post = $this->input->post(NULL, TRUE);

        if (!empty ($post)) {
            $data_tbverifikasi = array(
                'verif_date_recommendedby' => null
            );
            $data_tbremarks = array(
                'remarks_recommendedby' => null
            );
            try {
                $this->db->insert('gatepass_tbverifikasi', $data_tbverifikasi);
                $id_verifikasi = $this->db->insert_id();
                $this->db->insert('gatepass_tbremarks', $data_tbremarks);
                $id_remarks = $this->db->insert_id();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            $data_tbpengesahan = array(
                'requestedby_pst_pnr' => $post['requested'],
                'recommendedby_pst_pnr' => $post['recommended'],
                'approvedby_pst_pnr' => $post['approved'],
                'acknowledgedby_pst_pnr' => $post['acknowledged'],
                'id_verifikasi' => $id_verifikasi,
                'id_remarks' => $id_remarks
            );
            try {
                $this->db->insert('gatepass_tbpengesahan', $data_tbpengesahan);
                $id_pengesahan = $this->db->insert_id();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            $data_tbtime = array(
                'est_time_out' => $post['est_time_out'],
                'est_time_in' => $post['est_time_in']
            );
            try {
                $this->db->insert('gatepass_tbtime', $data_tbtime);
                $id_time = $this->db->insert_id();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            $data_gatepass = array(
                'requestedby_pst_name' => $post['requested_name'],
                'tanggal_gatepass' => $post['tanggal'],
                'tanggal_gatepass_dibuat' => 'now()',
                'keperluan' => $post['keperluan'],
                'penjelasan_keperluan' => $post['penjelasan'],
                'id_time' => $id_time,
                'id_pengesahan' => $id_pengesahan
            );
            try {
                $this->db->insert('gatepass_tb', $data_gatepass);
                $idd = $this->db->insert_id();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            redirect('dashboard');
        } else {
            echo 'eror';
        }
    }
    public function GetProgress($pst_pnr)
    {
        $this->db->select('
    a.*,
    b.*,
    c.*,
    d.*,
    e.*,
    f.pst_name as recommended_name,
    f2.pst_name as approved_name,
    f3.pst_name as acknowledged_name'
        );
        $this->db->from('gatepass_tb a');
        $this->db->join('gatepass_tbtime b', 'a.id_time = b.id_time', 'left');
        $this->db->join('gatepass_tbpengesahan c', 'a.id_pengesahan = c.id_pengesahan', 'left');
        $this->db->join('gatepass_tbverifikasi d', 'c.id_verifikasi = d.id_verifikasi', 'left');
        $this->db->join('gatepass_tbremarks e', 'c.id_remarks = e.id_remarks', 'left');
        $this->db->join('pst f', 'c.recommendedby_pst_pnr = f.pst_pnr', 'left');
        $this->db->join('pst f2', 'c.approvedby_pst_pnr = f2.pst_pnr', 'left');
        $this->db->join('pst f3', 'c.acknowledgedby_pst_pnr = f3.pst_pnr', 'left');
        $this->db->where('c.requestedby_pst_pnr', $pst_pnr);
        $this->db->where("(status_recommended = 0 OR status_approved = 0 OR status_acknowledged = 0)");

        $query = $this->db->get();
        return $query->result();
    }
    public function GetProgressApproval($pst_pnr)
    {
        $this->db->select('
    a.*,
    b.*,
    c.*,
    d.*,
    e.*,
    f.pst_name as recommended_name,
    f2.pst_name as approved_name,
    f3.pst_name as acknowledged_name'
        );
        $this->db->from('gatepass_tb a');
        $this->db->join('gatepass_tbtime b', 'a.id_time = b.id_time', 'left');
        $this->db->join('gatepass_tbpengesahan c', 'a.id_pengesahan = c.id_pengesahan', 'left');
        $this->db->join('gatepass_tbverifikasi d', 'c.id_verifikasi = d.id_verifikasi', 'left');
        $this->db->join('gatepass_tbremarks e', 'c.id_remarks = e.id_remarks', 'left');
        $this->db->join('pst f', 'c.recommendedby_pst_pnr = f.pst_pnr', 'left');
        $this->db->join('pst f2', 'c.approvedby_pst_pnr = f2.pst_pnr', 'left');
        $this->db->join('pst f3', 'c.acknowledgedby_pst_pnr = f3.pst_pnr', 'left');
        $this->db->where("(c.recommendedby_pst_pnr ='$pst_pnr' OR c.approvedby_pst_pnr ='$pst_pnr' OR c.acknowledgedby_pst_pnr = '$pst_pnr')");
        $this->db->where("(status_recommended = 0 OR status_approved = 0 OR status_acknowledged = 0)");
        $this->db->order_by('a.id_gatepass', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    public function GetLevel($pst_pnr)
    {
        try {
            $this->db->select('id');
            $this->db->from('tbmleave_setting');
            $this->db->where('verifikasi1', $pst_pnr);
            $this->db->or_where('verifikasi2', $pst_pnr);
            $this->db->or_where('approval1', $pst_pnr);
            $this->db->or_where('approval2', $pst_pnr);
            $query = $this->db->get();
            return $query->num_rows();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function DeleteGatepass($id_gatepass, $id_pengesahan)
    {
        // id_pengesahan gak perlu sih cuman supaya aman dikit aja 
        $data = array('status' => 2);
        $this->db->where('id_gatepass', $id_gatepass);
        $this->db->where('id_pengesahan', $id_pengesahan);
        $this->db->update('gatepass_tb', $data);
        redirect('dashboard');
    }

    public function AcceptGatepass($id, $as)
    {
        $data = array(
            'status_' . $as => '1',
            'verif_date_' . $as . 'by' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_verifikasi', $id);
        $this->db->update('gatepass_tbverifikasi', $data);
        redirect('approve');
    }
    public function RejectGatepass($id, $as)
    {
        $data = array(
            'status_' . $as => '-1',
            'verif_date_' . $as . 'by' => 'now()'
        );
        $this->db->where('id_verifikasi', $id);
        $this->db->update('gatepass_tbverifikasi', $data);
        redirect('approve');
    }
    public function PendingGatepass($id, $as)
    {
        $data = array(
            'status_' . $as => '0',
            'verif_date_' . $as . 'by' => 'now()'
        );
        $this->db->where('id_verifikasi', $id);
        $this->db->update('gatepass_tbverifikasi', $data);
        redirect('approve');
    }
    public function GetHistory($pst_pnr)
    {
        $this->db->select('
    a.*,
    b.*,
    c.*,
    d.*,
    e.*,
    f.pst_name AS recommended_name,
    f2.pst_name AS approved_name,
    f3.pst_name AS acknowledged_name');
        $this->db->from('gatepass_tb a');
        $this->db->join('gatepass_tbtime b', 'a.id_time = b.id_time', 'left');
        $this->db->join('gatepass_tbpengesahan c', 'a.id_pengesahan = c.id_pengesahan', 'left');
        $this->db->join('gatepass_tbverifikasi d', 'c.id_verifikasi = d.id_verifikasi', 'left');
        $this->db->join('gatepass_tbremarks e', 'c.id_remarks = e.id_remarks', 'left');
        $this->db->join('pst f', 'c.recommendedby_pst_pnr = f.pst_pnr', 'left');
        $this->db->join('pst f2', 'c.approvedby_pst_pnr = f2.pst_pnr', 'left');
        $this->db->join('pst f3', 'c.acknowledgedby_pst_pnr = f3.pst_pnr', 'left');
        $this->db->where('requestedby_pst_pnr', $pst_pnr);
        $this->db->where('status_recommended !=', 0);
        $this->db->where('status_approved !=', 0);
        $this->db->where('status_acknowledged !=', 0);
        $this->db->order_by('a.tanggal_gatepass', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    public function GetGatepass($pst_pnr, $id_gatepass)
    {
        $this->db->select('
    a.*,
    b.*,
    c.*,
    d.*,
    e.*,
    f.pst_name AS recommended_name,
    f2.pst_name AS approved_name,
    f3.pst_name AS acknowledged_name,
    f4.signature AS requested_signature');
        $this->db->from('gatepass_tb a');
        $this->db->join('gatepass_tbtime b', 'a.id_time = b.id_time', 'left');
        $this->db->join('gatepass_tbpengesahan c', 'a.id_pengesahan = c.id_pengesahan', 'left');
        $this->db->join('gatepass_tbverifikasi d', 'c.id_verifikasi = d.id_verifikasi', 'left');
        $this->db->join('gatepass_tbremarks e', 'c.id_remarks = e.id_remarks', 'left');
        $this->db->join('pst f', 'c.recommendedby_pst_pnr = f.pst_pnr', 'left');
        $this->db->join('pst f2', 'c.approvedby_pst_pnr = f2.pst_pnr', 'left');
        $this->db->join('pst f3', 'c.acknowledgedby_pst_pnr = f3.pst_pnr', 'left');
        $this->db->join('pst f4', 'c.requestedby_pst_pnr = f4.pst_pnr', 'left');
        $this->db->where('requestedby_pst_pnr', $pst_pnr);
        $this->db->where('id_gatepass', $id_gatepass);
        $this->db->where('status_recommended !=', 0);
        $this->db->where('status_approved !=', 0);
        $this->db->where('status_acknowledged !=', 0);
        $this->db->order_by('a.tanggal_gatepass', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


}

?>