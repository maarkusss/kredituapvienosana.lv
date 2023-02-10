document.querySelector("#header_menu_button").addEventListener("click", () => {
    document.querySelector("#header_menu").classList.toggle("hidden");
});

document
    .querySelector("#language_dropdown_button")
    ?.addEventListener("click", () => {
        document
            .querySelector("#language_dropdown_menu")
            .classList.toggle("hidden");
    });
