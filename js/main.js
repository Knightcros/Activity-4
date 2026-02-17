 document.addEventListener('DOMContentLoaded', function () {
            const navbarToggle = document.getElementById('navbarToggle');
            const navbarMenu = document.getElementById('navbarMenu');

            if (navbarToggle && navbarMenu) {
                navbarToggle.addEventListener('click', function () {
                   
                    navbarToggle.classList.toggle('is-active');
                    navbarMenu.classList.toggle('is-active');

                  
                    const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';
                    navbarToggle.setAttribute('aria-expanded', !isExpanded);
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("checkoutForm");
            const password = document.getElementById("Password");
            const confirmPassword = document.getElementById("ConfirmPassword");

                form.addEventListener("submit", function (e) {
                    if (password.value !== confirmPassword.value) {
                        e.preventDefault(); 
                        alert("Passwords do not match!");
                        confirmPassword.focus();
        }
    });
});
 function login() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if(email === "" || password === "") {
                alert("Please enter email and password");
            } else {
                
                alert(`Email: ${email}\nPassword: ${password}`);
            }
        }
