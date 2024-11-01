async function encrypt(input) {
    const key = await window.crypto.subtle.generateKey(
        {name: "AES-GCM", length: 128},
        true, // extractable
        ["encrypt", "decrypt"],
    );

    const encrypted = await window.crypto.subtle.encrypt(
        {name: "AES-GCM", iv: new Uint8Array(12)},
        key,
        new TextEncoder().encode(input),
    );

    const objectKey = (await window.crypto.subtle.exportKey("jwk", key)).k;
    window.sessionStorage.setItem('objectKey', objectKey)

    const encryptedArray = new Uint8Array(encrypted);
    return btoa(String.fromCharCode(...encryptedArray))
}

function generateUrl() {
    const key = window.sessionStorage.getItem('objectKey');

    if (!key) {
        console.log('No objectKey found. Please create a new secret.');
        return;
    }

    return `#key=${key}`;
}

async function decrypt(input) {
    const objectKey = window.location.hash.slice("#key=".length);

    const key = await window.crypto.subtle.importKey(
        "jwk",
        {
            k: objectKey,
            alg: "A128GCM",
            ext: true,
            key_ops: ["encrypt", "decrypt"],
            kty: "oct",
        },
        {name: "AES-GCM", length: 128},
        false, // extractable
        ["decrypt"],
    );

    const encrypted = new Uint8Array(atob(input).split('').map(c => c.charCodeAt(0)));
    const decrypted = await window.crypto.subtle.decrypt(
        {name: "AES-GCM", iv: new Uint8Array(12)},
        key,
        encrypted,
    );
    return new window.TextDecoder().decode(new Uint8Array(decrypted));
}
