require("./bootstrap");
const feather = require("feather-icons");
feather.replace({
    "aria-hidden": "true",
});

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
