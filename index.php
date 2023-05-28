<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Kalender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <header>
        <h2>My Kalender</h2>
    </header>
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
                        <input type="text" placeholder="Lokasi" class="event-location" />
                    </div>
                    <div class="add-event-input">
                        <input type="text" placeholder="Waktu mulai" class="event-time-from" />
                        <input type="text" placeholder="Waktu selesai " class="event-time-to" />
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

    <footer>
        <p>We made with ❤️</p>
    </footer>

    <!-- <script src="./js/script.js"></script> -->
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
            "Augustus",
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
                    // console.log(data);
                    for (let i = 0; i < data.length; i++) {
                        eventsArr.push(data[i]);
                    }
                    initCalendar();
                },
            });
        }

        console.log(eventsArr);

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
            console.log("here");
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
                        let isExpired = false;

                        if (event.level == "1") level = "sedang";
                        else if(event.level == "2") level = "penting";

                        if (today > new Date(year, month, date + 1)) {
                            isExpired = true;
                        }
                        
                        events += `<div class="event">
                        <input type="hidden" id="${event.id}" value="${event.id}"/>
            <div class="title">
              <h3 class="event-title ${isExpired ? "isExpired" : ""}">${event.title} <i class="fas fa-circle ${level}"></i></h3> ${isExpired ? "<i class='expired'>expired</i>" : ""}
            </div>
            <div class="event-time">
            <span class="event-time desc">${event.description}</span><br><br>
            <span class="event-time">
            <i class="fa-solid fa-location-pin"></i>
                <b>${event.location} | ${event.time}</b>
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

        //allow only time in eventtime from and to
        addEventFrom.addEventListener("input", (e) => {
            addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
            if (addEventFrom.value.length == 2) {
                addEventFrom.value += ":";
            }
            if (addEventFrom.value.length > 5) {
                addEventFrom.value = addEventFrom.value.slice(0, 5);
            }
        });

        addEventTo.addEventListener("input", (e) => {
            addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
            if (addEventTo.value.length == 2) {
                addEventTo.value += ":";
            }
            if (addEventTo.value.length > 5) {
                addEventTo.value = addEventTo.value.slice(0, 5);
            }
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
                alert("Please fill all the fields");
                return;
            }

            //check correct time format 24 hour
            const timeFromArr = eventTimeFrom.split(":");
            const timeToArr = eventTimeTo.split(":");
            if (
                timeFromArr.length !== 2 ||
                timeToArr.length !== 2 ||
                timeFromArr[0] > 23 ||
                timeFromArr[1] > 59 ||
                timeToArr[0] > 23 ||
                timeToArr[1] > 59
            ) {
                alert("Invalid Time Format");
                return;
            }

            const timeFrom = convertTime(eventTimeFrom);
            const timeTo = convertTime(eventTimeTo);

            $.ajax({
                url: "php/addData.php",
                type: "POST",
                data: "title=" + eventTitle + "&time=" + timeFrom + " - " + timeTo + "&day=" + activeDay + "&month=" + (month + 1) + "&year=" + year + "&location=" + eventLocation + "&description=" + eventDescription + "&level=" + eventLevel,
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

            // console.log(eventsArr);
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
                if (confirm("Yakin ingin menghapus kegiatan ini?")) {
                    // mengambil id dari event yang di klik
                    const eventId = e.target.children[0].value;

                    // delete event from database and update eventsArr
                    $.ajax({
                        url: "php/deleteData.php",
                        type: "POST",
                        data: "id=" + eventId,
                        success: function (data) {
                            alert(data);
                            getAllData();
                        }
                    })
                }
                window.location.reload();
                updateEvents(activeDay);
            }
        });

        function convertTime(time) {
            //convert time to 24 hour format
            let timeArr = time.split(":");
            let timeHour = timeArr[0];
            let timeMin = timeArr[1];
            let timeFormat = timeHour >= 12 ? "PM" : "AM";
            timeHour = timeHour % 12 || 12;
            time = timeHour + ":" + timeMin + " " + timeFormat;
            return time;
        }
    </script>
</body>

</html>