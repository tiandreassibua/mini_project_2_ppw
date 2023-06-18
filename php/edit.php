<?php

include "config.php";
session_start();

// mengambil data kegiatan yang akan diedit.
$query = "SELECT * FROM `events_dev` WHERE `id` = '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// jika id_user pada kegiatan tidak sama dengan id_user pada session, maka akan diarahkan ke halaman utama.
if ($row["id_user"] !== $_SESSION["id_user"]) header("location: ../");

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
        <form enctype="multipart/form-data">
            <ul class="error"></ul>
            <label for="">Judul <sup>*</sup></label>
            <input type="text" placeholder="Title" id="title" value="<?= $row["title"] ?>" />
            <label for="">Deskripsi <sup>*</sup></label>
            <textarea id="description" placeholder="Description"><?= $row["description"] ?></textarea>
            <label for="">Lokasi <sup>*</sup></label>
            <input type="text" placeholder="Lokasi/link maps" id="location" value="<?= $row["location"] ?>" />
            <label for="">Gambar Kegiatan</label>
            <input type="file" id="image" />
            <label for="">Waktu Mulai <sup>*</sup></label>
            <input type="datetime-local" id="startTime" />
            <label for="">Waktu Selesai <sup>*</sup></label>
            <input type="datetime-local" id="endTime" />
            <label for="">Level kegiatan <sup>*</sup></label>
            <select id="level">
                <option value="0" <?php if ($row["level"] == "0") echo "selected" ?>>Biasa</option>
                <option value="1" <?php if ($row["level"] == "1") echo "selected" ?>>Sedang</option>
                <option value="2" <?php if ($row["level"] == "2") echo "selected" ?>>Sangat Penting</option>
            </select>
            <p><sup>(*)</sup> wajib diisi!</p>
            <br>
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

            const image = document.querySelector("#image");

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

            // toFixed(0) berfungsi untuk membulatkan angka desimal ke angka bulat

            const time = `${new Date(startTime.value).getDate()} ${namaBulan[new Date(startTime.value).getMonth()]} - ${new Date(endTime.value).getDate()} ${namaBulan[new Date(endTime.value).getMonth()]}`;

            // validasi inputan
            if (title.value == "" || timeFrom == "Invalid Date" || timeTo == "Invalid Date" || lokasi.value == "" || description.value == "") {
                alert("Inputan tidak boleh kosong!");
                return;
            }

            // validasi waktu mulai dan waktu selesai kegiatan jika waktu mulai lebih besar atau sama dengan waktu selesai
            if (new Date(timeFrom) >= new Date(timeTo)) {
                alert("Waktu mulai tidak boleh lebih besar atau sama dengan tanggal selesai!")
                return;
            }

            const formData = new FormData();

            if (image.files[0] != undefined) {
                // buat validasi ekstensi file yang diupload
                const fileExtension = image.files[0].name.split('.').pop().toLowerCase();
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const fileSize = image.files[0].size / 1024 / 1024;
                if (fileSize > 2) {
                    alert('Ukuran file tidak boleh lebih dari 2 MB');
                    return;
                } else if (!allowedExtensions.includes(fileExtension)) {
                    alert('Ekstensi file yang diupload harus berupa jpg, jpeg, atau png');
                    return;
                }
                // jika semua validasi terpenuhi, maka file akan ditambahkan ke formData
                formData.append("image", image.files[0]);
            }

            formData.append("id", id);
            formData.append("title", title.value);
            formData.append("time", time);
            formData.append("duration", duration);
            formData.append("day", day);
            formData.append("month", month + 1);
            formData.append("year", year);
            formData.append("location", lokasi.value);
            formData.append("description", description.value);
            formData.append("level", level.value);
            formData.append("startTime", timeFrom);
            formData.append("endTime", timeTo);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    alert(xhr.responseText);
                    window.location.href = "../";
                }
            };

            xhr.send(formData);
        });
    </script>
</body>

</html>