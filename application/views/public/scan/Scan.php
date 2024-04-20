<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scan - Gatepass</title>
  <!-- <link href="webcodecam/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="webcodecam/css/style.css" rel="stylesheet"> -->
</head>

<body>
  <main class="content px-4 py-4">
    <div class="container-fluid">
      <div class="mb-5 text-center text-uppercase">
        <h4>Scan</h4>
      </div>
      <div class="row mb-5">
        <div class="w-100 d-flex">
          <div class="mx-auto">
            <div class="row mb-5 border">
              <form action="">
                <input type="text" name="" id="" placeholder="Input Qrcode">
                <button type="submit">search</button>
              </form>
            </div>

            <div class="row" id="QR-Code">
              <div class="navbar-form navbar-right">
                <select class="form-control" id="camera-select"></select>
                <div class="form-group">
                  <input id="image-url" type="text" class="form-control" placeholder="Image url">
                  <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button"
                    data-toggle="tooltip"><span class="glyphicon glyphicon-upload">upload</span></button>
                  <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button"
                    data-toggle="tooltip"><span class="glyphicon glyphicon-picture">upload</span></button>
                  <button title="Play" class="btn btn-success btn-sm" id="play" type="button"
                    data-toggle="tooltip"><span class="glyphicon glyphicon-play">play</span></button>
                  <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button"
                    data-toggle="tooltip"><span class="glyphicon glyphicon-pause">pause</span></button>
                  <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button"
                    data-toggle="tooltip"><span class="glyphicon glyphicon-stop">stop</span></button>
                </div>
              </div>
              <div class="col-xl-12 border">
                <div class="well bg-secondary" style="position: relative;display: inline-block;">
                  <canvas style="max-width:100%;" width="320" height="240" id="webcodecam-canvas"></canvas>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="thumbnail" id="result">
                  <div class="well" style="overflow: hidden;">
                    <img style="max-width:100%;" width="320" height="240" id="scanned-img" src="">
                  </div>
                  <div class="caption">
                    <h3>Scanned result</h3>
                    <p id="scanned-QR"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row mb-5 text-white" id="button-option" style="display:none;">
        <div class="col-xl-6 col-sm-12 p-2" style="cursor:pointer;" onclick="window.open('keluar.com','_self')">
          <div class="bg-secondary d-flex flex-column p-4 shadow">
            <h3 class="m-auto mb-3">Keluar</h3>
          </div>
        </div>
        <div class="col-xl-6 col-sm-12 p-2" style="cursor:pointer;" onclick="window.open('masuk.com','_self')">
          <div class="bg-success d-flex flex-column p-4 shadow">
            <h3 class="m-auto mb-3">Masuk</h3>
          </div>
        </div>
      </div> -->

    </div>
  </main>





  <!-- punya header -->
  </div>
  </div>

  <script type="text/javascript" src="webcodecam/js/filereader.js"></script>
  <script type="text/javascript" src="webcodecam/js/qrcodelib.js"></script>
  <script type="text/javascript" src="webcodecam/js/webcodecamjs.js"></script>
  <script type="text/javascript" src="webcodecam/js/main.js"></script>
</body>


</html>