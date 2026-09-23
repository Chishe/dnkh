

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- <link rel="stylesheet" type="text/css" href="../../public/style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.4.0/chartjs-plugin-annotation.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="..\..\style.css">


    <title>Denso | FIN 11.5D LL PATROL</title>
    <link rel="icon" href="../../picture/Denso.png">

    <?php include("navbar/header_115_d.html") ?>

</head>

<body>
    <div class="container">
        <div class="row" style="color: palegoldenrod; font-weight: bold; font-size: 2rem; justify-content: center; text-align: center;">
            LL Patrol record form
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh; color: palegoldenrod;">Line : Radiator fin
                    forming no.6 : </div>
                <div class="divScroll">
                    <form action="LL_patrol_insert.php" method="post">
                        <table>
                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Your ID:</label>
                                    </div>
                                </th>
                                <td><input type="text" name="yourId" placeholder="Type something..."></td>
                            </tr>
                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Recorder:</label>
                                    </div>
                                </th>
                                <td><input type="text" name="recorder" placeholder="Type something..."></td>
                            </tr>
                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Date :</label>
                                    </div>
                                </th>
                                <td><input type="text" name="date_patrol" id="datepicker" readonly></td>
                            </tr>
                            <script>
                                $(function() {
                                    // Initialize Datepicker
                                    $("#datepicker").datepicker({
                                        dateFormat: "yy-mm-dd", // Set the desired date format
                                        onSelect: function(dateText) {
                                            // When a date is selected, update the input field
                                            $("#datepicker").val(dateText);
                                        }
                                    });

                                    // Set default value to the current date
                                    var currentDate = new Date();
                                    var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1).toString().padStart(2, '0') + "-" + currentDate.getDate().toString().padStart(2, '0');
                                    $("#datepicker").datepicker("setDate", formattedDate);
                                });
                            </script>
                            </script>
                            <script>
                                // Function to format the current date
                                function getCurrentDate() {
                                    const now = new Date();
                                    const year = now.getFullYear();
                                    const month = String(now.getMonth() + 1).padStart(2, '0');
                                    const day = String(now.getDate()).padStart(2, '0');

                                    return `${year}-${month}-${day}`;
                                }

                                // Set the value of the date input field when the page loads
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dateInput = document.getElementsByName('date')[0];
                                    if (dateInput) {
                                        dateInput.value = getCurrentDate();
                                    }
                                });
                            </script>

                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Time start :</label>
                                    </div>
                                </th>
                                <td><input type="text" name="timeStart" readonly></td>
                            </tr>
                            <script>
                                // Function to format the current date and time
                                function getCurrentDateTime() {
                                    const now = new Date();
                                    const hours = String(now.getHours()).padStart(2, '0');
                                    const minutes = String(now.getMinutes()).padStart(2, '0');
                                    const seconds = String(now.getSeconds()).padStart(2, '0');

                                    return `${hours}:${minutes}:${seconds}`;
                                }

                                // Set the value of the timeStart input field when the page loads
                                document.addEventListener('DOMContentLoaded', function() {
                                    const timeStartInput = document.getElementsByName('timeStart')[0];
                                    if (timeStartInput) {
                                        timeStartInput.value = getCurrentDateTime();
                                    }
                                });
                            </script>
                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Time stop :</label>
                                    </div>
                                </th>
                                <td><input type="text" name="timeStop" readonly></td>
                            </tr>
                            <script>
                                // Function to format the current time
                                function getCurrentTime() {
                                    const now = new Date();
                                    const hours = String(now.getHours()).padStart(2, '0');
                                    const minutes = String(now.getMinutes()).padStart(2, '0');
                                    const seconds = String(now.getSeconds()).padStart(2, '0');

                                    return `${hours}:${minutes}:${seconds}`;
                                }

                                // Set the value of the timeStop input field when the form is submitted
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.querySelector('form'); // Adjust selector if needed
                                    if (form) {
                                        form.addEventListener('submit', function(event) {
                                            event.preventDefault(); // Prevent the form from submitting

                                            const timeStopInput = document.getElementsByName('timeStop')[0];
                                            if (timeStopInput) {
                                                timeStopInput.value = getCurrentTime();
                                            }

                                            // You can submit the form programmatically if needed
                                            form.submit();
                                        });
                                    }
                                });
                            </script>

                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Round :</label>
                                    </div>
                                </th>
                                <td>
                                    <select name="round">
                                        <option value="">-Select Option-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                                        <label for="quality">Shift :</label>
                                    </div>
                                </th>
                                <td>
                                    <select name="shift">
                                        <option value="">-Select Option-</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br>
                </div>
            </div>
            <script>
                function toggleSelectVisibility(checkboxId, selectId) {
                    var checkbox = document.getElementById(checkboxId);
                    var select = document.getElementById(selectId);

                    // Show the select element only if the checkbox is checked
                    select.style.display = checkbox.checked ? 'block' : 'none';
                }
            </script>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="quality">Quality#1 :</label>
                </div>
                <div class="section-title">1.Graph quality result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality1Hidden" name="quality1Hidden" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn Didn't Pass" id="quality1" name="quality1">
                    <label class="custom-control-label" for="quality1" id="labelQuality1">****</label>
                </div>

                <div class="section-title">2.History quality result all P/N in control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality2Hidden" name="quality2Hidden" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn Didn't Pass" id="quality2" name="quality2">
                    <label class="custom-control-label" for="quality2" id="labelQuality2">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownQuality" name="dropdownQuality" style="display: none;">
                    <option value="">-Quality result-</option>
                    <option value="KN222310-8750">KN222310-8750</option>
                    <option value="KN233310-1880">KN233310-1880</option>
                    <option value="KN222310-9320">KN222310-9320</option>
                    <option value="KN222310-9350">KN222310-9350</option>
                    <option value="KN222310-9650">KN222310-9650</option>
                    <option value="KN222310-9710">KN222310-9710</option>
                    <option value="KN222310-9110">KN222310-9110</option>
                    <option value="KN233310-5080">KN233310-5080</option>
                    <option value="KN222310-9970">KN222310-9970</option>
                    <option value="KN233310-0090">KN233310-0090</option>

                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxQuality" name="textboxQuality" placeholder="Type something..." style="display: none;">



                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="machineCondition">Machine Condition#1 :</label>
                </div>
                <div class="section-title">1.Graph Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine1Hidden" name="Machine1Hidden" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn1 Didn't Pass" id="Machine1" name="Machine1">
                    <label class="custom-control-label" for="Machine1" id="labelMachine1">****</label>
                </div>

                <div class="section-title">2.History Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine2Hidden" name="Machine2Hidden" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn1 Didn't Pass" id="Machine2" name="Machine2">
                    <label class="custom-control-label" for="Machine2" id="labelMachine2">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownMachine" name="dropdownMachine" style="display: none;">
                    <option value="">-Machine condition-</option>
                    <option value="After cut air blow 1">After cut air blow 1</option>
                    <option value="Twist chut air blow 1">Twist chut air blow 1</option>
                    <option value="After cut air blow 2">After cut air blow 2</option>
                    <option value="Twist chut air blow 2">Twist chut air blow 2</option>
                    <option value="Tension pressure">Tension pressure</option>
                    <option value="Tension adjust pressure">Tension adjust pressure</option>
                    <option value="Flow 1">Flow 1</option>
                    <option value="Flow 2">Flow 2</option>
                    <option value="Flow 3">Flow 3</option>
                    <option value="Flow 4">Flow 4</option>
                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxMachine" name="textboxMachine" placeholder="Type something..." style="display: none;">
                <br>
                <br>
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="quality">Quality#2 :</label>
                </div>
                <div class="section-title">1.Graph quality result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality1Hidden_b" name="quality1Hidden_b" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn3 Didn't Pass" id="quality1_b" name="quality1_b">
                    <label class="custom-control-label" for="quality1_b" id="labelQuality1_b">****</label>
                </div>

                <div class="section-title">2.History quality result all P/N in control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality2Hidden_b" name="quality2Hidden_b" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn3 Didn't Pass" id="quality2_b" name="quality2_b">
                    <label class="custom-control-label" for="quality2_b" id="labelQuality2_b">****</label>
                </div>
                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownQuality_b" name="dropdownQuality_b" style="display: none;">
                    <option value="">-Quality result-</option>
                    <option value="KN222310-8750">KN222310-8750</option>
                    <option value="KN233310-1880">KN233310-1880</option>
                    <option value="KN222310-9320">KN222310-9320</option>
                    <option value="KN222310-9350">KN222310-9350</option>
                    <option value="KN222310-9650">KN222310-9650</option>
                    <option value="KN222310-9710">KN222310-9710</option>
                    <option value="KN222310-9110">KN222310-9110</option>
                    <option value="KN233310-5080">KN233310-5080</option>
                    <option value="KN222310-9970">KN222310-9970</option>
                    <option value="KN233310-0090">KN233310-0090</option>

                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxQuality_b" name="textboxQuality_b" placeholder="Type something..." style="display: none;">



                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="machineCondition">Machine Condition#2 :</label>
                </div>
                <div class="section-title">1.Graph Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine1Hidden_b" name="Machine1Hidden_b" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn4 Didn't Pass" id="Machine1_b" name="Machine1_b">
                    <label class="custom-control-label" for="Machine1_b" id="labelMachine1_b">****</label>
                </div>

                <div class="section-title">2.History Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine2Hidden_b" name="Machine2Hidden_b" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn4 Didn't Pass" id="Machine2_b" name="Machine2_b">
                    <label class="custom-control-label" for="Machine2_b" id="labelMachine2_b">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownMachine_b" name="dropdownMachine_b" style="display: none;">
                    <option value="">-Machine condition-</option>
                    <option value="After cut air blow 1">After cut air blow 1</option>
                    <option value="Twist chut air blow 1">Twist chut air blow 1</option>
                    <option value="After cut air blow 2">After cut air blow 2</option>
                    <option value="Twist chut air blow 2">Twist chut air blow 2</option>
                    <option value="Tension pressure">Tension pressure</option>
                    <option value="Tension adjust pressure">Tension adjust pressure</option>
                    <option value="Flow 1">Flow 1</option>
                    <option value="Flow 2">Flow 2</option>
                    <option value="Flow 3">Flow 3</option>
                    <option value="Flow 4">Flow 4</option>
                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxMachine_b" name="textboxMachine_b" placeholder="Type something..." style="display: none;">
                <br>
                <br>
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="quality">Quality#3 :</label>
                </div>
                <div class="section-title">1.Graph quality result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality1Hidden_c" name="quality1Hidden_c" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn5 Didn't Pass" id="quality1_c" name="quality1_c">
                    <label class="custom-control-label" for="quality1_c" id="labelQuality1_c">****</label>
                </div>

                <div class="section-title">2.History quality result all P/N in control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality2Hidden_c" name="quality2Hidden_c" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn5 Didn't Pass" id="quality2_c" name="quality2_c">
                    <label class="custom-control-label" for="quality2_c" id="labelQuality2_c">****</label>
                </div>
                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownQuality_c" name="dropdownQuality_c" style="display: none;">
                    <option value="">-Quality result-</option>
                    <option value="KN222310-8750">KN222310-8750</option>
                    <option value="KN233310-1880">KN233310-1880</option>
                    <option value="KN222310-9320">KN222310-9320</option>
                    <option value="KN222310-9350">KN222310-9350</option>
                    <option value="KN222310-9650">KN222310-9650</option>
                    <option value="KN222310-9710">KN222310-9710</option>
                    <option value="KN222310-9110">KN222310-9110</option>
                    <option value="KN233310-5080">KN233310-5080</option>
                    <option value="KN222310-9970">KN222310-9970</option>
                    <option value="KN233310-0090">KN233310-0090</option>

                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxQuality_c" name="textboxQuality_c" placeholder="Type something..." style="display: none;">



                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="machineCondition">Machine Condition#3 :</label>
                </div>
                <div class="section-title">1.Graph Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine1Hidden_c" name="Machine1Hidden_c" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn6 Didn't Pass" id="Machine1_c" name="Machine1_c">
                    <label class="custom-control-label" for="Machine1_c" id="labelMachine1_c">****</label>
                </div>

                <div class="section-title">2.History Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine2Hidden_c" name="Machine2Hidden_c" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn6 Didn't Pass" id="Machine2_c" name="Machine2_c">
                    <label class="custom-control-label" for="Machine2_c" id="labelMachine2_c">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownMachine_c" name="dropdownMachine_c" style="display: none;">
                    <option value="">-Machine condition-</option>
                    <option value="After cut air blow 1">After cut air blow 1</option>
                    <option value="Twist chut air blow 1">Twist chut air blow 1</option>
                    <option value="After cut air blow 2">After cut air blow 2</option>
                    <option value="Twist chut air blow 2">Twist chut air blow 2</option>
                    <option value="Tension pressure">Tension pressure</option>
                    <option value="Tension adjust pressure">Tension adjust pressure</option>
                    <option value="Flow 1">Flow 1</option>
                    <option value="Flow 2">Flow 2</option>
                    <option value="Flow 3">Flow 3</option>
                    <option value="Flow 4">Flow 4</option>
                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxMachine_c" name="textboxMachine_c" placeholder="Type something..." style="display: none;">
                <br>
                <br>
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="quality">Quality#4 :</label>
                </div>
                <div class="section-title">1.Graph quality result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality1Hidden_d" name="quality1Hidden_d" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn7 Didn't Pass" id="quality1_d" name="quality1_d">
                    <label class="custom-control-label" for="quality1_d" id="labelQuality1_d">****</label>
                </div>

                <div class="section-title">2.History quality result all P/N in control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality2Hidden_d" name="quality2Hidden_d" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn7 Didn't Pass" id="quality2_d" name="quality2_d">
                    <label class="custom-control-label" for="quality2_d" id="labelQuality2_d">****</label>
                </div>
                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownQuality_d" name="dropdownQuality_d" style="display: none;">
                    <option value="">-Quality result-</option>
                    <option value="KN222310-8750">KN222310-8750</option>
                    <option value="KN233310-1880">KN233310-1880</option>
                    <option value="KN222310-9320">KN222310-9320</option>
                    <option value="KN222310-9350">KN222310-9350</option>
                    <option value="KN222310-9650">KN222310-9650</option>
                    <option value="KN222310-9710">KN222310-9710</option>
                    <option value="KN222310-9110">KN222310-9110</option>
                    <option value="KN233310-5080">KN233310-5080</option>
                    <option value="KN222310-9970">KN222310-9970</option>
                    <option value="KN233310-0090">KN233310-0090</option>

                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxQuality_d" name="textboxQuality_d" placeholder="Type something..." style="display: none;">



                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="machineCondition">Machine Condition#4 :</label>
                </div>
                <div class="section-title">1.Graph Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine1Hidden_d" name="Machine1Hidden_d" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn8 Didn't Pass" id="Machine1_d" name="Machine1_d">
                    <label class="custom-control-label" for="Machine1_d" id="labelMachine1_d">****</label>
                </div>

                <div class="section-title">2.History Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine2Hidden_d" name="Machine2Hidden_d" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn8 Didn't Pass" id="Machine2_d" name="Machine2_d">
                    <label class="custom-control-label" for="Machine2_d" id="labelMachine2_d">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownMachine_d" name="dropdownMachine_d" style="display: none;">
                    <option value="">-Machine condition-</option>
                    <option value="After cut air blow 1">After cut air blow 1</option>
                    <option value="Twist chut air blow 1">Twist chut air blow 1</option>
                    <option value="After cut air blow 2">After cut air blow 2</option>
                    <option value="Twist chut air blow 2">Twist chut air blow 2</option>
                    <option value="Tension pressure">Tension pressure</option>
                    <option value="Tension adjust pressure">Tension adjust pressure</option>
                    <option value="Flow 1">Flow 1</option>
                    <option value="Flow 2">Flow 2</option>
                    <option value="Flow 3">Flow 3</option>
                    <option value="Flow 4">Flow 4</option>
                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxMachine_d" name="textboxMachine_d" placeholder="Type something..." style="display: none;">

                <br>
                <br>
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="quality">Quality#5 :</label>
                </div>
                <div class="section-title">1.Graph quality result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality1Hidden_e" name="quality1Hidden_e" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn9 Didn't Pass" id="quality1_e" name="quality1_e">
                    <label class="custom-control-label" for="quality1_e" id="labelQuality1_e">****</label>
                </div>

                <div class="section-title">2.History quality result all P/N in control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="quality2Hidden_e" name="quality2Hidden_e" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn9 Didn't Pass" id="quality2_e" name="quality2_e">
                    <label class="custom-control-label" for="quality2_e" id="labelQuality2_e">****</label>
                </div>
                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownQuality_e" name="dropdownQuality_e" style="display: none;">
                    <option value="">-Quality result-</option>
                    <option value="KN222310-8750">KN222310-8750</option>
                    <option value="KN233310-1880">KN233310-1880</option>
                    <option value="KN222310-9320">KN222310-9320</option>
                    <option value="KN222310-9350">KN222310-9350</option>
                    <option value="KN222310-9650">KN222310-9650</option>
                    <option value="KN222310-9710">KN222310-9710</option>
                    <option value="KN222310-9110">KN222310-9110</option>
                    <option value="KN233310-5080">KN233310-5080</option>
                    <option value="KN222310-9970">KN222310-9970</option>
                    <option value="KN233310-0090">KN233310-0090</option>

                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxQuality_e" name="textboxQuality_e" placeholder="Type something..." style="display: none;">



                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">
                    <label for="machineCondition">Machine Condition#5 :</label>
                </div>
                <div class="section-title">1.Graph Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine1Hidden_e" name="Machine1Hidden_e" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn10 Didn't Pass" id="Machine1_e" name="Machine1_e">
                    <label class="custom-control-label" for="Machine1_e" id="labelMachine1_e">****</label>
                </div>

                <div class="section-title">2.History Machine Condition result all P/N in line control</div>
                <div class="custom-control custom-switch">
                    <input type="hidden" id="Machine2Hidden_e" name="Machine2Hidden_e" value="">
                    <input type="checkbox" class="custom-control-input toggle-btn10 Didn't Pass" id="Machine2_e" name="Machine2_e">
                    <label class="custom-control-label" for="Machine2_e" id="labelMachine2_e">****</label>
                </div>

                <div class="section-title">3.What's item hasn't been recovered</div>
                <select id="dropdownMachine_e" name="dropdownMachine_e" style="display: none;">
                    <option value="">-Machine condition-</option>
                    <option value="After cut air blow 1">After cut air blow 1</option>
                    <option value="Twist chut air blow 1">Twist chut air blow 1</option>
                    <option value="After cut air blow 2">After cut air blow 2</option>
                    <option value="Twist chut air blow 2">Twist chut air blow 2</option>
                    <option value="Tension pressure">Tension pressure</option>
                    <option value="Tension adjust pressure">Tension adjust pressure</option>
                    <option value="Flow 1">Flow 1</option>
                    <option value="Flow 2">Flow 2</option>
                    <option value="Flow 3">Flow 3</option>
                    <option value="Flow 4">Flow 4</option>
                </select>
                <div class="section-title">4.What's the problem (Re-check by 5M1E)</div>
                <input type="text" id="textboxMachine_e" name="textboxMachine_e" placeholder="Type something..." style="display: none;">

                <div class="section-title">Suggestion</div>
                <div>
                    <input type="text" name="suggestion" placeholder="Type something...">
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <button type="submit" class="btn">Submit</button>
    </form>
    <br><br>
</body>


</html>


<style>
    /* Optional: Add some styling for better appearance */
    /* body {
        font-family: Arial, sans-serif;
        background-color: #0B0153;
        color: white;
        font-weight: bold;
    } */

    /* form {
        display: grid;
        gap: 10px;
    } */

    h2 {
        margin-bottom: 10px;
    }

    /* 
    label {
        display: block;
        margin-bottom: 5px;
    } */

    .custom-control {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .toggle-btn {
        margin-right: 10px;
        background-color: transparent;
        border: 1px solid #fff;
        border-radius: 4px;
        padding: 8px;
        cursor: pointer;
    }

    .toggle-btn.pass {
        background-color: #fff;
        color: #fff;
        border: 1px solid #fff;
    }

    .toggle-btn.no {
        background-color: #fff;
        color: #fff;
        border: 1px solid #fff;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .custom-control-label {
        cursor: pointer;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: white;
    }

    .custom-control-input:checked~.custom-control-label::before {
        background-color: green;
    }

    .custom-control-input:not(:checked)~.custom-control-label::before {
        background-color: red;
    }

    .btn {
        display: block;
        border-radius: 11px;
        border: 1px solid white;
        font-weight: bold;
        color: #000;
        margin-top: 10px;
        margin-left: 40em;
        margin-right: 30em;
        background-color: #ffc000;
        justify-content: center;
    }
</style>

<script>
    function setupToggleButton(checkboxId, labelId, hiddenInputId) {
        const checkbox = document.getElementById(checkboxId);
        const label = document.getElementById(labelId);
        const hiddenInput = document.getElementById(hiddenInputId);

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                label.textContent = 'Pass';
                hiddenInput.value = 'Pass';
            } else {
                label.textContent = "Didn't pass";
                hiddenInput.value = "Didn't pass";
            }
        });

        // Call the event listener once to initialize the state
        checkbox.dispatchEvent(new Event('change'));
    }

    // Call the function for each toggle button
    setupToggleButton('quality1', 'labelQuality1', 'quality1Hidden');
    setupToggleButton('quality2', 'labelQuality2', 'quality2Hidden');
    setupToggleButton('Machine1', 'labelMachine1', 'Machine1Hidden');
    setupToggleButton('Machine2', 'labelMachine2', 'Machine2Hidden');

    setupToggleButton('quality1_b', 'labelQuality1_b', 'quality1Hidden_b');
    setupToggleButton('quality2_b', 'labelQuality2_b', 'quality2Hidden_b');
    setupToggleButton('Machine1_b', 'labelMachine1_b', 'Machine1Hidden_b');
    setupToggleButton('Machine2_b', 'labelMachine2_b', 'Machine2Hidden_b');

    setupToggleButton('quality1_c', 'labelQuality1_c', 'quality1Hidden_c');
    setupToggleButton('quality2_c', 'labelQuality2_c', 'quality2Hidden_c');
    setupToggleButton('Machine1_c', 'labelMachine1_c', 'Machine1Hidden_c');
    setupToggleButton('Machine2_c', 'labelMachine2_c', 'Machine2Hidden_c');

    setupToggleButton('quality1_d', 'labelQuality1_d', 'quality1Hidden_d');
    setupToggleButton('quality2_d', 'labelQuality2_d', 'quality2Hidden_d');
    setupToggleButton('Machine1_d', 'labelMachine1_d', 'Machine1Hidden_d');
    setupToggleButton('Machine2_d', 'labelMachine2_d', 'Machine2Hidden_d');

    setupToggleButton('quality1_e', 'labelQuality1_e', 'quality1Hidden_e');
    setupToggleButton('quality2_e', 'labelQuality2_e', 'quality2Hidden_e');
    setupToggleButton('Machine1_e', 'labelMachine1_e', 'Machine1Hidden_e');
    setupToggleButton('Machine2_e', 'labelMachine2_e', 'Machine2Hidden_e');
    // Add more if needed...
</script>
<script>
    const toggleCheckboxes = document.querySelectorAll('.toggle-btn');
    const dropdown = document.getElementById('dropdownQuality');
    const textbox = document.getElementById('textboxQuality');

    toggleCheckboxes.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownQuality.style.display = 'none';
                textboxQuality.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownQuality.style.display = 'block';
                textboxQuality.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxes1 = document.querySelectorAll('.toggle-btn1'); // Update to a unique class
    const dropdownMachine = document.getElementById('dropdownMachine');
    const textboxMachine = document.getElementById('textboxMachine');

    toggleCheckboxes1.forEach(toggleCheckbox1 => {
        toggleCheckbox1.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownMachine.style.display = 'none';
                textboxMachine.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownMachine.style.display = 'block';
                textboxMachine.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox1.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesQuality_b = document.querySelectorAll('.toggle-btn3');
    const dropdownQuality_b = document.getElementById('dropdownQuality_b');
    const textboxQuality_b = document.getElementById('textboxQuality_b');

    toggleCheckboxesQuality_b.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownQuality_b.style.display = 'none';
                textboxQuality_b.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownQuality_b.style.display = 'block';
                textboxQuality_b.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesMachine_b = document.querySelectorAll('.toggle-btn4'); // Update to a unique class
    const dropdownMachine_b = document.getElementById('dropdownMachine_b');
    const textboxMachine_b = document.getElementById('textboxMachine_b');

    toggleCheckboxesMachine_b.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownMachine_b.style.display = 'none';
                textboxMachine_b.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownMachine_b.style.display = 'block';
                textboxMachine_b.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesQuality_c = document.querySelectorAll('.toggle-btn5');
    const dropdownQuality_c = document.getElementById('dropdownQuality_c');
    const textboxQuality_c = document.getElementById('textboxQuality_c');

    toggleCheckboxesQuality_c.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownQuality_c.style.display = 'none';
                textboxQuality_c.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownQuality_c.style.display = 'block';
                textboxQuality_c.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesMachine_c = document.querySelectorAll('.toggle-btn6'); // Update to a unique class
    const dropdownMachine_c = document.getElementById('dropdownMachine_c');
    const textboxMachine_c = document.getElementById('textboxMachine_c');

    toggleCheckboxesMachine_c.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownMachine_c.style.display = 'none';
                textboxMachine_c.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownMachine_c.style.display = 'block';
                textboxMachine_c.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesQuality_d = document.querySelectorAll('.toggle-btn7');
    const dropdownQuality_d = document.getElementById('dropdownQuality_d');
    const textboxQuality_d = document.getElementById('textboxQuality_d');

    toggleCheckboxesQuality_d.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownQuality_d.style.display = 'none';
                textboxQuality_d.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownQuality_d.style.display = 'block';
                textboxQuality_d.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesMachine_d = document.querySelectorAll('.toggle-btn8'); // Update to a unique class
    const dropdownMachine_d = document.getElementById('dropdownMachine_d');
    const textboxMachine_d = document.getElementById('textboxMachine_d');

    toggleCheckboxesMachine_d.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownMachine_d.style.display = 'none';
                textboxMachine_d.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownMachine_d.style.display = 'block';
                textboxMachine_d.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesQuality_e = document.querySelectorAll('.toggle-btn9');
    const dropdownQuality_e = document.getElementById('dropdownQuality_e');
    const textboxQuality_e = document.getElementById('textboxQuality_e');

    toggleCheckboxesQuality_e.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownQuality_e.style.display = 'none';
                textboxQuality_e.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownQuality_e.style.display = 'block';
                textboxQuality_e.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>
<script>
    const toggleCheckboxesMachine_e = document.querySelectorAll('.toggle-btn10'); // Update to a unique class
    const dropdownMachine_e = document.getElementById('dropdownMachine_e');
    const textboxMachine_e = document.getElementById('textboxMachine_e');

    toggleCheckboxesMachine_e.forEach(toggleCheckbox => {
        toggleCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // If toggle is checked (pass), hide the elements
                dropdownMachine_e.style.display = 'none';
                textboxMachine_e.style.display = 'none';
            } else {
                // If toggle is unchecked (no), show the elements
                dropdownMachine_e.style.display = 'block';
                textboxMachine_e.style.display = 'block';
            }
        });

        // Call the event listener once to initialize the state
        toggleCheckbox.dispatchEvent(new Event('change'));
    });
</script>