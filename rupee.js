function animateRupee() {
    var rupee = document.querySelector(".rupee");
    rupee.classList.add("animate-rupee");
    setTimeout(function() {
      rupee.classList.remove("animate-rupee");
    }, 500);
  }