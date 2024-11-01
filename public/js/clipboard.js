async function copyToClipboard(contentId, copyBtnId) {
    const secret = document.getElementById(contentId);
    const copyBtn = document.getElementById(copyBtnId);
    await navigator.clipboard.writeText(secret.value)
    copyBtn.textContent = 'Copied!';
    setTimeout(() => {
        copyBtn.textContent = 'Copy';
    }, 2000);
}
