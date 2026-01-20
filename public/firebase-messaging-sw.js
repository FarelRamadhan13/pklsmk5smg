importScripts('https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.5/firebase-analytics.js');

firebase.initializeApp({
    apiKey: "AIzaSyD7vd67yqhhJ8tqXzwpTTNLE6TIq2HLzWE",
    authDomain: "notifikasi-magang.firebaseapp.com",
    projectId: "notifikasi-magang",
    storageBucket: "notifikasi-magang.appspot.com",
    messagingSenderId: "750762821815",
    appId: "1:750762821815:web:ced110754402de57c62532",
    measurementId: "G-0880EF8RXS"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});
