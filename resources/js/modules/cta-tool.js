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
            style: data.style ?? "primary",
        };
        this.wrapper = null;
    }

    render() {
        this.wrapper = document.createElement("div");
        this.wrapper.style.cssText = `
            border: 2px dashed #6366f1; border-radius: 12px;
            padding: 1.25rem; display: flex; flex-direction: column;
            gap: 0.75rem; background: #f5f3ff; font-family: inherit;
        `;

        this.wrapper.innerHTML = `
            <label style="font-size:11px;font-weight:800;color:#6366f1;text-transform:uppercase;letter-spacing:.06em;">
                📣 CTA Block
            </label>

            <input data-field="title" placeholder="Heading (e.g. Ready to get started?)"
                value="${this._esc(this.data.title)}"
                style="${this._inp("1rem", "700")}">

            <input data-field="subtitle" placeholder="Supporting text (optional)"
                value="${this._esc(this.data.subtitle)}"
                style="${this._inp()}">

            <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                <input data-field="buttonText" placeholder="Button label"
                    value="${this._esc(this.data.buttonText)}"
                    style="${this._inp("0.85rem", "600", true)}">
                <input data-field="buttonUrl" placeholder="https://..."
                    value="${this._esc(this.data.buttonUrl)}"
                    style="${this._inp("0.85rem", "400", true)}">
            </div>

            <div style="display:flex;gap:0.5rem;align-items:center;">
                <label style="font-size:12px;font-weight:600;color:#374151;">Style:</label>
                <select data-field="style"
                    style="border:1px solid #d1d5db;border-radius:6px;padding:0.3rem 0.6rem;
                           font-size:0.8rem;background:#fff;outline:none;">
                    <option value="primary"  ${this.data.style === "primary" ? "selected" : ""}>Primary</option>
                    <option value="gradient" ${this.data.style === "gradient" ? "selected" : ""}>Gradient</option>
                    <option value="minimal"  ${this.data.style === "minimal" ? "selected" : ""}>Minimal</option>
                </select>
            </div>
        `;

        this.wrapper.querySelectorAll("[data-field]").forEach((el) => {
            el.addEventListener("input", (e) => {
                this.data[e.target.dataset.field] = e.target.value;
            });
        });

        return this.wrapper;
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
    _inp(size = "0.85rem", weight = "400", half = false) {
        return `flex:1;${half ? "min-width:120px;" : "width:100%;"}border:1px solid #d1d5db;
                border-radius:8px;padding:0.5rem 0.75rem;font-size:${size};font-weight:${weight};
                font-family:inherit;background:#fff;outline:none;`;
    }
}
