document.addEventListener("DOMContentLoaded", () => {
    const loadData = async (endpoint) => {
        try {
            const response = await fetch(endpoint);
            if (!response.ok) throw new Error(`Помилка: ${response.statusText}`);
            const data = await response.json();
            displayTable(data);
            setupFilter(data); // Підключаємо фільтр
        } catch (error) {
            console.error("Помилка завантаження даних:", error);
        }
    };

    const displayTable = (data, filter = "all") => {
        const outputDiv = document.getElementById("output");
        outputDiv.innerHTML = ""; // Очищаємо існуючий контент
    
        Object.keys(data).forEach((key) => {
            if (filter !== "all" && key !== filter) return; // Фільтруємо дані
    
            const sectionTitle = document.createElement("h2");
            sectionTitle.textContent = key.toUpperCase();
            outputDiv.appendChild(sectionTitle);
    
            const table = document.createElement("table");
            table.classList.add("data-table");
    
            const headers = Object.keys(data[key][0] || {}); // Заголовки таблиці
            const thead = document.createElement("thead");
            const headerRow = document.createElement("tr");
    
            headers.forEach((header) => {
                const th = document.createElement("th");
                th.textContent = header;
                headerRow.appendChild(th);
            });
    
            thead.appendChild(headerRow);
            table.appendChild(thead);
    
            const tbody = document.createElement("tbody");
            data[key].forEach((row) => {
                const tableRow = document.createElement("tr");
    
                headers.forEach((header) => {
                    const td = document.createElement("td");
    
                    if (header === "image" || header === "photo") {  // Перевірка на наявність зображення
                        const img = document.createElement("img");
                        img.src = row[header];
                        img.alt = "Image";  // Текст, якщо зображення не завантажилось
                        img.style.maxWidth = "100px";  // Обмежуємо розмір зображення
                        img.style.height = "auto";
                        td.appendChild(img);
                    } else {
                        td.textContent = row[header];
                    }
    
                    tableRow.appendChild(td);
                });
    
                tbody.appendChild(tableRow);
            });
    
            table.appendChild(tbody);
            outputDiv.appendChild(table);
        });
    };

    const setupFilter = (data) => {
        const filterSelect = document.getElementById("filter");
        if (filterSelect) {
            filterSelect.addEventListener("change", (event) => {
                const selectedFilter = event.target.value;
                displayTable(data, selectedFilter);
            });
        } else {
            console.error("Filter element not found.");
        }
    };
    

    loadData("../api/manager/get_manager_info.php");
});
