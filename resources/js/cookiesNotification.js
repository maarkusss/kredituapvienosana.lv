const cookiesAreAccepted = document.cookie
    .split(";")
    .some((cookie) => cookie.trim().startsWith("cookies_accepted="));

if (!cookiesAreAccepted) {
    document.querySelector("#cookies_notification").classList.remove("hidden");

    document
        .querySelector("#cookies_notification_button")
        .addEventListener("click", () => {
            const cookieExpiryDate = new Date(
                Date.now() + 30 * 1000 * 60 * 60 * 24
            ).toUTCString(); // 30 days

            document.cookie =
                "cookies_accepted=1;expires=" + cookieExpiryDate + ";path=/";

            document
                .querySelector("#cookies_notification")
                .classList.add("hidden");
        });
}
