const cors = require('cors');
// ...

// Middleware
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


document.getElementById("addActivityForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const name = document.getElementById("userName").value;
    const date = document.getElementById("activityDate").value;
    const time = document.getElementById("activityTime").value;
    const location = document.getElementById("activityLocation").value;
    const ootd = document.getElementById("activityOOTD").value;

    const newActivity = {
        user_name: name,
        date,
        time,
        location,
        ootd,
    };

    fetch('http://localhost:3000/addActivity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(newActivity),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        displayActivities();  // Display the updated list of activities
    })
    .catch((error) => {
        console.error('Error:', error);
    });

    // Reset the form
    e.target.reset();
});
