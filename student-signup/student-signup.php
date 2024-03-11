<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIGNUP PAGE</title>
     <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="student-signup.css">
</head>

<body>
    <h1>Abrod College Management System</h1>
    <div class="login-form">
        <h2>Sign Up Here</h2>
            <div class="form-group">
                <label>Username</label>
                <div class="group">
                     <input type="text" class="form-control" id="username" placeholder="username" required />
                </div>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <div class="group">
                    <input type="email" class="form-control" id="email" placeholder="email" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <div class="group">
                    <input type="password" class="form-control" id="password" placeholder="password" required>
                </div>
            </div>
            <div class="form-group">
                <label>Re-Password</label>
                <div class="group">
                    
                    <input type="password" class="form-control" id="re-password" placeholder="re-password" required>
                    <div id="error"></div>
                </div>
            </div>
            
           

            
        
        <button onclick="signup()">Sign Up</button>
        <p class="register-p">Already a member? <a href="../login/login.php?key=1"> Login</a></p>
    </div>
<script>
    async function signup() {
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;
    const repass = document.querySelector('#re-password').value;
    const email = document.querySelector('#email').value;
    document.querySelector('#error').innerHTML = '';

    if (password !== repass) {
        document.querySelector('#error').innerHTML = `<p style="color: red;">Password doesn't Match</p>`;
    } else {
        const data = new FormData();
        data.append('email', email);
        data.append('username', username);
        data.append('password', password);

        try {
            const response = await fetch("../includes/signup.inc.php", {
                method: "post",
                body: data,
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.text();
            console.log(result);
            if (result === 'success') {
                console.log('Redirecting...');
                window.location.href = '../login/login.php?key=1';
            } else {
                console.log(result);
                document.querySelector('#error').innerHTML += result;
            }
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }
}

// function resultremove() {
//     document.querySelector('#error').innerHTML = '';
// }

</script>    
</body>

</html>
