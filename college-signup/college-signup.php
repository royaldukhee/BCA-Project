<!DOCTYPE html>
<html lang="en">

<head>
    <title>COLLEGE SIGNUP PAGE</title>
     <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="college-signup.css">
</head>

<body>
    <h1>Abrod College Management System</h1>
    <div class="login-form">
        <h2>Sign Up Here</h2>
<form >
            <div class="form-group">
                <label>College Name</label>
                <div class="group">
                     <input type="text" class="form-control" id="collegename" placeholder="college name" onchange="resultremove()" required />
                </div>
            </div>
            
            <div class="form-group">
                <label>College Email</label>
                <div class="group">
                    <input type="email" class="form-control" id="email" placeholder="email" required onchnage="resultremove()">
                </div>
            </div>
            <div class="form-group">
                <label>Country Name</label>
                <div class="group">
                    <input type="text" class="form-control" id="country" placeholder="country" required onchnage="resultremove()">
                </div>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <div class="group">
                    <input type="password" class="form-control" id="password" placeholder="password" require onchnage="resultremove()">
                </div>
            </div>
            <div class="form-group">
                <label>Re-Password</label>
                <div class="group">
                    
                    <input type="password" class="form-control" id="re-password" placeholder="re-password" required onchnage="resultremove()">
                    <div id="error"></div>
                </div>
            </div>
            
           

            <button onclick="signup()">Sign Up</button>
        </form>
        <p class="register-p">Already a member? <a href="../login/login.php?key=2"> Login</a></p>
    </div>
<script>
    async function signup() {
    const collegenae = document.querySelector('#collegename').value;
        const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;
    const repass = document.querySelector('#re-password').value;
    const country = document.querySelector('#country').value;
    document.querySelector('#error').innerHTML = '';

    if (password !== repass) {
        document.querySelector('#error').innerHTML = `<p style="color: red;">Password doesn't Match</p>`;
    } else {
        const data = new FormData();
        data.append('collegename', collegename);
        data.append('email', email);
        data.append('country', country);
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
                window.location.href = '../login/login.php?key=2';
            } else {
                console.log(result);
                document.querySelector('#error').innerHTML += result;
            }
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }
}

function resultremove() {
    document.querySelector('#error').innerHTML = '';
}

</script>    
</body>

</html>
