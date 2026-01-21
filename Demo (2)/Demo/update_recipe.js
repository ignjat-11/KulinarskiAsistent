document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const recipeId = urlParams.get("id");

    if (recipeId) {
        fetch(`get_recipe.php?id=${recipeId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("title").value = data.recipe.title;
                    document.getElementById("ingredients").value = data.recipe.ingredients;
                    document.getElementById("instructions").value = data.recipe.instructions;
                    document.getElementById("image_path").value = data.recipe.image_path;
                    document.getElementById("category").value = data.recipe.category;
                } else {
                    alert("Greška: " + data.message);
                }
            })
            .catch(error => console.error("Greška pri učitavanju recepta:", error));
    } else {
        alert("Nema ID recepta u URL-u.");
    }


    document.querySelector("#updateForm").addEventListener("submit", function (e) {
        e.preventDefault(); 

        const recipeData = {
            recipe_id: recipeId,
            title: document.getElementById("title").value.trim(),
            ingredients: document.getElementById("ingredients").value.trim(),
            instructions: document.getElementById("instructions").value.trim(),
            image_path: document.getElementById("image_path").value.trim(),
            category: document.getElementById("category").value.trim()
        };

        fetch("update_recipe.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(recipeData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Recept uspešno ažuriran!");
                window.location.href = "main.html"; 
            } else {
                alert("Greška pri ažuriranju: " + data.error);
            }
        })
        .catch(error => console.error("Greška:", error));
    });
});
