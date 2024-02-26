function filterResources() {
    const input = document.getElementById('search-input');
    const filter = input.value.toUpperCase();
    const ul = document.querySelector('.resources-list');
    const li = ul.getElementsByTagName('li');

    for (let i = 0; i < li.length; i++) {
        // Cette fois, nous voulons vérifier à la fois le titre et la description.
        let textContent = li[i].textContent || li[i].innerText;
        if (textContent.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
