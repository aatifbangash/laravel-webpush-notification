initSW();

function initSW() {
    if (!"serviceWorker" in navigator) {
        //service worker isn't supported
        console.log('serviceWorker is not supported');
        return;
    }

    //don't use it here if you use service worker
    //for other stuff.
    if (!"PushManager" in window) {
        //push isn't supported
        console.log('push api is not supported');
        return;
    }

    //register the service worker
    navigator.serviceWorker.register('sw.js')
        .then(() => {
            console.log('serviceWorker installed!')
            initPush();
        })
        .catch((err) => {
            console.log(err)
        });
}

function initPush() {
    if (!navigator.serviceWorker.ready) {
        console.log('serviceWorker not activated!')
        return;
    }

    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    }).then((permissionResult) => {
        if (permissionResult !== 'granted') {
            throw new Error('We weren\'t granted permission.');
        }
        subscribeUser();
    });
}

function subscribeUser() {
    navigator.serviceWorker.ready
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    'BN3ckHqWmdrWgugkwMNnmj_ZCs764ahhao8JJVf9DLH8XRZwprynH3Fsjp5GIVjvqnS8U-p0DdMKpj_UJnLf7yA'
                )
            };

            return registration.pushManager.subscribe(subscribeOptions);
        }).then((pushSubscription) => {
        console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
        storePushSubscription(pushSubscription);
    });
}

function storePushSubscription(pushSubscription) {
    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    console.log(JSON.stringify(pushSubscription));
    fetch('push', {
        method: 'POST',
        body: JSON.stringify(pushSubscription),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token
        }
    })
        .then((res) => {
            return res.json();
        })
        .then((res) => {
            console.log(res)
        })
        .catch((err) => {
            console.log(err)
        });
}

function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
