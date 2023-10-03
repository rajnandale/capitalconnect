document.addEventListener("DOMContentLoaded", function() {
    var button = document.querySelector(".profile-button");
    var dropdown = document.querySelector(".dropdown-content");
  
    button.addEventListener("click", function() {
      dropdown.classList.toggle("show");
    });
  
    window.addEventListener("click", function(event) {
      if (!event.target.matches(".profile-button")) {
        dropdown.classList.remove("show");
      }
    });
  });