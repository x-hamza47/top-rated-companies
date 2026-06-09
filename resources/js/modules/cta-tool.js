export default class CtaTool {
    static get toolbox() {
        return {
            title: "CTA",
            icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <rect x="2" y="7" width="20" height="10" rx="3"/>
                     <path d="M8 12h8M14 9l3 3-3 3"/>
                   </svg>`,
        };
    }

    constructor({ data }) {
        this.data = {
            title: data.title ?? "",
            subtitle: data.subtitle ?? "",
            buttonText: data.buttonText ?? "Get Started",
            buttonUrl: data.buttonUrl ?? "",
            button2Text: data.button2Text ?? "",
            button2Url: data.button2Url ?? "",
            style: data.style ?? "primary",
        };
        this.wrapper = null;
    }

    render() {
        this.wrapper = document.createElement("div");
        this.wrapper.style.cssText = `
            font-family: var(--font-primary, 'Poppins', sans-serif);
            background: var(--color-background, #fff);
            border: 1.5px solid var(--color-border, #e2e8f0);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        `;
        this._rebuild();
        return this.wrapper;
    }

    _rebuild() {
        const styleOptions = [
            { value: "primary", label: "Primary (Dark bg)" },
            { value: "gradient", label: "Gradient" },
            { value: "minimal", label: "Minimal (Border)" },
        ];

        const selOpts = styleOptions
            .map(
                (o) =>
                    `<option value="${o.value}" ${this.data.style === o.value ? "selected" : ""}>${o.label}</option>`,
            )
            .join("");

        this.wrapper.innerHTML = `
            <!-- Header -->
            <div style="display:flex;align-items:center;justify-content:space-between;
                        padding:0.875rem 1.25rem;
                        background:var(--color-primary-50,rgba(73,125,0,0.05));
                        border-bottom:1px solid var(--color-primary-100,rgba(73,125,0,0.1));">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:28px;height:28px;background:var(--color-primary,#497d00);
                                border-radius:7px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                            <rect x="2" y="7" width="20" height="10" rx="3"/>
                            <path d="M8 12h8M14 9l3 3-3 3"/>
                        </svg>
                    </div>
                    <span style="font-size:11px;font-weight:800;color:var(--color-primary,#497d00);
                                 text-transform:uppercase;letter-spacing:0.08em;">CTA Block</span>
                </div>
                <select data-field="style"
                    style="font-size:11px;font-weight:600;
                           color:var(--color-primary,#497d00);
                           background:var(--color-primary-100,rgba(73,125,0,0.1));
                           border:1px solid var(--color-primary-200,rgba(73,125,0,0.2));
                           border-radius:8px;padding:0.3rem 0.65rem;cursor:pointer;
                           font-family:inherit;outline:none;">
                    ${selOpts}
                </select>
            </div>

            <!-- Fields -->
            <div style="padding:1rem 1.25rem;display:flex;flex-direction:column;gap:0.6rem;">

                <!-- Title -->
                <div style="display:flex;flex-direction:column;gap:0.2rem;">
                    <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                 text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Heading</span>
                    <input data-field="title" value="${this._esc(this.data.title)}"
                        placeholder="Ready to find your next tech partner?"
                        style="${this._inp("1rem", "700")}">
                </div>

                <!-- Subtitle -->
                <div style="display:flex;flex-direction:column;gap:0.2rem;">
                    <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                 text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Supporting text (optional)</span>
                    <input data-field="subtitle" value="${this._esc(this.data.subtitle)}"
                        placeholder="Describe the value proposition..."
                        style="${this._inp()}">
                </div>

                <!-- Button 1 -->
                <div style="display:flex;gap:0.625rem;flex-wrap:wrap;">
                    <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.2rem;">
                        <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                     text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Button 1 Label</span>
                        <input data-field="buttonText" value="${this._esc(this.data.buttonText)}"
                            placeholder="Hire a Company"
                            style="${this._inp()}">
                    </div>
                    <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.2rem;">
                        <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                     text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Button 1 URL</span>
                        <input data-field="buttonUrl" value="${this._esc(this.data.buttonUrl)}"
                            placeholder="https://..."
                            style="${this._inp()}">
                    </div>
                </div>

                <!-- Button 2 (optional) -->
                <div style="display:flex;gap:0.625rem;flex-wrap:wrap;">
                    <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.2rem;">
                        <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                     text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Button 2 Label (optional)</span>
                        <input data-field="button2Text" value="${this._esc(this.data.button2Text)}"
                            placeholder="List your Company"
                            style="${this._inp()}">
                    </div>
                    <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.2rem;">
                        <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                                     text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">Button 2 URL (optional)</span>
                        <input data-field="button2Url" value="${this._esc(this.data.button2Url)}"
                            placeholder="https://..."
                            style="${this._inp()}">
                    </div>
                </div>

            </div>
        `;

        // Sync all inputs + select
        this.wrapper.querySelectorAll("[data-field]").forEach((el) => {
            el.addEventListener("focus", () => {
                if (el.tagName === "INPUT") {
                    el.style.borderColor = "var(--color-primary,#497d00)";
                    el.style.boxShadow =
                        "0 0 0 3px var(--color-primary-100,rgba(73,125,0,0.1))";
                }
            });
            el.addEventListener("blur", () => {
                if (el.tagName === "INPUT") {
                    el.style.borderColor = "var(--color-border,#e2e8f0)";
                    el.style.boxShadow = "none";
                }
            });
            el.addEventListener("input", () => {
                this.data[el.dataset.field] = el.value;
            });
            el.addEventListener("change", () => {
                this.data[el.dataset.field] = el.value;
            });
        });
    }

    save() {
        return this.data;
    }

    validate(data) {
        return data.title.trim() !== "" || data.buttonText.trim() !== "";
    }

    _esc(str) {
        return (str ?? "").replace(/"/g, "&quot;");
    }

    _inp(size = "0.8rem", weight = "400") {
        return `width:100%;border:1px solid var(--color-border,#e2e8f0);border-radius:8px;
                padding:0.45rem 0.65rem;font-size:${size};font-weight:${weight};font-family:inherit;
                background:var(--color-background,#fff);color:var(--color-text,#1e293b);
                outline:none;transition:0.2s ease;box-sizing:border-box;`;
    }
}
