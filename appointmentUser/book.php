<?php
session_start();
include '../connect.php';
// include 'getAvailableTimes.php';

$date = date('Y-m-d');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the received data
    $user_id = $_SESSION['user_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d');
    $time = $_POST['times'] ?? '';

    // Check if the selected time is already booked for the selected date
    $sql = "SELECT * FROM appointments WHERE date = ? AND time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingBooking = $result->fetch_assoc();

    if ($existingBooking) {
        // If the time is already booked, notify the user
        echo "Error: This time slot is already booked for the selected date.";
        exit;
    }

    if ($user_id !== '' && $date !== '' && $time !== '') {
        $sql = "INSERT INTO appointments (user_id, name, phone_number, date, time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $user_id, $name, $phone_number, $date, $time);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Incomplete data received.";
    }

    exit; // Stop further execution after handling the POST request
}

// // Function to get available times for a specific date
function getAvailableTimesForDate($conn, $date)
{
    $allTimesForDay = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00');

    $sql = "SELECT time FROM appointments WHERE date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookedTimesForSelectedDate = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookedTimesForSelectedDate[] = date('H:i', strtotime($row['time']));
        }
    }


    // Available times for the selected date
    $availableTimesForSelectedDate = array_diff($allTimesForDay, $bookedTimesForSelectedDate);
    return $availableTimesForSelectedDate;
}

// Get the available times for the selected date
$selectedDate = $_POST['date'] ?? date('Y-m-d');
$availableTimesForSelectedDate = getAvailableTimesForDate($conn, $selectedDate);


include '../header-main.php';
?>


<link href='/assets/css/fullcalendar.min.css' rel='stylesheet' />
<script src='/assets/js/fullcalendar.min.js'></script>
<form method="post" action="/appointmentUser/book.php">

    <div x-data="calendar">
        <div class="panel">
            <div class="mb-5">
                <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center">
                    <div class="sm:mb-0 mb-4">
                        <!-- The "Back" button aligned to the top left -->
                        <button type="button" onclick="window.location.href='/appointmentUser/index.php'" class="btn btn-danger">Back</button>
                    </div>
                    <button type="button" onclick="window.location.href='/appointmentUser/view.php'"class="btn btn-primary top-3 right-3 mt-1 mr-4">View Appointments</button>


                    <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden"
                        :class="isAddEventModal && '!block'">
                        <div class="flex items-center justify-center min-h-screen px-4"
                            @click.self="isAddEventModal = false">
                            <div x-show="isAddEventModal" x-transition x-transition.duration.300
                                class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
                                <button type="button"
                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark"
                                    @click="isAddEventModal = false">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>


                                <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]"
                                    x-text="params.id ? 'Edit Event' : 'Book an Appointment'"></h3>
                                <div class="p-5">

                                    <div class="mb-5">
                                        <label for="name">Name :</label>
                                        <input id="name" type="text" name="name" class="form-input" required />
                                        <div class="text-danger mt-2" id="name"></div>
                                    </div>

                                    <div class="mb-5">
                                        <label for="phone_number">Contact No :</label>
                                        <input id="phone_number" type="tel" name="phone_number" class="form-input"
                                            required />
                                        <div class="text-danger mt-2" id="phone_number"></div>
                                    </div>


                                    <div class="mb-5">
                                        <label for="date">Date :</label>
                                        <input id="date" type="date" name="date" class="form-input"
                                            x-model="params.start" @change="watchDateChange($event)"
                                            value="<?= isset($date) ? $date : '' ?>" required />
                                        <div class="text-danger mt-2" id="startDateErr"></div>
                                    </div>

                                    <div class="mb-5">


                                    <div>
                                        <label for="time">Time:</label>
                                        <select id="counsellor" name="counsellor" class="form-select text-white-dark">

                                            <option>Dr. Aishah Rahman</option>
                                            <option>Priya Devi</option>
                                            <option>Chen Wei Ming</option>
                                            <option>Lin Mei Ling</option>

                                        </select>
                                    </div>
                                    </div>

                                    <div>
                                        <label for="counsellor">Counsellor:</label>
                                        <select id="counsellor" name="counsellor" class="form-select text-white-dark">

                                            <option>Dr. Aishah Rahman</option>
                                            <option>Priya Devi</option>
                                            <option>Chen Wei Ming</option>
                                            <option>Lin Mei Ling</option>

                                        </select>
                                    </div>

                                    <div class="flex justify-end items-center mt-8">
                                        <button type="button" class="btn btn-outline-danger"
                                            @click="isAddEventModal = false">Cancel</button>
                                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Book
                                            Slot</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calendar-wrapper" id='calendar'></div>
            </div>
        </div>
    </div>
</form>
<script>

    document.addEventListener("alpine:init", () => {
        Alpine.data("calendar", () => ({
            defaultParams: ({
                id: null,
                title: '',
                start: '',
                end: '',
                description: '',
                type: 'primary'
            }),
            params: {
                id: null,
                title: '',
                start: '',
                end: '',
                description: '',
                type: 'primary'
            },
            isAddEventModal: false,
            minStartDate: '',
            minEndDate: '',
            calendar: null,
            now: new Date(),
            events: [],
            init() {

                const dateInput = document.getElementById('date');
                dateInput.addEventListener('change', this.watchDateChange);
                var calendarEl = document.getElementById('calendar');
                this.calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: '',
                    },
                    editable: true,
                    dayMaxEvents: true,
                    selectable: true,
                    droppable: true,
                    eventClick: (event) => {
                        this.editEvent(event);
                    },
                    select: (event) => {
                        this.editDate(event)
                    },

                    events: this.events,
                });
                this.calendar.render();


            },



            watchDateChange(event) {
                const selectedDate = event.target.value;
                console.log('watchDateChange function is running.'); // Add this line


                const select = document.getElementById('times');
                if (selectedDate) {
                    fetch(`appointmentUser/getAvailableTimes.php?date=${selectedDate}`)
                        .then(response => response.json())
                        .then(data => {
                            select.innerHTML = '';
                            data.forEach(time => {
                                const option = document.createElement('option');
                                option.value = time;
                                option.text = time;
                                select.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching available times:', error);
                        });
                }
            },


            getMonth(dt, add = 0) {
                let month = dt.getMonth() + 1 + add;
                return dt.getMonth() < 10 ? '0' + month : month;
            },

            editEvent(data) {
                this.params = JSON.parse(JSON.stringify(this.defaultParams));
                if (data) {
                    let obj = JSON.parse(JSON.stringify(data.event));
                    this.params = {
                        id: obj.id ? obj.id : null,
                        title: obj.title ? obj.title : null,
                        start: this.dateFormat(obj.start),
                        end: this.dateFormat(obj.end),
                        type: obj.classNames ? obj.classNames[0] : 'primary',
                        description: obj.extendedProps ? obj.extendedProps.description : '',
                    };
                    this.minStartDate = new Date();
                    this.minEndDate = this.dateFormat(obj.start);
                } else {
                    this.minStartDate = new Date();
                    this.minEndDate = new Date();
                }

                this.isAddEventModal = true;
            },


            editDate(data) {
                let obj = {
                    event: {
                        start: data.start,
                        end: data.end
                    },
                };
                this.editEvent(obj);
            },

            dateFormat(dt) {
                dt = new Date(dt);
                const year = dt.getFullYear();
                const month = (dt.getMonth() + 1).toString().padStart(2, '0');
                const day = dt.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            },

            saveEvent() {
                if (!this.params.title) {
                    return true;
                }
                if (!this.params.start) {
                    return true;
                }
                if (!this.params.end) {
                    return true;
                }

                if (this.params.id) {
                    //update event
                    let event = this.events.find((d) => d.id == this.params.id);
                    event.title = this.params.title;
                    event.start = this.params.start;
                    event.end = this.params.end;
                    event.description = this.params.description;
                    event.className = this.params.type;
                } else {
                    //add event
                    let maxEventId = 0;
                    if (this.events) {
                        maxEventId = this.events.reduce(
                            (max, character) => (character.id > max ? character.id : max),
                            this.events[0].id
                        );
                    }

                    let event = {
                        id: maxEventId + 1,
                        title: this.params.title,
                        start: this.params.start,
                        end: this.params.end,
                        description: this.params.description,
                        className: this.params.type,
                    };
                    this.events.push(event);
                }
                this.calendar.getEventSources()[0].refetch() //refresh Calendar
                this.showMessage('Event has been saved successfully.');
                this.isAddEventModal = false;
            },

            startDateChange(event) {
                const dateStr = event.target.value;
                if (dateStr) {
                    this.minEndDate = this.dateFormat(dateStr);
                    this.params.end = '';
                }
            },



            showMessage(msg = '', type = 'success') {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                });
                toast.fire({
                    icon: type,
                    title: msg,
                    padding: '10px 20px',
                });
            }
        }));
    });
</script>
<?php include '../footer-main.php'; ?>