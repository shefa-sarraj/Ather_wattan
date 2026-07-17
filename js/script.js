const menuBtn = document.getElementById("mobileMenuBtn");
const navbar = document.querySelector(".navbarr");

menuBtn.addEventListener("click", () => {
    navbar.classList.toggle("show");
});


function toggleStory(button) {
  const card = button.closest(".card");
  const moreText = card.querySelector(".more-text");

  moreText.classList.toggle("show");

  if (moreText.classList.contains("show")) {
    button.innerText = "إخفاء القصة";
  } else {
    button.innerText = "اقرا القصة";
  }
}