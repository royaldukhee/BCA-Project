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
        <h2>Student Login</h2>
        <form>
            <div class="form-group">
                <label>Username</label>
                <div class="group">
                    <input type="text" class="form-control" id="username" placeholder="username" required>
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
        <button type="button" onclick="submit()">Login</button>

        <p class="forget-password">Forget Password? <a href="../signup/signup.php"> Click-here</a></p>
        <p class="register-p">Don't have an account? <a href="..\signup\signup.php"> Sign up</a></p>
    </div>


</body>
<script>
    function submit() {
        // var request = new XMLHttpRequest();
        // request.open("POST", "../includes/login.inc.php", true);
        // const username = document.querySelector('#username').value;
        // const password = document.querySelector('#password').value;
        // const data={
        //     username: username,
        //     password: password};


        // jsonstring=JSON.stringify(data);
        // request.send(jsonstring);
        // request.onload = function() {
        //     let data = JSON.parse(this.response);
        //     console.log(data);
        //     document.querySelector('.error').innerHTML = data.message;
        // }
        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
        const key = '<?php
                 echo   $_GET['key'];
                    ?>'
        const data = new FormData();
        data.append('username', username);
        data.append('password', password);
        data.append('key',key);

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
                    // console.log(text);
                    document.querySelector('.error').innerHTML = "<span style='color: red;'>" + text + "</span>";
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>

</html>