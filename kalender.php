<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender - Kelas Virtual</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #fdf3f8;
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background-color: #c03cd2;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .back-arrow {
            position: absolute;
            left: 20px;
            font-size: 20px;
            cursor: pointer;
        }

        .navbar h1 {
            font-size: 18px;
            font-weight: 500;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 15px;
        }

        .month-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
        }

        .month-nav-btn {
            background: none;
            border: none;
            color: #c03cd2;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .month-nav-btn:hover {
            background-color: #f0e0f5;
        }

        .current-month {
            text-align: center;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .current-month i {
            color: #c03cd2;
            margin-bottom: 5px;
        }

        .today-date {
            font-size: 20px;
            font-weight: 500;
            margin: 15px 0;
            text-align: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 20px;
        }

        .day-header {
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            color: #666;
            padding: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .calendar-day:hover {
            background-color: #f0e0f5;
        }

        .calendar-day.empty {
            visibility: hidden;
        }

        .calendar-day.today {
            background-color: #c03cd2;
            color: white;
        }

        .calendar-day.has-event::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: #c03cd2;
            border-radius: 50%;
            bottom: 5px;
        }

        .calendar-day.selected {
            background-color: #c03cd2;
            color: white;
        }

        .calendar-day.has-event:not(.selected) {
            border: 2px solid #c03cd2;
        }

        .events-container {
            background-color: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .events-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
            color: #c03cd2;
        }

        .event-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .event-time {
            font-weight: 500;
            min-width: 70px;
            color: #666;
        }

        .event-details {
            flex-grow: 1;
        }

        .event-title {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .event-teacher {
            font-size: 12px;
            color: #666;
        }

        .add-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #c03cd2;
            color: white;
            border: none;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(192, 60, 210, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .add-btn:hover {
            transform: scale(1.1);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 350px;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-title {
            font-weight: 500;
            color: #c03cd2;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .form-group input, 
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .submit-btn {
            background-color: #c03cd2;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background-color: #a832b8;
        }

        .no-events {
            text-align: center;
            color: #666;
            padding: 20px 0;
        }

        .add-event-btn {
            background-color: #c03cd2;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .add-event-btn:hover {
            background-color: #a832b8;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php" class="back-arrow"><i class="fas fa-arrow-left" style="color: white";></i></a>
        <h1>Kalender</h1>
    </div>

    <div class="container">
        <div class="month-navigation">
            <button class="month-nav-btn" id="prev-month"><i class="fas fa-chevron-left"></i> Juni</button>
            <div class="current-month">
                <i class="far fa-calendar-alt"></i>
                <span id="current-month">Juli 2023</span>
            </div>
            <button class="month-nav-btn" id="next-month">Agustus <i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="today-date" id="today-date">Kamis, 17 Juli 2023</div>

        <div class="calendar-grid" id="calendar-grid">
            <!-- Day headers -->
            <div class="day-header">M</div>
            <div class="day-header">S</div>
            <div class="day-header">S</div>
            <div class="day-header">R</div>
            <div class="day-header">K</div>
            <div class="day-header">J</div>
            <div class="day-header">S</div>
            
            <!-- Calendar days will be generated by JavaScript -->
        </div>

        <div class="events-container">
            <div class="events-title">Jadwal Hari Ini</div>
            <div id="events-list">
                <!-- Events will be loaded here -->
            </div>
        </div>
    </div>

    <button class="add-btn" id="add-btn">+</button>

    <!-- Add Event Modal -->
    <div class="modal" id="event-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Jadwal</h3>
                <button class="close-btn" id="close-modal">&times;</button>
            </div>
            <form id="event-form">
                <input type="hidden" id="event-date">
                <div class="form-group">
                    <label for="event-title">Judul Jadwal</label>
                    <input type="text" id="event-title" required>
                </div>
                <div class="form-group">
                    <label for="event-time">Waktu</label>
                    <input type="time" id="event-time" required>
                </div>
                <div class="form-group">
                    <label for="event-teacher">Pengajar</label>
                    <input type="text" id="event-teacher" required>
                </div>
                <div class="form-group">
                    <label for="event-duration">Durasi (menit)</label>
                    <input type="number" id="event-duration" value="45" min="15" step="15" required>
                </div>
                <div class="form-group">
                    <label for="event-notes">Catatan</label>
                    <textarea id="event-notes"></textarea>
                </div>
                <button type="submit" class="submit-btn">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Event Detail Modal -->
    <div class="modal" id="detail-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="detail-date">Detail Jadwal</h3>
                <button class="close-btn" id="close-detail">&times;</button>
            </div>
            <div id="detail-content">
                <!-- Event details will be loaded here -->
            </div>
            <button class="add-event-btn" id="add-new-event">Tambah Jadwal Baru</button>
        </div>
    </div>

    <script>
        // Current date and calendar state
        let currentDate = new Date();
        let selectedDate = new Date();
        let events = JSON.parse(localStorage.getItem('calendarEvents')) || [];

        // DOM Elements
        const calendarGrid = document.getElementById('calendar-grid');
        const currentMonthEl = document.getElementById('current-month');
        const todayDateEl = document.getElementById('today-date');
        const eventsList = document.getElementById('events-list');
        const addBtn = document.getElementById('add-btn');
        const eventModal = document.getElementById('event-modal');
        const detailModal = document.getElementById('detail-modal');
        const closeModal = document.getElementById('close-modal');
        const closeDetail = document.getElementById('close-detail');
        const eventForm = document.getElementById('event-form');
        const eventDateInput = document.getElementById('event-date');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');
        const addNewEventBtn = document.getElementById('add-new-event');

        // Month names in Indonesian
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        // Initialize calendar
        function initCalendar() {
            renderCalendar();
            renderEventsForDate(selectedDate);
            updateTodayDate();
        }

        // Render calendar grid
        function renderCalendar() {
            // Clear previous days
            while (calendarGrid.children.length > 7) {
                calendarGrid.removeChild(calendarGrid.lastChild);
            }

            // Set current month year text
            currentMonthEl.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;

            // Update navigation buttons
            prevMonthBtn.innerHTML = `<i class="fas fa-chevron-left"></i> ${monthNames[(currentDate.getMonth() - 1 + 12) % 12]}`;
            nextMonthBtn.innerHTML = `${monthNames[(currentDate.getMonth() + 1) % 12]} <i class="fas fa-chevron-right"></i>`;

            // Get first day of month and total days
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

            // Add empty cells for days before first day of month
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day empty';
                calendarGrid.appendChild(emptyDay);
            }

            // Add days of month
            for (let i = 1; i <= daysInMonth; i++) {
                const day = document.createElement('div');
                day.className = 'calendar-day';
                day.textContent = i;

                const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                
                // Check if day is today
                const today = new Date();
                if (date.toDateString() === today.toDateString()) {
                    day.classList.add('today');
                }

                // Check if day is selected
                if (date.toDateString() === selectedDate.toDateString()) {
                    day.classList.add('selected');
                }

                // Check if day has events
                if (hasEventsOnDate(date)) {
                    day.classList.add('has-event');
                }

                // Add click event
                day.addEventListener('click', () => {
                    selectedDate = date;
                    renderCalendar();
                    renderEventsForDate(date);
                });

                calendarGrid.appendChild(day);
            }
        }

        // Check if date has events
        function hasEventsOnDate(date) {
            return events.some(event => {
                const eventDate = new Date(event.date);
                return eventDate.toDateString() === date.toDateString();
            });
        }

        // Render events for selected date
        function renderEventsForDate(date) {
            eventsList.innerHTML = '';

            const dateEvents = events.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.toDateString() === date.toDateString();
            });

            if (dateEvents.length === 0) {
                eventsList.innerHTML = '<div class="no-events">Tidak ada jadwal untuk hari ini</div>';
                return;
            }

            // Sort events by time
            dateEvents.sort((a, b) => a.time.localeCompare(b.time));

            dateEvents.forEach(event => {
                const eventItem = document.createElement('div');
                eventItem.className = 'event-item';
                eventItem.innerHTML = `
                    <div class="event-time">${event.time}</div>
                    <div class="event-details">
                        <div class="event-title">${event.title}</div>
                        <div class="event-teacher">${event.teacher}</div>
                    </div>
                `;
                
                eventItem.addEventListener('click', () => {
                    showEventDetail(event);
                });

                eventsList.appendChild(eventItem);
            });
        }

        // Show event detail modal
        function showEventDetail(event) {
            const detailContent = document.getElementById('detail-content');
            const detailDate = document.getElementById('detail-date');
            
            const eventDate = new Date(event.date);
            const formattedDate = `${dayNames[eventDate.getDay()]}, ${eventDate.getDate()} ${monthNames[eventDate.getMonth()]} ${eventDate.getFullYear()}`;
            
            detailDate.textContent = formattedDate;
            
            detailContent.innerHTML = `
                <div class="form-group">
                    <label>Judul</label>
                    <div>${event.title}</div>
                </div>
                <div class="form-group">
                    <label>Waktu</label>
                    <div>${event.time} (${event.duration} menit)</div>
                </div>
                <div class="form-group">
                    <label>Pengajar</label>
                    <div>${event.teacher}</div>
                </div>
                ${event.notes ? `
                <div class="form-group">
                    <label>Catatan</label>
                    <div>${event.notes}</div>
                </div>
                ` : ''}
            `;
            
            // Set up add new event button for this date
            addNewEventBtn.onclick = () => {
                detailModal.style.display = 'none';
                openAddEventModal(new Date(event.date));
            };
            
            detailModal.style.display = 'flex';
        }

        // Update today's date display
        function updateTodayDate() {
            const today = new Date();
            todayDateEl.textContent = `${dayNames[today.getDay()]}, ${today.getDate()} ${monthNames[today.getMonth()]} ${today.getFullYear()}`;
        }

        // Open add event modal
        function openAddEventModal(date) {
            selectedDate = date;
            eventDateInput.value = date.toISOString();
            eventForm.reset();
            eventModal.style.display = 'flex';
        }

        // Event Listeners
        addBtn.addEventListener('click', () => {
            openAddEventModal(selectedDate);
        });

        closeModal.addEventListener('click', () => {
            eventModal.style.display = 'none';
        });

        closeDetail.addEventListener('click', () => {
            detailModal.style.display = 'none';
        });

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        eventForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const newEvent = {
                id: Date.now(),
                date: eventDateInput.value,
                title: document.getElementById('event-title').value,
                time: document.getElementById('event-time').value,
                teacher: document.getElementById('event-teacher').value,
                duration: document.getElementById('event-duration').value,
                notes: document.getElementById('event-notes').value
            };
            
            events.push(newEvent);
            localStorage.setItem('calendarEvents', JSON.stringify(events));
            
            eventModal.style.display = 'none';
            renderCalendar();
            renderEventsForDate(new Date(newEvent.date));
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === eventModal) {
                eventModal.style.display = 'none';
            }
            if (e.target === detailModal) {
                detailModal.style.display = 'none';
            }
        });

        // Initialize the calendar
        initCalendar();
    </script>
</body>
</html>