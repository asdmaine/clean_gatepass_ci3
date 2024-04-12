<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All History - Gatepass</title>

</head>

<body>
  <main class="content px-4 py-4">
    <div class="container-fluid">
      <div class="mb-5 text-center text-uppercase">
        <h4>All Gatepass History</h4>
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
            <tr class="text">
              <th class="text-center align-middle">1</th>
              <td class="text-center align-middle">2024-01-11</td>
              <td class="align-middle">Perusahaan dan Keluarga</td>
              <td class="text-center">
                <div class="btn btn-success">Accepted</div>
              </td>
              <td class="text-center spacing-2">
                <div class="btn btn-info m-1"><i class="fa-solid fa-circle-info"></i></div>
              </td>
            </tr>
            <tr class="text">
              <th class="text-center align-middle">2</th>
              <td class="text-center align-middle">2024-01-11</td>
              <td class="align-middle">Perusahaan atau Keluarga</td>
              <td class="text-center">
                <div class="btn btn-danger">Rejected</div>
              </td>
              <td class="text-center spacing-2">
                <div class="btn btn-info m-1"><i class="fa-solid fa-circle-info"></i></div>
              </td>
            </tr>
            </tfoot>
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