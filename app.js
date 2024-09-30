const borrowedBooks = [];

// Function to add borrowed book data
function addBorrowedBook(name, membershipNumber, phone, bookTitle) {
    const borrowDate = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
    borrowedBooks.push({ name, membershipNumber, phone, bookTitle, borrowDate });
    updateBorrowedBooksTable();
}

// Update the table with borrowed books data
function updateBorrowedBooksTable() {
    const borrowedBooksList = document.getElementById("borrowedBooksList");
    borrowedBooksList.innerHTML = ""; // Clear existing rows
    borrowedBooks.forEach(book => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${book.name}</td>
            <td>${book.membershipNumber}</td>
            <td>${book.phone}</td>
            <td>${book.bookTitle}</td>
            <td>${book.borrowDate}</td>
        `;
        borrowedBooksList.appendChild(row);
    });
}

// Event listener for form submission
document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get values from the form
    const name = this.name.value;
    const membershipNumber = this.membership_number.value;
    const phone = this.phone.value;
    const bookTitle = this.querySelector(".sliderTitle").innerText; // Assuming the title is in the slider

    // Add borrowed book
    addBorrowedBook(name, membershipNumber, phone, bookTitle);

    // Reset form fields
    this.reset();
});
