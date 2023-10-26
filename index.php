<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
	background: linear-gradient(to right, #d4494e, #fad0c4);
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	margin: 0;
  }
  
  * {
	font-family: 'Quicksand', sans-serif;
	box-sizing: border-box;
  }
  
  form {
	width: 400px;
	border: 2px solid #fff;
	padding: 30px;
	background: linear-gradient(to bottom right, #a18cd1, #fbc2eb);
	border-radius: 15px;
	box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  }
  
  h2 {
	text-align: center;
	margin-bottom: 30px;
	color: #333;
  }
  
  input {
	display: block;
	width: 100%;
	padding: 10px;
	margin: 10px 0;
	border: none;
	border-radius: 5px;
	background-color: rgba(255, 255, 255, 0.8);
  }
  
  label {
	color: #fff;
	font-size: 16px;
	margin-bottom: 5px;
  }
  
  button {
	background: linear-gradient(to bottom right, #6a11cb, #fc25fc);
	color: #fff;
	padding: 10px 15px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
  }
  
  button:hover {
	background: linear-gradient(to bottom right, #b24592, #f15f79);
  }
  
  .error {
	background: #ff5e5e;
	color: #fff;
	padding: 10px;
	border-radius: 5px;
	margin: 20px 0;
  }
  
  .success {
	background: #32cd32;
	color: #fff;
	padding: 10px;
	border-radius: 5px;
	margin: 20px 0;
  }
  
  .ca {
	font-size: 14px;
	display: block;
	margin-top: 20px;
	text-align: center;
	text-decoration: none;
	color: #fff;
  }
  
  .ca:hover {
	text-decoration: underline;
	color: #ccc;
  }
  
</style>
<body>
     <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        
        <label>Email</label>
        <input type="email" 
               name="email" 
               placeholder="Email"><br>

        <label>Password</label>
        <input type="password" 
               name="password" 
               placeholder="Password"><br>

        <button type="submit">Login</button>
        <a href="signup.php" class="ca">Create an account</a>
     </form>
</body>
</html>
