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
  let url = "/ProjetWeb/ideas?";
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
