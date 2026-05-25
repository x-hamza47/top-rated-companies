<div id="serviceSelectorOverlay" style="display: none" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 ">
    <div class="service-selector-container bg-(--color-background) rounded-2xl shadow-xl w-full max-w-2xl p-6 fixed top-1/2 left-1/2  -translate-1/2">
        <!-- Close Button -->
        <button id="closeServiceSelector" type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>

        <h3 class="text-2xl font-semibold mb-4">Add Services</h3>

        <!-- Search Box -->
        <input type="text" id="serviceSearch" placeholder="Search services..."
            class="w-full p-3 mb-4 border border-(--color-border) rounded-lg focus:ring-2 focus:ring-(--color-primary) outline-none">

        <div id="serviceAccordion" class="space-y-2 max-h-96 overflow-y-auto">
            @foreach ($categories as $category)
                <div class="category-accordion border border-(--color-border) rounded-lg overflow-hidden">

                    <button type="button"
                        class="accordion-header w-full flex justify-between items-center px-4 py-3 bg-(--color-surface) hover:bg-(--color-surface-hover) transition font-medium text-left">
                        <span>{{ $category->name }}</span>
                        <span class="accordion-icon text-(--color-primary) text-lg">+</span>
                    </button>

                    <div class="accordion-content hidden bg-(--color-background)">
                        @foreach ($category->services as $service)
                            <div class="service-item flex justify-between items-center px-4 py-2 cursor-pointer hover:bg-(--color-secondary) rounded"
                                data-id="{{ $service->id }}" data-name="{{ $service->name }}">
                                <span>{{ $service->name }}</span>
                                <button type="button"
                                    class="add-service-btn text-sm text-lime-500 hover:text-lime-700 font-medium">Add</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
