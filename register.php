<?php

session_start();
if (isset($_SESSION["isLogin"]))
    header('location: index.php')

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | My Kalender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/auth.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form>
            <ul class="error"></ul>
            <input type="text" placeholder="Fullname" id="fname">
            <input type="text" placeholder="Username" id="uname">
            <input type="password" placeholder="Password" id="pwd">
        </form>
        <button onclick="register()">Daftar</button>
        <p>Sudah punya akun? Login <a href="./login.php">disini</a></p>
    </div>


    <script>
        const fname = document.querySelector("#fname");
        const uname = document.querySelector("#uname");
        const pwd = document.querySelector("#pwd");


        const msg = document.querySelector(".error");

        function validateUsername(username) {
            var pattern = /^[a-z0-9]{3,15}$/;
            return pattern.test(username);
        }

        const register = (e) => {
            fname.removeAttribute("class");
            uname.removeAttribute("class");
            pwd.removeAttribute("class");

            msg.innerHTML = "";

            if (fname.value === "") {
                msg.innerHTML += "<li>Nama tidak boleh kosong</li>"
                fname.setAttribute("class", "warningBox")
            }

            if (uname.value === "") {
                msg.innerHTML += "<li>Username tidak boleh kosong</li>"
                uname.setAttribute("class", "warningBox")
            } else if (!validateUsername(uname.value)) {
                msg.innerHTML += "<li>Username hanya terdiri dari huruf kecil dan angka, min 3char dan max 15char.</li>"
                uname.setAttribute("class", "warningBox")
            }

            if (pwd.value === "") {
                msg.innerHTML += "<li>Password tidak boleh kosong</li>"
                pwd.setAttribute("class", "warningBox")
            }

            if (msg.innerHTML == "") {
                // $.ajax({
                //     url: "php/registerProses.php",
                //     type: "POST",
                //     data: `fullname=${fname.value}&username=${uname.value}&password=${pwd.value}`,
                //     success: (response) => {
                //         alert(response.message)
                //         if (response.status == 1) window.location.href = "login.php";
                //     },
                //     error: (response) => {
                //         console.log(response.responseText);
                //     }
                // });

                var data = {
                    fullname: fname.value,
                    username: uname.value,
                    password: pwd.value
                }
                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./php/registerProses.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.response)
                        alert(response.message)
                        if (response.status == 1) window.location.href = "login.php";
                    }
                };

                xhr.send(JSON.stringify(data));
            }
        }
    </script>
</body>

</html>