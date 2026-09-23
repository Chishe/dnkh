document.addEventListener('DOMContentLoaded', function() {
    // Function to update charts
    function updateCharts() {
        // Fetch data from PHP script
        fetch('server/mc_chart_data.php')
            .then(response => response.json())
            .then(data => {
                // Process data and update charts
                updateChart1(data.table1);
                updateChart2(data.table2);
                updateChart3(data.table3);
                updateChart4(data.table4);
                updateChart5(data.table5);
                updateChart6(data.table6);
                updateChart7(data.table7);
                updateChart8(data.table8);
                updateChart9(data.table9);
                updateChart10(data.table10);
 
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    
    // Function to update Chart 1
    function updateChart1(data) {
        // Extract relevant data for Chart 1
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);
        const gaugevalue = data[0].pressure_actual;

        // Get the canvas element
        const ctx = document.getElementById('chart1').getContext('2d');

        fetch('server/mc_chart_data.php')
            .then(response => response.json())
            .then(data => {
                // Process data and update charts
                updateSetupAC1(data.setupac1);
            })
            .catch(error => console.error('Error fetching data:', error));
        
        function updateSetupAC1(data){
            const alarmmax = data[0].alarm_max;
            // console.log(alarmmax);
        

        // Create or update Chart 1
        if (window.myChart1) {
            // Update existing chart
            window.myChart1.data.labels = labels;
            window.myChart1.data.datasets[0].data = values;
            window.myChart1.update();
        } else {
            // Create new chart
            window.myChart1 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'After cut air blow 1',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: data[0].chart_max,
                        min: data[0].chart_min,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)', // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)', // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                            tickLength: 5,
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)', // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                            // minRotation: 90,
                            // maxRotation: 90,
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: alarmmax,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: data[0].alarm_min,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
        if (window.mygauge1){
            window.mygauge1.set(latestDataAC1.value);
            window.myChart1.update();
        }}
    }

    // Function to update Chart 2
    function updateChart2(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart2').getContext('2d');

        // Create or update Chart 2
        if (window.myChart2) {
            // Update existing chart
            window.myChart2.data.labels = labels;
            window.myChart2.data.datasets[0].data = values;
            window.myChart2.update();
        } else {
            // Create new chart
            window.myChart2 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Twist chut air blow 1',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart3(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart3').getContext('2d');

        // Create or update Chart 2
        if (window.myChart3) {
            // Update existing chart
            window.myChart3.data.labels = labels;
            window.myChart3.data.datasets[0].data = values;
            window.myChart3.update();
        } else {
            // Create new chart
            window.myChart3 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'After cut air blow 2',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart4(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart4').getContext('2d');

        // Create or update Chart 2
        if (window.myChart4) {
            // Update existing chart
            window.myChart4.data.labels = labels;
            window.myChart4.data.datasets[0].data = values;
            window.myChart4.update();
        } else {
            // Create new chart
            window.myChart4 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Twist chut air blow 2',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart5(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart5').getContext('2d');

        // Create or update Chart 2
        if (window.myChart5) {
            // Update existing chart
            window.myChart5.data.labels = labels;
            window.myChart5.data.datasets[0].data = values;
            window.myChart5.update();
        } else {
            // Create new chart
            window.myChart5 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tension pressure',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart6(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart6').getContext('2d');

        // Create or update Chart 2
        if (window.myChart6) {
            // Update existing chart
            window.myChart6.data.labels = labels;
            window.myChart6.data.datasets[0].data = values;
            window.myChart6.update();
        } else {
            // Create new chart
            window.myChart6 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tension adjust press',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart7(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart7').getContext('2d');

        // Create or update Chart 2
        if (window.myChart7) {
            // Update existing chart
            window.myChart7.data.labels = labels;
            window.myChart7.data.datasets[0].data = values;
            window.myChart7.update();
        } else {
            // Create new chart
            window.myChart7 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Flow 1',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart8(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart8').getContext('2d');

        // Create or update Chart 2
        if (window.myChart8) {
            // Update existing chart
            window.myChart8.data.labels = labels;
            window.myChart8.data.datasets[0].data = values;
            window.myChart8.update();
        } else {
            // Create new chart
            window.myChart8 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Flow 2',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart9(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart9').getContext('2d');

        // Create or update Chart 2
        if (window.myChart9) {
            // Update existing chart
            window.myChart9.data.labels = labels;
            window.myChart9.data.datasets[0].data = values;
            window.myChart9.update();
        } else {
            // Create new chart
            window.myChart9 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Flow 3',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    function updateChart10(data) {
        // Extract relevant data for Chart 2
        const labels = data.map(item => item.datetime);
        const values = data.map(item => item.pressure_actual);

        // Get the canvas element
        const ctx = document.getElementById('chart10').getContext('2d');

        // Create or update Chart 2
        if (window.myChart10) {
            // Update existing chart
            window.myChart10.data.labels = labels;
            window.myChart10.data.datasets[0].data = values;
            window.myChart10.update();
        } else {
            // Create new chart
            window.myChart10 = new Chart(ctx, {
                type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Flow 4',
                data: values,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
                scales: {
                    y:{
                        max: 1.0,
                        min: 0.0,
                        axis: 'y', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        }
                    },
                    x:{
                        axis: 'x', // ระบุแกนที่จะปรับสี
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของเส้นกริด
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.5)' // ตั้งค่าสีของข้อมูลที่ปรากฏบนแกน X
                        },
                    },
                },
                // responsive: true,
                // maintainAspectRatio: false,

                plugins: {
                    legend: {
                        // labels: {
                        //     usePointStyle: true,
                        //     pointStyle: 'line',
                        //     color: '#ffffff',
                        // },
                        display: false,
                    },
                    annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.9,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Max',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.05,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    content: 'Min',
                                    enabled: false,
                                    position: 'end'
                                }
                            },
                    ]
                    }
                }
            }
            });
        }
    }

    // Initial update
    updateCharts();

    // Set interval for periodic updates (every 10 seconds)
    setInterval(updateCharts, 1000);
});
