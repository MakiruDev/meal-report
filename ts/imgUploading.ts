import * as VAR from "./_variables.js";


function showPreview(file: File | null): void {
    if (!file || !file.type.startsWith('image/')) return;
    const url = URL.createObjectURL(file);
    VAR.img.src = url;
    VAR.img.onload = () => URL.revokeObjectURL(url);
}

VAR.input?.addEventListener('change', (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0] || null;
    showPreview(file);
});

