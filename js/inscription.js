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