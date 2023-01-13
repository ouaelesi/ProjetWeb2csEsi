// filtring all recipes
const filterOptions = {
  category: "all",
  note: "all",
  preparationTime: "all",
  cookTime: "all",
  totalTime: "all",
};

const setCurrenctfilter = () => {
  const queryString = window.location.search;

  const urlParams = new URLSearchParams(queryString);
  const category = urlParams.get("category");
  const note = urlParams.get("note");
  const preparationTime = urlParams.get("preparationTime");
  const cookTime = urlParams.get("cookTime");
  const totalTime = urlParams.get("totalTime");

  filterOptions["category"] = category == "null" ? "all" : category;
  filterOptions["note"] = note == "null" ? "all" : note;
  filterOptions["preparationTime"] =
    preparationTime == "null" ? "all" : preparationTime;
  filterOptions["cookTime"] = cookTime == "null" ? "all" : cookTime;
  filterOptions["totalTime"] = totalTime == "null" ? "all" : totalTime;
  console.log(filterOptions);
};

const filter = (option, value) => {
  filterOptions[option] = value;
  let baseUrl = document.location.href.split("?")[0];
  let url = baseUrl + "?";
  url =
    url +
    "category=" +
    filterOptions["category"] +
    "&note=" +
    filterOptions["note"] +
    "&preparationTime=" +
    filterOptions["preparationTime"] +
    "&cookTime=" +
    filterOptions["cookTime"] +
    "&totalTime=" +
    filterOptions["totalTime"];

  document.location.href = url;
  console.log(filterOptions);
};

const upplyFilter = () => {};

const clearfilter = () => {
  let currentUrl = window.location.href;
  window.location.href = currentUrl.split("?")[0];
};
const gotoUrl = (url) => {
  window.location.href = url;
};
setCurrenctfilter();

// Rate recipe
function rateRecipe(recipeID, note) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    recetteID: recipeID,
    note: note,
    recipeRating: "1",
  })
    .then((data) => {})
    .catch((err) => {
      for (let i = 1; i <= 5; i++) {
        i <= note
          ? $(`#starsBox img:nth-child(${i})`).attr(
              "src",
              "public/icons/Yellow_Star.png"
            )
          : $(`#starsBox img:nth-child(${i})`).attr(
              "src",
              "public/icons/emptyStar.png"
            );
      }

      console.log(err);
    });
}

function likeRecipe(e, recipeId) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    recetteID: recipeId,
    likerecipe: true,
  })
    .then((data) => {
      console.log("done");
    })
    .catch((err) => {
      $(e).children().attr("src", "public/icons/fullheart.png");
      console.log("done");
      console.log(err);
    });
}

function stickyNavAnimations() {
  $(".hiddenToNav").hide();
  if ($("#stickyNav").offset().top > 280) {
    $(".hiddenToNav").show();
  }
}
$(".hiddenToNav").hide();
$(window).scroll(function () {
  stickyNavAnimations();
});

// Ajouter un ingredient
let ingredientList = [
  {
    name: "Potato",
    quantity: "5kg",
  },
];

// add ingredient to the list

function addRecipeIngredient() {
  $("#ingredientsList").empty();
  let ingredient = new Object();
  ingredient["name"] = $("#ingredientName").val();
  ingredient["quantity"] = $("#quantity").val();
  ingredientList.push(ingredient);
  renderIngredients();
}

function removeIngredient(id) {
  $("#ingredientsList").empty();
  ingredientList.splice(id, 1);
  renderIngredients();
}

function renderIngredients() {
  ingredientList.map((ingredient, key) => {
    var container = $(
      "<p class='bluredBox px-4 py-3 rounded-3 d-flex justify-content-between'></p>"
    );
    container.append(
      `<div>${
        key + 1
      }. <input name="ingName${key}" class="bg-transparent text-light border-0 outline-none" value='${
        ingredient.name
      }'></input></div>`
    );
    container.append(
      `<div>quantity: <input name='ingQuantity${ingredient.quantity}' class="bg-transparent text-light border-0 outline-none" value='${ingredient.quantity}'></input></div>`
    );
    container.append(
      `<div onclick='removeIngredient(${key})' class='cursor-pointer'> X </div>`
    );
    $("#ingredientsList").append(container);
  });
}

renderIngredients();

// add step

let stepsList = [
  {
    title: "Step one",
    description:
      "this is the step description, this is the step description,this is the step description,this is the step description,",
  },
];

function renderSteps() {
  $("#stepsList").empty();
  stepsList.map((step, key) => {
    var container = $("<p class='bluredBox px-4 py-3 rounded-3'></p>");
    var header = $("<div class='d-flex justify-content-between'> </div>");
    header.append(
      `<div class="h4">${
        key + 1
      }. <input class="bg-transparent text-light border-0 outline-none" value='${
        step.title
      }'/></div>`
    );
    header.append(
      `<div onclick='removeStep(${key})' class='cursor-pointer'> X </div>`
    );
    container.append(header);
    container.append(
      `<div><input class="bg-transparent text-light border-0 outline-none w-100" value='${step.description}'/></div>`
    );
    $("#stepsList").append(container);
  });
}

function addStep() {
  $("#stepsList").empty();
  let step = new Object();
  step["title"] = $("#stepTitle").val();
  step["description"] = $("#stepDescription").val();
  let newStep = new Object();
  stepsList.push(step);
  renderSteps();
}

function removeStep(id) {
  $("#stepsList").empty();
  stepsList.splice(id, 1);
  renderSteps();
}

renderSteps();

// ideas search
let ingredients = [
  {
    name: "t",
  },
  {
    name: "t",
  },
  {
    name: "to",
  },
  {
    name: "tom",
  },
  {
    name: "toma",
  },
  {
    name: "ouael",
  },
  {
    name: "sahbi",
  },
];

let addedIngredients = [];

function autoComplete() {
  let inputValue = $("#ideasSearch").val();
  $("#ingredientsSuggestions").empty();
  ingredients.map((ingredient, key) => {
    if (ingredient.name.startsWith(inputValue) && inputValue != "") {
      $("#ingredientsSuggestions").append(
        `<div class="py-2 bluredBox  rounded-1 my-1 mx-2 px-2 suggestion" onclick='addIngredient(${key})'>${ingredient.name}</div>`
      );
    }
  });
}

function addIngredient(id) {
  addedIngredients.push(ingredients[id]);
  console.log(addedIngredients);
  renderAddedIngredients();
}

function renderAddedIngredients() {
  $("#addedIngredients").empty();
  addedIngredients.map((ingredient, key) => {
    $("#addedIngredients").append(
      `<div class="bluredBox rounded-1 px-2 py-1">${ingredient.name} <span role="button" class="text-dark ms-2" onclick="rmAddedIngre(${key})">X</span></div>`
    );
  });
}

function rmAddedIngre(id) {
  addedIngredients.splice(id, 1);
  $("#addedIngredients").empty();
  renderAddedIngredients();
}

///

function addRecipeByUser() {
  console.log("here");
  $.post("/ProjetWeb/api/apiRoute.php", {
    recetteID: "",
    addRecipe: true,
  })
    .then((data) => {
      console.log(data);
    })
    .catch((err) => {
      console.log("done");
      console.log(err);
    });
}

function validateAccount(id) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    userId: id,
    validateAccount: true,
  })
    .then((data) => {
      document.location.reload(true);
    })
    .catch((err) => {
      document.location.reload(true);
      console.log(err);
    });
}

function rejectAccount(id) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    userId: id,
    rejectAccount: true,
  })
    .then((data) => {
      document.location.reload(true);
    })
    .catch((err) => {
      document.location.reload(true);
      console.log(err);
    });
}

// edit ingredient
function editIngredient(id) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    ingredientId: id,
    editIngredient: true,
    name: $("#ingredientName").val(),
    healthy: $("#isHealthy").val(),
    season: $("#ingredientSeason").val(),
    calories: $("#calories").val(),
  })
    .then((data) => {
      document.location.reload(true);
    })
    .catch((err) => {
      document.location.reload(true);
      console.log(err);
    });
}

function deleteIngredient(id) {
  $.post("/ProjetWeb/api/apiRoute.php", {
    ingredientId: id,
    deleteIngredient: true,
  })
    .then((data) => {
      document.location.reload(true);
    })
    .catch((err) => {
      document.location.reload(true);
      console.log(err);
    });
}
