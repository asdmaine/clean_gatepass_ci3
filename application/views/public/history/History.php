<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History - Gatepass</title>

</head>

<body>
  <main class="content px-4 py-4">
    <div class="container-fluid">
      <div class="mb-5 text-center text-uppercase">
        <h4>History</h4>
      </div>
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th>Date</th>
              <th>Reason</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($History as $hs) {
              $recommended_name = $hs->recommended_name;
              $approved_name = $hs->approved_name;
              $acknowledged_name = $hs->acknowledged_name;
              $content_recommended = 'undefined';
              $content_approved = 'undefined';
              $content_acknowledged = 'undefined';

              if ($hs->status_recommended == 1) {
                $content_recommended = 'Accepted by ' . $hs->recommended_name . ' at ' . $hs->verif_date_recommendedby;
                if ($hs->status_approved == 1) {
                  $content_approved = 'Accepted by ' . $hs->approved_name . ' at ' . $hs->verif_date_approvedby;
                  if ($hs->status_acknowledged == 1) {
                    $content_acknowledged = 'Accepted by ' . $hs->acknowledged_name . ' at ' . $hs->verif_date_acknowledgedby;
                  } else {
                    $content_acknowledged = 'Rejected by ' . $hs->acknowledged_name . ' at ' . $hs->verif_date_acknowledgedby;
                  }
                } else {

                  $content_approved = 'Rejected by ' . $hs->approved_name . ' at ' . $hs->verif_date_approvedby;
                  $content_acknowledged = $content_approved;
                }
              } else {
                $content_recommended = 'Rejected by ' . $hs->recommended_name . ' at ' . $hs->verif_date_recommendedby;
                $content_approved = $content_recommended;
                $content_acknowledged = $content_recommended;
              }

              ?>
              <tr class="text">
                <th class="text-center align-middle">
                  <?= $i ?>
                </th>
                <td class="text-center align-middle">
                  <?= $hs->tanggal_gatepass ?>
                </td>
                <td class="align-middle">
                  <?= $hs->keperluan ?>
                </td>
                <?php
                if ($hs->status_recommended == -1 || $hs->status_approved == -1 || $hs->status_acknowledged == -1) { ?>
                  <td class="text-center">
                    <div class="btn btn-danger">Rejected</div>
                  </td>
                <?php } else { ?>
                  <td class="text-center">
                    <div class="btn btn-success">Accepted</div>
                  </td>
                <?php } ?>
                <td class="text-center">
                  <div class="btn btn-info m-1" data-toggle="modal" data-target=".ModalDetail<?= $i ?>">
                    <i class="fa-solid fa-circle-info"></i>
                  </div>
                  <div class="btn btn-secondary m-1" onclick="window.open('<?= base_url('pdf/print/'.$hs->id_gatepass) ?>','_blank');">
                    <i class="fa-solid fa-print"></i>
                  </div>
                </td>
              </tr>
              <!-- modal detail -->
              <div class="modal fade ModalDetail<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content px-4">
                    <div class="modal-header">
                      <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Detail Gatepass</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group mb-4">
                          <label for="tanggal" class="col-form-label font-weight-bold">Tanggal</label>
                          <input type="date" class="form-control w-50" id="tanggal" value="<?= $hs->tanggal_gatepass ?>"
                            disabled>
                        </div>
                        <div class="form-group mb-4 ">
                          <label class="form-label font-weight-bold">Keperluan</label><br>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="<?= $hs->keperluan ?>"
                              value="<?= $hs->keperluan ?>" disabled checked>
                            <label class="form-check-label" for="<?= $hs->keperluan ?>">Urusan
                              Perusahaan&nbsp;&nbsp;&nbsp;&nbsp;</label>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label for="penjelasan" class="form-label font-weight-bold">Penjelasan</label>
                          <textarea class="form-control" id="penjelasan" style="height: 100px"
                            disabled><?= $hs->penjelasan_keperluan ?></textarea>
                        </div>
                        <div class="form-group mb-4">
                          <label class="form-label font-weight-bold">Perkiraan Waktu</label><br>
                          <div class="input-group mb-1">
                            <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Keluar"
                              disabled>
                            <input class="form-control" type="time" id="est_time_out" value="<?= $hs->est_time_out ?>"
                              disabled>
                          </div>
                          <div class="input-group mb-4">
                            <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Masuk" disabled>
                            <input class="form-control" type="time" id="est_time_in" value="<?= $hs->est_time_in ?>"
                              disabled>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label class="form-label font-weight-bold">Pengesahan</label><br>
                          <div class="input-group">
                            <div class="input-group mb-1">
                              <div class="input-group overflow-scroll">
                                <div class="input-group-prepend w-100">
                                  <input type="text" class="input-group-text w-25" value="Requested By" disabled>
                                  <input type="text" class="input-group-text w-75 text-left"
                                    value="<?= $hs->requestedby_pst_name ?>" disabled>
                                </div>

                              </div>
                            </div>
                            <div class="input-group mb-1">
                              <div class="input-group overflow-scroll">
                                <div class="input-group-prepend w-50">
                                  <input type="text" class="input-group-text w-50" value="Recommended By" disabled>
                                  <input type="text" class="input-group-text w-50 text-left"
                                    value="<?= $recommended_name ?>" disabled>
                                </div>
                                <input type="text" class="form-control overflow-scroll"
                                  value="<?= $content_recommended ?>" disabled>
                              </div>
                            </div>
                            <div class="input-group mb-1">
                              <div class="input-group overflow-scroll container-lg">
                                <div class="input-group-prepend w-50">
                                  <input type="text" class="input-group-text w-50" value="Approved By" disabled>
                                  <input type="text" class="input-group-text w-50 text-left" value="<?= $approved_name ?>"
                                    disabled>
                                </div>
                                <input type="text" class="form-control overflow-scroll" value="<?= $content_approved ?>"
                                  disabled>
                              </div>
                              </select>

                            </div>
                            <div class="input-group mb-4">
                              <div class="input-group overflow-scroll">
                                <div class="input-group-prepend w-50">
                                  <input type="text" class="input-group-text w-50" value="Acknowledged By" disabled>
                                  <input type="text" class="input-group-text w-50 text-left"
                                    value="<?= $acknowledged_name ?>" disabled>
                                </div>
                                <input type="text" class="form-control overflow-scroll"
                                  value="<?= $content_acknowledged ?>" disabled>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>





  <!-- punya header -->
  </div>
  </div>
  <script>
    // untk datatables
    new DataTable('#example');
  </script>
</body>

</html>