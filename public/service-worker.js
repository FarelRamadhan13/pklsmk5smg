

self.addEventListener('push', function (event) {
    const data = event.data.json();
    self.registration.showNotification(data.title, {
        body: data.body,
        icon: '/icon.png', // Ganti dengan path icon Anda
        actions: data.actions,
        tag: data.tag
    });
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    if (event.action) {
        event.waitUntil(clients.openWindow(event.action));
    } else {
        event.waitUntil(clients.openWindow('/'));
    }
});
