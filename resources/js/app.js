import './bootstrap';
import Quill from 'quill';
import "quill/dist/quill.snow.css";

class App {
    constructor() {
        this.getElements();

        if (this.form) {
            this.setupQuill();
            this.setEvents();
        }
    }

    getElements() {
        this.form = document.querySelector('.app__form');
        this.tokenInput = this.form.querySelector('input[name="_token"]');
        this.csrfToken = this.tokenInput ? this.tokenInput.value : null;
    }

    setupQuill() {
        this.toolbarOptions = [['image', 'link']];

        this.options = {
            modules: {
                toolbar: {
                    container: this.toolbarOptions,
                    handlers: {
                        image: this.imageHandler.bind(this),
                    }
                },
            },
            theme: 'snow'
        };

        this.quill = new Quill('#editor', this.options);
    }

    imageHandler() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            try {
                const res = await fetch('/upload-image', {
                    method: 'POST',
                    headers: this.csrfToken ? { 'X-CSRF-TOKEN': this.csrfToken } : {},
                    body: formData,
                });

                if (!res.ok) {
                    const text = await res.text();
                    console.error('Upload failed', res.status, text);
                    alert('Image upload failed.');
                    return;
                }

                const data = await res.json();
                const range = this.quill.getSelection(true) || { index: 0 };
                this.quill.insertEmbed(range.index, 'image', data.url, 'user');
                this.quill.setSelection(range.index + 1);
            } catch (err) {
                console.error(err);
                alert('Image upload error.');
            }
        };
    }

    setEvents() {
        this.form.addEventListener('submit', this.onSubmit.bind(this));
    }

    async onSubmit(e) {
        e.preventDefault();

        const content = this.quill.root.innerHTML;

        try {
            const res = await fetch(this.form.getAttribute('action') || '/posts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    ...(this.csrfToken ? { 'X-CSRF-TOKEN': this.csrfToken } : {})
                },
                body: JSON.stringify({ post: content }),
            });

            if (res.ok) {
                window.location.reload();
            } else {
                console.error('Save failed', res.status, await res.text());
                alert('Error saving post.');
            }
        } catch (err) {
            console.error(err);
            alert('Network error while saving post.');
        }
    }
}

window.addEventListener('DOMContentLoaded', () => {
    new App();
});
