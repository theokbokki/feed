import './bootstrap';

class App {
    constructor() {
        this.files = [];

        this.form = document.getElementById('postForm');
        this.fileInput = document.getElementById('fileInput');
        this.addImageBtn = document.getElementById('addImageBtn');
        this.preview = document.getElementById('preview');

        if (!this.form) return;

        this.bindEvents();
    }

    bindEvents() {
        this.addImageBtn.addEventListener('click', () => {
            this.fileInput.click();
        });

        this.fileInput.addEventListener('change', () => {
            this.handleFiles();
        });

        this.form.addEventListener('submit', (e) => {
            this.handleSubmit(e);
        });
    }

    handleFiles() {
        if (!this.fileInput.files.length) return;

        for (const file of this.fileInput.files) {
            if (!file.type.startsWith('image/')) continue;

            this.files.push(file);
            this.renderThumbnail(file);
        }

        this.fileInput.value = '';
    }

    renderThumbnail(file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('thumb');

            img.addEventListener('click', () => {
                this.removeFile(file, img);
            });

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
            console.log('Post created');
        }
    }
}

window.addEventListener('DOMContentLoaded', () => {
    new App();
    document.querySelector('.posts__group:last-of-type .post:last-of-type')?.scrollIntoView();
});
