async function copyToClipboard(event, inputId) {
    const button = event.currentTarget;
    const input = document.getElementById(inputId).value;
    await navigator.clipboard.writeText(input);

    // Store the original SVG
    const originalSVG = button.innerHTML;

    // Replace with checkmark
    button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            `;

    // Revert back after delay
    setTimeout(() => {
        button.innerHTML = originalSVG;
    }, 1300);
}
