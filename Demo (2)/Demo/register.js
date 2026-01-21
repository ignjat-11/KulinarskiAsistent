document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();

        
        const usernameRegex = /^[a-zA-Z0-9_-]{3,20}$/; 
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        const passwordRegex = /^.{6,16}$/; 

       
        if (!usernameRegex.test(username)) {
            alert("Korisničko ime mora imati između 3 i 20 karaktera i može sadržati slova, brojeve, _ i -.");
            isValid = false;
        }

        
        if (!emailRegex.test(email)) {
            alert("Unesite ispravnu email adresu (npr. example@mail.com).");
            isValid = false;
        }

       
        if (!passwordRegex.test(password)) {
            alert("Lozinka mora imati između 6 i 16 karaktera.");
            isValid = false;
        }

       
        if (password !== confirmPassword) {
            alert("Lozinke se ne poklapaju. Pokušajte ponovo.");
            isValid = false;
        }

        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
