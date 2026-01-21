document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get("user_id");

    if (userId) {
        fetch("get_users.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "user_id=" + encodeURIComponent(userId)
        })
        .then(response => response.json())
        .then(user => {
            if (!user || user.error) {
                console.error("Greška:", user?.error || "Nema podataka o korisniku.");
                return;
            }

            document.getElementById("editUsername").value = user.username || "";
            document.getElementById("editEmail").value = user.email || "";
            document.getElementById("editRole").value = user.role_id;

            let hiddenInput = document.getElementById("user_id");
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.id = "user_id";
                hiddenInput.name = "user_id";
                document.getElementById("editUserForm").appendChild(hiddenInput);
            }
            hiddenInput.value = user.user_id;
        })
        .catch(error => console.error("Greška pri preuzimanju podataka:", error));
    }
});
