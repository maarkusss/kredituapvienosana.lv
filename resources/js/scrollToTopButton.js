const scrollToTopButton = document.querySelector("#scroll_to_top_button");

const scrollHeightTillVisible = 1000;

window.addEventListener("scroll", (e) => {
  if (
    window.pageYOffset >= scrollHeightTillVisible &&
    scrollToTopButton.classList.contains("hidden")
  ) {
    scrollToTopButton.classList.remove("hidden");
  } else if (
    window.pageYOffset < scrollHeightTillVisible &&
    !scrollToTopButton.classList.contains("hidden")
  ) {
    scrollToTopButton.classList.add("hidden");
  }
});

scrollToTopButton.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});
