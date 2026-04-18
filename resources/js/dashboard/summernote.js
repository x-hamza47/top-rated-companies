$(".summernote").summernote({
    height: 250,
    placeholder: "Write about your company...",
    maxHeight: 600,
    minHeight: 100,
    toolbar: [
        ["style", ["style"]],
        ["style", ["bold", "italic", "underline", "clear"]],
        ["font", ["fontsize", "color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["insert", ["link"]],
        ["view", ["fullscreen", "help"]],
    ],
    callbacks: {
        onPaste: function (e) {
            var clipboardData = (e.originalEvent || e).clipboardData;
            if (clipboardData && clipboardData.items) {
                for (var i = 0; i < clipboardData.items.length; i++) {
                    if (clipboardData.items[i].type.indexOf("image") !== -1) {
                        e.preventDefault();
                        alert("Pasting images is not allowed.");
                        return false;
                    }
                }
            }
        },
        onImageUpload: function (files) {
            alert("Uploading images is not allowed.");
            return false;
        },
    },
});
