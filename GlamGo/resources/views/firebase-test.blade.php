<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Test - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    
    <!-- Include Header -->
    @include('components.header')

    <main class="pt-32 pb-16">
        <div class="container mx-auto px-4">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <h1 class="text-3xl font-bold mb-6">Firebase Connection Test</h1>
                
                <div class="space-y-6">
                    <!-- Test Write -->
                    <div class="p-4 border rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Test Write to Database</h2>
                        <input type="text" id="testMessage" placeholder="Enter a test message" 
                               class="w-full p-2 border rounded mb-2">
                        <button id="writeBtn" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Write to Database
                        </button>
                        <p id="writeStatus" class="mt-2 text-sm"></p>
                    </div>

                    <!-- Test Read -->
                    <div class="p-4 border rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Test Read from Database</h2>
                        <button id="readBtn" class="bg-green-500 text-white px-4 py-2 rounded">
                            Read from Database
                        </button>
                        <div id="readResult" class="mt-2 p-2 bg-gray-100 rounded"></div>
                    </div>

                    <!-- Connection Status -->
                    <div class="p-4 border rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Connection Status</h2>
                        <p id="connectionStatus">Checking connection...</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Footer -->
    @include('components.footer')

    <!-- Firebase -->
    <script type="module">
        import { database } from '/js/firebase-init.js';
        import { ref, set, get, onValue } from 'https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js';

        // Connection test
        const connectedRef = ref(database, '.info/connected');
        onValue(connectedRef, (snap) => {
            const status = snap.val() ? 'Connected to Firebase! ✅' : 'Not connected to Firebase ❌';
            document.getElementById('connectionStatus').textContent = status;
        });

        // Write test
        document.getElementById('writeBtn').addEventListener('click', async () => {
            const message = document.getElementById('testMessage').value;
            const statusEl = document.getElementById('writeStatus');
            
            try {
                await set(ref(database, 'test/message'), {
                    text: message,
                    timestamp: new Date().toISOString()
                });
                statusEl.textContent = 'Successfully wrote to database! ✅';
                statusEl.className = 'mt-2 text-sm text-green-600';
            } catch (error) {
                statusEl.textContent = `Error writing to database: ${error.message} ❌`;
                statusEl.className = 'mt-2 text-sm text-red-600';
            }
        });

        // Read test
        document.getElementById('readBtn').addEventListener('click', async () => {
            const resultEl = document.getElementById('readResult');
            
            try {
                const snapshot = await get(ref(database, 'test/message'));
                if (snapshot.exists()) {
                    const data = snapshot.val();
                    resultEl.textContent = `Last message: ${data.text} (${data.timestamp})`;
                } else {
                    resultEl.textContent = 'No data found in database';
                }
            } catch (error) {
                resultEl.textContent = `Error reading from database: ${error.message}`;
            }
        });
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</body>
</html>
