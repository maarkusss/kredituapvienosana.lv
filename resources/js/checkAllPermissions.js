window.onload = function () {
    const checkAll = document.querySelector("#checkAll");
    const checkBoxes = document.querySelectorAll("input[type=checkbox]");

    var notChecked = 0;
    checkBoxes.forEach((element) => {
        if (element.checked == false) {
            notChecked = notChecked + 1;
        }
        if (notChecked == 2) {
            return false;
        }
    });

    if (notChecked == 1) {
        checkAll.checked = true;
    } else {
        checkAll.checked = false;
    }

    checkAll?.addEventListener("change", (event) => {
        if (event.target.checked) {
            checkBoxes.forEach((element) => {
                element.checked = true;
            });
        } else {
            checkBoxes.forEach((element) => {
                element.checked = false;
            });
        }
    });
};