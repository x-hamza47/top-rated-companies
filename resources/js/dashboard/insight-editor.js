import CompaniesTool from "../modules/companies-tool";
import CtaTool from "../modules/cta-tool";

export function initInsightEditor({
    uploadImageRoute,
    getSlugRoute,
    deleteTempImageRoute,
    existingData,
    isAdmin,
}) {
    const uploadedImages = new Set();

    const editor = new EditorJS({
        holder: "editorjs",
        placeholder: "Start writing your post...",
        tools: {
            header: {
                class: Header,
                config: { levels: [2, 3, 4], defaultLevel: 2 },
            },
            list: { class: EditorjsList, inlineToolbar: true },
            companies: { class: CompaniesTool },
            cta: { class: CtaTool },
            quote: Quote,
            code: CodeTool,
            delimiter: Delimiter,
            raw: RawTool,
            warning: {
                class: Warning,
                inlineToolbar: true,
                config: {
                    titlePlaceholder: "Title",
                    messagePlaceholder: "Message",
                },
            },
            table: {
                class: Table,
                inlineToolbar: true,
                config: { rows: 2, cols: 2, withHeadings: true },
            },
            inlineCode: { class: InlineCode },
            image: {
                class: ImageTool,
                config: {
                    endpoints: { byFile: uploadImageRoute },
                    additionalRequestHeaders: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]',
                        ).content,
                    },
                },
            },
        },
        data: existingData ?? undefined,
    });

    // Track uploaded images via XHR intercept
    const originalOpen = XMLHttpRequest.prototype.open;
    const originalSend = XMLHttpRequest.prototype.send;

    XMLHttpRequest.prototype.open = function (method, url, ...rest) {
        this._url = url;
        return originalOpen.call(this, method, url, ...rest);
    };

    XMLHttpRequest.prototype.send = function (...args) {
        this.addEventListener("load", function () {
            try {
                if (this._url?.includes("upload-image")) {
                    const data = JSON.parse(this.responseText);
                    if (data.success && data.file?.filename)
                        uploadedImages.add(data.file.filename);
                }
            } catch (e) {}
        });
        return originalSend.apply(this, args);
    };

    async function syncImageCleanup() {
        const data = await editor.save();
        const usedImages = new Set(
            data.blocks
                .filter((b) => b.type === "image")
                .map((b) => b.data?.file?.url?.split("/").pop())
                .filter(Boolean),
        );

        for (const filename of [...uploadedImages].filter(
            (f) => !usedImages.has(f),
        )) {
            try {
                await axios.delete(deleteTempImageRoute, {
                    data: { filename },
                });
            } catch (err) {
                console.error("Delete failed:", err);
            }
            uploadedImages.delete(filename);
        }
    }

    window.submitPost = async function () {
        try {
            const output = await editor.save();
            const title = document
                .querySelector('input[name="title"]')
                .value.trim();
            const errors = [];

            if (!title) errors.push("Post title is required.");
            if (!output.blocks?.length)
                errors.push("Post content cannot be empty.");

            if (errors.length > 0) {
                await Swal.fire({
                    icon: "warning",
                    title: "Hold on!",
                    html: errors
                        .map((e) => `<p class="text-sm text-gray-600">${e}</p>`)
                        .join(""),
                    confirmButtonText: "Got it",
                    confirmButtonColor: "#010521",
                });
                return;
            }

            document.getElementById("content_json").value =
                JSON.stringify(output);
            await syncImageCleanup();
            document.getElementById("post-form").submit();
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Something went wrong",
                text: "Failed to save editor content.",
                confirmButtonColor: "#010521",
            });
        }
    };

    // Thumbnail preview
    const thumbInput = document.getElementById("thumbnail");
    const thumbPreview = document.getElementById("thumb-preview");
    const thumbLabel = document.getElementById("thumb-label");

    thumbInput?.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;
        thumbLabel.textContent = file.name;
        const reader = new FileReader();
        reader.onload = (e) => {
            thumbPreview.src = e.target.result;
            thumbPreview.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    });

    // Slug auto-generation (admin only)
    if (isAdmin && getSlugRoute) {
        document
            .querySelector('input[name="title"]')
            ?.addEventListener("change", function () {
                const slugInput = document.querySelector('input[name="slug"]');
                if (!this.value.trim() || !slugInput) return;

                const btn = document.querySelector("button[type=button]");
                btn.disabled = true;

                fetch(
                    `${getSlugRoute}?name=${encodeURIComponent(this.value.trim())}`,
                )
                    .then((r) => r.json())
                    .then((res) => {
                        if (res.status) slugInput.value = res.slug;
                    })
                    .finally(() => {
                        btn.disabled = false;
                    });
            });
    }
}
