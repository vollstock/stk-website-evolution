const detectPlatform = () => {
    const userAgent = navigator.userAgent || '';
    const platformHint = [
        navigator.userAgentData?.platform,
        navigator.platform,
        navigator.appVersion,
        userAgent,
    ].filter(Boolean).join(' ').toLowerCase();

    return /iphone|ipad|ipod|ios/.test(platformHint) ? 'iOS'
        : /android/.test(platformHint) ? 'Android'
            : /windows|win32|win64/.test(platformHint) ? 'Windows'
                : /macintosh|mac os x|mac_powerpc|darwin/.test(platformHint) ? 'macOS'
                    : /nintendo|switch|nx/.test(platformHint) ? 'Nintendo Switch'
                        : /linux/.test(platformHint) ? 'Linux' : 'Other';
};

const detectArchitecture = () => {
    const architectureHint = [
        navigator.userAgentData?.architecture,
        navigator.platform,
        navigator.userAgent || '',
    ].filter(Boolean).join(' ').toLowerCase();

    return /aarch64|arm64/.test(architectureHint) ? 'ARM 64-bit'
        : /armv7|armv7l/.test(architectureHint) ? 'ARM 32-bit'
            : /x86_64|x64|amd64/.test(architectureHint) ? 'Intel / AMD 64-bit'
                : /i686|i386|x86/.test(architectureHint) ? 'Intel / AMD 32-bit'
                    : /riscv64/.test(architectureHint) ? 'RISC-V 64-bit' : '';
};

const chooseDownload = (box) => {
    const options = [...box.querySelectorAll('[data-download-option]')];
    const platform = detectPlatform();
    const architecture = detectArchitecture();
    const platformOptions = options.filter((option) => option.dataset.platform === platform);
    const selected = platformOptions.find((option) => option.dataset.architecture === architecture)
        || platformOptions[0]
        || options[0];

    if (!selected) return;

    const isIos = platform === 'iOS';
    const isAndroid = platform === 'Android';
    box.classList.toggle('bg-white', !isIos && !isAndroid);
    box.classList.toggle('shadow', !isIos && !isAndroid);
    box.classList.toggle('px-6', !isIos && !isAndroid);
    box.querySelector('[data-desktop-download]')?.classList.toggle('hidden', isIos || isAndroid);
    box.querySelector('[data-release-meta]')?.classList.toggle('hidden', isIos || isAndroid);
    box.querySelector('[data-ios-badge]')?.classList.toggle('hidden', !isIos);
    box.querySelector('[data-android-badge]')?.classList.toggle('hidden', !isAndroid);

    const downloadLink = box.querySelector('[data-download-link]');
    const selectedArchitecture = box.querySelector('[data-selected-architecture]');
    if (downloadLink) downloadLink.href = selected.dataset.url;
    if (selectedArchitecture) selectedArchitecture.textContent = selected.dataset.architecture || '';
};

document.querySelectorAll('[data-download-box]').forEach((box) => {
    chooseDownload(box);
    box.querySelectorAll('[data-download-option]').forEach((option) => {
        option.addEventListener('click', () => {
            const downloadLink = box.querySelector('[data-download-link]');
            const selectedArchitecture = box.querySelector('[data-selected-architecture]');
            if (downloadLink) downloadLink.href = option.dataset.url;
            if (selectedArchitecture) selectedArchitecture.textContent = option.dataset.architecture || '';
        });
    });
});