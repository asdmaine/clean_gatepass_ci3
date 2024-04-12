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
        <h4>Dashboard</h4>
      </div>
      <div class="" style="height:1000px;">
        <div class="row">
          <div class="col-md-3 border p-2">
            <p class="text-center">card gatepass anda bulan ini</p>
          </div>
          <div class="col-md-3 border">
            
          </div>
          <div class="col-md-3 border">
            
          </div>
          <div class="col-md-3 border">
            
          </div>
        </div>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-12">


          </div>
        </div>
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
              <textarea id="sig-dataUrl" class="form-control" name="signature" rows="5" hidden></textarea>
              <textarea id="sig-dataUrl" class="form-control" name="pst_pnr" rows="5" hidden><?= $this->logindata['user']['pst_pnr'] ?></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <img id="sig-image" src="<?= $this->logindata['user']['signature'] ?>" alt="Your signature will go here!"
                hidden />
            </div>
          </div>
          <button type="submit" class="btn btn-primary px-5">Upload Signature</button>
        </form>
      </div>

      <div class="">
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
      </div>
    </div>
  </main>





  <!-- punya header -->
  </div>
  </div>
</body>
<script>
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



      // // Membuat link unduh
      // var downloadLink = document.createElement('a');
      // downloadLink.setAttribute('href', dataUrl);
      // downloadLink.setAttribute('download', 'signature.png'); // Nama file yang akan diunduh

      // Klik link unduh secara otomatis
      // downloadLink.click();
    }, false);



  })();
</script>

</html>