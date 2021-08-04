const requireModule = require.context(".", false, /\.store\.js$/);
const modules = {};

requireModule.keys().forEach((filename) => {
    if (filename === "./index.js") return;
    const moduleName = filename
        .replace(/(\.\/|\.store\.js)/g, "")
        .replace(/^\w/, (c) => c.toUpperCase());
    modules[moduleName] =
        requireModule(filename).default || requireModule(filename);
});

export default modules;
