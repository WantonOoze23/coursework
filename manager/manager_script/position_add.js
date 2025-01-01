
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#position_add form");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("../api/manager/add_position.php", {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            if (result.success) {
                alert("Посада додано успішно!");
                form.reset();
            } else {
                alert(`Помилка: ${result.message}`);
            }
        } catch (error) {
            console.error("Error adding position:", error);
            alert("Виникла помилка під час додавання посади.");
        }
    });
});
