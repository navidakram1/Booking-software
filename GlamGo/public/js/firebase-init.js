// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-analytics.js";
import { getDatabase } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
import { getStorage } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-storage.js";

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCp1ZYguR_eMmKG1CPjr_U4CCIiCw2PoVQ",
    authDomain: "glamgo-62925.firebaseapp.com",
    databaseURL: "https://glamgo-62925-default-rtdb.firebaseio.com",
    projectId: "glamgo-62925",
    storageBucket: "glamgo-62925.firebasestorage.app",
    messagingSenderId: "755603916094",
    appId: "1:755603916094:web:8bcf40d3e3afb646ab986f",
    measurementId: "G-YGCQK5988S"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const database = getDatabase(app);
const auth = getAuth(app);
const storage = getStorage(app);

export { app, analytics, database, auth, storage };
