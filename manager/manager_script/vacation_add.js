document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#vacation_add form");
    const beginningInput = document.querySelector("#beginning");
    const endInput = document.querySelector("#end");
    const amountInput = document.querySelector("#amount");

    // Function to calculate the number of days between two dates
    function calculateDays() {
        const beginningDate = new Date(beginningInput.value);
        const endDate = new Date(endInput.value);

        if (beginningDate && endDate && endDate >= beginningDate) {
            const timeDiff = endDate - beginningDate;
            const daysDiff = timeDiff / (1000 * 3600 * 24); // Convert milliseconds to days
            amountInput.value = daysDiff + 1; // Including both start and end date
        } else {
            amountInput.value = ''; // Reset if invalid dates
        }
    }

    // Event listeners to calculate days whenever the user changes the dates
    beginningInput.addEventListener('change', calculateDays);
    endInput.addEventListener('change', calculateDays);

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("../api/manager/add_vacation.php", {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            if (result.success) {
                alert("Vacation додано успішно!");
                form.reset();
            } else {
                alert(`Помилка: ${result.message}`);
            }
        } catch (error) {
            console.error("Error adding vacation:", error);
            alert("Виникла помилка під час додавання vacation.");
        }
    });
});
