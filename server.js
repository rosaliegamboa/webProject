const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());  // Add this line
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// MySQL Connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'gamboa',
});

db.connect(err => {
  if (err) {
    console.error('Database connection failed: ' + err.stack);
    return;
  }
  console.log('Connected to database');
});

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// API endpoint to add a new activity
app.post('/addActivity', (req, res) => {
  const { user_name, date, time, location, ootd } = req.body;

  const sql = 'INSERT INTO your_table_name (user_name, date, time, location, ootd) VALUES (?, ?, ?, ?, ?)';
  const values = [user_name, date, time, location, ootd];

  db.query(sql, values, (err, result) => {
    if (err) {
      console.error('Error inserting activity: ' + err.stack);
      res.status(500).send('Error inserting activity');
      return;
    }

    console.log('Activity inserted successfully');
    res.status(200).send('Activity inserted successfully');
  });
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
