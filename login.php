<?php

session_start();
if (isset($_SESSION["isLogin"]))
    header('location: index.php')

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | My Kalender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/auth.css" />
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form>
            <ul class="error"></ul>
            <input type="text" placeholder="Username" id="uname" />
            <input type="password" placeholder="Password" id="pwd" />
        </form>
        <button onclick="login()">Masuk</button>
        <p>
            Belum punya akun? Daftar <a href="./register.php">disini!</a>
        </p>
    </div>

    <script>
        const login = () => {
            var uname = document.querySelector("#uname");
            var pwd = document.querySelector("#pwd");

            var msg = document.querySelector(".error");
            msg.innerHTML = "";

            uname.removeAttribute("class");
            pwd.removeAttribute("class");

            if (uname.value === "") {
                msg.innerHTML += "<li>Username tidak boleh kosong</li>";
                uname.setAttribute("class", "warningBox");
            }

            if (pwd.value === "") {
                msg.innerHTML += "<li>Username tidak boleh kosong</li>";
                pwd.setAttribute("class", "warningBox");
            }

            if (msg.innerHTML == "") {
                var data = {
                    username: uname.value,
                    password: pwd.value
                }
                var xhr = new XMLHttpRequest();

                xhr.open("POST", "./php/loginProses.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.response)
                        alert(response.message);
                        if (response.status === 1) {
                            alert(`Selamat datang, ${response.user}`);
                            window.location.href = "index.php"
                        }
                    }
                };

                xhr.send(JSON.stringify(data));
            }
        };
    </script>
</body>

</html>