document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const recipeId = urlParams.get("recipe_id");

    if (recipeId) {
        const formData = new FormData();
        formData.append("recipe_id", recipeId);

        fetch("get_admin_recipe.php", {
        method: "POST",
        body: formData
        })

        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                document.getElementById("editTitle").value = data.recipe.title;
                document.getElementById("editCategory").value = data.recipe.category;
                document.getElementById("editIngredients").value = data.recipe.ingredients;
                document.getElementById("editInstructions").value = data.recipe.instructions;
                document.getElementById("recipe_id").value = recipeId;

                let imagePreview = document.getElementById("imagePreview");
                if (imagePreview && data.recipe.image_path) {
                    imagePreview.src = data.recipe.image_path;
                    imagePreview.style.display = "block";
                }
            } else {
                alert("Greška: " + data.message);
            }
        })
        .catch(error => console.error("Greška pri preuzimanju podataka:", error));
    }

    
    const form = document.querySelector("#editRecipeForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const updatedData = new FormData(this);

            fetch("update_recipes.php", {
                method: "POST",
                body: updatedData
            })
            .then(response => response.text())
            .then(responseText => {
                if (responseText.includes("Recept uspešno ažuriran")) {
                    alert("Recept je uspešno ažuriran!");
                    window.location.href = "admin_dashboard.php";
                } else {
                    alert("Greška pri ažuriranju recepta.");
                    console.error("Odgovor servera:", responseText);
                }
            })
            .catch(error => console.error("Greška pri ažuriranju:", error));
        });
    }
});
