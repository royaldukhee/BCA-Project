<?php
    $key = $_GET['key'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGIN PAGE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h1>Abroad College Management System</h1>
    <div class="login-form">
        <h2>
            <?php
                echo ($key==1)?"Student Login":"College Login";
            ?> </h2>
        <form>
            <div class="form-group">
                <label>
                    <?php echo ($key==1)?"Username":"Email"; ?> 
                </label>
                <div class="group">
                <?php
                echo ($key==1)?"<input type='text' class='form-control' id='username' placeholder='username' required>":"<input type='email' class='form-control' id='username' placeholder='email' required>";
            ?>
                    </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="group">
                    <input type="password" class="form-control" id="password" placeholder="password" required>
                    <div class="error"></div>
                </div>
            </div>


        </form>
        <button onclick=login()>Login</button>

        <p class="forget-password">Forget Password? <a href=""> Click-here</a></p>
        <p class="register-p">Don't have an account? <?php if($key==1){
            echo '<a href="..\student-signup\student-signup.php"> Sign up</a>';
        }
        else {
            echo '<a href="..\college-signup\college-signup.php"> Sign up</a>';
        }
        ?>
        </p>
    </div>


</body>
<script>
    function login() {
               
        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
       const key = <?php echo $key; ?>;
        const data = new FormData();
        data.append('username', username);
        data.append('password', password);
       data.append('key', key);
        fetch("../includes/login.inc.php", {
                method: "post",
                body: data,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(text => {
                if (text === 'success') {
                    console.log('Redirecting...');
                    // Redirect to the desired location
                    window.location.href = '../student-home/student-home.php';
                } else {
                    console.log(text);
                    document.querySelector('.error').innerHTML = "<span style='color: red;'>" + text + "</span>";
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>

</html>