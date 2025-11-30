const CACHE_NAME = "libweb-cache-v1";
const urlsToCache = [
  "/index.html",
  "/about.html",
  "/services.html",
  "/projects.html",
  "/packages.html",
  "/reviews.html",
  "/contact.html",
  "/style.css",
  "/logo.png",
  "/manifest.json"
];

// Install service worker
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
  );
});

// Activate service worker
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(cacheNames =>
      Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) return caches.delete(cache);
        })
      )
    )
  );
});

// Fetch from cache first
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => response || fetch(event.request))
  );
});
