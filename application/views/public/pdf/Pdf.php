<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF - Gatepass</title>
  <link rel="stylesheet" href="<?php echo base_url('src/assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <main class="content px-4 py-4">
    <div class="container">
      <!-- <div class="row border border mb-4" style="">
        <div class="border border-secondary col-3 d-flex flex-column p-2">
          <img src="<?= base_url('src/assets/img/logo.png') ?>" class="m-auto" alt="" width=100 height=90>
          <h5 class="font-weight-bolder m-auto ">PT. DSAW</h5>
        </div>
        <div class="border border-secondary col-6 d-flex flex-column">
          <h4 class="font-weight-bolder text-uppercase m-auto text-center">GATEPASS PERMIT<br>Surat Ijin Keluar</h4>
        </div>
        <div class="border border-secondary col-3 d-flex flex-column">
          <h5 class="font-weight-bolder text-uppercase m-auto">Form QSF HRD 041
            Rev.: 0
          </h5>
        </div>
      </div> -->



      <table class="table table-bordered border-secondary" style="width:100%">

        <thead>
          <tr>
            <th>
              <div class="d-flex flex-column">
                <img src="<?= base_url('src/assets/img/logo.png') ?>" class="m-auto" alt="" width=100 height=90>
                <h5 class="font-weight-bolder m-auto ">PT. DSAW</h5>
              </div>
            </th>
            <th colspan="2" class="align-middle ">
              <div class="text-center">
                <h4 class="font-weight-bolder text-uppercase">GATEPASS PERMIT<br>Surat Ijin Keluar
                </h4>
              </div>
            </th>
            <th class="align-middle ">
              <div>
                <h5 class="font-weight-bolder text-uppercase m-auto">Form QSF HRD 041<br>
                  Rev.: 0
                </h5>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="4"><strong>Hari/Tanggal</strong> / <i>Day/Date</i> :
              <mark><?= $Gatepass[0]->tanggal_gatepass ?></mark>
            </td>
          </tr>
          <tr>
            <td colspan="4"><strong>Keperluan</strong> / <i>Reason</i></td>
          </tr>
          <tr class="text-uppercase ">
            <td><i class="fa-regular fa-square"></i> urusan perusahaan</td>
            <td><i class="fa-regular fa-square"></i> urusan keluarga</td>
            <td><i class="fa-regular fa-square"></i> sakit/klinik/rs</td>
            <td><i class="fa-solid fa-square-check"></i> lain-lain</td>
          </tr>
          <tr style="height:250px;">
            <td colspan="4"><strong>Penjelasan</strong> / <i>Reason</i> :
              <mark><?= $Gatepass[0]->penjelasan_keperluan ?></mark>
            </td>
          </tr>
          <tr>
            <td colspan="4"><strong>Perkiraan Waktu</strong> / <i>Estimated Time</i></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Perkiraan Jam Keluar</strong><br><i>Estimated Time Out</i></td>
            <td class="col-3 align-middle"><mark><?= $Gatepass[0]->est_time_out ?></mark></td>
            <td class="col-3"><strong>Perkiraan Jam Masuk</strong><br><i>Estimated Time In</i></td>
            <td class="col-3 align-middle"><mark><?= $Gatepass[0]->est_time_in ?></mark></td>
          </tr>
          <tr>
            <td colspan="4"><strong>Pengesahan</strong> / <i>Authorization</i></td>
          </tr>
          <tr>
            <td><strong>Diajukan oleh</strong><br><i>Requested by</i></td>
            <td class="text-center align-middle">
              <p><mark><?= $Gatepass[0]->requestedby_pst_name ?></mark></p>
            </td>
            <td><i>NIK/Empl. No :</i><br>Tanda tangan/Sign</td>
            <td class="text-center"><mark><?= $Gatepass[0]->requestedby_pst_pnr ?></mark><br>
              <img width="150" height="70" src="<?= $Gatepass[0]->requested_signature ?>" alt="">
            </td>
          </tr>
          <tr>
            <td><strong>Direkomendasikan oleh</strong><br><i>Recommended by</i></td>
            <td class="text-center align-middle">
              <p><mark><?= $Gatepass[0]->recommended_name ?></mark></p>
            </td>
            <td class="align-bottom">Tanda tangan/Sign</td>
            <td class="text-center">
              
              <img width="150" height="70" src="<?= $Gatepass[0]->recommended_signature ?>" alt="">
            </td>
          </tr>
          <tr>
            <td><strong>Disetujui oleh</strong><br><i>Approved by</i></td>
            <td class="text-center align-middle">
              <p><mark><?= $Gatepass[0]->approved_name ?></mark></p>
            </td>
            <td class="align-bottom">Tanda tangan/Sign</td>
            <td class="text-center">
              <img width="150" height="70" src="<?= $Gatepass[0]->approved_signature ?>" alt="">
            </td>
          </tr>
          <tr>
            <td><strong>Diketahui oleh</strong><br><i>Acknowledged by</i></td>
            <td class="text-center align-middle">
              <p><mark><?= $Gatepass[0]->acknowledged_name ?></mark></p>
            </td>
            <td class="align-bottom">Tanda tangan/Sign</td>
            <td class="text-center">
              <img width="150" height="70" src="<?= $Gatepass[0]->acknowledged_signature ?>" alt="">
            </td>
          </tr>
          <tr>
            <td colspan="4"><strong>Waktu Sebenarnya</strong> / <i>Actual Time</i></td>
          </tr>
          <tr>
            <td><strong>Jam keluar </strong> / <i>Time Out</i></td>
            <td><mark><?= $Gatepass[0]->rl_time_out ?></mark></td>
            <td><strong>Jam Masuk </strong> / <i>Time In</i></td>
            <td><mark><?= $Gatepass[0]->rl_time_in ?></mark></td>
          </tr>
          <tr>
            <td>Nama & Paraf Satpam<br>Security Initial</td>
            <td><mark>security</mark></td>
            <td>Nama & Paraf Satpam<br>Security Initial</td>
            <td class="text-center">
              <!-- experimental -->
              <img width="150" height="70" src="<?= $Gatepass[0]->requested_signature ?>" alt="">
            </td>
          </tr>
          <tr>
            <td colspan="4"><strong>Distribusi</strong> / <i>Distribution</i></td>
          </tr>
          <tr style="height:200px;">
            <td colspan="4" class="align-middle">Noted :
              <br>*)Satpam harus mencatat/menandatangani saat Pemohon/Karyawan KELUAR/MASUK dan diserahkan ke HRD
              Security shall record/sign and verify when the Recipient/Employee OUT/IN and deliver to HRD
              <br>
              <div class="col-md-6 text-center">
                <img src="data:image/png;base64,<?= $Gatepass[0]->qrcode_64 ?>" />
                <h1 class="font-weight-bolder"><?= $Gatepass[0]->qrcode ?></h1>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </main>




  <script src="<?php echo base_url('src/assets/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('src/assets/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('src/assets/js/bootstrap.min.js'); ?>"></script>

  <script>
    $(document).ready(function () {
      window.print();
    });
  </script>
</body>

</html>