// Function to toggle the navbar visibility
function toggleNavbar() {
    const navbar = document.getElementById("navbar");

    // Toggle between visible and hidden states
    if (navbar.style.display === "block") {
        navbar.style.display = "none"; // Hide the navbar
    } else {
        navbar.style.display = "block"; // Show the navbar
    }
}