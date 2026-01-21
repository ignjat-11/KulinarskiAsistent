document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;

  
        const usernameEmail = document.getElementById("username_email").value.trim();
        const password = document.getElementById("password").value.trim();

     
        const usernameRegex = /^[a-zA-Z0-9_-]{3,20}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        const passwordRegex = /^.{6,16}$/; 

       
        if (!(emailRegex.test(usernameEmail) || usernameRegex.test(usernameEmail))) {
            alert("Unesite ispravno korisničko ime (3-20 karaktera) ili email (example@mail.com).");
            isValid = false;
        }

        
        if (!passwordRegex.test(password)) {
            alert("Lozinka mora imati između 6 i 16 karaktera.");
            isValid = false;
        }

  
        if (!isValid) {
            event.preventDefault();
        }
    });
});
