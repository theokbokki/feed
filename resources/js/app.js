import './bootstrap';

class App {
    constructor() {
        this.init();
        this.getElements();

        if (!this.form) return;

        this.setEvents();
        this.scrollToBottom();
    }

    init() {
        this.files = [];
    }

    getElements() {
        this.form = document.getElementById('postForm');
        this.fileInput = document.getElementById('fileInput');
        this.addImageBtn = document.getElementById('addImageBtn');
        this.preview = document.getElementById('preview');
    }

    setEvents() {
        this.addImageBtn.addEventListener('click', () => this.fileInput.click());

        this.fileInput.addEventListener('change', this.handleFiles.bind(this));

        this.form.addEventListener('paste', this.handlePaste.bind(this));

        this.form.addEventListener('submit', this.handleSubmit.bind(this));
    }

    async handleFiles() {
        if (!this.fileInput.files.length) return;

        for (const file of this.fileInput.files) {
            if (!file.type.startsWith('image/')) continue;

            await this.processAndAddFile(file);
        }

        this.fileInput.value = '';
    }

    async handlePaste(e) {
        const items = e.clipboardData?.items;

        if (!items) return;

        for (const item of items) {
            if (item.type.startsWith('image/')) {
                e.preventDefault();

                const file = item.getAsFile();
                if (!file) continue;

                await this.processAndAddFile(file);
            }
        }
    }

    async processAndAddFile(file) {
        const optimized = await this.resizeImage(file, 480);

        if (this.files.some(f => f.name === optimized.name && f.size === optimized.size)) {
            return;
        }

        this.files.push(optimized);
        this.renderThumbnail(optimized);
    }

    resizeImage(file, maxWidth) {
        return new Promise((resolve) => {
            const img = new Image();
            const reader = new FileReader();

            reader.onload = (e) => img.src = e.target.result;

            img.onload = () => {
                const scale = Math.min(1, maxWidth / img.width);
                const width = Math.round(img.width * scale);
                const height = Math.round(img.height * scale);

                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob(
                    (blob) => {
                        const webpFile = new File(
                            [blob],
                            this.toWebpName(file.name),
                            { type: 'image/webp' }
                        );

                        resolve(webpFile);
                    },
                    'image/webp',
                    0.8
                );
            };

            reader.readAsDataURL(file);
        });
    }

    toWebpName(name) {
        return name.replace(/\.[^.]+$/, '') + '.webp';
    }

    renderThumbnail(file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('post__thumb');
            img.title = 'Click to remove';

            img.addEventListener('click', () => this.removeFile(file, img));

            this.preview.appendChild(img);
        };

        reader.readAsDataURL(file);
    }

    removeFile(file, img) {
        this.files = this.files.filter(f => f !== file);

        img.remove();
    }

    async handleSubmit(e) {
        e.preventDefault();

        const formData = new FormData(this.form);

        this.files.forEach(file => {
            formData.append('attachments[]', file);
        });

        const response = await fetch(this.form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (response.ok) {
            this.form.reset();
            this.files = [];
            this.preview.innerHTML = '';
            this.form.querySelector('textarea')?.focus();
            window.location.reload();
            this.scrollToBottom();
        }
    }

    scrollToBottom() {
        requestAnimationFrame(() => {
            window.scrollTo({
                top: document.documentElement.scrollHeight,
            });
        });
    }
}

window.addEventListener('DOMContentLoaded', () => {
    new App();
});
