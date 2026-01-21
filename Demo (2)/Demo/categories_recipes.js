function toggleRecipe(button) {
    var recipeDetails = button.closest(".recipe-card").querySelector(".recipe-details");
    if (recipeDetails.style.display === "none" || recipeDetails.style.display === "") {
        recipeDetails.style.display = "block";
        button.textContent = "Sakrij recept";
    } else {
        recipeDetails.style.display = "none";
        button.textContent = "Prikaži recept";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    
    document.querySelector(".category-list").addEventListener("click", function(event) {
        if (event.target.classList.contains("category")) {
            let selectedCategory = event.target.getAttribute("data-category");

            fetch("categories_recipes.php?category=" + encodeURIComponent(selectedCategory))
                .then(response => response.text())
                .then(data => {
                    document.querySelector(".recipes-grid").innerHTML = data;
                })
                .catch(error => console.error("Greška: ", error));
        }
    });
});



