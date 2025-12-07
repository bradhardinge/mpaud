//console.log("Hello World: 1.0.0");

// Import Alpine.js
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

// import listbox from '@alpinejs/listbox';

// Declare Alpine as a global property
declare global {
  interface Window {
    Alpine: typeof Alpine;
  }
}

// Set Alpine.js as a global variable
window.Alpine = Alpine;

// Register Alpine.js plugins
Alpine.plugin(focus);

// Start Alpine.js
Alpine.start();
