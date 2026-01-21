document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();

       
        const usernameRegex = /^[a-zA-Z0-9_-]{3,20}$/; 
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const messageMinLength = 10;

        
        if (!usernameRegex.test(username)) {
            alert("Korisničko ime mora imati 3-20 karaktera i može sadržati slova, brojeve, '_' ili '-'.");
            isValid = false;
        }

      
        if (!emailRegex.test(email)) {
            alert("Unesite ispravan email (npr. example@mail.com).");
            isValid = false;
        }

    
        if (message.length < messageMinLength) {
            alert(`Poruka mora imati najmanje ${messageMinLength} karaktera.`);
            isValid = false;
        }

   
        if (!isValid) {
            event.preventDefault();
        }
    });
});
