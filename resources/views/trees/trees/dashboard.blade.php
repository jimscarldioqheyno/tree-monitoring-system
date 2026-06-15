<!DOCTYPE html>
<html>
<head>
    <title>Tree Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .card { background: #f0f0f0; padding: 20px; margin: 10px 0; border-radius: 10px; }
        button { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🌳 Tree Monitoring Dashboard</h1>

    <div class="card">
        <h3>📊 Summary</h3>
        <p>Total Trees: 3</p>
        <p>Healthy: 2</p>
        <p>Warning: 1</p>
        <p>Critical: 0</p>
    </div>

    <div class="card">
        <h3>📍 Quick Actions</h3>
        <button onclick="window.location.href='/capture-location'">➕ Add New Tree</button>
        <button onclick="window.location.href='/map'">🗺️ View Map</button>
    </div>

    <div class="card">
        <h3>📋 Tree List</h3>
        <ul>
            <li>Old Oak - Oak - Healthy</li>
            <li>Mango Tree - Mango - Healthy</li>
            <li>Narra - Narra - Warning</li>
        </ul>
    </div>
</body>
</html>
