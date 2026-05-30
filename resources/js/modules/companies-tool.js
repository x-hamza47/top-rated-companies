export default class CompaniesTool {
    static get toolbox() {
        return {
            title: "Companies",
            icon: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                     <circle cx="9" cy="7" r="4"/>
                     <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                   </svg>`,
        };
    }

    constructor({ data }) {
        this.data = { items: data.items ?? [this._emptyItem()] };
        this.wrapper = null;
    }

    _emptyItem() {
        return {
            name: "",
            rating: "",
            employees: "",
            hourlyRate: "",
            projectRange: "",
            url: "",
        };
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
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <span style="font-size:11px;font-weight:800;color:var(--color-primary,#497d00);
                                 text-transform:uppercase;letter-spacing:0.08em;">Companies Block</span>
                </div>
                <button type="button" data-action="add" style="
                    display:inline-flex;align-items:center;gap:0.35rem;
                    font-size:12px;font-weight:600;
                    color:var(--color-primary,#497d00);
                    background:var(--color-primary-100,rgba(73,125,0,0.1));
                    border:1px solid var(--color-primary-200,rgba(73,125,0,0.2));
                    border-radius:8px;padding:0.35rem 0.75rem;cursor:pointer;
                    font-family:inherit;transition:0.2s ease;">
                    + Add Company
                </button>
            </div>

            <!-- Cards -->
            <div data-cards style="display:flex;flex-direction:column;">
                ${this.data.items.length === 0 ? this._emptyState() : this.data.items.map((item, i) => this._cardHTML(item, i)).join("")}
            </div>
        `;

        // Add button hover
        const addBtn = this.wrapper.querySelector('[data-action="add"]');
        addBtn.addEventListener("mouseenter", () => {
            addBtn.style.background = "var(--color-primary,#497d00)";
            addBtn.style.color = "white";
        });
        addBtn.addEventListener("mouseleave", () => {
            addBtn.style.background =
                "var(--color-primary-100,rgba(73,125,0,0.1))";
            addBtn.style.color = "var(--color-primary,#497d00)";
        });
        addBtn.addEventListener("click", () => {
            this.data.items.push(this._emptyItem());
            this._rebuild();
        });

        // Remove buttons
        this.wrapper
            .querySelectorAll('[data-action="remove"]')
            .forEach((btn) => {
                btn.addEventListener("click", () => {
                    this.data.items.splice(parseInt(btn.dataset.index), 1);
                    this._rebuild();
                });
            });

        // Sync inputs
        this.wrapper.querySelectorAll("[data-field]").forEach((input) => {
            input.addEventListener("focus", () => {
                input.style.borderColor = "var(--color-primary,#497d00)";
                input.style.boxShadow =
                    "0 0 0 3px var(--color-primary-100,rgba(73,125,0,0.1))";
            });
            input.addEventListener("blur", () => {
                input.style.borderColor = "var(--color-border,#e2e8f0)";
                input.style.boxShadow = "none";
            });
            input.addEventListener("input", () => {
                const i = parseInt(input.dataset.index);
                this.data.items[i][input.dataset.field] = input.value;
            });
        });
    }

    _emptyState() {
        return `
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;
                        padding:2rem;gap:0.5rem;color:var(--color-text-muted,#94a3b8);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" style="opacity:0.3;">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <p style="font-size:12px;font-weight:500;">No companies yet. Click "Add Company" to start.</p>
            </div>
        `;
    }

    _cardHTML(item, i) {
        const fields = [
            [
                {
                    key: "name",
                    label: "Company Name",
                    placeholder: "e.g. Acme Corp",
                },
                { key: "rating", label: "Rating", placeholder: "e.g. 4.9" },
            ],
            [
                {
                    key: "employees",
                    label: "Employees",
                    placeholder: "e.g. 50–249",
                },
                {
                    key: "hourlyRate",
                    label: "Hourly Rate",
                    placeholder: "e.g. $25–$49/hr",
                },
            ],
            [
                {
                    key: "projectRange",
                    label: "Project Range",
                    placeholder: "e.g. $10k–$50k",
                },
                {
                    key: "url",
                    label: "Profile URL",
                    placeholder: "https://...",
                },
            ],
        ];

        const inp = ({ key, label, placeholder }, value) => `
            <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.2rem;">
                <span style="font-size:9.5px;font-weight:700;color:var(--color-text-muted,#94a3b8);
                             text-transform:uppercase;letter-spacing:0.06em;padding-left:2px;">${label}</span>
                <input data-field="${key}" data-index="${i}" value="${this._esc(value)}"
                    placeholder="${placeholder}"
                    style="width:100%;border:1px solid var(--color-border,#e2e8f0);border-radius:8px;
                           padding:0.45rem 0.65rem;font-size:0.8rem;font-family:inherit;
                           background:var(--color-background,#fff);color:var(--color-text,#1e293b);
                           outline:none;transition:0.2s ease;">
            </div>
        `;

        return `
            <div style="padding:1rem 1.25rem;border-bottom:1px solid var(--color-border,#e2e8f0);">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                    <span style="font-size:10px;font-weight:700;color:var(--color-primary,#497d00);
                                 background:var(--color-primary-50,rgba(73,125,0,0.05));
                                 border:1px solid var(--color-primary-100,rgba(73,125,0,0.1));
                                 border-radius:5px;padding:0.15rem 0.5rem;
                                 text-transform:uppercase;letter-spacing:0.06em;">
                        Company ${i + 1}
                    </span>
                    <button type="button" data-action="remove" data-index="${i}"
                        style="display:inline-flex;align-items:center;gap:0.25rem;
                               font-size:11px;font-weight:600;color:#ef4444;
                               background:rgba(239,68,68,0.05);
                               border:1px solid rgba(239,68,68,0.15);
                               border-radius:6px;padding:0.2rem 0.5rem;cursor:pointer;
                               font-family:inherit;transition:0.2s ease;">
                        ✕ Remove
                    </button>
                </div>
                ${fields
                    .map(
                        (row) => `
                    <div style="display:flex;gap:0.625rem;flex-wrap:wrap;margin-bottom:0.5rem;">
                        ${row.map((f) => inp(f, item[f.key])).join("")}
                    </div>
                `,
                    )
                    .join("")}
            </div>
        `;
    }

    save() {
        return this.data;
    }

    validate(data) {
        return (
            Array.isArray(data.items) &&
            data.items.some((i) => i.name.trim() !== "")
        );
    }

    _esc(str) {
        return (str ?? "").replace(/"/g, "&quot;");
    }
}
