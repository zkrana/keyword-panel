function clearInput() {
    var inputField = document.getElementById('search-input');
    inputField.value = ''; // Clear the input field
}

// Set a timeout to hide the custom alert after 3 seconds (3000 milliseconds)
setTimeout(function() {
    customAlert.style.display = "none";
}, 3000);