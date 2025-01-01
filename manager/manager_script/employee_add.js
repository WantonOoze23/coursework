
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#employee_add form");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("../api/manager/add_employee.php", {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            if (result.success) {
                alert("Співробітника додано успішно!");
                form.reset();
            } else {
                alert(`Помилка: ${result.message}`);
            }
        } catch (error) {
            console.error("Error adding employee:", error);
            alert("Виникла помилка під час додавання співробітника.");
        }
    });
});
