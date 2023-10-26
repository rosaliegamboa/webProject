<!DOCTYPE html>
<html>
<head>
    <title>SIGN UP</title>
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
     <form action="signup-check.php" method="post">
        <h2>SIGN UP</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <label>Full Name</label>
            <input type="text" name="name" placeholder="Full Name"><br>

        <label>Email</label>
            <input type="email" name="email" placeholder="Email"><br>

        <label>Password</label>
        <input type="password" 
               name="password" 
               placeholder="Password" id="p1"><br>

        <label>Re-enter Password</label>
        <input type="password" 
               name="re_password" 
               placeholder="Re-enter Password" onblur="checkPass()" id="p2"><br>

               
        <label>Role</label>
            <select name="role" id="">
            <option value="">Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            </select><br><br><br>

               
        <label>Gender</label>
        <select name="gender" id="">
        <option value="">Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>


        <button type="submit">Sign Up</button>
        <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
<script>

    function checkPass(){

        const p1 = document.getElementById("p1").value;
        const p2 = document.getElementById("p2").value;


       if(p1 != p2){ 
            alert("password not match!");
        }
    }     

</script>
</html>
