<?php
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Lelang System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="">

    <div class="container">
        <div class="pt-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    Lelang Simple
                </div>
                <div class="card-body">
                    <?php
                    $listFile = json_decode(file_get_contents('listItems.json'))[0];
                    ?>
                    Tanggal Sekarang : <span id="now"><?= date('d-m-Y H:i:s', time()); ?></span> <br /><hr>
                    Nama : <?= $listFile->name; ?> <br />
                    Start Lelang : <?= $listFile->start; ?> | Berakhir Lelang : <?= $listFile->end; ?> <br />
                    Waktu Berakhir : <span id="end"></span><br /><br />
                    Status Lelang : <span id="status"></span>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        function callData() {
            var now = document.getElementById('now');
            now.innerHTML = new Date().toLocaleString();
            var unixEnd = <?= strtotime($listFile->end); ?>;
            var unixStart = <?= strtotime($listFile->start); ?>;
            var unixNow = new Date().getTime() / 1000;
            var end = document.getElementById('end');
            // Diff start and end and show time
            var diff = unixEnd - unixNow;
            end.innerHTML = new Date(diff * 1000).toISOString().substr(11, 8);
            var status = document.getElementById('status');
            if (unixNow < unixStart) {
                status.innerHTML = 'Belum Dimulai';
            } else if (unixNow > unixEnd) {
                status.innerHTML = 'Sudah Berakhir';
            } else {
                status.innerHTML = 'Sedang Berlangsung';
            }
        }
        $(document).ready(function() {
            $("#status").html("Loading...")
            setInterval(callData, 1000)
        });
    </script>

</body>
</html>