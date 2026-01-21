$(document).ready(function () {
    $("#showUsers").click(function () {
        $.post("get_user.php", function (data) {
            let users = JSON.parse(data);
            let html = `<h2>Korisnici</h2><table><tr><th>ID</th><th>Korisničko ime</th><th>Email</th><th>Akcije</th></tr>`;
            users.forEach(user => {
                html += `<tr>
                    <td>${user.user_id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="edit-btn" onclick="editUser(${user.user_id})">Izmeni</button>
                        <button class="delete-btn" onclick="deleteUser(${user.user_id})">Obriši</button>
                    </td>
                </tr>`;
            });
            html += `</table>`;
            $("#adminContent").html(html);
        });
    });

    $("#showRecipes").click(function () {
        $.post("get_recipes.php", function (data) {
            let recipes = JSON.parse(data);
            let html = `<h2>Recepti</h2><table><tr><th>ID</th><th>Naziv</th><th>Kategorija</th><th>Akcije</th></tr>`;
            recipes.forEach(recipe => {
                html += `<tr>
                    <td>${recipe.recipe_id}</td>
                    <td>${recipe.title}</td>
                    <td>${recipe.category}</td>
                    <td>
                        <button class="edit-btn" onclick="editRecipe(${recipe.recipe_id})">Izmeni</button>
                        <button class="delete-btn" onclick="deleteRecipe(${recipe.recipe_id})">Obriši</button>
                    </td>
                </tr>`;
            });
            html += `</table>`;
            $("#adminContent").html(html);
        });
    });
});


function editUser(userId) {
    window.location.href = `admin_update_users.html?user_id=${encodeURIComponent(userId)}`;
}


function deleteUser(userId) {
    if (confirm("Da li ste sigurni da želite obrisati korisnika ID: " + userId + "?")) {
        $.post("delete_user.php", { user_id: userId }, function (response) {
            alert(response); 
            $("#showUsers").click();
        });
    }
}

function editRecipe(recipeId) {
    window.location.href = `admin_update_recipe.html?recipe_id=${encodeURIComponent(recipeId)}`;
}


function deleteRecipe(recipeId) {
    
    if (confirm("Da li ste sigurni da želite obrisati recept ID: " + recipeId + "?")) {
        $.post("delete_recipes.php", { recipe_id: recipeId }, function (response) {
            alert(response);  
            $("#showRecipes").click(); 
        });
    }
}
