document.addEventListener("DOMContentLoaded", function () {
    loadRecipes();
});

function loadRecipes() {
    fetch("read_recipe.php")
        .then(response => response.json())
        .then(data => displayRecipes(data))
        .catch(error => console.error("Greška pri učitavanju recepata:", error));
}

function displayRecipes(recipes) {
    const recipeList = document.getElementById("recipe-list");
    recipeList.innerHTML = ""; 

    recipes.forEach(recipe => {
        const recipeDiv = document.createElement("div");
        recipeDiv.classList.add("recipe-card");

        recipeDiv.innerHTML = `
            <img src="${recipe.image_path}" alt="${recipe.title}">
            <div class="recipe-content">
                <h2>${recipe.title}</h2>
                <h3>Sastojci:</h3>
                <p>${recipe.ingredients}</p>
                <h3>Uputstvo:</h3>
                <p>${recipe.instructions}</p>
                <button class="btn-change" id="btn-delete" data-id="${recipe.id}">Izbriši</button>
                <button class="btn-change" id="btn-update" data-id="${recipe.id}">Ažuriraj</button>

            </div>
        `;

        recipeList.appendChild(recipeDiv);
    });

    
    document.querySelectorAll("#btn-delete").forEach(button => {
        button.addEventListener("click", function () {
            const recipeId = this.getAttribute("data-id");
            deleteRecipe(recipeId);
        });
    });

    document.querySelectorAll("#btn-update").forEach(button => {
        button.addEventListener("click", function() {
            const recipeId = this.getAttribute("data-id"); 
            if (recipeId) {
                window.location.href = `update_recipe.html?id=${recipeId}`; 
            }
        });
    });
    
    
}


function deleteRecipe(recipeId) {
    if (confirm("Da li ste sigurni da želite da izbrišete recept?")) {
        fetch("delete_recipe.php", {
            method: "DELETE",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ recipe_id: recipeId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Recept uspešno obrisan!");
                loadRecipes(); 
            } else {
                alert("Došlo je do greške pri brisanju recepta: " + data.error);
            }
        })
        .catch(error => console.error("Greška pri brisanju recepta:", error));
    }
}


function updateRecipe(recipeId, updatedData) {
    if (confirm("Da li ste sigurni da želite da ažurirate recept?")) {
        fetch("update_recipe.php", {
            method: "PUT",  
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                recipe_id: recipeId,
                title: updatedData.title,
                ingredients: updatedData.ingredients,
                instructions: updatedData.instructions,
                image_path: updatedData.image_path,
                category: updatedData.category
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Recept uspešno ažuriran!");
                window.location.href = "read_recipe.html";  
            } else {
                alert("Došlo je do greške pri ažuriranju recepta: " + data.error);
            }
        })
        .catch(error => console.error("Greška pri ažuriranju recepta:", data.error));
    }
}

