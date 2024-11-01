async function encrypt(input) {
    console.log('Encrypting:', input);
    // Generate a random key
    const key = await window.crypto.subtle.generateKey(
        {
            name: "AES-GCM",
            length: 256,
        },
        true, // extractable
        ["encrypt", "decrypt"]
    );

    // Generate a random IV (12 bytes for AES-GCM)
    const iv = window.crypto.getRandomValues(new Uint8Array(12));

    // Convert secretContent to a Uint8Array
    const encoder = new TextEncoder();
    const data = encoder.encode(input);

    // Encrypt the data
    const encryptedContent = await window.crypto.subtle.encrypt(
        {
            name: "AES-GCM",
            iv: iv,
        },
        key,
        data
    );

    // Convert the encrypted content to Base64
    const encryptedArray = new Uint8Array(encryptedContent);
    const encryptedBase64 = btoa(String.fromCharCode(...encryptedArray));

    // Store the key and IV in sessionStorage in Base64 format
    const exportedKey = await window.crypto.subtle.exportKey("raw", key);
    const key_b64 = btoa(String.fromCharCode(...new Uint8Array(exportedKey)));
    const iv_b64 = btoa(String.fromCharCode(...iv));

    window.sessionStorage.setItem('key', key_b64);
    window.sessionStorage.setItem('iv', iv_b64);

    // Return the Base64 encoded encrypted value
    return encryptedBase64;
}

function generateUrl() {
    const key = window.sessionStorage.getItem('key');
    const iv = window.sessionStorage.getItem('iv');

    if (!key || !iv) {
        console.log('No key or iv found. Please create a new secret.');
        return;
    }

    return '#' + btoa(`key=${key}&iv=${iv}`);
}

async function decryptContent(content) {
    const hash_b64 = window.location.hash.substring(1); // Remove the `#` character
    const hash = atob(hash_b64);

    const params = new URLSearchParams(hash);

    const key_b64 = params.get('key');
    const iv_b64 = params.get('iv');

    console.log(key_b64)

    if (!key_b64 || !iv_b64) {
        console.error("Missing required parameters in the hash fragment.");
        return;
    }

    // Decode Base64 strings back to byte arrays
    const encryptedArray = new Uint8Array(atob(content).split("").map(char => char.charCodeAt(0)));
    const keyArray = new Uint8Array(atob(key_b64).split("").map(char => char.charCodeAt(0)));
    const ivArray = new Uint8Array(atob(iv_b64).split("").map(char => char.charCodeAt(0)));

    // Import the key
    const key = await window.crypto.subtle.importKey(
        "raw",
        keyArray,
        {
            name: "AES-GCM",
        },
        false,
        ["decrypt"]
    );

    // Decrypt the data
    try {
        const decryptedContent = await window.crypto.subtle.decrypt(
            {
                name: "AES-GCM",
                iv: ivArray,
            },
            key,
            encryptedArray
        );

        // Convert decrypted content back to a string
        const decoder = new TextDecoder();
        return decoder.decode(decryptedContent);

    } catch (error) {
        console.error("Decryption failed:", error);
    }
}
