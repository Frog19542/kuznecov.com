<!DOCTYPE html>
<html>
<head>
    <title>API Client</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        button { margin: 5px; padding: 8px 16px; }
        pre { background: #f4f4f4; padding: 10px; }
    </style>
</head>
<body>
    <h1>Тестирование API kuznecov.com</h1>
    <div>
        <button onclick="fetchAPI('/day.php')">Текущий день</button>
        <button onclick="fetchAPI('/month.php')">Текущий месяц</button>
        <button onclick="fetchAPI('/year.php')">Текущий год</button>
        <button onclick="fetchWeekday()">День недели (2025-05-01)</button>
        <button onclick="fetchDiff()">Разница дат (2025-01-01 и 2025-12-31)</button>
        <button onclick="fetchCities()">Города России</button>
        <button onclick="fetchCRUD()">CRUD все записи</button>
    </div>
    <pre id="output">Результат...</pre>

    <script>
        const API_BASE = 'http://api.kuznecov.com';
        async function fetchAPI(endpoint) {
            try {
                const res = await fetch(API_BASE + endpoint);
                const data = await res.json();
                document.getElementById('output').textContent = JSON.stringify(data, null, 2);
            } catch(e) {
                document.getElementById('output').textContent = 'Ошибка: ' + e.message;
            }
        }
        async function fetchWeekday() {
            const res = await fetch(API_BASE + '/weekday.php?date=2025-05-01');
            const data = await res.json();
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }
        async function fetchDiff() {
            const res = await fetch(API_BASE + '/diff.php?date1=2025-01-01&date2=2025-12-31');
            const data = await res.json();
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }
        async function fetchCities() {
            const res = await fetch(API_BASE + '/cities.php?country=Russia');
            const data = await res.json();
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }
        async function fetchCRUD() {
            const res = await fetch(API_BASE + '/index.php?action=all');
            const data = await res.json();
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }
    </script>
</body>
</html>

