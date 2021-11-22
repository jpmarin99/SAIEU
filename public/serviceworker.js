importScripts('https://cdn.jsdelivr.net/npm/pouchdb@7.0.0/dist/pouchdb.min.js')

importScripts('./sw-db.js');
importScripts('./sw-utils.js');


var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
  //  '/views/layouts/app',
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
    '/images/png/SAIEU.png',
];
const APP_SHELL_INMUTABLE = [
    'https://fonts.googleapis.com/css?family=Quicksand:300,400',
    'https://fonts.googleapis.com/css?family=Lato:400,300',
    'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
    'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css',
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
    'https://cdn.jsdelivr.net/npm/pouchdb@7.0.0/dist/pouchdb.min.js'
];
// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});


// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    let respuesta;
    if ( event.request.url.includes('/api') ) {

        // return respuesta????
        respuesta = manejoApiMensajes( DYNAMIC_CACHE, event.request );

    } else {

        respuesta = caches.match(event.request).then(res => {

            if (res) {

                actualizaCacheStatico(STATIC_CACHE, event.request, APP_SHELL_INMUTABLE);
                return res;

            } else {

                return fetch(event.request).then(newRes => {

                    return actualizaCacheDinamico(DYNAMIC_CACHE, event.request, newRes);

                });
            }
        })
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    return response || fetch(event.request);
                })
                .catch(() => {
                    return caches.match('offline');
                })
        )
    }
});
// tareas asíncronas
self.addEventListener('sync', e => {

    console.log('SW: Sync', e.tag);

    if (e.tag === 'nuevo-post') {

        // postear a BD cuando hay conexión
        const respuesta = postearMensajes();

        e.waitUntil(respuesta);
    }

});
