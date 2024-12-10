function validateForm() {
    const form = document.getElementById("bibliographyForm");
    const isbn = document.getElementById("isbn_electronic").value.trim();
    const year = document.getElementById("publication_year").value.trim();
    const currentYear = new Date().getFullYear();

    // ISBN Validation: Must be 13 digits
    if (!/^\d{13}$/.test(isbn)) {
        alert("The ISBN of the electronic book must be exactly 13 digits.");
        return false;
    }

    // Publication Year Validation: Must be current or past year
    if (year > currentYear) {
        alert("Publication year cannot be in the future.");
        return false;
    }

    // Price Validation: Must be in valid Rand format
    const priceField = document.getElementById("price");
    if (!priceField.value.match(/^\d+(\.\d{2})?$/)) {
        alert("Price must be in the format R 0.00.");
        return false;
    }

    // If all validations pass
    return true;
}
