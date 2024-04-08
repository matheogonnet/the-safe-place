function moveToNext(currentElement, index) {
    if (currentElement.value.length >= currentElement.maxLength) {
        if (index < 5) {
            // Move to the next field
            const nextField = document.querySelector(`#institution-code-${index + 1}`);
            if (nextField) {
                nextField.focus();
            }
        }
    }
}

function toggleForm() {
    var isChecked = document.getElementById("userTypeToggle").checked;
    var eleveForm = document.getElementById("eleveForm");
    var parentForm = document.getElementById("parentForm");
    if (isChecked) {
        eleveForm.style.display = "none";
        parentForm.style.display = "block";
    } else {
        eleveForm.style.display = "block";
        parentForm.style.display = "none";
    }
}
