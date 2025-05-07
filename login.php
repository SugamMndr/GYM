<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
</head>

<body>
    <div class="background">
        <div class="login-container">
            <div class="login-form">
                <div class="header">
                    <div class="logo-circle"></div>
                    <h1>Log In</h1>
                    <p>Welcome back! Please enter your details</p>
                </div>

                <form action="./validation/login-validation.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" required>
                        </div>
                    </div>

                    <button type="submit" class="login-button">Log In</button>

                    <div class="divider">
                        <span>Or Continue With</span>
                    </div>

                    <div class="social-login">
                        <button type="button" class="social-button google">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google">
                            Google
                        </button>
                        <button type="button" class="social-button facebook">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                            Facebook
                        </button>
                    </div>

                    <div class="signup-link">
                        Don't have account? <a href="#">Sign up</a>
                    </div>
                </form>
            </div>

            <div class="image-container">
                <img src="/placeholder.svg?height=800&width=600" alt="Fitness enthusiast with headphones">
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>

</html>