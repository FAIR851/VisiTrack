// Show register form when clicking "Register" link
document.getElementById("showRegisterForm").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
});

// Show login form when clicking "Login" link
document.getElementById("showLoginForm").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("registerForm").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
});

// Handle form submission for registration
document.querySelector("form[action='register.php']").reset().addEventListener("submit", function (event) {
    event.preventDefault();

    // Clear form fields immediately
    document.querySelector("form[action='register.php']").reset();

    // Redirect to the login page
    window.location.href = "index.php";
});
