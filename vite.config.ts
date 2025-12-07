import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "web/dist",
    rollupOptions: {
      input: "web/js/main.ts",
      output: {
        entryFileNames: "main.min.js",
        format: "es",
      },
    },
  },
});
