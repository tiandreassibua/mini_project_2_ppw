<?php

include "config.php";
session_start();

$query = "SELECT * FROM `events` WHERE `id` = '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row["id_user"] !== $_SESSION["id_user"]) {
    header("location: ../");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Kegiatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/edit.css" />
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->
</head>

<body>
    <header>
        <h2>My Kalender</h2>
        <div class="user">
            <span class="name"><i class="fas fa-user"></i> <?= $_SESSION["nama"] ?></span>
            <button onclick="logout()">Logout</button>
        </div>
    </header>
    <div class="container">
        <h2>Update Kegiatan</h2>
        <form>
            <ul class="error"></ul>
            <label for="">Judul</label>
            <input type="text" placeholder="Title" id="title" value="<?= $row["title"] ?>" />
            <label for="">Deskripsi</label>
            <!-- <input type="text" placeholder="Description" id="description" value="<?= $row["description"] ?>" /> -->
            <textarea id="description" placeholder="Description"><?= $row["description"] ?></textarea>
            <label for="">Lokasi</label>
            <input type="text" placeholder="Lokasi/link maps" id="location" value="<?= $row["location"] ?>" />
            <label for="">Waktu Mulai</label>
            <input type="datetime-local" value="<?= $formattedStartTime ?>" id="startTime" />
            <label for="">Waktu Selesai</label>
            <input type="datetime-local" value="<?= $formattedEndTime ?>" id="endTime" />
            <label for="">Level kegiatan</label>
            <select id="level">
                <option value="0" <?php if ($row["level"] == "0") echo "selected" ?>>Biasa</option>
                <option value="1" <?php if ($row["level"] == "1") echo "selected" ?>>Sedang</option>
                <option value="2" <?php if ($row["level"] == "2") echo "selected" ?>>Sangat Penting</option>
            </select>
        </form>
        <div class="buttons">
            <a href="../">Kembali</a>
            <button id="submit">Update</button>
        </div>
    </div>
    <footer>
        <p>We made with ❤️</p>
    </footer>

    <script>
        const namaBulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        const submit = document.querySelector("#submit");
        submit.addEventListener("click", () => {
            const id = <?= $_GET['id'] ?>;
            const startTime = document.querySelector("#startTime");
            const endTime = document.querySelector("#endTime");

            const day = new Date(startTime.value).getDate();
            const month = new Date(startTime.value).getMonth();
            const year = new Date(startTime.value).getFullYear();
            const title = document.querySelector("#title");
            const description = document.querySelector("#description");
            const level = document.querySelector("#level");
            const lokasi = document.querySelector("#location");

            const timeTo = new Date(endTime.value);
            const timeFrom = new Date(startTime.value);

            const selisihMiliseken = timeTo.getTime() - timeFrom.getTime();
            const selisihJam = selisihMiliseken / (1000 * 60 * 60);
            let duration = "";

            if (selisihJam < 24) {
                duration = selisihJam.toFixed(0) + ' jam';
            } else {
                const selisihHari = selisihMiliseken / (1000 * 60 * 60 * 24);
                duration = selisihHari.toFixed(0) + ' hari ' + (selisihJam % 24).toFixed(0) + ' jam';
            }

            const time = `${new Date(startTime.value).getDate()} ${namaBulan[new Date(startTime.value).getMonth()]} - ${new Date(endTime.value).getDate()} ${namaBulan[new Date(endTime.value).getMonth()]}`;

            if (title.value == "" || timeFrom == "Invalid Date" || timeTo == "Invalid Date" || lokasi.value == "" || description.value == "") {
                alert("Inputan tidak boleh kosong!");
                return;
            }

            if (new Date(timeFrom) >= new Date(timeTo)) {
                alert("Waktu mulai tidak boleh lebih besar atau sama dengan tanggal selesai!")
                return;
            }

            var data = {
                id: id,
                title: title.value,
                time: time,
                duration: duration,
                day: day,
                month: month + 1,
                year: year,
                location: lokasi.value,
                description: description.value,
                level: level.value,
                startTime: timeFrom,
                endTime: timeTo
            }

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "update.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    alert(xhr.responseText);
                    window.location.href = "../";
                }
            };

            xhr.send(JSON.stringify(data));
        });
    </script>
</body>

</html>