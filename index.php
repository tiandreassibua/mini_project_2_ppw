<?php

session_start();
if (!isset($_SESSION["isLogin"])) {
    echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
    echo "<script>window.location.href = 'login.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Kalender</title>
    <!-- icon rel -->
    <link rel="icon" href="https://www.iconarchive.com/download/i103365/paomedia/small-n-flat/calendar.1024.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <header>
        <h2>My Kalender</h2>
        <div class="user">
            <span class="name"><i class="fas fa-user"></i> <?= $_SESSION["nama"] ?></span>
            <button onclick="logout()">Logout</button>
        </div>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="left">
                <div class="calendar">
                    <div class="month">
                        <i class="fa fa-angle-left prev"></i>
                        <div class="date"></div>
                        <i class="fa fa-angle-right next"></i>
                    </div>
                    <div class="weekdays">
                        <div>Min</div>
                        <div>Sen</div>
                        <div>Sel</div>
                        <div>Rab</div>
                        <div>Kam</div>
                        <div>Jum</div>
                        <div>Sab</div>
                    </div>
                    <div class="days"></div>
                    <div class="goto-today">
                        <div class="goto">
                            <input type="text" placeholder="mm/yyyy" class="date-input" />
                            <button class="goto-btn">go</button>
                        </div>
                        <button class="today-btn">Hari ini</button>
                    </div>
                </div>
            </div>

            <!-- start modal detail kegiatan -->
            <div class="modalDetail">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title">Detail Kegiatan</div>
                        <i class="fas fa-times close-modal"></i>
                    </div>
                    <div class="modal-body">
                        <b class="title-detail"></b>
                        <p class="description-detail"></p><br>
                        <p>
                            <span class="fa-solid fa-location-pin"></span>
                            <span class="location-detail"></span>
                        </p>
                        <p>
                            <span class="fa-solid fa-stopwatch"></span>
                            <span class="duration-detail"></span>
                        </p>
                        <p>
                            <span class="fa-solid fa-level-up"></span>
                            <span class="level-detail"></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-delete-event">Hapus</button>
                        <input type="hidden" class="id-detail">
                    </div>
                </div>
            </div>
            <!-- end modal detail kegiatan -->

            <div class="right">
                <div class="today-date">
                    <div class="event-day"></div>
                    <div class="event-date"></div>
                </div>
                <div class="events">
                    <!-- will be dynamic -->
                </div>

                <div class="add-event-wrapper">
                    <div class="add-event-header">
                        <div class="title">Tambah Kegiatan</div>
                        <i class="fas fa-times close"></i>
                    </div>
                    <div class="add-event-body">
                        <div class="add-event-input">
                            <input type="text" placeholder="Nama kegiatan" class="event-name" />
                        </div>
                        <div class="add-event-input">
                            <input type="text" placeholder="Deskripsi" class="event-description" />
                        </div>
                        <div class="add-event-input">
                            <input type="text" placeholder="Lokasi/link maps" class="event-location" />
                        </div>
                        <div class="add-event-input">
                            <input type="datetime-local" placeholder="Waktu mulai" class="event-time-from" />
                            <input type="datetime-local" placeholder="Waktu selesai " class="event-time-to" />
                        </div>
                        <div class="add-event-input">
                            <select class="event-level">
                                <option value="0">Pilih level penting</option>
                                <option value="0">Biasa</option>
                                <option value="1">Sedang</option>
                                <option value="2">Sangat Penting</option>
                            </select>
                        </div>
                    </div>
                    <div class="add-event-footer">
                        <button class="add-event-btn">Simpan</button>
                    </div>
                </div>
            </div>
            <button class="add-event">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <footer>
        <p>We made with ❤️</p>
    </footer>

    <!-- <script src="./js/modal.js"></script> -->
    <script>
        const calendar = document.querySelector(".calendar"),
            date = document.querySelector(".date"),
            daysContainer = document.querySelector(".days"),
            prev = document.querySelector(".prev"),
            next = document.querySelector(".next"),
            todayBtn = document.querySelector(".today-btn"),
            gotoBtn = document.querySelector(".goto-btn"),
            dateInput = document.querySelector(".date-input"),
            eventDay = document.querySelector(".event-day"),
            eventDate = document.querySelector(".event-date"),
            eventsContainer = document.querySelector(".events"),
            addEventBtn = document.querySelector(".add-event"),
            addEventWrapper = document.querySelector(".add-event-wrapper "),
            addEventCloseBtn = document.querySelector(".close "),
            addEventTitle = document.querySelector(".event-name "),
            addEventFrom = document.querySelector(".event-time-from "),
            addEventTo = document.querySelector(".event-time-to "),
            addEventLocation = document.querySelector(".event-location"),
            addEventDescription = document.querySelector(".event-description"),
            addEventLevel = document.querySelector(".event-level"),
            addEventSubmit = document.querySelector(".add-event-btn ");

        let today = new Date();
        let activeDay;
        let month = today.getMonth();
        let year = today.getFullYear();

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
            "Desember",
        ];

        const namaHari = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];

        getAllData();
        var eventsArr = [];

        // function to get all event data from database
        function getAllData() {
            $.ajax({
                url: "./php/getAllData.php",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    for (let i = 0; i < data.length; i++) {
                        eventsArr.push(data[i]);
                    }
                    initCalendar();
                },
            });
        }

        //function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
        function initCalendar() {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const prevLastDay = new Date(year, month, 0);
            const prevDays = prevLastDay.getDate();
            const lastDate = lastDay.getDate();
            const day = firstDay.getDay();
            const nextDays = 7 - lastDay.getDay() - 1;

            date.innerHTML = namaBulan[month] + " " + year;

            let days = "";

            for (let x = day; x > 0; x--) {
                days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
            }

            for (let i = 1; i <= lastDate; i++) {
                //check if event is present on that day
                let event = false;
                eventsArr.forEach((eventObj) => {
                    if (
                        eventObj.day == i &&
                        eventObj.month == month + 1 &&
                        eventObj.year == year
                    ) {
                        event = true;
                    }
                });
                if (
                    i == new Date().getDate() &&
                    year == new Date().getFullYear() &&
                    month == new Date().getMonth()
                ) {
                    activeDay = i;
                    getActiveDay(i);
                    updateEvents(i);
                    if (event) {
                        days += `<div class="day today active event">${i}</div>`;
                    } else {
                        days += `<div class="day today active">${i}</div>`;
                    }
                } else {
                    if (event) {
                        days += `<div class="day event">${i}</div>`;
                    } else {
                        days += `<div class="day ">${i}</div>`;
                    }
                }
            }

            for (let j = 1; j <= nextDays; j++) {
                days += `<div class="day next-date">${j}</div>`;
            }
            daysContainer.innerHTML = days;
            addListner();
        }

        //function to add month and year on prev and next button
        function prevMonth() {
            month--;
            if (month < 0) {
                month = 11;
                year--;
            }
            initCalendar();
        }

        function nextMonth() {
            month++;
            if (month > 11) {
                month = 0;
                year++;
            }
            initCalendar();
        }

        prev.addEventListener("click", prevMonth);
        next.addEventListener("click", nextMonth);

        initCalendar();

        //function to add active on day
        function addListner() {
            const days = document.querySelectorAll(".day");
            days.forEach((day) => {
                day.addEventListener("click", (e) => {
                    getActiveDay(e.target.innerHTML);
                    updateEvents(Number(e.target.innerHTML));
                    activeDay = Number(e.target.innerHTML);
                    //remove active
                    days.forEach((day) => {
                        day.classList.remove("active");
                    });
                    //if clicked prev-date or next-date switch to that month
                    if (e.target.classList.contains("prev-date")) {
                        prevMonth();
                        //add active to clicked day afte month is change
                        setTimeout(() => {
                            //add active where no prev-date or next-date
                            const days = document.querySelectorAll(".day");
                            days.forEach((day) => {
                                if (
                                    !day.classList.contains("prev-date") &&
                                    day.innerHTML == e.target.innerHTML
                                ) {
                                    day.classList.add("active");
                                }
                            });
                        }, 100);
                    } else if (e.target.classList.contains("next-date")) {
                        nextMonth();
                        //add active to clicked day afte month is changed
                        setTimeout(() => {
                            const days = document.querySelectorAll(".day");
                            days.forEach((day) => {
                                if (
                                    !day.classList.contains("next-date") &&
                                    day.innerHTML == e.target.innerHTML
                                ) {
                                    day.classList.add("active");
                                }
                            });
                        }, 100);
                    } else {
                        e.target.classList.add("active");
                    }
                });
            });
        }

        todayBtn.addEventListener("click", () => {
            today = new Date();
            month = today.getMonth();
            year = today.getFullYear();
            initCalendar();
        });

        dateInput.addEventListener("input", (e) => {
            dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
            if (dateInput.value.length == 2) {
                dateInput.value += "/";
            }
            if (dateInput.value.length > 7) {
                dateInput.value = dateInput.value.slice(0, 7);
            }
            if (e.inputType == "deleteContentBackward") {
                if (dateInput.value.length == 3) {
                    dateInput.value = dateInput.value.slice(0, 2);
                }
            }
        });

        gotoBtn.addEventListener("click", gotoDate);

        function gotoDate() {
            const dateArr = dateInput.value.split("/");
            if (dateArr.length == 2) {
                if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length == 4) {
                    month = dateArr[0] - 1;
                    year = dateArr[1];
                    initCalendar();
                    return;
                }
            }
            alert("Invalid Date");
        }

        //function get active day day name and date and update eventday eventdate
        function getActiveDay(date) {
            const day = new Date(year, month, date);
            const dayName = namaHari[day.getDay()];
            eventDay.innerHTML = dayName;
            eventDate.innerHTML = date + " " + namaBulan[month] + " " + year;
        }

        //function update events when a day is active
        function updateEvents(date) {
            let events = "";
            eventsArr.forEach((event) => {
                if (
                    date == event.day &&
                    month + 1 == event.month &&
                    year == event.year
                ) {
                    event.events.forEach((event) => {
                        let level = "0";

                        if (event.level == "1") level = "sedang";
                        else if (event.level == "2") level = "penting";

                        const todayDate = new Date();
                        const endTime = new Date(event.end_time);
                        
                        console.log(`Hari ini => ${todayDate}`);
                        console.log(`end time => ${endTime}`);

                        let isExpired = false;
                        if (todayDate > endTime) {
                            isExpired = true;
                        }

                        events += `<div class="event">
                        <input type="hidden" id="${event.id}" value="${event.id}"/>
            <div class="title">
              <h3 class="event-title ${isExpired ? "isExpired" : ""}">${event.title} <i class="fas fa-circle ${level}"></i></h3> ${isExpired ? "<i class='expired'>expired</i>" : ""}
            </div>
            <div class="event-time">
            
            <span class="event-time">
                <b>${event.time}</b>
            </span>
            </div>
        </div>`;
                    });
                }
            });
            if (events == "") {
                events = `<div class="no-event">
            <h3>Tidak ada kegiatan</h3>
        </div>`;
            }
            eventsContainer.innerHTML = events;
            // saveEvents();
        }

        //function to add event
        addEventBtn.addEventListener("click", () => {
            addEventWrapper.classList.toggle("active");
        });

        addEventCloseBtn.addEventListener("click", () => {
            addEventWrapper.classList.remove("active");
        });

        document.addEventListener("click", (e) => {
            if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
                addEventWrapper.classList.remove("active");
            }
        });

        //allow 50 chars in eventtitle
        addEventTitle.addEventListener("input", (e) => {
            addEventTitle.value = addEventTitle.value.slice(0, 60);
        });

        //function to add event to eventsArr
        addEventSubmit.addEventListener("click", () => {
            const eventTitle = addEventTitle.value;
            const eventLocation = addEventLocation.value;
            const eventDescription = addEventDescription.value;
            const eventLevel = addEventLevel.value;
            const eventTimeFrom = addEventFrom.value;
            const eventTimeTo = addEventTo.value;

            if (eventTitle == "" || eventTimeFrom == "" || eventTimeTo == "" || eventLocation == "" || eventDescription == "") {
                alert("Inputan tidak boleh kosong!");
                return;
            }

            const timeFrom = new Date(eventTimeFrom);
            const timeTo = new Date(eventTimeTo);
            var time = `${timeFrom.getDate()} ${namaBulan[timeFrom.getMonth()]} - ${timeTo.getDate()} ${namaBulan[timeTo.getMonth()]}`;

            const millisecondDifference = timeTo.getTime() - timeFrom.getTime();
            const hourDifference = millisecondDifference / (1000 * 60 * 60);
            let duration = "";

            if (hourDifference < 24) {
                duration = hourDifference.toFixed(0) + ' jam';
            } else {
                const dayDifference = millisecondDifference / (1000 * 60 * 60 * 24);
                duration = dayDifference.toFixed(0) + ' hari ' + (hourDifference % 24).toFixed(0) + ' jam';
            }

            console.log(duration);
            console.log(time);

            $.ajax({
                url: "php/addData.php",
                type: "POST",
                data: `title=${eventTitle}&time=${time}&duration=${duration}&day=${activeDay}&month=${month + 1}&year=${year}&location=${eventLocation}&description=${eventDescription}&level=${eventLevel}&startTime=${eventTimeFrom}&endTime=${eventTimeTo}`,
                success: function (data) {
                    alert(data);
                    getAllData();
                    updateEvents(activeDay);
                },
                error: function (data) {
                    alert(data.responseText)
                },
            });

            window.location.reload();

            addEventWrapper.classList.remove("active");
            addEventTitle.value = "";
            addEventLocation.value = "";
            addEventDescription.value = "";
            addEventLevel.value = "";
            addEventFrom.value = "";
            addEventTo.value = "";

            //select active day and add event class if not added
            const activeDayEl = document.querySelector(".day.active");
            if (!activeDayEl.classList.contains("event")) {
                activeDayEl.classList.add("event");
            }
        });

        // fungsi untuk menghapus kegiatan ketika kegiatan di klik
        eventsContainer.addEventListener("click", (e) => {
            if (e.target.classList.contains("event")) {
                const eventId = e.target.children[0].value;
                // let singeEvent = []
                $.ajax({
                    url: "php/getData.php",
                    type: "GET",
                    data: "id=" + eventId,
                    success: function (response) {
                        showDetail(response[0]);
                    }
                });
            }
        });

        function showDetail(event) {
            let isExpired = false;
            const date = new Date();
            const eventEndTime = new Date(event.end_time);

            if (date > eventEndTime) isExpired = true;

            if (isExpired) {
                alert("Kegiatan ini sudah berakhir");
                return;
            }
            else {
                const detail = document.querySelector(".modalDetail");
                detail.style.display = "block";

                const titleDetail = document.querySelector(".title-detail");
                const locationDetail = document.querySelector(".location-detail");
                const durationDetail = document.querySelector(".duration-detail");
                const descriptionDetail = document.querySelector(".description-detail");
                const levelDetail = document.querySelector(".level-detail");
                const idDetail = document.querySelector(".id-detail");

                titleDetail.innerHTML = event.title;
                descriptionDetail.innerHTML = event.description;

                const timeFrom = new Date(event.start_time);
                const timeTo = new Date(event.end_time);
                var time = `${namaHari[timeFrom.getDay()]}, ${timeFrom.getDate()} ${namaBulan[timeFrom.getMonth()]} ${timeFrom.getHours()}:${timeFrom.getMinutes()} - ${namaHari[timeTo.getDay()]}, ${timeTo.getDate()} ${namaBulan[timeTo.getMonth()]} ${timeTo.getHours()}:${timeTo.getMinutes()}`;

                durationDetail.setAttribute("title", time);
                durationDetail.innerHTML = event.duration;
                idDetail.value = event.id;

                // lakukan pengecekan apakah location berupa link atau bukan
                var urlPattern = /^(|http|https):\/\/[^ "]+$/;
                var location = event.location;

                if (urlPattern.test(location)) {
                    location = `<a href="${location}" class="link-maps" target="_blank">Buka di maps</a>`;
                }


                locationDetail.innerHTML = location;

                let level = "Biasa";
                if (event.level == 1) level = "Sedang";
                else if (event.level == 2) level = "Sangat Penting";
                levelDetail.innerHTML = level;
            }
        }

        // fungsi untuk menghilangkan modal ketika tombol close di klik
        const close = document.querySelector(".close-modal");
        close.addEventListener("click", () => {
            const detail = document.querySelector(".modalDetail");
            detail.style.display = "none";
        });

        // fungsi untuk menghapus kegiatan ketika tombol delete di klik
        const deleteBtn = document.querySelector(".btn-delete-event");

        deleteBtn.addEventListener("click", (e) => {
            const id = document.querySelector(".id-detail").value;
            if (confirm("Yakin ingin menghapus kegiatan ini?")) {
                $.ajax({
                    url: "php/deleteData.php",
                    type: "POST",
                    data: "id=" + id,
                    success: function (data) {
                        alert(data);
                        getAllData();
                    }
                });
            }
            window.location.reload();
        });

        function logout() {
            alert("Yakin ingin logout?");
            window.location.href = "php/logout.php";
        }
    </script>
</body>

</html>