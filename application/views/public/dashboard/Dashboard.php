<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    #sig-canvas {
      border: 2px solid #CCCCCC;
      cursor: crosshair;
    }
  </style>
</head>

<body>
  <main class="content px-4 py-4">
    <div class="container-fluid">
      <div class="mb-5 text-center text-uppercase">
        <!-- <h4>Dashboard</h4> -->
      </div>
      <div class="row mb-5 text-white">
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
          <div class="bg-danger d-flex flex-column p-4 shadow">
            <h3 class="mb-3">Gatepass Bulan ini</h3>
            <h2 class="font-weight-bold mb-0 text-right">30</h2>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
          <div class="bg-success d-flex flex-column p-4 shadow">
            <h3 class="mb-3">Gatepass Bulan lalu</h3>
            <h2 class="font-weight-bold mb-0 text-right">30</h2>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
          <div class="bg-secondary d-flex flex-column p-4 shadow">
            <h3 class="mb-3">Gatepass Tahun ini</h3>
            <h2 class="font-weight-bold mb-0 text-right">90</h2>
          </div>
        </div>
      </div>
      <hr>


      <!-- table-progress -->
      <div id="table-progress" class="row">
        <!-- konversi data progress -->
        <div class="table-responsive">
          <h6 class="text-center text-uppercase mb-3">Gatepass Progress</h6>
          <table class="table table-striped table-bordered">
            <thead class="text-center">
              <tr>
                <td scope="col">#</td>
                <td scope="col">Date</td>
                <td scope="col">Reason</td>
                <td scope="col">Recommended by</td>
                <td scope="col">Approved by</td>
                <td scope="col">Acknowledged by</td>
                <td scope="col">Action</td>
              </tr>
            </thead>
            <tbody>
              <!-- SHOW -->
              <tr class="text">
                <?php foreach ($Progress as $pg) {
                }
                if (empty($pg->id_gatepass)) { ?>
                <tr class="text">
                  <th class="text-center align-middle text-uppercase" colspan="7">no data to be shown</th>
                </tr>
              <?php } else {
                  $recommended_name = $pg->recommended_name;
                  $approved_name = $pg->approved_name;
                  $acknowledged_name = $pg->acknowledged_name;
                  $verif_date_recommendedby = $pg->verif_date_recommendedby;
                  $verif_date_approvedby = $pg->verif_date_approvedby;
                  $verif_date_acknowledgedby = $pg->verif_date_acknowledgedby;
                  $status_recommended = $pg->status_recommended;
                  $status_approved = $pg->status_approved;
                  $status_acknowledged = $pg->status_acknowledged;
                  ?>
                <th class="text-center align-middle">1</th>
                <td class="text-center align-middle">
                  <?= $pg->tanggal_gatepass ?>
                </td>
                <td class="align-middle text-uppercase">
                  <?= $pg->keperluan ?>
                </td>
                <!-- RECOMMENDED -->
                <td class="text-center">
                  <?php if ($status_recommended == 1) { ?>
                    <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_recommended = 'Accepted by ' . $recommended_name . ' at ' . $verif_date_recommendedby;
                      echo $content_recommended; ?>">
                      Accepted</div>
                  <?php } elseif ($status_recommended == 0) {
                    $status_approved = 0;
                    $approved_name = $recommended_name;
                    $verif_date_approvedby = $verif_date_recommendedby;
                    $status_acknowledged = 0;
                    $acknowledged_name = $recommended_name;
                    $verif_date_acknowledgedby = $verif_date_recommendedby;
                    ?>
                    <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_recommended = 'Still waiting ' . $recommended_name;
                      echo $content_recommended;
                      $content_approved = $content_recommended;
                      $content_acknowledged = $content_recommended; ?>">Waiting</div>
                  <?php } elseif ($status_recommended == -1) {
                    $status_approved = -1;
                    $approved_name = $recommended_name;
                    $verif_date_approvedby = $verif_date_recommendedby;
                    $status_acknowledged = -1;
                    $acknowledged_name = $recommended_name;
                    $verif_date_acknowledgedby = $verif_date_recommendedby;
                    ?>
                    <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_recommended = 'Rejected by ' . $recommended_name . ' at ' . $verif_date_recommendedby;
                      echo $content_recommended;
                      $content_approved = $content_recommended;
                      $content_acknowledged = $content_recommended; ?>">
                      Rejected</div>
                  <?php } ?>
                </td>
                <!-- END RECOMMENDED -->

                <!-- APROVED -->
                <td class="text-center">
                  <?php if ($status_approved == 1) { ?>
                    <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_approved = 'Accepted by ' . $approved_name . ' at ' . $verif_date_approvedby;
                      echo $content_approved; ?>">
                      Accepted</div>
                  <?php } elseif ($status_approved == 0) {
                    $status_acknowledged = 0;
                    $acknowledged_name = $approved_name;
                    $verif_date_acknowledgedby = $verif_date_approvedby;
                    ?>
                    <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_approved = 'Still waiting ' . $approved_name;
                      echo $content_approved;
                      $content_acknowledged = $content_approved; ?>">
                      Waiting</div>
                  <?php } elseif ($status_approved == -1) {
                    $status_acknowledged = -1;
                    $acknowledged_name = $approved_name;
                    $verif_date_acknowledgedby = $verif_date_approvedby;
                    ?>
                    <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_approved = 'Rejected by ' . $approved_name . ' at ' . $verif_date_approvedby;
                      echo $content_approved;
                      $content_acknowledged = $content_approved; ?>">
                      Rejected</div>
                  <?php } ?>
                </td>
                <!-- END APPROVED -->

                <!-- ACKNOWLEDGED -->
                <td class="text-center">
                  <?php if ($status_acknowledged == 0) { ?>
                    <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_acknowledged = 'Still waiting ' . $acknowledged_name;
                      echo $content_acknowledged; ?>">
                      Waiting</div>
                  <?php } elseif ($status_acknowledged == 1) { ?>
                    <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_acknowledged = 'Accepted by ' . $acknowledged_name . ' at ' . $verif_date_acknowledgedby;
                      echo $content_acknowledged; ?>">
                      Accepted</div>
                  <?php } elseif ($status_acknowledged == -1) { ?>
                    <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                      data-trigger="focus" data-content="<?php $content_acknowledged = 'Rejected by ' . $acknowledged_name . ' at ' . $verif_date_acknowledgedby;
                      echo $content_acknowledged; ?>">
                      Rejected</div>
                  <?php } ?>
                </td>
                <!-- END ACKNOWLEDGED -->
                <td class="text-center spacing-2">
                  <div class="btn btn-info m-1" data-toggle="modal" data-target=".ModalDetail"><i
                      class="fa-solid fa-circle-info"></i></div>
                  <div class="btn btn-danger" data-toggle="modal" data-target="#ModalSure"><i
                      class="fa-solid fa-trash"></i></div>
                </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr>

      <!-- table-history -->
      <!-- <div id="table-history" class="table-responsive">
      <h6 class="text-center text-uppercase mb-3">Gatepass History</h6>
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
            foreach ($History as $hs) { ?>
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
                  <div class="btn btn-secondary m-1"
                    onclick="window.open('<?= base_url('pdf/print/' . $hs->id_gatepass) ?>','_blank');">
                    <i class="fa-solid fa-print"></i>
                  </div>
                </td>
              </tr>

              <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
      <hr> -->



      <!-- esignature -->
      <div class="row d-flex flex-column">
        <div>
          <a class="btn btn-info text-white mb-3" id="show-signature">
            E-Signature
          </a>
        </div>

        <div id="sigField" style="display:none;">
          <div class="row">
            <div class="col-md-12">
              <canvas id="sig-canvas" width="420" height="160">

              </canvas>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
              <button class="btn btn-secondary" id="sig-clearBtn">Clear Signature</button>
            </div>
          </div>
          <br />
          <form action="upload_signature.php" method="post">
            <div class="row">
              <div class="col-md-12">
                <textarea id="sig-dataUrl" class="form-control" name="signature" rows="5" hidden required></textarea>
                <textarea class="form-control" name="pst_pnr" rows="5"
                  hidden><?= $this->logindata['user']['pst_pnr'] ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <img id="sig-image" src="<?= $this->logindata['user']['signature'] ?>"
                  alt="Anda belum membuat signature" />
              </div>
            </div>
            <p id="sig-alert" class="text-danger" style="display:none;">Tekan Submit Signature terlebih dahulu</p>
            <button id="sig-uploadBtn" type="submit" class="btn btn-primary px-5">Upload Signature</button>
          </form>
        </div>
      </div>

      <!-- info login -->
      <!-- <div class="">
        <p><strong>INFO LOGIN ANDA</strong></p>
        <p>sign :
          <?= $this->logindata['user']['signature'] ?>
        </p>
        <p>pst_name :
          <?= $this->logindata['user']['pst_name'] ?>
        </p>
        <p>job_level :
          <?= $this->logindata['user']['job_level'] ?>
        </p>
        <p>jobtl_name :
          <?= $this->logindata['user']['jobtl_name'] ?>
        </p>
        <p>verifikasi1 :
          <?= $this->logindata['user']['verifikasi1'] ?> (
          <?= $this->logindata['user']['verifikasi1_name'] ?>)
        </p>
        <p>verifikasi2 :
          <?= $this->logindata['user']['verifikasi2'] ?> (
          <?= $this->logindata['user']['verifikasi2_name'] ?>)
        </p>
        <p>approval1 :
          <?= $this->logindata['user']['approval1'] ?> (
          <?= $this->logindata['user']['approval1_name'] ?>)
        </p>
        <p>approval2 :
          <?= $this->logindata['user']['approval2'] ?> (
          <?= $this->logindata['user']['approval2_name'] ?>)
        </p>





        <br><br><br><br><br>
        <p>Requested by :
          <?= $this->logindata['user']['pst_pnr'] ?> (
          <?= $this->logindata['user']['pst_name'] ?>)
        </p>
        <p>Recommended by :
          <?= $this->logindata['user']['verifikasi1'] ?> (
          <?= $this->logindata['user']['verifikasi1_name'] ?>)
        </p>
        <p class="text-secondary">Recommended by (alternate) :
          <?= $this->logindata['user']['verifikasi2'] ?> (
          <?= $this->logindata['user']['verifikasi2_name'] ?>)
        </p>
        <p>Approved by :
          <?= $this->logindata['user']['approval1'] ?> (
          <?= $this->logindata['user']['approval1_name'] ?>)
        </p>
        <p class="text-secondary">Approved by (alternate) :
          <?= $this->logindata['user']['approval2'] ?> (
          <?= $this->logindata['user']['approval2_name'] ?>)
        </p>
        <p>Acknowledged by : Pak Aris ?? (HRD)</p>
        <p class="text-secondary">Acknowledged by (alternate): Buk Yanti</p>
        <p class="text-secondary">Acknowledged by (alternate): Pak Akbar</p>
        <p class="text-center text-secondary text-uppercase">note : mengetahui dia bisa approve gatepass orang atau
          tidak itu BUKAN berdasarkan job_Level!!
          <br>melainkan berdasarkan tbmleave_setting apakh pst_pnr dia ada di verifikasi/approval
        </p>
      </div> -->
    </div>
  </main>






  <!-- punya header -->
  </div>
  </div>
</body>
<script>
  new DataTable('#example');
  (function () {
    window.requestAnimFrame = (function (callback) {
      return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function (callback) {
          window.setTimeout(callback, 1000 / 60);
        };
    })();

    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;

    var drawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function (e) {
      drawing = true;
      lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function (e) {
      drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function (e) {
      mousePos = getMousePos(canvas, e);
    }, false);

    // Add touch event support for mobile
    canvas.addEventListener("touchstart", function (e) {

    }, false);

    canvas.addEventListener("touchmove", function (e) {
      var touch = e.touches[0];
      var me = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchstart", function (e) {
      mousePos = getTouchPos(canvas, e);
      var touch = e.touches[0];
      var me = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchend", function (e) {
      var me = new MouseEvent("mouseup", {});
      canvas.dispatchEvent(me);
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
      }
    }

    function getTouchPos(canvasDom, touchEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
      }
    }

    function renderCanvas() {
      if (drawing) {
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        lastPos = mousePos;
      }
    }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function (e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchend", function (e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);
    document.body.addEventListener("touchmove", function (e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, false);

    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();

    function clearCanvas() {
      canvas.width = canvas.width;
    }

    // Set up the UI
    var sigText = document.getElementById("sig-dataUrl");
    var sigImage = document.getElementById("sig-image");
    var clearBtn = document.getElementById("sig-clearBtn");
    var submitBtn = document.getElementById("sig-submitBtn");
    var uploadBtn = document.getElementById("sig-uploadBtn");
    var sigAlert = document.getElementById("sig-alert");
    var showSig = document.getElementById("show-signature");
    clearBtn.addEventListener("click", function (e) {
      clearCanvas();
      sigText.innerHTML = "Data URL for your signature will go here!";
      sigImage.setAttribute("src", "");
    }, false);
    //   submitBtn.addEventListener("click", function(e) {
    //     var dataUrl = canvas.toDataURL();
    //     sigText.innerHTML = dataUrl;
    //     sigImage.setAttribute("src", dataUrl);
    //   }, false);
    submitBtn.addEventListener("click", function (e) {
      var dataUrl = canvas.toDataURL('image/png'); // Mengonversi ke format PNG
      sigText.innerHTML = dataUrl;
      sigImage.setAttribute("src", dataUrl);
      sigAlert.style.display = "none";


      // // Membuat link unduh
      // var downloadLink = document.createElement('a');
      // downloadLink.setAttribute('href', dataUrl);
      // downloadLink.setAttribute('download', 'signature.png'); // Nama file yang akan diunduh

      // Klik link unduh secara otomatis
      // downloadLink.click();
    }, false);

    uploadBtn.addEventListener("click", function (e) {

      if (sigText.innerHTML === "") {
        sigAlert.style.display = "block";
        console.log('kosong');
      } else {
        sigAlert.style.display = "none";
      }
    }, false);

    showSig.addEventListener("click", function (e) {
      if (document.getElementById("sigField").style.display === 'none') {
        document.getElementById("sigField").style.display = 'block';
      } else {
        document.getElementById("sigField").style.display = 'none';
      }
    }, false);



  })();
</script>


<!-- Modal sure-->
<div class="modal fade" id="ModalSure" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="ModalSureLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalSureLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This action will delete your gatepass progress.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url('submit/do_delete/' . $pg->id_gatepass . '/' . $pg->id_pengesahan) ?>"
          class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<!-- modal detail -->
<div class="modal fade ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <input type="date" class="form-control w-50" id="tanggal" value="<?= $pg->tanggal_gatepass ?>" disabled>
          </div>
          <div class="form-group mb-4 ">
            <label class="form-label font-weight-bold">Keperluan</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="<?= $pg->keperluan ?>" value="<?= $pg->keperluan ?>"
                disabled checked>
              <label class="form-check-label text-uppercase" for="<?= $pg->keperluan ?>"><?= $pg->keperluan ?></label>
            </div>
          </div>
          <div class="form-group mb-4">
            <label for="penjelasan" class="form-label font-weight-bold">Penjelasan</label>
            <textarea class="form-control" id="penjelasan" style="height: 100px"
              disabled><?= $pg->penjelasan_keperluan ?></textarea>
          </div>
          <div class="form-group mb-4">
            <label class="form-label font-weight-bold">Perkiraan Waktu</label><br>
            <div class="input-group mb-1">
              <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Keluar" disabled>
              <input class="form-control" type="time" id="est_time_out" value="<?= $pg->est_time_out ?>" disabled>
            </div>
            <div class="input-group mb-4">
              <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Masuk" disabled>
              <input class="form-control" type="time" id="est_time_in" value="<?= $pg->est_time_in ?>" disabled>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</html>