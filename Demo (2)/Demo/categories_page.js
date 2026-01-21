document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("category");
    const recipesGrid = document.getElementById("recipes-grid");

    function loadRecipes(category) {
        fetch(`categories_page.php?category=${category}`)
            .then(response => response.text())
            .then(data => {
                recipesGrid.innerHTML = data;
                attachRecipeToggleEvents();
            })
            .catch(error => console.error("Greška pri učitavanju recepata:", error));
    }

    categorySelect.addEventListener("change", function () {
        loadRecipes(this.value);
    });

    function attachRecipeToggleEvents() {
        document.querySelectorAll(".prikazi-recept-btn").forEach(button => {
            button.addEventListener("click", function () {
                let recipeDetails = this.closest(".recipe-card").querySelector(".recipe-details");

                if (recipeDetails.style.display === "none" || recipeDetails.style.display === "") {
                    recipeDetails.style.display = "block";
                    this.textContent = "Sakrij recept";
                } else {
                    recipeDetails.style.display = "none";
                    this.textContent = "Prikaži recept";
                }
            });
        });
    }

    
    loadRecipes("all");
});

