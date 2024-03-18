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
        
            <div class="form-group">
                <label>College Name</label>
                <div class="group">
                    <input type="text" class="form-control" id="collegename" placeholder="college name"  >
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <div class="group">
                    <input type="email" class="form-control" id="email" placeholder="email"  >
                </div>
            </div>
            <div class="form-group">
                <label>Country</label>
                <div class="group">
                    <input type="text" class="form-control" id="country" placeholder="country"   >
                </div>
            </div>
            <div class="form-group">
                <label>State</label>
                <div class="group">
                    <input type="text" class="form-control" id="state" placeholder="state"    >
                </div>
            </div>
            <div class="form-group">
                <label>City</label>
                <div class="group">
                    <input type="text" class="form-control" id="city" placeholder="city"    >
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="group">
                    <input type="password" class="form-control" id="password" placeholder="password"  >
                </div>
            </div>
            <div class="form-group">
                <label>Re-Password</label>
                <div class="group">

                    <input type="password" class="form-control" id="re-password" placeholder="re-password"  >
                    <div class="error"></div>
                </div>
            </div>

   

        <button onclick="signup(event)">Sign Up</button>
        <p class="register-p">Already a member? <a href="../login/login.php?key=2"> Login</a></p>
    </div>
    <script>
        const inputElements = document.querySelectorAll('.form-control');
    inputElements.forEach(input => {
        input.addEventListener('input', errorRemove);
    });

    function errorRemove(){
        document.querySelector('.error').innerHTML=" ";
    }  
        async function signup(event) {
            event.preventDefault();

            const collegename = document.querySelector('#collegename').value;
            const email = document.querySelector('#email').value;
            const country = document.querySelector('#country').value;
            const state = document.querySelector('#state').value;
            const city = document.querySelector('#city').value;
            const password = document.querySelector('#password').value;
            const repass = document.querySelector('#re-password').value;
            
            document.querySelector('.error').innerHTML = '';
            if (collegename == null || collegename =='' || email == null ||email == '' || password == null || password =='' || repass == null || repass == '' || country == null || country == '' || state == null || state == ''||city==null||city=='') {
                document.querySelector('.error').innerHTML = `<p style="color: red;">Please Fill Out All Fields</p>`;
            } else {
                if (password !== repass) {
                    document.querySelector('.error').innerHTML = `<p style="color: red;">Password doesn't Match</p>`;
                } else {
                    const data = new FormData();
                    data.append('collegename', collegename);
                    data.append('email', email);
                    data.append('country', country);
                    data.append('state', state);
                    data.append('city', city);
                   data.append('password', password);
                    

                    try {
                        const response = await fetch("../includes/college-signup.inc.php", {
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
                        document.querySelector('#error').innerHTML+='There was a problem with the fetch operation:'+ error;
                    }
                }
            }
        }

    </script>
</body>

</html>